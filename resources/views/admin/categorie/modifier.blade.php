@extends('templates/adminTemplate')

@section('indexAdmin')

    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexCategories') }}"><b>Catégories</b></a>
            <span class="breadcrumb-item active">Modifier</span>
        </nav>

        <span class="font-weight-bold">
            <i class="fas fa-edit    "></i>
            Modifier catégorie
        </span><br /><br />

        @if($message = Session::get('message'))

            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <strong>{{$message}}</strong> 
            </div>

        @endif
        
        <script>
          $(".alert").alert();
        </script>

        @foreach($categories as $categorie)
        
            <form action="{{ route('updateCategorie', $categorie->id) }}" method="post">

                {{ csrf_field() }}

                <table>
                    <tr>
                        <td width="300">
                            <label for="nom"><b>Nom de la catégorie</b></label>
                            <input type="text" required class="form-control" id="nom" name='nom' value="{{ $categorie->nom }}">
                        </td>
                        <td width="300">
                            <label for="description"><b>Description de la catégorie</b></label>
                            <input type="text" required class="form-control" id="description" name='description' value="{{ $categorie->description }}">
                        </td>
                        <td width="150">
                            <label for="gamme"><b>Gamme</b></label>
                            <select name="gamme_produit_id" id="gamme" class="form-control">
                                @foreach($gammes as $gamme)
                                    <option <?=($categorie->gamme_produit_id == $gamme->id) ? 'selected' : '' ?>
                                    value="{{ $gamme->id }}">{{ $gamme->nom }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td width="100">
                            <button type="submit" style="margin-top: 30px;" class="btn btn-md btn-green white-text rounded btn-block">
                                Modifier
                            </button>
                        </td>
                    </tr>
                </table><hr />

            </form>
        @endforeach

    </div>

@endsection