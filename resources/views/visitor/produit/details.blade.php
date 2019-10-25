@extends('templates.visitorTemplate')

@section('indexVisitor')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-3">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{ route('indexVisitor') }}">Accueil</a>
                    <span class="breadcrumb-item active">Détails produit</span>
                </nav>
            </div>
        </div><br />
        <div class="row">
            
            @foreach($produits as $produit)
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ URL::asset($produit->image) }}" alt="img-{{ $produit->nom }}" width="100%">
                    <div class="font-weight-bold">{{ $produit->nom }}</div>
                    <div>{{ $produit->description }}</div><br /><br />
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    Plus d'infos sur le produit : <b>{{ $produit->nom }}</b><br /><br />

                    <i class="fa fa-list" aria-hidden="true"></i>
                    Catégorie :

                    @foreach($categories as $categorie)
                        @if($categorie->id == $produit->categorie_produit_id)
                            <b>{{$categorie->nom}}</b>
                        @endif
                    @endforeach<br />

                    <i class="fa fa-truck" aria-hidden="true"></i>
                    Founisseur :
                    @foreach($partenaires as $partenaire)
                        @if($partenaire->id == $produit->partenaire_id)
                            <b>{{$partenaire->nom}}</b>
                        @endif
                    @endforeach<br /><br /><br />

                    <div class="text-right">
                        <a href="{{ route('commanderProduit', $produit->id) }}" class="btn btn-md btn-green white-text rounded-mr-0">
                            <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                            Commander le produit
                        </a>
                    </div>

                </div>
            @endforeach

        </div>
    </div><br /><br /><br /><br /><br /><br />

@endsection