@extends('templates.visitorTemplate')

@section('indexVisitor')

<div class="container">
    <div class="row">
        <div class="col-12 pt-3">
            <nav class="breadcrumb">
                <a class="breadcrumb-item" href="{{ route('indexVisitor') }}">Home</a>
                <span class="breadcrumb-item active">Nous écrire</span>
            </nav>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-sm-12">

        @if($message = Session::get('message'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <strong>{{ $message }}</strong>
            </div>
        @endif


        <h5>
            Envoyez-nous un messages ici
        </h5><br />

        <form action="{{ route('envoyerMessage') }}" method="post">
            {{ csrf_field() }}
            <label for="contact">Téléphone ou email</label>
            <input type="text" class="form-control" name="contact" placeholder="Saisir votre email ou téléphone"><br />
            
            <label for="message">Contenu du message *</label>
            <textarea name="message" minLentgh="5" maxLength="500" required id="message" rows="5" class="form-control" placeholder="Saisir dans le champs ..."></textarea>
            
            <button type="submit" class="btn btn-green white-text rounded ml-0 btn-md">
                Envoyer
            </button>
        </form>

    </div>
</div><br /><br /><br /><br /><br />

@endsection