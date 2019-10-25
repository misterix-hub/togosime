@extends('templates/adminTemplate')

@section('indexAdmin')
    
    <div>
        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexProduits') }}"><b>Produits</b></a>
            <span class="breadcrumb-item active">Détails</span>
        </nav>

        @foreach($produits as $produit)

            <div class="font-weight-bold">
                Détails sur le produit : {{ $produit->nom }}
            </div>

            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12">
                    <div>
                        <img src="{{ URL::asset($produit->image) }}" alt="image-{{ $produit->nom }}" width="100%">
                    </div>
                    <small>
                        <i class="fa fa-chevron-down" aria-hidden="true"></i>
                        <b>Description</b>
                    </small><br />
        
                    <div>
                        {{ $produit->description }}
                    </div>
                </div>
                <div class="col-lg-5 col-md-12 col-sm-12">

                    <div class="text-right">
                        <a href="{{ route('modifierProduit', $produit->id) }}" class="btn btn-primary btn-primary btn-md rounded">
                            Modifier le produit
                        </a>
                    </div><br />
                    
                    <i class="fas fa-truck"></i>
                    Fournisseur :
                    @foreach($partenaires as $partenaire)
                        @if($partenaire->id == $produit->partenaire_id)
                            <b>{{$partenaire->nom}}</b>
                        @endif
                    @endforeach<br />

                    <i class="fa fa-list" aria-hidden="true"></i>
                    Catégorie :
                    @foreach($categories as $categorie)
                        @if($categorie->id == $produit->categorie_produit_id)
                            <b>{{$categorie->nom}}</b>
                        @endif
                    @endforeach
                </div>
            </div>


        @endforeach
    </div>

@endsection