@extends('templates.visitorTemplate')

@section('indexVisitor')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-3">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{ route('indexVisitor') }}">Accueil</a>
                    <span class="breadcrumb-item active">Rechercher</span>
                </nav>
            </div>
        </div><br />
        <div class="row">

            <div class="col-12">
                {{ count($produits) }} Résultat(s) trouvé(s) pour <i>{{ $search_q }}</i><br /><br />
            </div>

            @forelse($produits as $produit)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <img src="{{ URL::asset('images/produits/1571567724_img (130).jpg') }}" width="100%" alt=""><br />
                    <div style="height: 100px; overflow: auto;">
                        <b>Prix : 1500 F cfa</b><br />
                        Nom du produit ici<br />
                        <a href="{{ route('dProduit', $produit->id) }}"><i class="fa fa-list" aria-hidden="true"></i> <b>Détails</b></a>&nbsp;&nbsp;&nbsp;
                        <a href="{{ route('commanderProduit', $produit->id) }}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <b>Commander</b></a>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center"><br /><br /><br />
                    <b>Aucun résultat n'a été retrouvé !</b>
                </div>
            @endforelse

        </div>
    </div><br /><br /><br /><br /><br /><br />

@endsection