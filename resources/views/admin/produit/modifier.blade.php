@extends('templates/adminTemplate')

@section('indexAdmin')

    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexProduits') }}"><b>Produits</b></a>
            <span class="breadcrumb-item active">Modifier</span>
        </nav>

        <span class="font-weight-bold">
            <i class="fas fa-edit    "></i>
            Modifier produit
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

        @foreach($produits as $produit)
        
            <form action="{{ route('updateProduit', $produit->id) }}" method="post" enctype="multipart/form-data">

                {{ csrf_field() }}

                <table>
                    <tr>
                        <td width="300">
                            <label for="nom"><b>Nom du produit</b></label>
                            <input type="text" required class="form-control" id="nom" name='nom' value="{{ $produit->nom }}">
                        </td>
                        <td width="300">
                            <label for="categorie"><b>Catégorie</b></label>
                            <select name="categorie_produit_id" id="gamme" class="form-control">
                                @foreach($categories as $categorie)
                                    <option <?=($produit->categorie_produit_id == $categorie->id) ? 'selected' : '' ?> value="{{ $categorie->id }}">{{ $categorie->nom }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td width="150">
                            <label for="categorie"><b>Prix (F CFA)</b></label>
                            <input type="number" class="form-control" name="prix" value="{{ $produit->prix }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <textarea rows="3" required class="form-control" id="description" name='description'>{{ $produit->description }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <label for="categorie"><b>Fournisseur</b></label>
                            <select name="partenaire_id" id="gamme" class="form-control">
                                @foreach($partenaires as $partenaire)
                                    <option <?=($produit->partenaire_id == $partenaire->id) ? 'selected' : '' ?> value="{{ $partenaire->id }}">{{ $partenaire->nom }}</option>
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
                                    aria-describedby="inputGroupFileAddon01" name="image">
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
                </table><hr />
            </form>
        @endforeach

    </div>

@endsection