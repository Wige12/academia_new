<a href="<?php echo base_url();?>index.php/produtos/adicionar" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Produto</a>
<a href="<?php echo base_url();?>index.php/produtos/desativados" class="btn btn-link"><i class="icon-plus icon-white"></i> Produtos desativados</a>
<a  href="#modal-etiquetas" role="button" data-toggle="modal" class="btn btn-link" style="float: right;"><i class="icon-barcode icon-white"></i> Gerar Etiquetas</a>
<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Produtos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Estoque</th>
            <th>Preço</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="5">Nenhum Produto Cadastrado</td>
        </tr>
    </tbody>
</table>
</div>
</div>

<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-barcode"></i>
         </span>
        <h5>Produtos</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Nome</th>
            <th>Estoque</th>
            <th>Preço</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            echo '<tr>';
            echo '<td>'.$r->idProdutos.'</td>';
            echo '<td>'.$r->descricao.'</td>';
            echo '<td>'.$r->estoque.'</td>';
            echo '<td>'.number_format($r->precoVenda,2,',','.').'</td>';
            
            echo '<td>
                      <a href="'.base_url().'index.php/produtos/visualizar/'.$r->idProdutos.'" class="btn tip-top" title="Visualizar Produto"><i class="icon-eye-open"></i></a>  
                      <a href="'.base_url().'index.php/produtos/editar/'.$r->idProdutos.'" class="btn btn-info tip-top" title="Editar Produto"><i class="icon-pencil icon-white"></i></a>
                      <a href="#modal-excluir" role="button" data-toggle="modal" produto="'.$r->idProdutos.'" class="btn btn-danger tip-top" title="Excluir Produto"><i class="icon-remove icon-white"></i></a>
                  </td>';
            echo '</tr>';
        }?>
        <tr>
            
        </tr>
    </tbody>
</table>
</div>
</div>
	
<?php echo $this->pagination->create_links();}?>



<!-- Modal -->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/produtos/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Produto</h5>
  </div>
  <div class="modal-body">
    <span class="span12 alert alert-error" style="margin-left: 0"><b>Atenção:</b> Ao desativar o produto, o mesmo não poderá ser adicionado em novas vendas ou orçamentos. Você pode visualizar e ativar novamente este produto clicando na opção "<b>Produtos desativados</b>".</span>
    <input type="hidden" id="idProduto" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente desativar este produto?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Desativar</button>
  </div>
  </form>
</div>



<!-- Modal Etiquetas -->
<div id="modal-etiquetas" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/relatorios/etiquetas" method="get" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Gerar etiquetas com Código de Barras</h5>
  </div>
  <div class="modal-body">
  <div class="span12 alert alert-info" style="margin-left: 0"> Escolha o intervalo de produtos para gerar as etiquetas.</div>
  
		<div class="span12" style="margin-left: 0;">
			<div class="span6" style="margin-left: 0;"> 
	          <label for="valor">De</label>
	          <input class="span9" style="margin-left: 0" type="text" id="de_id" name="de_id" placeholder="ID do primeiro produto" value="" />
			</div>

			<div class="span6"> 
	          <label for="valor">Até</label>
	          <input class="span9" type="text" id="ate_id" name="ate_id"  placeholder="ID do último produto" value="" />
			</div>
	  </div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-success">Gerar</button>
  </div>
  </form>
</div>


<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var produto = $(this).attr('produto');
        $('#idProduto').val(produto);

    });

});

</script>