@extends('template')

@section('content')
    <div class="content">
        <div class="row" style="margin-bottom: 2%">
            <div class="col-md-9">
                <h4>Detalhes do usuário {{$usuario->nome}}</h4>
            </div>
            <div class="col-md-3">
                <a href="/" class="btn btn-info pull-right" onclick="startLoading();">
                    <i class="fa fa-chevron-left" aria-hidden="true"></i> Voltar
                </a>
            </div>
        </div>

        <div class="card row">
            <div class="card-header" onclick="toggle('informacoes')" style="cursor: pointer">
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
            <div class="card row">
                <div class="card-header" onclick="toggle('endereco')" style="cursor: pointer">
                    Endereço
                </div>
                <div class="row col-md-12" id="endereco" style="display: none;">
                    <div class="form-group col-md-4">
                        <label>CEP</label>
                        <p class="form-control">{!! $usuario->endereco->cep !!}</p>
                    </div>
                    <div class="form-group col-md-8">
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
        @if(count($usuario->listaDeDividas))
            <br>
            <div class="card row">
                <div class="card-header" onclick="toggle('lista_de_dividas')" style="cursor: pointer">
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
        @endif
        @if(count($usuario->fontesDeRendas))
            <br>
            <div class="card row">
                <div class="card-header" onclick="toggle('fontes_de_renda')" style="cursor: pointer">
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
        @endif
        @if(count($usuario->movimentacoesFinanceiras))
            <br>
            <div class="card row">
                <div class="card-header" onclick="toggle('movimentacoes_financeiras')" style="cursor: pointer">
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
        @endif
        @if($usuario->dadoUltimaCompraCartaoCredito)
            <br>
            <div class="card row">
                <div class="card-header" onclick="toggle('dado_ultima_compra_cartao_credito')" style="cursor: pointer">
                    Dados da última compra com cartao de crédito
                </div>
                <div class="row col-md-12" id="dado_ultima_compra_cartao_credito" style="display: none;">
                    <div class="form-group col-md-3">
                        <label>Bandeira</label>
                        <p class="form-control">{!! $usuario->dadoUltimaCompraCartaoCredito->bandeira !!}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Número</label>
                        <p class="form-control">{!! $usuario->dadoUltimaCompraCartaoCredito->numero !!}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Vencimento</label>
                        <p class="form-control">{!! $usuario->dadoUltimaCompraCartaoCredito->vencimento !!}</p>
                    </div>
                    <div class="form-group col-md-3">
                        <label>Valor</label>
                        <p class="form-control">{!! $usuario->dadoUltimaCompraCartaoCredito->valor !!}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        function toggle(id) {
            $('#' + id).toggle();
        }
    </script>
@endsection

