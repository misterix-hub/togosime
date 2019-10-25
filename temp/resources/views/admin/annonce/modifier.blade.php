@extends('templates/adminTemplate')

@section('indexAdmin')

    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexAnnonces') }}"><b>Annonces</b></a>
            <span class="breadcrumb-item active">Modifier</span>
        </nav>

        <span class="font-weight-bold">
            <i class="fas fa-edit    "></i>
            Modifier annonce
        </span><br /><br />

        @if($message = Session::get('message'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{$message}}</strong> 
            </div>

        @endif
        
        <script>
          $(".alert").alert();
        </script>

        @foreach($annonces as $annonce)
        
            <form action="{{ route('updateAnnonce', $annonce->id) }}" method="post" enctype='multipart/form-data'>

                {{ csrf_field() }}

                
                <table>
                    <tr>
                        <td width="300">
                            <label for="titre"><b>Titre de l'annonces</b></label>
                            <input type="text" required class="form-control" id="titre" name='titre' value="{{ $annonce->titre }}">
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
                            <textarea name="description" rows="5" required class="form-control" placeholder="Saisir la description de l'anonce ici ...">{{ $annonce->description }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <button type="submit" style="margin-top: 30px;" class="btn btn-md btn-green white-text rounded ml-0">
                                Modifier
                            </button>
                        </td>
                    </tr>
                </table>
                <hr />
            </form>

        @endforeach

    </div>

@endsection