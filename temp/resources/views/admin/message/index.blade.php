@extends('templates/adminTemplate')

@section('indexAdmin')
    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Messages</span>
        </nav>

        <span class="font-weight-bold">Messages</span><br /><br />

        @if($message = Session::get('message'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{$message}}</strong> 
            </div>

        @endif
        
        
        <table class="table table-hover table-inverse">
            <thead class="thead-inverse" width="100%">
                <tr>
                    <th>
                        <b>Contact</b>
                    </th>
                    <th>
                        <b>Message</b>
                    </th>
                    <th class="text-center">
                        <b>Supprimer</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td scope="row">
                                <b><?=($message->contact != '') ? $message->contact : '<i>Non renseigné !</i>'; ?></b>
                            </td>
                           <td>
                                <b>{{ $message->message }}</b>
                           </td>
                            <td  width="20">
                                <a href="{{route('supprimerMessage', $message->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">
                                <div class="text-center">
                                    <b>Aucun nouveau message</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </table>

    </div>

@endsection