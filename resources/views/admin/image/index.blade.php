@extends('templates/adminTemplate')

@section('indexAdmin')
    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Images</span>
        </nav>

        <span class="font-weight-bold">Images</span><br /><br />

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
            <b>Ajouter une image</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterImage') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <table>
                <tr>
                    <td width="400">
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
                    <td width="100">
                        <button type="submit" class="btn btn-md btn-green white-text rounded btn-block">
                            Ajouter
                        </button>
                    </td>
                </tr>
            </table><br />

        </form>

        <table class="table table-hover table-inverse">
            <tbody>
                
                    <tr>
                        <td scope="row" >
                            <div class="row">
                                @forelse($images as $image)
                                    <div class="col-6">
                                        <div class="text-right">
                                            <a href="{{route('supprimerImage', $image->id)}}" class="btn btn-danger btn-primary btn-sm rounded">
                                                <i class="fa fa-trash" aria-hidden="true"></i>
                                            </a>
                                        </div>
                                        <img src="{{ URL::asset($image->url) }}" alt="" width="100%">
                                    </div>
                                @empty
                                    <div class="text-center col-12">
                                        <b>Aucune image n'a été ajoutée !</b>
                                    </div>
                                @endforelse
                            </div>
                        </td>
                    </tr>
            </tbody>
        </table>

    </div>

@endsection