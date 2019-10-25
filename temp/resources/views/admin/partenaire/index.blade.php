@extends('templates/adminTemplate')

@section('indexAdmin')
    
    <div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Partenaires</span>
        </nav>

        <span class="font-weight-bold">Partenaires</span><br /><br />

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
            <b>Ajouter un parenaire</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterPartenaire') }}" method="post" enctype='multipart/form-data'>

            {{ csrf_field() }}

            
            <table>
                <tr>
                    <td colspan="3">
                        <div class="text-right">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" name="fournisseur" id="customSwitches">
                                <label class="custom-control-label" for="customSwitches"><b>Fournisseur</b></label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td width="200">
                        <label for="nom"><b>Nom du partenaire</b></label>
                        <input type="text" required class="form-control" id="nom" name='nom' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="description"><b>Description du partenaire</b></label>
                        <input type="text" required class="form-control" id="description" name='description' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="inputGroupFile01"><b>Logo</b></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <small class="input-group-text" style="font-size: 13px;" id="inputGroupFileAddon01">Télécharger</small>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01"
                                aria-describedby="inputGroupFileAddon01" required name="logo">
                                <label class="custom-file-label" for="inputGroupFile01">Sélectionner</label>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" class="btn btn-md btn-green white-text rounded ml-0">
                            Ajouter
                        </button>
                    </td>
                </tr>
            </table>
            <hr />
        </form>

        <table class="table table-hover table-inverse">
            <thead class="thead-inverse" width="100%">
                <tr>
                    <th>
                        <b>Nom du partenaire</b>
                    </th>
                    <th>
                        <b>Description du partenaire</b>
                    </th>
                    <th class="text-center">
                        <b>Founisseur</b>
                    </th>
                    <th width='100' class="text-center">
                        <b>Logo</b>
                    </th>
                    <th colspan="2" class="text-center">
                        <b>Action</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($partenaires as $partenaire)
                    <tr>
                        <td scope="row">
                            <b>{{ $partenaire->nom }}</b>
                        </td>
                        <td>
                            <b>{{ $partenaire->description }}</b>
                        </td>
                        <td class="text-center">
                            @if($partenaire->fournisseur == "on")
                                <b>Oui</b>
                            @else
                                <b>Non</b>
                            @endif
                        </td>
                        <td width="200">
                            <img src="{{ URL::asset($partenaire->logo) }}" width="100%" alt="logo-{{ $partenaire->nom }}">
                        </td>
                        <td width="20">
                            <a href="{{ route('modifierPartenaire', $partenaire->id) }}" class="btn btn-primary btn-primary btn-sm rounded btn-block">
                                <i class="fas fa-edit    "></i>
                            </a>
                        </td>
                        <td  width="20">
                            <a href="{{route('supprimerPartenaire', $partenaire->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td scope="row" colspan="5">
                            <div class="text-center">
                                <b>Aucun partenaire n'a été ajouté !</b>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    </div>

@endsection