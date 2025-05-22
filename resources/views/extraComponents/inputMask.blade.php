<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
    $(document).ready(function(){
        $('input[name="manufacturer_cnpj"]').mask('00.000.000/0000-00');
        $('input[name="valor_de_compra"], input[name="valor_de_venda"]').mask('000000.00', {reverse: true});
        $('input[name="data_de_compra"],input[name="data_de_venda"]').mask('00/00/0000');
    });
</script>
