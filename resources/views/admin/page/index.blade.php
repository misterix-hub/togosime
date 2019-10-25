@extends('templates/adminTemplate')

@section('indexAdmin')
    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Pages</span>
        </nav>

        <span class="font-weight-bold">Pages</span><br /><br />

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
            <b>Ajouter une page</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterPage') }}" method="post">

            {{ csrf_field() }}

            <table>
                <tr>
                    <td width="400">
                        <label for="nom"><b>Nom de la page</b></label>
                        <input type="text" required class="form-control" id="nom" name='nom' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="icone"><b>icone de la page</b></label>
                        <input type="text" required class="form-control" id="icone" name='icone' placeholder="Saisir dans le champs">
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <textarea name="contenu" id="" rows="3" class="form-control" required placeholder="Saisir le contenu ici ..."></textarea>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <button type="submit" class="btn btn-md btn-green white-text rounded ml-0">
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
                        <b>Nom de page</b>
                    </th>
                    <th>
                        <b>Contenu de la page</b>
                    </th>
                    <th class="text-center">
                        <b>Icon de la page</b>
                    </th>
                    <th colspan="2" class="text-center">
                        <b>Action</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td scope="row">
                                <b>{{ $page->nom }}</b>
                            </td>
                            <td>
                                <b>{{ $page->contenu }}</b>
                            </td>
                            <td class="text-center">
                                <h3><i class="{{ $page->icone }}"></i></h3>
                            </td>
                            <td width="20">
                                <a href="{{ route('modifierPage', $page->id) }}" class="btn btn-primary btn-primary btn-sm rounded btn-block">
                                    <i class="fas fa-edit    "></i>
                                </a>
                            </td>
                            <td  width="20">
                                <a href="{{route('supprimerPage', $page->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">
                                <div class="text-center">
                                    <b>Aucune page n'a été ajoutée !</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </table>

    </div>

@endsection