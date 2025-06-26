<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('extraComponents.headerWrapper', [
    'titlePage' => 'Vendas',
    'page' => 'Vendas'
        ])

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- COLOR PALETTE -->

            <!-- /.card -->
            <!-- START ALERTS AND CALLOUTS -->


            <div class="row">
                @include('salesComponents.saleRegister')
                @include('salesComponents.alerts')

            </div>
            @include('salesComponents.salesTable')
        </div>
    </section>
</div>
