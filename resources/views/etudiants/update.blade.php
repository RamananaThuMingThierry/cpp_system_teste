@extends('index', ['titre' => 'Créer un étudiant'])

@section('contenu')
  <div class="container mt-4">
   <div class="card elevation-1 rounded-0 p-3">
    <h1 class="text-center">Modifier un étudiant</h1>
    <form action="{{ route('etudiant.update', ['id' => $etudiant->id]) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mt-3">
            <label for="nom">Nom</label>
            <input type="text" value="{{ old('nom',$etudiant->nom) }}" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" placeholder="Entrez le nom de l'étudiant" autofocus>
            @error('nom')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-group mt-3">
            <label for="prenom">Prénom</label>
            <input type="text" class="form-control"  value="{{ old('prenom', $etudiant->prenom) }}"  id="prenom" name="prenom" placeholder="Entrez le prénom de l'étudiant">
        </div>
        <div class="form-group mt-3">
            <label for="promotion">Promotion</label>
            <input type="text"  value="{{ old('promotion', $etudiant->promotion) }}" class="form-control @error('promotion') is-invalid @enderror" id="promotion" name="promotion" placeholder="Entrez la promotion de l'étudiant">
            @error('promotion')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>
        <div class="form-group mt-3">
            <label for="genre">Genre</label>
            <select class="form-control" id="genre" name="genre">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
                <option value="Autres">Autres</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Modifier</button>
    </form>
   </div>
  </div>
@endsection