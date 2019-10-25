@extends('templates/adminTemplate')

@section('indexAdmin')
    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Paramètres</span>
        </nav>

        <span class="font-weight-bold">Paramètres</span><br /><br />

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
            <b>Ajouter une paramètre</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterParametre') }}" method="post">

            {{ csrf_field() }}

            <table>
                <tr>
                    <td width="200">
                        <label for="nom"><b>Nom du paramètre</b></label>
                        <input type="text" required class="form-control" id="nom" name='nom' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="valeur"><b>Valeur du paramètre</b></label>
                        <input type="text" required class="form-control" id="valeur" name='valeur' placeholder="Saisir dans le champs">
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
                        <b>Nom du paramètre</b>
                    </th>
                    <th>
                        <b>Valeur du paramètre</b>
                    </th>
                    <th colspan="2" class="text-center">
                        <b>Action</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @forelse($parametres as $parametre)
                        <tr>
                            <td scope="row">
                                <b>{{ $parametre->nom }}</b>
                            </td>
                            <td>
                                <b>{{ $parametre->valeur }}</b>
                            </td>
                            <td width="20">
                                <a href="{{ route('modifierParametre', $parametre->id) }}" class="btn btn-primary btn-primary btn-sm rounded btn-block">
                                    <i class="fas fa-edit    "></i>
                                </a>
                            </td>
                            <td  width="20">
                                <a href="{{route('supprimerParametre', $parametre->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">
                                <div class="text-center">
                                    <b>Aucun paramètre n'a été ajouté !</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </table>

    </div>

@endsection