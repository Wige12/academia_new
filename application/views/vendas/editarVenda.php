<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>


<div class="row-fluid" style="margin-top:0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-shopping-cart"></i>
                </span>
                <h5>Editar Venda</h5>
            </div>
            <div class="widget-content nopadding">


                <div class="span12" id="divProdutosServicos" style=" margin-left: 0">
                    <ul class="nav nav-tabs">
                        <li class="active" id="tabDetalhes"><a href="#tab1" data-toggle="tab">Detalhes da Venda</a></li>

                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab1">

                            <div class="span12" id="divEditarVenda">
                                    <?php echo form_hidden('idVendas',$result->idVendas) ?>
                                    
                                    <div class="span12" style="padding: 1%; margin-left: 0">
                                        <h3>#Venda: <?php echo $result->idVendas ?></h3>
                                    </div>

                                
                                <div class="span12 well" style="padding: 1%; margin-left: 0">
								<form id="formProdutos" action="<?php echo base_url(); ?>index.php/vendas/adicionarProduto" method="post">
                                            <div class="span3">
                                                <label for=""><i class="icon-white icon-barcode"></i> Código de Barras</label>
                                                <input type="text" class="span12" name="produto" id="produtocod" placeholder="Insira o código do produto" autofocus=""/>
                                            </div>
                                            
                                            <div class="span4">
                                                <input type="hidden" name="idProduto" id="idProduto" />
                                                <input type="hidden" name="idVendasProduto" id="idVendasProduto" value="<?php echo $result->idVendas?>" />
                                                <input type="hidden" name="estoque" id="estoque" value=""/>
                                                <input type="hidden" name="preco" id="preco" value=""/>
                                                <label for="">Produto</label>
                                                <input type="text" class="span12" name="produto" id="produto" placeholder="Digite o nome do produto" />
                                            </div>
                                            
                                            <div class="span2">
                                                <label for="">Quantidade</label>
                                                <input type="text" placeholder="Quantidade" id="quantidade" name="quantidade" class="span12" value="1" />
                                            </div>
                                            <div class="span2">
                                                <label for="">&nbsp</label>
                                                <button class="btn btn-success span12" id="btnAdicionarProduto"><i class="icon-white icon-plus"></i> Adicionar</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="span12" id="divProdutos" style="margin-left: 0">
                                        <table class="table table-bordered" id="tblProdutos">
                                            <thead>
                                                <tr>
                                                    <th>Produto</th>
                                                    <th>Quantidade</th>
                                                    <th>Ações</th>
                                                    <th>Sub-total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                foreach ($produtos as $p) {
                                                    
                                                    $total = $total + $p->subTotal;
                                                    echo '<tr>';
                                                    echo '<td>'.$p->descricao.'</td>';
                                                    echo '<td>'.$p->quantidade.'</td>';
                                                    echo '<td><a href="" idAcao="'.$p->idItens.'" prodAcao="'.$p->idProdutos.'" quantAcao="'.$p->quantidade.'" title="Excluir Produto" class="btn btn-danger"><i class="icon-remove icon-white"></i></a></td>';
                                                    echo '<td>R$ '.number_format($p->subTotal,2,',','.').'</td>';
                                                    echo '</tr>';
                                                }?>
                                               
                                                <tr>
                                                    <td colspan="3" style="text-align: right"><strong>Total:</strong></td>
                                                    <td><strong>R$ <?php echo number_format($total,2,',','.');?></strong> <input type="hidden" id="total-venda" value="<?php echo number_format($total,2); ?>"></td>
                                                </tr>
                                            </tbody>
                                        </table>


                                        


                                    </div>

                            </div>

                        </div>

                    </div>

                </div>

.

        </div>

    </div>
</div>
</div>

 <?php if($result->faturado == 0){ ?>
<a href="#modal-faturar" id="btn-faturar" role="button" data-toggle="modal" class="btn btn-success" style="float:right;"><i class="icon-file"></i> Faturar</a>
<?php } ?>

<!-- Modal Faturar-->
<div id="modal-faturar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<form id="formFaturar" action="<?php echo current_url() ?>" method="post">
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
  <h3 id="myModalLabel">Faturar Venda</h3>
