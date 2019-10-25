@extends('templates.visitorTemplate')

@section('indexVisitor')


@if($message = Session::get('message'))

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>{{$message}}</strong>
    </div>

@endif
<br />
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-7 col-md-12 col-sm-12">

            <!--Carousel Wrapper-->
            <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
                <!--Indicators-->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                    <li data-target="#carousel-example-1z" data-slide-to="2"></li>
                </ol>
                
                <!--/.Indicators-->
                <!--Slides-->
                <div class="carousel-inner" role="listbox">
                    <!--First slide-->
                    @foreach($carousels as $carousel)
                        <div class="carousel-item <?=($i == 0) ? 'active' : '' ?>">
                            <img class="d-block w-100" src="{{ $carousel->image }}" alt="First slide">
                            <!--<div class="mask pattern-6 flex-center"></div>-->
                            <div class="carousel-caption">
                                <div class="mask rgba-white-strong pl-4 pt-1 text-left rounded">
                                    <div class="black-text">
                                        <b>Prix : {{ $carousel->prix }} F cfa</b><br />
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        {{ $carousel->nom }}, Produit par
                                    </div>
                                    <p class="mb-0">
                                        
                                        @foreach($partenaires as $partenaire)
                                            @if($partenaire->id == $carousel->partenaire_id)
                                                {{$partenaire->nom}}
                                            @endif
                                        @endforeach
                                    </p>
                                    <div class="text-right">
                                        <a href="{{ route('dProduit', $carousel->id) }}"
                                        class="ml-0 btn btn-sm rounded btn-white black-text">
                                            <b>Détails</b>
                                        </a>
                                        <a href="{{ route('commanderProduit', $carousel->id) }}"
                                        class="ml-0 btn btn-sm rounded btn-green white-text">
                                            Commander
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i = $i + 1; ?>
                    @endforeach
                    <?php $i = 0 ?>
                </div>
                <!--/.Slides-->
                <!--Controls-->
                <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <!--/.Controls-->
                <!--/.Carousel Wrapper-->

            </div><br />
        </div>

        <div class="col-lg-5 col-md-12 col-sm-12">

            <!--<a href='https://wa.me/22891985311/?text=hello'><b>iuunhohohuoihuoiuhoiuh</b></a>-->

            <div style="background-color: #1faa00;" class="pt-2 pb-2 text-center white-text">
                <i class="fa fa-film" aria-hidden="true"></i>
                SPOTS VIDEO
            </div>

            <iframe width="100%" height="315" src="https://www.youtube.com/embed/nZFQPjWpXkE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            
            <a href="https://www.youtube.com/channel/UCgR9RjhUoF8EBvg4f8oqmrw" target="_blank">
                <i class="fa fa-share" aria-hidden="true"></i>
                Cliqez ici
            </a> pour accéder à toute notre chaîne.

        </div>

    </div>

    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
        <div class="col-lg-6 col-md-12 col-sm-12"><br />
            <div class="text-center pt-2 pb-2" style="border: 1px solid #CCC; border-radius: 4px 4px 0 0; border-bottom: 3px solid #1faa00;">
                <b>QUELQUES UNS DE NOS PRODUITS</b>
            </div><br /><br />
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
    </div>

    <div class="row">
        @foreach($produits as $produit)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <img src="{{ $produit->image }}" width="100%" alt=""><br />
                <div style="height: 100px; overflow: auto;">
                    <b class="orange-text">Prix : {{ $produit->prix }} F cfa</b><br />
                    {{ $produit->nom }}<br />
                    <a href="{{route('dProduit', $produit->id)}}"><i class="fa fa-list" aria-hidden="true"></i> <b>Détails</b></a>&nbsp;&nbsp;&nbsp;
                    <a href="{{ route('commanderProduit', $produit->id) }}"><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <b>Commander</b></a>
                </div>
            </div>
        @endforeach

        <div class="col-12">

            <nav aria-label="Page navigation" style="pull: right;">
              <ul class="pagination">
                {{ $produits }}
              </ul>
            </nav>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
        <div class="col-lg-6 col-md-12 col-sm-12"><br />
            <div class="text-center pt-2 pb-2" style="border: 1px solid #CCC; border-radius: 4px 4px 0 0; border-bottom: 3px solid #1faa00;">
                <b>EN SAVOIR PLUS SUR NOUS</b>
            </div><br />
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
    </div>
    <div class="row">
        @foreach($pages as  $page)
            <div class="col-lg-3 col-md-6 col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">
                            <i class="{{ $page->icone }} fa-2x green-text" aria-hidden="true"></i>
                        </h4>
                        <h5 class="text-center">{{ $page->nom }}</h5>

                        <div class="text-center" style="height: 160px; overflow: auto;">
                            {{ $page->contenu }}
                            <ul>
                                @foreach($ligne_pages as $ligne_page)
                                    @if($page->id == $ligne_page->page_id)
                                        <li>
                                            {{ $ligne_page->ligne }}
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                            <a href="{{ route('page', $page->id) }}">
                                <i class="fa fa-plus" aria-hidden="true"></i>
                                Lire plus
                            </a>
                        </div>
                    </div>
                </div><br />
            </div>
        @endforeach
    </div>

    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
        <div class="col-lg-6 col-md-12 col-sm-12"><br /><br />
            <div class="text-center pt-2 pb-2" style="border: 1px solid #CCC; border-radius: 4px 4px 0 0; border-bottom: 3px solid #ef6c00;">
                <i class="fa fa-image orange-text" aria-hidden="true"></i>
                <b>QUELQUES IMAGES EN APPERCU</b>
            </div><br />
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
    </div>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($images as $image)
                <div class="carousel-item <?=($i == 0) ? 'active' : '' ?>">
                    <img class="d-block w-100" src="{{ $image->url }}"
                    alt="First slide">
                </div>
                <?php $i += 1; ?>
            @endforeach
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



    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
        <div class="col-lg-6 col-md-12 col-sm-12"><br />
            <div class="text-center pt-2 pb-2" style="border: 1px solid #CCC; border-radius: 4px 4px 0 0; border-bottom: 3px solid #1faa00;">
                <i class="fas fa-map-marker-alt   red-text "></i>
                <b>OU VOUS POUVEZ NOUS TROUVER</b>
            </div><br />
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
    </div>
    <div class="row">
        <div class="col-6">
            <div>
                <b class="text-muted">PLAN 1</b>
                <img src="{{ URL::asset('images/assets/3.jpg') }}" alt="map1" width="100%">
            </div>
        </div>
        <div class="col-6">
            <div>
                <b class="text-muted">PLAN 2</b>
                <img src="{{ URL::asset('images/assets/3.jpg') }}" alt="map1" width="100%">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
        <div class="col-lg-6 col-md-12 col-sm-12"><br /><br />
            <div class="text-center pt-2 pb-2" style="border: 1px solid #CCC; border-radius: 4px 4px 0 0; border-bottom: 3px solid #536dfe;">
                <i class="fa fa-phone-square blue-text" aria-hidden="true"></i>
                <b>NOS CONTACTS</b>
            </div><br />
        </div>
        <div class="col-lg-3 col-md-12 col-sm-12"></div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="text-center">
                @foreach($parametres as $parametre)
                    {{ $parametre->nom }} : {{ $parametre->valeur }}<br />
                @endforeach
            </div>
        </div>
    </div>
</div><br /><br /><br /><br />

@endsection