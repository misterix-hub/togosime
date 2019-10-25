@extends('templates/adminTemplate')

@section('indexAdmin')

    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexVideos') }}"><b>Vidéos</b></a>
            <span class="breadcrumb-item active">Modifier</span>
        </nav>

        <span class="font-weight-bold">
            <i class="fas fa-edit    "></i>
            Modifier vidéo
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

        @foreach($partenaires as $partenaire)
        
            <form action="{{ route('updatePartenaire', $partenaire->id) }}" method="post" enctype='multipart/form-data'>

                {{ csrf_field() }}

                
                <table>
                    <tr>
                        <td colspan="3">
                            <div class="text-right">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" <?=($partenaire->fournisseur == 'on') ? 'checked' : '' ?> name="fournisseur" id="customSwitches">
                                    <label class="custom-control-label" for="customSwitches"><b>Fournisseur</b></label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td width="200">
                            <label for="nom"><b>Nom du partenaire</b></label>
                            <input type="text" required class="form-control" id="nom" name='nom' value="{{ $partenaire->nom }}">
                        </td>
                        <td width="300">
                            <label for="description"><b>Description du partenaire</b></label>
                            <input type="text" required class="form-control" id="description" name='description' value="{{ $partenaire->description }}">
                        </td>
                        <td width="300">
                            <label for="inputGroupFile01"><b>Logo</b></label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <small class="input-group-text" style="font-size: 13px;" id="inputGroupFileAddon01">Télécharger</small>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01"
                                    aria-describedby="inputGroupFileAddon01" name="logo">
                                    <label class="custom-file-label" for="inputGroupFile01">Sélectionner</label>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <button type="submit" class="btn btn-md btn-green white-text rounded ml-0">
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