</div>
<div class="modal-body">
    
    <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    <div class="span12" style="margin-left: 0"> 
      <label for="descricao">Descrição</label>
      <input class="span12" id="descricao" type="text" name="descricao" value="Fatura de Venda - #<?php echo $result->idVendas; ?> "  />
      
    </div>  
    <div class="span12" style="display: none;margin-left: 0"> 
      <div class="span12" style="display: none;margin-left: 0"> 
        <label for="cliente" style="display: none;">Cliente*</label>
        <input type="hidden" name="cliente" id="cliente" value="<?php echo $result->nomeCliente ?>" />
        <input type="hidden" name="clientes_id" id="clientes_id" value="<?php echo $result->clientes_id ?>">
        <input type="hidden" name="vendas_id" id="vendas_id" value="<?php echo $result->idVendas; ?>">
      </div>  
    </div>
    <div class="span12" style="margin-left: 0;">
    
      <div class="span4" style="margin-left: 0;">  
        <label for="valor">Valor*</label>
        <input type="hidden" id="tipo" name="tipo" value="receita" /> 
        <input class="span12 money" id="valor" type="text" name="valor" value="<?php echo number_format($total,2); ?> "  />
      </div>
      
      <div class="span4">  
        <label for="desconto">Desconto</label>
        <input class="span6" id="desconto" type="text" name="desconto" value="" placeholder="em %" style="float: left;" />
        <input class="btn btn-inverse" onclick="mostrarValor();" type="button" name="valor_desconto" value="Aplicar" placeholder="em %" style="float: left;margin-left:5px;" />
      </div>

      <div class="span4">
        <label for="vencimento">Data Vencimento*</label>
        <input class="span12 datepicker" id="vencimento" type="text" name="vencimento" value="" />
      </div>
      
    </div>
    
    <div class="span12" style="margin-left: 0">
    		<div class="span4" style="margin-left: 0">
		    		<label for="qtdparcelas">Qtd Parcelas</label>
		    		<select name="qtdparcelas" id="qtdparcelas" class="span12">
		    			<option value="0">Pagamento à vista</option>			
		    			<option value="1">1x</option>			
		    			<option value="2">2x</option>			
		    			<option value="3">3x</option>			
		    			<option value="4">4x</option>			
		    			<option value="5">5x</option>			
		    			<option value="6">6x</option>			
		    			<option value="7">7x</option>			
		    			<option value="8">8x</option>			
		    			<option value="9">9x</option>			
		    			<option value="10">10x</option>			
		    			<option value="11">11x</option>			
		    			<option value="12">12x</option>			
		    		</select>
		    	<a href="#modalFaturar_parc" id="abrirmodalfaturarparcelado" data-toggle="modal" style="display: none;" role="button"> </a>
		    
	    	</div>    

    		<div class="span4">
    			<center>
	    			<label for="recebido">Recebido?</label>
	    			<input  id="recebido" type="checkbox" name="recebido" value="1" />	
    			</center>
    		</div>

      <div id="divRecebimento" class="span4" style=" display: none">
        <div class="span12">
          <label for="formaPgto">Forma Pgto</label>
          <select name="formaPgto" id="formaPgto" class="span12">
            <option value="Dinheiro">Dinheiro</option>
            <option value="Cartão de Crédito">Cartão de Crédito</option>
            <option value="Débito">Débito</option>        
          </select>
        </div>
      </div>
      
    </div>
    
    
</div>
<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar">Cancelar</button>
  <button class="btn btn-primary">Faturar</button>
</div>
</form>
</div>
 
