<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{URL::asset('mdb/css/style.css')}}">
    <link rel="stylesheet" href="{{URL::asset('mdb/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('mdb/css/mdb.min.css')}}">
    <link rel="stylesheet" href="{{URL::asset('icofont/icofont.min.css')}}">
    @yield('scriptCSS')
    <title>Togosimé</title>

    <style>
        .menu-bar {
            background-color: #079E2B;
            padding: 5px 23px;
        }
        .search-form {
            margin-left: 100px;
        }
        .search-form input {
            height: 40px;
            border: none;
            outline: none;
            padding: 0 23px;
            width: 400px;
            border-radius: 2px;
        }

        .search-form button {
            height: 40px;
            border-radius: 2px;
            border: none;
            outline: none;
            padding: 0 15px;
            border: 1px solid #777;
        }
        .sous-menu {
            border-bottom: 1px solid #DDD;
            padding: 5px 23px;
        }
        .sous-menu a div {
            border: 1px solid #DDD;
            background-color: #DDD;
            border-radius: 15px;
            font-size: 14px;
            padding: 0 10px;
            color: #222;
            margin-right: 5px;
        }
        .sous-menu a div:hover {
            background-color: #FFF;
        }
        footer {
            background-color: #222;
            padding: 0 10px;
        }
    </style>
</head>
<body>

    <div class="menu-bar">
        <table width="100%">
            <tr>
                <td width="45">
                    <a href="{{route('index')}}">
                        <img src="{{ URL::asset('assets/images/logo.png') }}" class="rounded" width="100%" alt="">
                    </a>
                </td>
                <td>
                    <form action="" method="post" class="search-form">
                        @csrf

                        <input type="text" name="search" id="search" placeholder="Rechercher un produit ...">
                        <button class="green darken-3 white-text" type="submit">
                            Rechercher
                        </button>
                    </form>
                </td>
                <td>

                </td>
                <td class="text-right">
                    <a href="" class="white-text">
                        <strong>Qui sommes nous ?</strong>
                    </a>&nbsp;&nbsp;
                    <a href="" class="btn btn-white btn-md m-0 z-depth-0 pl-3 pr-3">
                        <i class="icofont-phone"></i>
                        Contacts
                    </a>
                </td>
            </tr>
        </table>
    </div>
    <div class="sous-menu">
        <div class="container-fluid">
            <div class="row">
                @forelse ($categories as $categorie)    
                    <a href="">
                        <div>
                            <strong>{{ $categorie->nom }}</strong>
                        </div>
                    </a>
                @empty
                    
                @endforelse
            </div>
        </div>
    </div>

    @yield('content')

    <footer><br /><br />
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <b class="white-text"><i class="icofont-map-pins"></i> OU VOUS POUVEZ NOUS TROUVER</b><br />
                    <div class="row">
                        <div class="col-6">
                            <img src="{{ URL::asset('assets/images/3.jpg') }}" width="100%" alt="">
                            <div class="white-text" style="font-size: 14px;">TOGOSIME ADIDOGOME</div>
                        </div>
                        <div class="col-6">
                            <img src="{{ URL::asset('assets/images/3.jpg') }}" width="100%" alt="">
                            <div class="white-text" style="font-size: 14px;">TOGOSIME HEDZRANAWOE</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12"><br />
                    <b class="white-text"><i class="icofont-question-circle"></i> QUI SOMMES-NOUS ?</b><br />
                    <div class="white-text" style="text-align: justify;">
                        Lorem ipsum dolor sit, amet consectetur
                        adipisicing elit. Deleniti commodi harum
                        adipisicing elit.
                        sunt quia voluptatibus qui, ex in. Sit ni ...
                        <a href="" class="cyan-text">Lire plus</a>
                    </div><br />
                    <b class="white-text">NOS CONTACTS</b>
                    <address class="white-text">
                        whatsapp : +22891732811<br />
                        Téléphone : +22891732811<br />
                    </address>
                </div>
            </div>
        </div><br />
    </footer>

    <script src="{{URL::asset('mdb/js/popper.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/jquery.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/bootstrap.min.js')}}"></script>
    <script src="{{URL::asset('mdb/js/mdb.min.js')}}"></script>
    @yield('script')
</body>
</html>