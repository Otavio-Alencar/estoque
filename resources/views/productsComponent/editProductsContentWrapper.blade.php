<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Adicionar Produto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Adicionar Produto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <form class="content" action="{{ route('productEdit') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Informações do produto</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
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
                            <label for="inputName">Nome do Produto</label>
                            <input type="text" id="productName" name="nome" value="{{ $product->name }}" class="form-control" placeholder="Meu produto">
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Código do produto</label>
                            <input type="text" id="product_code" name="codigo" value="{{ $product->code }}" class="form-control" placeholder="XXXXXX XXXXXX">
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Data de Compra</label>
                            <input type="text" id="data_de_compra" value="{{ $date }}" name="data_de_compra" class="form-control" placeholder="XX/XX/XXXX">
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Valor de compra</label>
                            <input type="number" step="0.01" id="valor_de_compra" value="{{ $item->purchase_value }}" name="valor_de_compra" class="form-control" placeholder="10.00">
                        </div>
                        <div class="form-group">
                            <label for="inputClientCompany">Valor de Venda</label>
                            <input type="number" step="0.01" id="valor_de_venda"  value="{{ $item->sale_value }}" name="valor_de_venda" class="form-control" placeholder="15.00">
                        </div>
                        <div class="form-group">
                            <label for="inputEstimatedBudget">Quantidade</label>
                            <input type="number" id="quantity" name="quantidade" value="{{ $item->quantity }}" class="form-control" placeholder="ex: 4">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Fabricante</label>
                            <input type="text" id="manufacturer" name="fabricante" value="{{ $manufacturer->name }}" class="form-control" placeholder="Fabricante 1">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Email do Fabricante</label>
                            <input type="text" id="manufacturer_email" name="email" value="{{ $manufacturer->email }}" class="form-control" placeholder="fabricante@fabricante.com">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Endereço do Fabricante</label>
                            <input type="text" id="manufacturer_address" name="endereco"  value="{{ $manufacturer->address}}" class="form-control" placeholder="Rua do fabricante 244">
                        </div>
                        <div class="form-group">
                            <label for="inputName">Telefone do Fabricante</label>
                            <input type="text" id="manufacturer_phone" name="numero" class="form-control" value="{{ $manufacturer->phone }}" placeholder="XX XXXXXXXXX">
                        </div>
                        <div class="form-group">
                            <label for="inputName">CNPJ do Fabricante</label>
                            <input type="text" id="manufacturer_cnpj" name="cnpj" class="form-control" value="{{ $manufacturer->cnpj }}" placeholder="XX.XXX.XXX/XXXX-XX">
                        </div>
                         <div class="form-group">
                             <input type="hidden" id="original_code" name="original_code" class="form-control" value="{{ $code }}" placeholder="XX.XXX.XXX/XXXX-XX">
                         </div>


                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <a href="{{ route('products') }}" class="btn btn-secondary">Cancelar</a>
                <input type="submit" value="enviar" class="btn btn-success float-right">
            </div>
        </div>
    </form>
    <!-- /.content -->
</div>
