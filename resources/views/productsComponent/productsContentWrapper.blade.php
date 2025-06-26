<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('extraComponents.headerWrapper', [
    'titlePage' => 'Produtos',
    'page' => 'Produtos'
        ])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex w-100">
                        <button type="button" onclick="window.location.href='{{ route('addProduct') }}'" class="btn btn-primary flex-fill">Adicionar Produto</button>
                        <button type="button" onclick="window.location.href='{{ route('productCodeEdit') }}'"  class="btn btn-success flex-fill ml-2">Editar Produto</button>
                        <button type="button" onclick="window.location.href='{{ route('productCodeDelete') }}'" class="btn btn-danger flex-fill ml-2">Excluir Produto</button>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header">
                            <h3 class="card-title">Tabela de Produtos</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Valor de compra</th>
                                    <th>Valor de venda</th>
                                    <th>Quantidade</th>
                                    <th>Vencimento</th>
                                    <th>Vendas Registradas</th>
                                    <th>Código</th>
                                    <th>Fabricante</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($produtos as $item)
                                    <tr>
                                        <td>{{ $item->product->name }}</td>
                                        <td>{{ $item->purchase_value }}</td>
                                        <td>{{ $item->sale_value }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>{{ $item->due_date ?? 'Sem vencimento' }}</td>
                                        <td>{{ $item->quantity_sold }}</td>
                                        <td>{{ $item->product_code }}</td>
                                        <td>{{ $item->manufacturer->name }}</td>
                                    </tr>


                                @endforeach



                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
