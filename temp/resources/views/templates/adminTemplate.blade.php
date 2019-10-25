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
    <title>Togosime | admin</title>
</head>
<body>
    
    <div class="pl-2 pr-2 pt-2 pb-2 green darken-1">
        <table width="100%">
            <tr>
                <td>
                    <img src="{{ URL::asset('images/assets/logo.png') }}" class="mr-2 rounded" alt="logo" width='50'>
                    <span class="white-text"><b>TOGOSIME</b></span>
                </td>
                <td class="text-right">
                    <a href="#" class="btn btn-white btn-sm rounded mr-0">
                        <i class="fa fa-power-off" aria-hidden="true"></i>
                        <b>Se déconnecter</b>
                    </a>
                </td>
            </tr>
        </table>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-12 grey lighten-3" style="border-right: 1px solid #CCC;">

                <div class="p-2 mt-3 mb-3">
                    <table>
                        <tr>
                            <td>
                                <a href="{{ route('indexAdmin') }}">
                                    <img src="{{ URL::asset('images/assets/logo.png') }}" class="mr-2 rounded" alt="logo" width='60'>
                                </a>
                            </td>
                            <td>
                                <span class="font-weight-bold"><b>Togosime</b></span><br />
                                <small><b>Espace administrateur</b></small>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="">
                    <table class="tool-bar-item" width="100%">
                        <tr>
                            <td>
                                <a href="{{ route('indexGammes') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <b>Gammes produits</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexCategories') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <b>Catégories produits</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexProduits') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-list" aria-hidden="true"></i>
                                        <b>Produits</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexCommandes') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                                        <b>Commandes</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexPartenaires') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fas fa-handshake    "></i>
                                        <b>Partenaires | Fournisseurs</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexAnnonces') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-bullhorn" aria-hidden="true"></i>
                                        <b>Annonces</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexImages') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fas fa-image    "></i>
                                        <b>Images</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexVideos') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-film" aria-hidden="true"></i>
                                        <b>Videos</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexMessages') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-envelope" aria-hidden="true"></i>
                                        <b>Messages</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexParametres') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-wrench" aria-hidden="true"></i>
                                        <b>Paramètres</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <a href="{{ route('indexPages') }}">
                                    <div class="pt-2 pb-2 pt-2 pb-2">
                                        <i class="fa fa-book" aria-hidden="true"></i>
                                        <b>Pages</b>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </table><br /><br /><br /><br /><br /><br />
                </div>

            </div>
            <div class="col-lg-9 col-md-6 col-sm-12">
                @yield('indexAdmin')
            </div>
        </div>
    </div>

    

    <script src="{{ URL::asset('mdb/js/jquery-3.4.1.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/mdb.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/bootstrap.min.js') }}"></script>
</body>
</html>