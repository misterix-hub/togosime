@extends('templates/adminTemplate')

@section('indexAdmin')
    
    <div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Produits</span>
        </nav>

        <span class="font-weight-bold">Produits</span><br /><br />

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
            <b>Ajouter un produit</b>
        </small><br />
        
        <script>
          $(".alert").alert();
        </script>

        <form action="{{ route('ajouterProduit') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <table>
                <tr>
                    <td width="300">
                        <label for="nom"><b>Nom du produit</b></label>
                        <input type="text" required class="form-control" id="nom" name='nom' placeholder="Saisir dans le champs">
                    </td>
                    <td width="300">
                        <label for="categorie"><b>Catégorie</b></label>
                        <select name="categorie_produit_id" id="gamme" class="form-control">
                            @foreach($categories as $categorie)
                                <option value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="150">
                        <label for="categorie"><b>Prix (F CFA)</b></label>
                        <input type="number" class="form-control" name="prix">
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <textarea rows="3" required class="form-control" id="description" name='description' placeholder="Saisir la description du produit ici ..."></textarea>
                    </td>
                </tr>
                <tr>
                    <td >
                        <label for="categorie"><b>Fournisseur</b></label>
                        <select name="partenaire_id" id="gamme" class="form-control">
                            @foreach($partenaires as $partenaire)
                                <option value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td width="100">
                        <label for="inputGroupFile01"><b>Image</b></label>
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
                    <td colspan="3">
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
                        <b>Nom du produit</b>
                    </th>
                    <th>
                        <b>Description du produit</b>
                    </th>
                    <th>
                        <b>Catégorie</b>
                    </th>
                    <th>
                        <b>Prix (F CFA)</b>
                    </th>
                    <th>
                        <b>Fournisseur</b>
                    </th>
                    <th>
                        <b>Image</b>
                    </th>
                    <th colspan="3" class="text-center">
                        <b>Action</b>
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse($produits as $produit)
                    <tr>
                        <td scope="row">
                            <b>{{ $produit->nom }}</b>
                        </td>
                        <td>
                            <b>{{ $produit->description }}</b>
                        </td>
                        <td>
                            @foreach($categories as $categorie)
                                @if($categorie->id == $produit->categorie_produit_id)
                                    <b>{{ $categorie->nom }} </b>
                                @endif
                            @endforeach
                        </td>
                        <td>
                            <b>{{ $produit->prix }}</b>
                        </td>
                        <td>
                            @foreach($partenaires as $partenaire)
                                @if($partenaire->id == $produit->partenaire_id)
                                    <b>{{ $partenaire->nom }}</b>
                                @endif
                            @endforeach
                        </td>
                        <td width="100">
                            <img src="{{ URL::asset($produit->image) }}" alt="image-{{ $produit->nom }}" width="100%">
                        </td>
                        <td width="20">
                            <a href="{{ route('detailsProduit', $produit->id) }}" class="btn btn-grey btn-sm rounded btn-block">
                                <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        </td>
                        <td width="20">
                            <a href="{{ route('modifierProduit', $produit->id) }}" class="btn btn-primary btn-primary btn-sm rounded btn-block">
                                <i class="fas fa-edit    "></i>
                            </a>
                        </td>
                        <td  width="20">
                            <a href="{{route('supprimerProduit', $produit->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td scope="row" colspan="8">
                            <div class="text-center">
                                <b>Aucun produit n'a été ajoutée !</b>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>


    </div>

@endsection