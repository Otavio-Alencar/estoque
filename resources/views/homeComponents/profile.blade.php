<section class="col-lg-6 connectedSortable">
    <div class="">
        <!-- Widget: user widget style 1 -->
        <div class="card card-widget widget-user shadow">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-info">
                <h3 class="widget-user-username">{{ Auth::user()->name }}</h3>
                <h5 class="widget-user-desc">Administrador</h5>
            </div>
            <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{ Auth::user()->image ?? 'dist/img/avatar.png' }}" alt="User Avatar">
            </div>
            <div class="card-footer">
                <div class="row justify-content-center">
                    <div class="col-sm-4 border-right">
                        <div class="description-block">
                            <h5 class="description-header">{{ $quantitySold }}</h5>
                            <span class="description-text">vendas</span>
                        </div>
                        <!-- /.description-block -->
                    </div>

                    <div class="col-sm-4">
                        <div class="description-block">
                            <h5 class="description-header">{{ $itensQuantity }}</h5>
                            <span class="description-text">Produtos</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
        <!-- /.widget-user -->
    </div>
</section>
