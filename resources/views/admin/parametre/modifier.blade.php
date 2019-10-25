@extends('templates/adminTemplate')

@section('indexAdmin')

    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexParametres') }}"><b>Paramètres</b></a>
            <span class="breadcrumb-item active">Modifier</span>
        </nav>

        <span class="font-weight-bold">
            <i class="fas fa-edit    "></i>
            Modifier Parametre
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

        @foreach($parametres as $parametre)
        
            <form action="{{ route('updateParametre', $parametre->id) }}" method="post">

                {{ csrf_field() }}

                <table>
                    <tr>
                        <td width="200">
                            <label for="nom"><b>Nom du paramètre</b></label>
                            <input type="text" required class="form-control" id="nom" name='nom' value="{{ $parametre->nom }}">
                        </td>
                        <td width="300">
                            <label for="valeur"><b>Valeur du paramètre</b></label>
                            <input type="text" required class="form-control" id="valeur" name='valeur' value="{{ $parametre->valeur }}">
                        </td>
                        <td width="100">
                            <button type="submit" style="margin-top: 30px;" class="btn btn-md btn-green white-text rounded btn-block">
                                Modifier
                            </button>
                        </td>
                    </tr>
                </table><hr />

            </form>
        @endforeach

    </div>

@endsection