<!-- Modal faturamento parcelada -->
<div id="modalFaturar_parc" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formFaturar_parc" action="<?php echo current_url() ?>" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Faturar Venda Parcelada</h3>
  </div>
  <div class="modal-body">
  		
  		<div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="descricao_parc">Descrição*</label>
    		<input class="span12" id="descricao_parc" type="text" name="descricao_parc" />
			<input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />
    	</div>	
    <div class="span12" style="display: none;margin-left: 0"> 
      <div class="span12" style="display: none;margin-left: 0"> 
        <label for="cliente" style="display: none;">Cliente*</label>
        <input type="hidden" name="cliente_parc" id="cliente_parc" value="<?php echo $result->nomeCliente ?>" />
        <input type="hidden" name="clientes_id_parc" id="clientes_id_parc" value="<?php echo $result->clientes_id ?>">
        <input type="hidden" name="vendas_id_parc" id="vendas_id_parc" value="<?php echo $result->idVendas; ?>">
      </div>  
    </div>

    	<div class="span12" style="margin-left: 0"> 
    		<div class="span4" style="margin-left: 0">  
    			<label for="valor_parc">Valor*</label>
    			<input type="hidden" id="tipo_parc" name="tipo_parc" value="receita" />	
    			<input class="span12 money" id="valor_parc" type="text" name="valor_parc" />
    		</div>
      
    		<div id="divParcelamento" class="span4">
		    		<label for="qtdparcelas_parc">Qtd Parcelas</label>
		    		<select name="qtdparcelas_parc" id="qtdparcelas_parc" class="span12">
		    			<option value="1">1x</option>			
		    			<option value="2">2x</option>			
		    			<option value="3">3x</option>			
		    			<option value="4">4x</option>			
		    			<option value="5">5x</option>			
		    			<option value="6">6x</option>			
		    			<option value="7">7x</option>			
		    			<option value="8">8x</option>			
		    			<option value="9">9x</option>			
		    			<option value="10">10x</option>			
		    			<option value="11">11x</option>			
		    			<option value="12">12x</option>			
		    		</select>
	    	</div>

    		<div class="span4" style="float: right;">
		    		<label for="formaPgto_parc">Forma Pgto</label>
		    		<select name="formaPgto_parc" id="formaPgto_parc" class="span12">
		    			<option value="Dinheiro">Dinheiro</option>
		    			<option value="Cartão de Crédito">Cartão de Crédito</option> 			
		    		</select>
	    	</div>

    	</div>

	    <div class="span12" style="margin-left: 0;"> 

	    	<div class="span4">
	    		<label for="entrada">Entrada* <i class="icon-info-sign tip-right" title="O valor da entrada será lançado como pago no dia atual (Hoje)"></i></label>
	    		<input class="span12 money" id="entrada" type="text" name="entrada" value="0"/>
	    	</div>

	    	<div class="span4">
	    		<label for="dia_pgto">Data da Entrada*</label>
	    		<input class="span12" id="dia_pgto" type="text" name="dia_pgto" value="<?php echo date('d/m/Y'); ?>" style="color:#eeeeee" readonly=""/>
	    	</div>
	    	
	    	<div class="span4">
	    		<label for="dia_base_pgto">Data Base de Pgto* <i class="icon-info-sign tip-left" title="Dia do mês que serão lançadas as parcelas restantes, iniciando-se pela data selecionada."></i></label>
	    		<input class="span12 datepicker" id="dia_base_pgto" type="text" name="dia_base_pgto"  />
	    	</div>

	    	<div class="span12" style="background:#f5f5f5;border-radius:4px;margin: 0;border:1px solid #ddd;">
		    	<input id="valorparcelas" type="hidden" name="valorparcelas" readonly="" />
		    	<div class="span12" style="margin: 14px 0 0 0;float:right;text-align: center;">
		    		<label id="string_parc" style="font-weight: bold;"></label>
		    	</div>
	    	</div>
	    	
	    </div>

  </div>
<div class="modal-footer">
  <button class="btn" data-dismiss="modal" aria-hidden="true" id="btn-cancelar-faturar_parc">Cancelar</button>
  <button class="btn btn-primary" id="btn_faturar">Faturar</button>
</div>
  </form>
</div>


<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<script src="<?php echo base_url();?>js/maskmoney.js"></script>

<script type="text/javascript">
	function mostrarValor() {
		if (document.getElementById('valor').value == "" || document.getElementById('desconto').value == ""){
			
		}else{
			var valor = parseFloat(document.getElementById('valor').value);
			var desconto = parseInt(document.getElementById('desconto').value); 
			var resultado, total;
			resultado = valor/100;
			total = valor-(desconto*resultado);
			
			document.getElementById('valor').value = total;
			}
	}

