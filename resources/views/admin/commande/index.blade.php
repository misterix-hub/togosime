@extends('templates/adminTemplate')

@section('indexAdmin')
    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <span class="breadcrumb-item active">Commandes</span>
        </nav>

        <span class="font-weight-bold">Commandes</span><br /><br />

        @if($message = Session::get('message'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{$message}}</strong> 
            </div>

        @endif
        
        <!-- Button trigger modal -->
        <div class="text-right">
            <button type="button" class="btn btn-white btn-md" data-toggle="modal" data-target="#modelId">
                <i class="fa fa-check" aria-hidden="true"></i>
                <b>Voir les commandes validées</b>
            </button>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content rounded">
                    <div class="modal-header">
                        <h5 class="modal-title">Commandes validées</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                        <table class="table table-hover table-inverse">
                            <thead class="thead-inverse" width="100%">
                                <tr>
                                    <th>
                                        <b>Contact</b>
                                    </th>
                                    <th>
                                        <b>Produit demandé</b>
                                    </th>
                                    <th>
                                        <b>Prix</b>
                                    </th>
                                    <th class="text-center">
                                        <b>Supprimer</b>
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse($commandesV as $commandeV)
                                        <tr>
                                            <td scope="row">
                                                <b>{{ $commandeV->contact }}</b>
                                            </td>
                                            @foreach($produits as $produit)
                                                @if($produit->id == $commandeV->produit_id)
                                                    <td>
                                                        <b>{{$produit->nom}}</b>
                                                    </td>
                                                    <td class="text-right">
                                                        <b>{{$produit->prix}} F cfa</b>
                                                    </td>
                                                @endif
                                            @endforeach
                                            <td  width="20">
                                                <a href="{{route('supprimerCommande', $commandeV->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td scope="row" colspan="4">
                                                <div class="text-center">
                                                    <b>Aucune commande confirmée !</b>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
        <table class="table table-hover table-inverse">
            <thead class="thead-inverse" width="100%">
                <tr>
                    <th>
                        <b>Contact</b>
                    </th>
                    <th>
                        <b>Produit demandé</b>
                    </th>
                    <th>
                        <b>Prix</b>
                    </th>
                    <th colspan="2" class="text-center">
                        <b>Action</b>
                    </th>
                </tr>
                </thead>
                <tbody>
                    @forelse($commandes as $commande)
                        <tr>
                            <td scope="row">
                                <b>{{ $commande->contact }}</b>
                            </td>
                            @foreach($produits as $produit)
                                @if($produit->id == $commande->produit_id)
                                    <td>
                                        <b>{{$produit->nom}}</b>
                                    </td>
                                    <td class="text-right">
                                        <b>{{$produit->prix}} F cfa</b>
                                    </td>
                                @endif
                            @endforeach
                            <td width="20">
                                <a href="{{ route('validerCommande', $commande->id) }}" class="btn btn-success btn-primary btn-sm rounded btn-block">
                                    <i class="fa fa-check" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td  width="20">
                                <a href="{{route('supprimerCommande', $commande->id)}}" class="btn btn-danger btn-primary btn-sm rounded btn-block">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td scope="row" colspan="4">
                                <div class="text-center">
                                    <b>Aucune nouvelle commande !</b>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
        </table>

    </div>

@endsection