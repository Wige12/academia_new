<?php
	$sql = mysql_query("SELECT * FROM clientes");
		$conta = mysql_num_rows($sql);
		if($conta != 0){
?>
<a href="<?php echo base_url();?>index.php/vendas/adicionar" class="btn btn-success" style="float: left;"><i class="icon-plus icon-white"></i> Adicionar Venda</a>

<form action="<?php echo current_url().'/adicionar'; ?>" method="post" id="formVendas" style="float: left;">
<input id="dataVenda" class="span12 datepicker" type="hidden" name="dataVenda" value="<?php echo date('d/m/Y');?>" autofocus=""  />
<input id="clientes_id" class="span12" type="hidden" name="clientes_id" value="1"  />
<input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value="<?php echo $usuario->idUsuarios?>"  />

<button class="btn btn-link" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Venda Rápida</button>
</form>
<?php }else{
	echo '<span class="alert alert-error">Cadastre o seu estabelecimento como o 1º cliente para realizar "<b>vendas</b>" e "<b>venda rápida</b>"</span>';
}?>
<a href="<?php echo base_url();?>index.php/os/" class="btn btn-link" style="float: right;"><i class="icon-list icon-white"></i> Orçamentos</a>

<br />
<br />
<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-shopping-cart"></i>
         </span>
        <h5>Vendas</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data da Venda</th>
            <th>Cliente</th>
            <th>Faturado</th>
            <th>Valor Faturado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td colspan="6">Nenhuma venda Cadastrada</td>
        </tr>
    </tbody>
</table>
</div>
</div>
<?php } else{?>

<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-shopping-cart"></i>
         </span>
        <h5>Vendas</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Data da Venda</th>
            <th>Cliente</th>
            <th>Faturado</th>
            <th>Valor Faturado</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $r) {
            $dataVenda = date(('d/m/Y'),strtotime($r->dataVenda));
            if($r->faturado == 1){$faturado = 'Sim';} else{ $faturado = 'Não';}           
            echo '<tr>';
            echo '<td>'.$r->idVendas.'</td>';
            echo '<td>'.$dataVenda.'</td>';
            echo '<td><a href="'.base_url().'index.php/clientes/visualizar/'.$r->idClientes.'" style="color:#08c;">'.$r->nomeCliente.'</a></td>';
            echo '<td><center>'.$faturado.'</center></td>';
            if ($r->valorTotal == ""){echo '<td>Não Faturado</td>';}else{echo '<td>'.$r->valorTotal.'</td>';}
            
            echo '<td><a href="'.base_url().'index.php/vendas/visualizar/'.$r->idVendas.'" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>
                      <a href="'.base_url().'index.php/vendas/editar/'.$r->idVendas.'" class="btn btn-info tip-top" title="Editar venda"><i class="icon-pencil icon-white"></i></a>
                      <a href="#modal-excluir" role="button" data-toggle="modal" venda="'.$r->idVendas.'" class="btn btn-danger tip-top" title="Excluir Venda"><i class="icon-remove icon-white"></i></a>  
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
  <form action="<?php echo base_url() ?>index.php/vendas/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Excluir Venda</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idVenda" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente excluir esta Venda?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>






<script type="text/javascript">
$(document).ready(function(){


   $(document).on('click', 'a', function(event) {
        
        var venda = $(this).attr('venda');
        $('#idVenda').val(venda);

    });

});

</script>