<div class="card">
    <div class="card-header">
        <h3 class="card-title">Suas vendas</h3>
    </div>

    <div class="card-body p-0">
        <table class="table table-hover">
            <tbody>
            @if($sales->count() > 0)
                @foreach($sales as $sale)
                    <!-- Linha principal da venda -->
                    <tr data-widget="expandable-table" aria-expanded="false">
                        <td>
                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                            {{ $sale->product->name }} - CÓDIGO: {{ $sale->product->code }} - {{ $sale->sale_date }}
                        </td>
                    </tr>

                    <!-- Detalhes da venda -->
                    <tr class="expandable-body d-none">
                        <td>
                            <div class="p-0">
                                <table class="table table-hover">
                                    <tbody>
                                    <!-- Gatilho para Informações de venda -->
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>
                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            Informações de venda
                                        </td>
                                    </tr>
                                    <!-- Corpo expandido da venda -->
                                    <tr class="expandable-body d-none">
                                        <td>
                                            <div class="p-0">
                                                <table class="table table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>Quantidade vendida: {{ $sale->quantity }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Preço: {{ $sale->sale_value }} R$</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Lucro: {{ $sale->sale_value * $sale->quantity }} R$</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Data de venda: {{ $sale->sale_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Comprovante de pagamento:
                                                            <a href="{{ route('comprovante.download', ['filename' => $sale->proof]) }}">Baixar comprovante</a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Gatilho para Informações de produto -->
                                    <tr data-widget="expandable-table" aria-expanded="false">
                                        <td>
                                            <i class="expandable-table-caret fas fa-caret-right fa-fw"></i>
                                            Informações de produto
                                        </td>
                                    </tr>
                                    <!-- Corpo expandido do produto -->
                                    <tr class="expandable-body d-none">
                                        <td>
                                            <div class="p-0">
                                                <table class="table table-hover">
                                                    <tbody>
                                                    <tr>
                                                        <td>Nome do Produto: {{ $sale->product->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fornecedor: {{ $sale->manufacturer->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Código: {{ $sale->product->code }}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="1">Não há vendas registradas</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
</div>