$(document).ready(function(){
     $(".money").maskMoney(); 

     $('#recebido').click(function(event) {
		document.getElementById('vencimento').readOnly = this.checked;
        var flag = $(this).is(':checked');
        if(flag == true){
          $('#divRecebimento').show();
          $('#vencimento').val('<?php echo date("d/m/Y");?>');
        }
        else{
          $('#divRecebimento').hide();
        }
     });

		function valorParcelas(){
			var valor_parc = $("#valor_parc").val();
			var qtdparc = $("#qtdparcelas_parc").val();
			var entrada = $("#entrada").val();
			var result = (valor_parc - entrada) / qtdparc;

			if(qtdparc > 1){
				if(entrada > 0){
					$("#string_parc").text('R$ '+entrada+' de entrada mais '+qtdparc+' parcelas de '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}else{
					$("#string_parc").text(qtdparc+' parcelas de '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}
			}else{
				if(entrada > 0){
					$("#string_parc").text('R$ '+entrada+' de entrada mais '+qtdparc+' parcela de '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}else{
					$("#string_parc").text(qtdparc+' parcela de '+parseFloat(Math.round(result * 100) / 100).toFixed(2));
				$("#valorparcelas").val(parseFloat(Math.round(result * 100) / 100).toFixed(2));
				}
			}
		}

		$('#qtdparcelas').change(function(event) {
			var parcelas = $("#qtdparcelas").val();
			if(parcelas > 1){
				$('#btn-cancelar-faturar').trigger('click');
				$('#abrirmodalfaturarparcelado').trigger('click');
				$("#descricao_parc").val($("#descricao").val());
				$("#cliente_parc").val($("#cliente").val());
				$("#valor_parc").val($("#valor").val());
				$("#qtdparcelas_parc").val($("#qtdparcelas").val());		
			valorParcelas();
			}
			else{
				if(parcelas == 1){
					$('#btn-cancelar-faturar').trigger('click');
					$('#abrirmodalfaturarparcelado').trigger('click');
					$("#descricao_parc").val($("#descricao").val());
					$("#cliente_parc").val($("#cliente").val());
					$("#valor_parc").val($("#valor").val());
					$("#qtdparcelas_parc").val(1);		
					valorParcelas();
				}
			}
		});

		$('#valor_parc').keypress(function(event) {
			valorParcelas();
		});

		$('#qtdparcelas_parc').change(function(event) {
			valorParcelas();
		});
		
		$('#entrada').keypress(function(event){
			valorParcelas();
			var entrada = $("#entrada").val();
			if(entrada > 0){
				$('#dia_pgto').css("color", "#444444");
			}else{
				$('#dia_pgto').css("color", "#eeeeee");
			}
			
		});
		
		$('#valor_parc, #qtdparcelas_parc, #formaPgto_parc, #entrada, #dia_pgto, #dia_base_pgto').click(function(event){
			valorParcelas();
		});
		
		$('#btn_faturar').mouseover(function(event){
			valorParcelas();
		});


     $(document).on('click', '#btn-faturar', function(event) {
       event.preventDefault();
         valor = $('#total-venda').val();
         valor = valor.replace(',', '' );
         $('#valor').val(valor);
     });
     
     $("#formFaturar").validate({
          rules:{
             descricao: {required:true},
             cliente: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             cliente: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
          },
          submitHandler: function( form ){    
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/vendas/faturar",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar faturar venda.');
                    $('#progress-fatura').hide();
                }
              }
              });

              return false;
          }
     });

     $("#formFaturar_parc").validate({
          rules:{
 			descricao_parc: {required:true},
			cliente_parc: {required:true},
			valor_parc: {required:true},
			entrada: {required:true},
			dia_base_pgto: {required:true}
          },
          messages:{
          	descricao_parc: {required: 'Campo Requerido.'},
			cliente_parc: {required: 'Campo Requerido.'},
			valor_parc: {required: 'Campo Requerido.'},
			entrada: {required: 'Campo Requerido.'},
			dia_base_pgto: {required: 'Campo Requerido.'}
          },
          submitHandler: function( form ){       
            var dados = $( form ).serialize();
            $('#btn-cancelar-faturar_parc').trigger('click');
            $.ajax({
              type: "POST",
              url: "<?php echo base_url();?>index.php/vendas/faturar_parc",
              data: dados,
              dataType: 'json',
              success: function(data)
              {
                if(data.result == true){
                    window.location.reload(true);
                }
                else{
                    alert('Ocorreu um erro ao tentar faturar venda.');
                    $('#progress-fatura').hide();
                }
              }
              });

              return false;
          }
     });

     $("#produto").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteProduto",
            minLength: 2,
            select: function( event, ui ) {
                 $("#idProduto").val(ui.item.id);
                 $("#estoque").val(ui.item.estoque);
                 $("#preco").val(ui.item.preco);
                 $("#quantidade").focus();
            }
      });
      
      
      $("#produtocod").autocomplete({
      		autoFocus: true,
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteProdutocod",
            minLength: 13,
            focus: function( event, ui ) {
                 $("#idProduto").val(ui.item.id);
                 $("#estoque").val(ui.item.estoque);
                 $("#preco").val(ui.item.preco);
                 $("#btnAdicionarProduto").click();
            }
      });



      $("#cliente").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteCliente",
            minLength: 2,
            select: function( event, ui ) {
                 $("#clientes_id").val(ui.item.id);
            }
      });

      $("#tecnico").autocomplete({
            source: "<?php echo base_url(); ?>index.php/vendas/autoCompleteUsuario",
            minLength: 2,
            select: function( event, ui ) {
                 $("#usuarios_id").val(ui.item.id);
            }
      });



      $("#formVendas").validate({
          rules:{
             cliente: {required:true},
             tecnico: {required:true},
             dataVenda: {required:true}
          },
          messages:{
             cliente: {required: 'Campo Requerido.'},
             tecnico: {required: 'Campo Requerido.'},
             dataVenda: {required: 'Campo Requerido.'}
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




      $("#formProdutos").validate({
          rules:{
             quantidade: {required:true}
          },
          messages:{
             quantidade: {required: 'Insira a quantidade'}
          },
          submitHandler: function( form ){
             var quantidade = parseInt($("#quantidade").val());
             var estoque = parseInt($("#estoque").val());
             if(estoque < quantidade){
                alert('Você não possui estoque suficiente.');
             }
             else{
                 var dados = $( form ).serialize();
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/vendas/adicionarProduto",
                  data: dados,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $("#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        $("#produto").val('').focus();
                        $("#quantidade").val('1').focus();
                        $("#produtocod").val('').focus();
                        $("#idProduto").val('').focus();
                        $("#estoque").val('').focus();
                        $("#preco").val('').focus();
                    }
                    else{
                        alert('Ocorreu um erro ao tentar adicionar produto.');
                    }
                  }
                  });

                  return false;
                }

             }
             
       });

     

       $(document).on('click', 'a', function(event) {
            var idProduto = $(this).attr('idAcao');
            var quantidade = $(this).attr('quantAcao');
            var produto = $(this).attr('prodAcao');
            if((idProduto % 1) == 0){
                $("#divProdutos").html("<div class='progress progress-info progress-striped active'><div class='bar' style='width: 100%'></div></div>");
                $.ajax({
                  type: "POST",
                  url: "<?php echo base_url();?>index.php/vendas/excluirProduto",
                  data: "idProduto="+idProduto+"&quantidade="+quantidade+"&produto="+produto,
                  dataType: 'json',
                  success: function(data)
                  {
                    if(data.result == true){
                        $( "#divProdutos" ).load("<?php echo current_url();?> #divProdutos" );
                        
                    }
                    else{
                        alert('Ocorreu um erro ao tentar excluir produto.');
                    }
                  }
                  });
                  return false;
            }
            
       });

		$(".datepicker").datepicker({ dateFormat: 'dd/mm/yy' });

});

</script>

