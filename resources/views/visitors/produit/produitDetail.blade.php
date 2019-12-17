@extends('visitors.base')

@section('content')
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <div style="max-height: 150px; overflow: hidden;">
                <a href=""><img src="{{ URL::asset($produit->image) }}" alt="img-produit" width="100%"></a>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <b class="red-text"><b>{{ $produit->prix }} FCFA</b></b>
            <div><a href=""><b>{{ $produit->nom }}</b></a></div>
            <br>
            <p>{{ $produit->description }}</p>
            <div>
                <a href="#!" data-toggle="modal" data-target="#basicExampleModal" class="btn btn-orange btn-sm ml-0 z-depth-0 contacter-modal" data-value="{{ $produit->nom }}">
                    Contacter
                </a>
            </div>
        </div>
        <br />
        <br />
    </div>
</div>
@endsection
