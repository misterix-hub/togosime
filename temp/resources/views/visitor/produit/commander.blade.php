@extends('templates.visitorTemplate')

@section('indexVisitor')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-3">
                <nav class="breadcrumb">
                    <a class="breadcrumb-item" href="{{ route('indexVisitor') }}">Accueil</a>
                    <span class="breadcrumb-item active">Commander produit</span>
                </nav>
            </div>
        </div><br />
        <div class="row">
            @foreach($produits as $produit)
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <img src="{{ URL::asset($produit->image) }}" alt="img-{{ $produit->nom }}" width="100%"><br />
                    <span class="rounded border font-weight-bold">
                        Prix : {{ $produit->prix }} F cfa
                    </span><br />
                    {{ $produit->nom }}
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">

                    @if($message = Session::get('message'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong>{{ $message }}</strong> 
                        </div>
                    @endif

                    
                    <script>
                      $(".alert").alert();
                    </script>

                    Pour confirmer votre commande, veuillez saisir dans le chamos ci-dessous
                    votre email ou numéro de téléphone. Vous serez en suite contacté dans un
                    bref délai pour par notre équipe commerçial pour la suite de la procédure.<br /><br />

                    <form action="{{ route('commanderProccessing', $produit->id) }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-lg-6 col-md-12 col-sm-12 mb-2">
                                <input type="text" required name="contact" class="form-control" placeholder="Saisir le contacts ou email ici ...">
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12 mb-2">
                                <button type="submit" class="btn btn-green white-text rounded btn-md btn-block m-0">
                                    Terminer
                                </button>
                            </div>
                            <div class="col-lg-3 col-md-12 col-sm-12 mb-2">
                                <a href="{{ route('indexVisitor') }}" class="btn btn-white rounded btn-md btn-block m-0">
                                    <b>Annuller</b>
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            @endforeach

        </div>
    </div><br /><br /><br /><br /><br />
@endsection