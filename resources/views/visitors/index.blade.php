@extends('visitors.base')

@section('scriptCSS')
    
    <style>
        .square-container {
            border: 3px solid #079E2B;
            padding: 0 15px;
        }
        .square-container .titre{
            background-color: #079E2B;
        }
    </style>

@endsection

@section('content')
    <br />
    <div class="container-fluid pl-4">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ URL::asset('db/annonces/1575128023.jpg') }}" alt="">
                            <h5 class="mt-2">
                                <span class="font-weight-bold red-text pr-2 pt-1 pb-1" style="border-right: 5px solid green;">
                                1500 F CFA
                                </span>
                                <span class="pl-3"><a href=""><b>Le nom du produit de vra être ici</b></a></span>
                                <a href="#" class="float-right btn btn-orange btn-sm m-0">
                                    Contacter
                                </a>
                            </h5>
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ URL::asset('db/annonces/1575128023.jpg') }}" alt="">
                            <h5 class="mt-2">
                                <span class="font-weight-bold red-text pr-2 pt-1 pb-1" style="border-right: 5px solid green;">
                                1500 F CFA
                                </span>
                                <span class="pl-3"><a href=""><b>Le nom du produit de vra être ici</b></a></span>
                                <a href="#" class="float-right btn btn-orange btn-sm m-0">
                                    Contacter
                                </a>
                            </h5>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="square-container">
                    <div class="titre text-center white-text pt-2 pb-2 mb-1">
                        <i class="icofont-film"></i>
                        <b>SPOTS VIDEOS</b>
                    </div>
                    <div>
                        <img class="d-block w-100" src="{{ URL::asset('db/annonces/1575129213.jpg') }}" alt="">
                        <h1 style="font-weight: 100;">
                            Titre de la vidéo ici
                        </h1>
                        Cliquez sur <a href="">Ce lien</a> pour
                        accéder à toute notre chaîne de vidéos.<hr />

                        <i class="icofont-youtube red-text"></i>
                        <a href="">
                            <b>Chaîne youtube</b>
                        </a>
                        <div class="mt-3"></div>
                    </div>
                </div>
            </div>
        </div><br /><br />
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <div class="row">
                    @for ($i = 0; $i < 6; $i++)
                        <div class="col-lg-4 col-md-4 col-sm-12">
                            <a href=""><img src="{{ URL::asset('db/annonces/1575128023.jpg') }}" alt="img-produit" width="100%"></a>
                            <b class="red-text"><b>1500 F CFA</b></b>
                            <div><a href=""><b>Le nom du produit ici à cet endroit</b></a></div>
                            <div>
                                <a href="" class="btn btn-orange btn-sm ml-0 z-depth-0">
                                    Contacter
                                </a>
                            </div>
                            <br />
                        </div>
                    @endfor
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="square-container">
                    <div class="titre text-center white-text pt-2 pb-2 mb-1">
                        <i class="icofont-alarm"></i>
                        <b>COMMUNIQUES ET ANNONCES</b>
                    </div>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="{{ URL::asset('db/annonces/1575129213.jpg') }}" alt="">
                                <div class="grey lighten-3 text-center pr-2 pl-2 pt-2 pb-2">
                                    <b>Titre de l'annonce ou de l'actialité ici</b>
                                </div>
                                <div class="mt-3" style="text-align: justify;">
                                    Lorem ipsum dolor sit amet conse
                                    ctetur adipisicing elit. Reprehe
                                    nderit in corporis harum perspic
                                    iatis temporibus delectus quo mi
                                    nima ipsum blanditiis magni ex ...
                                    <a href="">Lire plus</a>
                                </div><br />
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="{{ URL::asset('db/annonces/1575129213.jpg') }}" alt="">
                                <div class="grey lighten-3 text-center pr-2 pl-2 pt-2 pb-2">
                                    <b>Titre de l'annonce ou de l'actialité ici</b>
                                </div>
                                <div class="mt-3" style="text-align: justify;">
                                    Lorem ipsum dolor sit amet conse
                                    ctetur adipisicing elit. Reprehe
                                    nderit in corporis harum perspic
                                    iatis temporibus delectus quo mi
                                    nima ipsum blanditiis magni ex ...
                                    <a href="">Lire plus</a>
                                </div><br />
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div><br /><br />
        <div class="row">
            @for($i = 0; $i < 4; $i++)
                <div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title text-center green-text">
                                <i class="icofont-home icofont-3x"></i>
                            </h4>
                            <h5 class="text-center">Titre de la page</h5>

                            <div class="text-center" style="height: 120px; overflow: auto;">
                                Lorem ipsum dolor sit amet consectetur,
                                adipisicing elit. Maiores amet quos sit
                                magni iure magnam eos, sunt esse dolor ...
                                <a href="">
                                    <i class="fa green-text fa-plus" aria-hidden="true"></i>
                                    Lire plus
                                </a>
                            </div>
                        </div>
                    </div><br />
                </div>
            @endfor
        </div><br /><br />
        
        <div class="row">
            <div class="col-12">
                <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="{{ URL::asset('db/images/1.jpg') }}" alt="">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="{{ URL::asset('db/images/1.jpg') }}" alt="">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div><br /><br />
    </div>

@endsection