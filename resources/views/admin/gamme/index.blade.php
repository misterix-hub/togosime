@extends('templates/adminTemplate')

@section('indexAdmin')
    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Gammes</span>
        </nav>

        <span class="font-weight-bold">Gammes produits</span><br /><br />

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
            <b>Ajouter une gamme</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterGamme') }}" method="post">

            {{ csrf_field() }}

            <table>
                <tr>
                    <td width="200">
                        <label for="nom"><b>Nom de la gamme</b></label>
                        <input type="text" required class="form-control" id="nom" name='nom' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="description"><b>Description de la gamme</b></label>
                        <input type="text" required class="form-control" id="description" name='description' placeholder="Saisir dans le champs">
                    </td>
                    <td width="100">
                        <button type="submit" style="margin-top: 30px;" class="btn btn-md btn-green white-text rounded btn-block">
                            Ajouter
                        </button>
                    </td>
                </tr>
            </table><hr />

        </form>

        <table class="table table-hover table-inverse">
            <thead class="thead-inverse" width="100%">
                <tr>
                    <th>
                        <b>Nom de la gamme</b>
                    </th>
                    <th>
                        <b>Description de la gamme</b>
                    </th>
                    <th colspan="2" class="text-center">
                        <b>Action</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @forelse($gammes as $gamme)
                        <tr>
                            <td scope="row">
                                <b>{{ $gamme->nom }}</b>
                            </td>
                            <td>
                                <b>{{ $gamme->description }}</b>
                            </td>
                            <td width="20">
                                <a href="{{ route('modifierGamme', $gamme->id) }}" class="btn btn-primary btn-primary btn-sm rounded btn-block">
                                    <i class="fas fa-edit    "></i>
                                </a>
                            </td>
                            <td  width="20">
                                <a href="{{route('supprimerGamme', $gamme->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">
                                <div class="text-center">
                                    <b>Aucune gamme n'a été ajoutée !</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </table>

    </div>

@endsection