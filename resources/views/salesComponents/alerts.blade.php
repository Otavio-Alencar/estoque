<section class="col-lg-6 connectedSortable">
    <div class="card card-default">

        <div class="card-header">
            <h3 class="card-title">
                <i class="fas fa-exclamation-triangle"></i>
                Avisos
            </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">

            @if($dangerItems)
                @foreach($dangerItems as $item)
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @php
                            $product = $item->product
                        @endphp
                        <h5><i class="icon fas fa-ban"></i> Alerta!</h5>
                        o item {{ $product->name }} acabou!
                    </div>
                @endforeach

            @endif

            @if($alertItems)
                @foreach($alertItems as $item)
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        @php
                            $product = $item->product
                        @endphp
                        <h5><i class="icon fas fa-ban"></i> Cuidado!</h5>
                        o item {{ $product->name }} tem apenas {{ $item->quantity }} unidades
                    </div>
                @endforeach

            @endif




        </div>
        <!-- /.card-body -->
    </div>
</section>
