@extends('template')

@section('content')
    <div class="content">
        <div class="row" style="margin-bottom: 2%">
            <div class="col-md-9">
                <h4>Detalhes do usuário {{$usuario->nome}}</h4>
            </div>
            <div class="col-md-3">
                <a href="/" class="btn btn-info pull-right">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                </a>
            </div>
        </div>

        <div class="card row" onclick="toggle('informacoes')" style="cursor: pointer">
            <div class="card-header">
                Informações
            </div>
            <div class="row col-md-12" id="informacoes">
                <div class="form-group col-md-4">
                    <label>Nome</label>
                    <p class="form-control">{!! $usuario->nome !!}</p>
                </div>
                <div class="form-group col-md-4">
                    <label>CPF</label>
                    <p class="form-control">{!! $usuario->cpf !!}</p>
                </div>
                <div class="form-group col-md-4">
                    <label>Idade</label>
                    <p class="form-control">{!! $usuario->idade !!}</p>
                </div>
                <div class="form-group col-md-4">
                    <label>Última consulta do CPF</label>
                    <p class="form-control">
                        {!! $usuario->ultima_consulta_cpf !!}
                    </p>
                </div>
                <div class="form-group col-md-4">
                    <label>Criado em</label>
                    <p class="form-control">{!! $usuario->created_at->format('d/m/Y H:i') !!}</p>
                </div>
                <div class="form-group col-md-4">
                    <label>Atualizado em</label>
                    <p class="form-control">{!! $usuario->updated_at->format('d/m/Y H:i') !!}</p>
                </div>
            </div>
        </div>
        @if($usuario->endereco)
            <br>
            <div class="card row" onclick="toggle('endereco')" style="cursor: pointer">
                <div class="card-header">
                    Endereço
                </div>
                <div class="row col-md-12" id="endereco" style="display: none;">
                    <div class="form-group col-md-4">
                        <label>CEP</label>
                        <p class="form-control">{!! $usuario->endereco->cep !!}</p>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Logradouro</label>
                        <p class="form-control">{!! $usuario->endereco->logradouro !!}</p>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Bairro</label>
                        <p class="form-control">{!! $usuario->endereco->bairro !!}</p>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Cidade</label>
                        <p class="form-control">{!! $usuario->endereco->cidade !!}</p>
                    </div>
                    <div class="form-group col-md-4">
                        <label>UF</label>
                        <p class="form-control">{!! $usuario->endereco->uf !!}</p>
                    </div>
                </div>
            </div>
        @endif
        <br>
        <div class="card row" onclick="toggle('lista_de_dividas')" style="cursor: pointer">
            <div class="card-header">
                Lista de dívidas
            </div>
            <div class="row col-md-12" id="lista_de_dividas" style="display: none;">
                @foreach($usuario->listaDeDividas as $lista_de_divida)
                    <div class="form-group col-md-6">
                        <label>Descrição</label>
                        <p class="form-control">{!! $lista_de_divida->descricao !!}</p>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Valor</label>
                        <p class="form-control">{!! $lista_de_divida->valor !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card row" onclick="toggle('fontes_de_renda')" style="cursor: pointer">
            <div class="card-header">
                Fontes de renda
            </div>
            <div class="row col-md-12" id="fontes_de_renda" style="display: none;">
                @foreach($usuario->fontesDeRendas as $fonte_de_renda)
                    <div class="form-group col-md-6">
                        <label>Descrição</label>
                        <p class="form-control">{!! $fonte_de_renda->descricao !!}</p>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Valor</label>
                        <p class="form-control">{!! $fonte_de_renda->valor !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
        <br>
        <div class="card row" onclick="toggle('movimentacoes_financeiras')" style="cursor: pointer">
            <div class="card-header">
                Movimentações financeiras
            </div>
            <div class="row col-md-12" id="movimentacoes_financeiras" style="display: none;">
                @foreach($usuario->movimentacoesFinanceiras as $movimentacao_financeira)
                    <div class="form-group col-md-6">
                        <label>Descrição</label>
                        <p class="form-control">{!! $movimentacao_financeira->descricao !!}</p>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Valor</label>
                        <p class="form-control">{!! $movimentacao_financeira->valor !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function toggle(id) {
            $('#' + id).toggle();
        }
    </script>
@endsection

