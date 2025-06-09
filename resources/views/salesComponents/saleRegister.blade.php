<section class="col-lg-6 connectedSortable">
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Registrar Venda</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post" action="{{ route('saleRegister') }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger mt-2">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="card-body">
                <div class="form-group">
                    <label>Produto que deseja registrar venda</label>
                    @if($products->count() > 0)
                        <select class="custom-select" id="produto" name="produto" required>
                            <option value="">Selecione um produto</option>
                            @foreach($products as $product)
                                <option value="{{ $product->code }}">{{ $product->name }} - codigo: {{ $product->code  }}</option>
                            @endforeach
                        </select>
                    @else
                        <p>Nenhum produto cadastrado.</p>
                    @endif
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email do comprador</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">Quantidade vendida</label>
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="Quantidade" value="{{ old('quantidade') }}">
                </div>
                <div class="form-group">
                    <label for="inputClientCompany">Data de Venda</label>
                    <input type="text" id="data_de_venda" name="data_de_venda" class="form-control" placeholder="XX/XX/XXXX" value="{{ old('data_de_venda') }}">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">comprovante de pagamento</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="comprovante" name="comprovante">
                            <label class="custom-file-label" for="exampleInputFile">Pegar comprovante</label>
                        </div>

                    </div>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</section>
