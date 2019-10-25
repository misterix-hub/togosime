@extends('templates.visitorTemplate')

@section('indexVisitor')

<div class="container">
    <div class="row">
        <div class="col-12 pt-3 pt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="{{ route('indexVisitor') }}">Accueil</a>
                <span class="breadcrumb-item active">Titre de page</span>
            </nav>
        </div>
    </div><br />
    <div class="row">
        <div class="col-lg-8 col-md-12 col-sm-12">
            @foreach($pages as  $page)

                <h1>{{ $page->nom }}</h1><br />

                <div>
                    {{ $page->contenu }}
                </div><br />

                <ul>
                    @foreach($ligne_pages as $ligne_page)
                        @if($page->id == $ligne_page->page_id)
                            <li>
                                {{ $ligne_page->ligne }}
                            </li>
                        @endif
                    @endforeach
                </ul>
            @endforeach

        </div>
    </div>
</div><br /><br /><br /><br /><br /><br />

@endsection