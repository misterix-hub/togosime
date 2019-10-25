@extends('templates/adminTemplate')

@section('indexAdmin')
    
    <div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Vidéos</span>
        </nav>

        <span class="font-weight-bold">Vidéos</span><br /><br />

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
            <b>Ajouter une vidéo</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterVideo') }}" method="post" enctype='multipart/form-data'>

            {{ csrf_field() }}

            
            <table>
                <tr>
                    <td width="300">
                        <label for="titre"><b>Titre de la vidéo</b></label>
                        <input type="text" required class="form-control" id="titre" name='titre' placeholder="Saisir dans le champs">
                    </td>
                    <td width="400">
                        <label for="inputGroupFile01"><b>Vidéo</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <small class="input-group-text" style="font-size: 13px;" id="inputGroupFileAddon01">Télécharger</small>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" required name="video">
                                <label class="custom-file-label" for="inputGroupFile01">Sélectionner</label>
                            </div>
                        </div>
                    </td>
                    <td class="pl-2">
                        <button type="submit" style="margin-top: 30px;" class="btn btn-md btn-green white-text rounded ml-0">
                            Ajouter
                        </button>
                    </td>
                </tr>
            </table>
            <hr />
        </form>

        <table class="table table-hover table-inverse">
            
            <tbody>
                <tr>
                    <td scope="row">
                        <div class="row">
                            @forelse($videos as $video)
                                <div class="col-6">
                                    <div class="text-right">
                                        <a href="#!{{route('modifierVideo', $video->id)}}" class="btn btn-primary btn-primary btn-sm rounded">
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{route('supprimerVideo', $video->id)}}" class="btn btn-danger btn-primary btn-sm rounded">
                                            <i class="fa fa-trash" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <video src="{{ URL::asset($video->url) }}" controls width="100%"></video>
                                    <b>{{ $video->titre }}</b>
                                </div>
                            @empty
                                <div class="text-center col-12">
                                    <b>Aucune vidéo n'a été ajoutée !</b>
                                </div>
                            @endforelse
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>


    </div>

@endsection