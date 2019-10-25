<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/style.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('fontawesome/css/all.min.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('images/assets/logo.png') }}" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Togosime | accueil</title>
</head>
<body>
    
    <!--Navbar-->
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #1faa00;">

        <!-- Navbar brand -->
        <a href="{{ route('indexVisitor') }}" class="mr-2">
            <img src="{{ URL::asset('images/assets/logo.png') }}" class="rounded" alt="logo" width="50">
        </a>
        <a class="navbar-brand" href="{{ route('indexVisitor') }}"><b>Togosime</b></a>

        <!-- Collapse button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#basicExampleNav"
            aria-controls="basicExampleNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible content -->
        <div class="collapse navbar-collapse" id="basicExampleNav">

            <!-- Links -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                <a class="nav-link" href="{{ route('indexVisitor') }}">Accueil
                    <span class="sr-only">(current)</span>
                </a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('messages') }}">Nous écrire</a>
                </li>

                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Catégories</a>
                    <div class="dropdown-menu dropdown-primary" style="max-height: 600px; overflow: auto;" aria-labelledby="navbarDropdownMenuLink">
                        @forelse($categories as $categorie)
                            <a class="dropdown-item" href="{{ route('categorie', $categorie->id) }}"><b>{{ $categorie->nom }}</b></a>
                        @empty
                            <a class="dropdown-item" href="#!"><b>Aucune catégorie</b></a>
                        @endforelse
                    </div>
                </li>

            </ul>
        <!-- Links -->

            <form class="form-inline" method="post" action="{{ route('rechercherProduit') }}">
                {{ csrf_field() }}
                <div class="lg-form my-0">
                    <input class="form-control mr-sm-2" id="search-input" required type="text" name="search_q" placeholder="Rechercher un produit ..." aria-label="Search">
                    <button type="submit" style="border: transparent; outline: none; background-color: transparent; margin-left: -50px; margin-top: 6px; position: absolute;">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </form>
        </div>
        <!-- Collapsible content -->

    </nav>
    <!--/.Navbar-->

    <div class="container-fluid" id="categorieBar">
        <div class="row grey lighten-2 p-1">
            @forelse($categories as $categorie)
                <a href="{{ route('categorie', $categorie->id) }}" style="text-decoration: none;" class="black-text">
                    <div class="card border-grey text-center pl-2 pr-2" style='font-size: 14px;'>
                            {{$categorie->nom}}
                    </div>
                </a>
            @empty
                <div class="col-12 text-center">
                    Aucune catégorie
                </div>
            @endforelse
        </div>
    </div>

    <form method="post" class="ml-3 mr-3 pt-2" action="{{ route('rechercherProduit') }}" id="smSearch">
        {{ csrf_field() }}
        <div class="lg-form my-0">
            <label for="search" style="font-size: 14px;"><b>RECHERCHER UN PRODUIT</b></label>
            <input class="form-control mr-sm-2" type="text" id="search" required name="search_q" placeholder="Rechercher un produit ..." aria-label="Search">
            <div class="text-right" style="position: absolute; right: 0; margin-top: -35px; margin-right: 10px;">
                <button type="submit" class="pull-right pl-3 pr-3 pt-1" style="border: none; background-color: transparent; outline: none;">
                    <i class="fa fa-search" aria-hidden="true"></i>
                </button>
            </div>
        </div>
    </form>

    @yield('indexVisitor')
    

    <div class="grey darken-2 container-fluid">
        <div class="row">
            <div class="col-12 white-text pt-2 pb-2" style="font-size: 14px;">
                Copyright &copy; 2019 | by IBTA-Group
            </div>
        </div>
    </div>

    <script src="{{ URL::asset('mdb/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/mdb.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/bootstrap.min.js') }}"></script>
    
</body>
</html>