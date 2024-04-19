<?php

namespace App\Http\Controllers\API;

use App\Models\Etudiant;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\EtudiantRequest;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $etudiant = Etudiant::all();
        return response()->json([
            'etudiant' => $etudiant
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

         $validator = Validator::make($request->all(), [
            'nom' => 'required|string|max:255',
            'prenom' => 'nullable|string',
            'promotion' => 'required|string',
            'genre' => 'required|in:Homme,Femme,Autres'
        ]);        

        if($validator->fails()){
            
            return response()->json([
                'errors' => $validator->messages(),
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);

        }else{   
        
            $nom = $request->nom;
            $prenom = $request->prenom;
            $promotion = $request->promotion;
            $genre = $request->genre;

            Etudiant::create([
                'nom' => $nom,
                'prenom' => $prenom,
                'promotion' => $promotion,
                'genre' => $genre
            ]);
            return response()->json([
                'message' => 'Enregistrement réussi!'
             ], 200);
        }
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Vérifions si id_etudiant existe dans la base de données
        $verifcation_id = Etudiant::where('id', $id)->exists();

        if($verifcation_id){
            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'prenom' => 'nullable|string',
                'promotion' => 'required|string',
                'genre' => 'required|in:Homme,Femme,Autres'
            ]);        
    
            if($validator->fails()){
                
                return response()->json([
                    'errors' => $validator->messages(),
                ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
    
            }else{   
            
                // Récupérer l'étudiant qu'on veut modifier
                $update_etudiant = Etudiant::where('id', $id)->first();

                $nom = $request->nom;
                $prenom = $request->prenom;
                $promotion = $request->promotion;
                $genre = $request->genre;
    
                $update_etudiant->update([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'promotion' => $promotion,
                    'genre' => $genre
                ]);
                return response()->json([
                    'message' => 'Modification réussi!'
                 ], 200);
            }
        }else{
            return response()->json([
                'message' => 'Cet idenfiant étudiant n\'existe pas dans la base de données!'
            ], 404);
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
            return response()->json([
                'message' => 'Suppression réussi'
            ], 200);

        }else{
           
            return response()->json([
                'message' => 'Cet idenfiant étudiant n\'existe pas dans la base de données!'
            ], 404);

        }
    }
}
