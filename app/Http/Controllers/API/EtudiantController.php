<?php

namespace App\Http\Controllers\API;

use Dompdf\Dompdf;
use App\Mail\SendPDF;
use App\Models\Etudiant;
use Faker\Factory as Faker;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use App\Http\Requests\EtudiantRequest;

class EtudiantController extends Controller
{

    public function page_email(){
        return view('etudiants.send_email_pdf');
    }

    public function sendEmail(Request $request)
    {
        $pdfFile = $request->file('pdf_file');
        
        // Vérifiez si un fichier a été téléchargé
        if ($pdfFile) {
            // Envoyez l'email avec le fichier PDF en pièce jointe
            Mail::to('ramananathumingthierry@gmail.com')->send(new SendPDF($pdfFile));

            // Rediriger avec un message de succès
            return redirect()->route('etudiant.index')->with('success', 'Email envoyé avec succès!');
        
        } else {
            // Rediriger avec un message d'erreur si aucun fichier n'a été téléchargé
            return redirect()->back()->with('error', 'Veuillez sélectionner un fichier PDF à envoyer.');
        }
        
    }
    
    public function genereLaListeDesEtudiants()
    {
        $faker = Faker::create('fr_FR'); // Utilisez le local français pour générer des noms, prénoms, etc. français

        for ($i = 0; $i < 50; $i++) { // Générer 10 étudiants
            Etudiant::create([
                'nom' => $faker->lastName,
                'prenom' => $faker->firstName,
                'promotion' => $faker->randomElement(['Licence', 'Master 1', 'Master 2']),
                'genre' => $faker->randomElement(['Homme', 'Femme', 'Autres']),
            ]);
        }

        return redirect()->route('etudiant.index')->with('success', 'Données des étudiants générées avec succès!');
    }

    public function exportPDF()
    {
        $etudiants = Etudiant::all(); // Supposons que vous récupérez les étudiants depuis votre modèle Etudiant
        $pdf = new Dompdf();
        $pdf->loadHtml(View::make('etudiants.pdf_etudiant', ['etudiants' => $etudiants])->render());
        $pdf->setPaper('A4', 'landscape'); // Pour définir l'orientation du papier en mode paysage
        $pdf->render();
        return $pdf->stream(); 
        // Pour afficher le PDF dans le navigateur
        // Ou bien, vous pouvez enregistrer le PDF sur le serveur en utilisant :
        // return $pdf->save(storage_path('app/etudiants.pdf'));

    }
    
    public function search(Request $request)
    {
        $query = $request->input('query');
        $etudiants = Etudiant::where('nom', 'LIKE', "%$query%")
            ->orWhere('prenom', 'LIKE', "%$query%")
            ->paginate(10);

        return view('etudiants.etudiant', compact('etudiants'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiants = Etudiant::Paginate(10);
        // return response()->json([
        //     'etudiants' => $etudiants
        // ], 200);
        
        $nombre = $etudiants->count();

        return view('etudiants.etudiant', compact('etudiants','nombre'));
    }

    public function create(){
        return view('etudiants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EtudiantRequest $request)
    {

        $etudiant = new Etudiant();
        $etudiant->nom = $request->input('nom');
        $etudiant->prenom = $request->input('prenom');
        $etudiant->promotion = $request->input('promotion');
        $etudiant->genre = $request->input('genre');
        $etudiant->save();

        return redirect()->route('etudiant.index')->with('success', 'Enregistrement réuissi!');
       
        //     return response()->json([
        //         'message' => 'Enregistrement réussi!'
        //      ], 200);
        // }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        // Vérifions si id_etudiant existe dans la base de données
        $verifcation_id = Etudiant::where('id', $id)->exists();

        if($verifcation_id){
          
            // Récupérer l'étudiant qui a cet id
            $etudiant = Etudiant::where('id', $id)->first();
          
            // Retourne le données en json
            return response()->json([
                'etudiant' => $etudiant
            ], 200);

        }else{
           
            return response()->json([
                'message' => 'Cet idenfiant étudiant n\'existe pas dans la base de données!'
            ], 404);

        }
    }


    public function edit(String $id){
         // Vérifions si id_etudiant existe dans la base de données
         $verifcation_id = Etudiant::where('id', $id)->exists();

         if($verifcation_id){
           
             // Récupérer l'étudiant qui a cet id
             $etudiant = Etudiant::where('id', $id)->first();
           
             // Retourne le données en json
             return view("etudiants.update", compact('etudiant'));
 
         }else{
            
             return response()->json([
                 'message' => 'Cet idenfiant étudiant n\'existe pas dans la base de données!'
             ], 404);
 
         }
        return view('etudiants.update', compact('etudiant'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(EtudiantRequest $request, string $id)
    {
        // Vérifions si id_etudiant existe dans la base de données
        $verifcation_id = Etudiant::where('id', $id)->exists();

        if($verifcation_id){
            
            $etudiant = Etudiant::find($id);

            $etudiant->nom = $request->input('nom');
            $etudiant->prenom = $request->input('prenom');
            $etudiant->promotion = $request->input('promotion');
            $etudiant->genre = $request->input('genre');
            $etudiant->save();
            return redirect()->route('etudiant.index')->with('success', 'Modification réuissi!');
        }else{
            return redirect()->route('etudiant.index')->with('warning', 'Cet idenfiant étudiant n\'existe pas dans la base de données!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Vérifiions si id étudiant existe dans la base de données
        $verifcation_id = Etudiant::where('id', $id)->exists();

        if($verifcation_id){
          
            // Récupérer l'étudiant qui a cet id
            $etudiant = Etudiant::where('id', $id)->first();
          
            $etudiant->delete();

            // Retourne le données en json
            return redirect()->route('etudiant.index')->with('success', 'Suppression réuissi!');
        }else{
            return redirect()->route('etudiant.index')->with('warning', 'Cet idenfiant étudiant n\'existe pas dans la base de données!');
        }
    }
}
