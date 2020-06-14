@extends('template')

@section('content')
    <div class="content">
        <div class="row" style="margin-bottom: 2%">
            <div class="col-md-9">
                <h4>Listagem de usuários</h4>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success pull-right">
                    <i class="fa fa-refresh" aria-hidden="true"></i> Sincronizar
                </button>
            </div>
        </div>

        <table id="datatable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Nome</th>
                <th width="5%">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nome }}</td>
                    <td>
                        <button type="button" class="btn btn-primary">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script type="application/javascript">
        $(function () {
            $('#datatable').DataTable();
        });
    </script>
@endsection

