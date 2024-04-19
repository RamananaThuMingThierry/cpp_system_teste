@extends('index', ['titre' => 'Envoyer un pdf par email'])

@section('contenu')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-offset-3">
      <div class="card">
        <form action="{{ route('send.email') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group">
              <label for="pdf_file">Sélectionner le fichier PDF à envoyer :</label>
              <input type="file" class="form-control-file" id="pdf_file" name="pdf_file">
          </div>
          <button type="submit" class="btn btn-primary">Envoyer par email</button>
        </form>
        
      </div>
    </div>
  </div>
</div>
@endsection