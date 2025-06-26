<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('extraComponents.headerWrapper', [
    'titlePage' => 'Adicionar Produto',
    'page' => 'Adicionar'
        ])

    <!-- Main content -->
    <form class="content" action="{{ route('storeProduct') }}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informações do produto</h3>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="form-group">
                            <label for="productName">Nome do Produto</label>
                            <input type="text" id="productName" name="nome" class="form-control" placeholder="Meu produto" value="{{ old('nome') }}">
                        </div>

                        <div class="form-group">
                            <label for="product_code">Código do produto</label>
                            <input type="text" id="product_code" name="codigo" class="form-control" placeholder="XXXXXX XXXXXX" value="{{ old('codigo') }}">
                        </div>

                        <div class="form-group">
                            <label for="data_de_compra">Data de Compra</label>
                            <input type="text" id="data_de_compra" name="data_de_compra" class="form-control" placeholder="XX/XX/XXXX" value="{{ old('data_de_compra') }}">
                        </div>

                        <div class="form-group">
                            <label for="data_de_vencimento">Data de Vencimento</label>
                            <input type="text" id="data_de_vencimento" name="data_de_vencimento" class="form-control" placeholder="XX/XX/XXXX (opcional)" value="{{ old('data_de_vencimento') }}">
                        </div>

                        <div class="form-group">
                            <label for="valor_de_compra">Valor de compra</label>
                            <input type="number" step="0.01" id="valor_de_compra" name="valor_de_compra" class="form-control" placeholder="10.00" value="{{ old('valor_de_compra') }}">
                        </div>

                        <div class="form-group">
                            <label for="valor_de_venda">Valor de Venda</label>
                            <input type="number" step="0.01" id="valor_de_venda" name="valor_de_venda" class="form-control" placeholder="15.00" value="{{ old('valor_de_venda') }}">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantidade</label>
                            <input type="number" id="quantity" name="quantidade" class="form-control" placeholder="ex: 4" value="{{ old('quantidade') }}">
                        </div>

                        <div class="form-group">
                            <label for="manufacturer">Fabricante</label>
                            <input type="text" id="manufacturer" name="fabricante" class="form-control" placeholder="Fabricante 1" value="{{ old('fabricante') }}">
                        </div>

                        <div class="form-group">
                            <label for="manufacturer_email">Email do Fabricante</label>
                            <input type="text" id="manufacturer_email" name="email" class="form-control" placeholder="fabricante@fabricante.com" value="{{ old('email') }}">
                        </div>

                        <div class="form-group">
                            <label for="manufacturer_address">Endereço do Fabricante</label>
                            <input type="text" id="manufacturer_address" name="endereco" class="form-control" placeholder="Rua do fabricante 244" value="{{ old('endereco') }}">
                        </div>

                        <div class="form-group">
                            <label for="manufacturer_phone">Telefone do Fabricante</label>
                            <input type="text" id="manufacturer_phone" name="numero" class="form-control" placeholder="XX XXXXXXXXX" value="{{ old('numero') }}">
                        </div>

                        <div class="form-group">
                            <label for="manufacturer_cnpj">CNPJ do Fabricante</label>
                            <input type="text" id="manufacturer_cnpj" name="cnpj" class="form-control" placeholder="XX.XXX.XXX/XXXX-XX" value="{{ old('cnpj') }}">
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('products') }}" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="Adicionar" class="btn btn-success float-right">
            </div>
        </div>
    </form>

    <!-- /.content -->
</div>
