<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<a href="#modalNovoAcompanhamento" data-toggle="modal" class="btn btn-success" style="float: left;"><i class="icon-plus icon-white"></i> Iniciar Novo Acompanhamento</a>
<br />
<br />
<?php if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-shopping-cart"></i>
         </span>
        <h5>Acompanhamentos</h5>

     </div>

				<div class="widget-content nopadding">
					<table class="table table-bordered ">
    					<tbody>
	        				<tr>
					            <td colspan="6"><center><div><h3>Nenhum acompanhamento iniciado</h3></div></center></td>
	        				</tr>
    					</tbody>
					</table>
				</div>
	</div>
<?php } else{?>
			<div class="widget-box">
					<div class="widget-content nopadding">
						<table class="table table-bordered ">
						    <thead>
						        <tr style="backgroud-color: #2D335B">
						            <th>#</th>
						            <th>Aluno</th>
						            <th>Objetivo</th>
						            <th>Última Atualização</th>
						            <th style="width:90px"></th>
						        </tr>
						    </thead>
						    <tbody>
								<?php foreach ($results as $r) {       
								    echo '<tr>';
								    echo '<td>'.$r->id.'</td>';
								    echo '<td>'.$r->nomeCliente.'</td>';
								    if($r->obj_1 == NULL){echo "<td>Nenhuma objetivo adicionado</td>";}else{echo "<td>".$r->obj_1."</td>";}
								    echo "<td>".date(('d/m/Y'),strtotime($r->last_update))."</td>";
								    echo '<td><a href="'.base_url().'index.php/acompanhamento/editar/'.$r->id.'" class="btn"><i class="icon-pencil icon-white"></i></a>
								                      <a href="#modal-excluir" role="button" data-toggle="modal" acompanhamento="'.$r->id.'" class="btn btn-danger"><i class="icon-trash icon-white"></i></a></td>';
								    echo '</tr>';
								        }?>
						    </tbody>
						</table>
					</div>
			</div>
<?php echo $this->pagination->create_links();}?>

<!-- Modal Novo Acompanhamento -->
<div id="modalNovoAcompanhamento" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formnovoacompanhamento" action="<?php echo current_url(); ?>/adicionar" method="post">
  
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Novo Acompanhamento</h3>
  </div>
  <div class="modal-body">
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span12" style="margin-left: 0"> 
    			<label for="cliente">Aluno</label>
    			<input class="span12" id="cliente" type="text" name="cliente" value=""/>
    			<input id="clientes_id" class="span12" type="hidden" name="clientes_id" value=""  />
    		</div>
    	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
  </div>
  </form>
</div>

<!-- Modal Excluir Acompanhamento-->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/acompanhamento/excluir" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Descontinuar acompanhamento</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idacompanhamento" name="id" value="" />
    <h5 style="text-align: center">Deseja realmente cancelar o acompanhamento deste aluno?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Descontinuar</button>
  </div>
  </form>
</div>

<script type="text/javascript">
$(document).ready(function(){
      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/acompanhamento/autoCompleteCliente",
            minLength: 2,
            select: function( event, ui ) {
                 $("#clientes_id").val(ui.item.id);
            }
      })

      $("#formnovoacompanhamento").validate({
          rules:{
             cliente: {required:true}
          },
          messages:{
             cliente: {required: 'Campo Requerido.'}
          },

            errorClass: "help-inline",
            errorElement: "span",
            highlight:function(element, errorClass, validClass) {
                $(element).parents('.control-group').addClass('error');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).parents('.control-group').removeClass('error');
                $(element).parents('.control-group').addClass('success');
            }
       });

   $(document).on('click', 'a', function(event) {
        var acompanhamento = $(this).attr('acompanhamento');
        $('#idacompanhamento').val(acompanhamento);

    });
});
</script>