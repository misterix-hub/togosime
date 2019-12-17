@extends('visitors.base')

@section('content')
<br>
<div class="container">
    <div class="row">
        @include('visitors.included.for', ['produits'=>$produits])
    </div>
</div>
@endsection
