@extends('template')

@section('content')
    <div class="content">
        <div class="row" style="margin-bottom: 2%">
            <div class="col-md-9">
                <h4>Listagem de usuários</h4>
            </div>
            <div class="col-md-3">
                <button type="button" class="btn btn-success pull-right"
                        onclick="syncBases()">
                    <i class="fa fa-refresh" aria-hidden="true"></i> Sincronizar
                </button>
            </div>
        </div>

        <table id="datatable" class="display" style="width:100%">
            <thead>
            <tr>
                <th>NOME</th>
                <th>CPF</th>
                <th>Idade</th>
                <th>Última consulta CPF</th>
                <th>Última sincronização</th>
                <th width="5%">Ações</th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr>
                    <td>{{ $usuario->nome }}</td>
                    <td>{{ $usuario->cpf }}</td>
                    <td>{{ $usuario->idade }}</td>
                    <td>{{ $usuario->ultima_consulta_cpf}}</td>
                    <td>{{ $usuario->updated_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="/usuario/{{$usuario->id}}" class="btn btn-primary">
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
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

        function syncBases() {
            startLoading();
            $.ajax({
                url: '/api/syncBases',
                type: 'GET'
            }).done(function (data) {
                if (data.success) {
                    location.reload();
                } else {
                    stopLoading();
                    alert(data.message)
                }
            });
        }
    </script>
@endsection

