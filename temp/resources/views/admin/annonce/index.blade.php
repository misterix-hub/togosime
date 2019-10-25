@extends('templates/adminTemplate')

@section('indexAdmin')
    
    <div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Annonces</span>
        </nav>

        <span class="font-weight-bold">Annonces</span><br /><br />

        @if($message = Session::get('message'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{$message}}</strong> 
            </div>

        @endif
        
        <small>
            <i class="fa fa-plus" aria-hidden="true"></i>
            <b>Ajouter une annonce</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterAnnonce') }}" method="post" enctype='multipart/form-data'>

            {{ csrf_field() }}

            
            <table>
                <tr>
                    <td width="400">
                        <label for="titre"><b>Titre de l'annonces</b></label>
                        <input type="text" required class="form-control" id="titre" name='titre' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="inputGroupFile01"><b>Image de l'annonce</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <small class="input-group-text" style="font-size: 13px;" id="inputGroupFileAddon01">Télécharger</small>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" required name="image">
                                <label class="custom-file-label" for="inputGroupFile01">Sélectionner</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <textarea name="description" required rows="5" class="form-control" placeholder="Saisir la description de l'anonce ici ..."></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <button type="submit" style="margin-top: 30px;" class="btn btn-md btn-green white-text rounded ml-0">
                            Ajouter
                        </button>
                    </td>
                </tr>
            </table>
            <hr />
        </form>

        <table class="table table-inverse">
            
            <tbody>
                <tr>
                    <td scope="row">
                        <div class="row">
                            @forelse($annonces as $annonce)
                                <div class="col-6">
                                    <img src="{{ URL::asset($annonce->url) }}" alt="img-annonce" width="100%">
                                </div>
                                <div class="col-6">
                                    <div class="text-right">
                                        <a href="{{route('modifierAnnonce', $annonce->id)}}" class="btn btn-primary btn-primary btn-sm rounded">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('supprimerAnnonce', $annonce->id)}}" class="btn btn-danger btn-primary btn-sm rounded">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <b class="font-weight-bold">{{ $annonce->titre }}</b><br />
                                    <b>{{ $annonce->description }}</b>
                                </div>
                                <div class="col-12">
                                    <div class="grey mb-1 pb-1"></div>
                                </div>
                            @empty
                                <div class="text-center col-12">
                                    <b>Aucune annonce n'a été ajoutée !</b>
                                </div>
                            @endforelse
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

@endsection