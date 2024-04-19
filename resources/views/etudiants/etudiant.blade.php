@extends('index', ['titre' => 'Liste des étudiants'])

@section('contenu')
<div class="container mt-4">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Liste des Etudiants</h1>
   <div>
    <a href="{{ route('etudiant.genere') }}" type="button" class="btn btn-primary">Générer les données des étudiants
    </a>
    <a href="{{ route('etudiant.index') }}" data-toggle="tooltip" data-placement="bottom" title="Actualiser les données des étudiants" class="btn btn-warning text-white" type="button" ><i class="fa fa-refresh"></i></a>
    <a href="{{ route('etudiant.create') }}" data-toggle="tooltip" data-placement="bottom" title="Créer un nouveau étudiant" class="btn btn-success" type="button" ><i class="fa fa-plus"></i></a>
  {{-- button exportation des données en pdf --}}
    <a href="{{ route('etudiant.exportPdf') }}" data-toggle="tooltip" data-placement="bottom" title="Exportation des données en PDF" class="btn btn-info" type="button" ><i class="fa fa-file-pdf-o"></i></a>
    {{-- button envoyer email par pdf --}}
    <a href="{{ route('page.email') }}" data-toggle="tooltip" data-placement="bottom" title="Envoyer un PDF par email" class="btn btn-secondary" type="button" ><i class="fa fa-envelope"></i></a>
   </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <form action="{{ route('etudiant.search') }}" method="GET" class="form-inline mb-3">
        <div class="input-group">
            <input class="form-control" type="search" placeholder="Rechercher" aria-label="Rechercher" name="query" style="width: 200px;">
            <div class="input-group-append">
                <button class="btn btn-outline-success" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
    
    </div>
  </div>
  <div class="row">
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Prénom</th>
                    <th scope="col">Promotion</th>
                    <th scope="col">Genre</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($etudiants as $etudiant)
                <tr>
                    <th scope="row">{{ $etudiant->id 
                    }}</th>
                    <td>{{ $etudiant->nom }}</td>
                    <td>{{ $etudiant->prenom ?? '-' }}</td>
                    <td>{{ $etudiant->promotion }}</td>
                    <td>{{ $etudiant->genre }}</td>
                    <td class="text-center">
                        <!-- Boutons d'action -->
                        <a href="{{ route('etudiant.edit', ['id' => $etudiant->id]) }}" type="button" class="btn btn-primary"><i class="fa fa-edit"></i></a>

                        <form action="{{ route('etudiant.delete',['id' => $etudiant->id ]) }}"  class="d-inline" method="POST">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                      </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
      <!-- Pagination -->
          <!-- Pagination -->
          <div class="d-flex justify-content-center align-items-center">
      {{ $etudiants->links() }}
  </div>
  </div>

</div>
@endsection
