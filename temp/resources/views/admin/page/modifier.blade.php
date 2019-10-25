@extends('templates/adminTemplate')

@section('indexAdmin')

    <div>

        <nav class="breadcrumb">
            <a class="breadcrumb-item" href="{{ route('indexAdmin') }}"><b>Home</b></a>
            <a class="breadcrumb-item" href="{{ route('indexPages') }}"><b>Pages</b></a>
            <span class="breadcrumb-item active">Modifier</span>
        </nav>

        <span class="font-weight-bold">
            <i class="fas fa-edit    "></i>
            Modifier Page
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

        @foreach($pages as $page)
        
            <form action="{{ route('updatePage', $page->id) }}" method="post">

                {{ csrf_field() }}

                <table>
                    <tr>
                        <td width="400">
                            <label for="nom"><b>Nom de la page</b></label>
                            <input type="text" required class="form-control" id="nom" name='nom' value="{{ $page->nom }}">
                        </td>
                        <td width="300">
                            <label for="icone"><b>icone de la page</b></label>
                            <input type="text" required class="form-control" id="icone" name='icone' value="{{ $page->icone }}">
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'>
                            <textarea name="contenu" id="" rows="3" required class="form-control">{{ $page->contenu }}</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-md btn-green white-text rounded ml-0">
                                Modifier
                            </button>
                        </td>
                    </tr>
                </table><hr />

            </form>
        @endforeach

    </div>

@endsection