<div class="widget-box">
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Dados do Aluno</a></li>
            <li><a data-toggle="tab" href="#tab2">Transações</a></li>
            <li><a data-toggle="tab" href="#tab3">Orçamentos</a></li>
            <div class="buttons">
                    <a title="Icon Title" class="btn btn-mini btn-info" href="<?php echo base_url()?>index.php/clientes/editar/<?php echo $result->idClientes?>"><i class="icon-pencil icon-white"></i> Editar</a>
                </div>
        </ul>
    </div>
    <div class="widget-content tab-content">
    <!--Tab 1-->
        <div id="tab1" class="tab-pane active" style="min-height: 300px">

            <div class="accordion" id="collapse-group">
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGOne" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Dados Pessoais</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse in accordion-body" id="collapseGOne">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Nome</strong></td>
                                                    <td><?php echo $result->nomeCliente ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Atualizações</strong></td>
                                                    <td><?php if ($result->update == 0){echo "Não Receber";}else{echo "<span>Receber</span>";} ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Data de Nascimento</strong></td>
                                                    <td><?php echo date('d/m/Y',  strtotime($result->nascimento)) ?></td>
                                                </tr>                                                
                                                <tr>
                                                    <td style="text-align: right"><strong>Data de Cadastro</strong></td>
                                                    <td><?php echo date('d/m/Y',  strtotime($result->dataCadastro)) ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGTwo" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Contatos</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGTwo">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Telefone</strong></td>
                                                    <td><?php echo $result->telefone ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Telefone 2</strong></td>
                                                    <td><?php echo $result->telefone2 ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-group widget-box">
                                <div class="accordion-heading">
                                    <div class="widget-title">
                                        <a data-parent="#collapse-group" href="#collapseGThree" data-toggle="collapse">
                                            <span class="icon"><i class="icon-list"></i></span><h5>Endereço</h5>
                                        </a>
                                    </div>
                                </div>
                                <div class="collapse accordion-body" id="collapseGThree">
                                    <div class="widget-content">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: right; width: 30%"><strong>Rua</strong></td>
                                                    <td><?php echo $result->rua ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Número</strong></td>
                                                    <td><?php echo $result->numero ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Bairro</strong></td>
                                                    <td><?php echo $result->bairro ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>Cidade</strong></td>
                                                    <td><?php echo $result->cidade ?> - <?php echo $result->estado ?></td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: right"><strong>CEP</strong></td>
                                                    <td><?php echo $result->cep ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
        </div>


        <!--Tab 2-->
        <div id="tab2" class="tab-pane" style="min-height: 300px">
			 <?php

			if(!$transacoes){?>
				<div class="widget-box">
			     <div class="widget-title">
			        <span class="icon">
			            <i class="icon-tags"></i>
			         </span>
			        <h5>Lançamentos Financeiros do Aluno</h5>

			     </div>

			<div class="widget-content nopadding">


			<table class="table table-bordered ">
			    <thead>
			        <tr style="backgroud-color: #2D335B">
			            <th>#</th>
			            <th>Tipo</th>
			            <th>Aluno</th>
			            <th>Descrição</th>
			            <th>Vencimento</th>
			            <th>Status</th>
			            <th>Valor</th>
			            <th></th>
			        </tr>
			    </thead>
			    <tbody>

			        <tr>
			            <td colspan="8">Nenhum lançamento encontrado</td>
			        </tr>
			    </tbody>
			</table>
			</div>
			</div>
			<?php } else{?>


			<div class="widget-box">
			     <div class="widget-title">
			        <span class="icon">
			            <i class="icon-tags"></i>
			         </span>
			        <h5>Lançamentos Financeiros do Aluno</h5>

			     </div>

			<div class="widget-content nopadding">


			<table class="table table-bordered " id="divLancamentos">
			    <thead>
			        <tr style="backgroud-color: #2D335B">
			            <th>#</th>
			            <th>Tipo</th>
			            <th>Aluno</th>
			            <th width="20%">Descrição</th>
			            <th>Vencimento</th>
			            <th>Status</th>
			            <th>Valor</th>
			            <th></th>
			        </tr>
			    </thead>
			    <tbody>
			        <?php 
			        $totalReceita = 0;
			        $totalDespesa = 0;
			        $saldo = 0;
			        foreach ($transacoes as $r) {
			            $vencimento = date(('d/m/Y'),strtotime($r->data_vencimento));
			            if($r->baixado == 0){$status = 'Pendente';}else{ $status = 'Pago';};
			            if($r->tipo == 'receita'){ $label = 'success'; $totalReceita += $r->valor;} else{$label = 'important'; $totalDespesa += $r->valor;}
			            echo '<tr>'; 
			            echo '<td>'.$r->idLancamentos.'</td>';
			            echo '<td><span class="label label-'.$label.'">'.ucfirst($r->tipo).'</span></td>';
			            echo '<td>'.$r->cliente_fornecedor.'</td>';
			            echo '<td>'.$r->descricao.'</td>';
			            echo '<td>'.$vencimento.'</td>';   
			            echo '<td>'.$status.'</td>';
			            echo '<td> R$ '.number_format($r->valor,2,',','.').'</td>';
			            
			            echo '<td>
			                      <a href="#modalEditar" data-toggle="modal" role="button" idLancamento="'.$r->idLancamentos.'" descricao="'.$r->descricao.'" valor="'.$r->valor.'" vencimento="'.date('d/m/Y',strtotime($r->data_vencimento)).'" baixado="'.$r->baixado.'" cliente="'.$r->cliente_fornecedor.'" formaPgto="'.$r->forma_pgto.'" tipo="'.$r->tipo.'" class="btn btn-info tip-top editar" title="Editar Lançamento"><i class="icon-pencil icon-white"></i></a>
			                      <a href="#modalExcluir" data-toggle="modal" role="button" idLancamento="'.$r->idLancamentos.'" class="btn btn-danger tip-top excluir" title="Excluir Lançamento"><i class="icon-remove icon-white"></i></a>
			                  </td>';
			            echo '</tr>';
			        }?>
			        <tr>
			            
			        </tr>
			    </tbody>
			    <tfoot>
			    	<tr>
			    		<td colspan="6" style="text-align: right; color: green"> <strong>Total:</strong></td>
			    		<td colspan="2" style="text-align: left; color: green"><strong>R$ <?php echo number_format($totalReceita,2,',','.') ?></strong></td>
			    	</tr>

			    </tfoot>
			</table>
			</div>
			</div>
		
		<?php } ?>
		</div>        
        
        <!--Tab 3-->
        <div id="tab3" class="tab-pane" style="min-height: 300px">
            <?php if (!$results) { ?>
                
                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Inicial</th>
						            <th>Data Final</th>
						            <th>Observações</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td colspan="6">Nenhum Orçamento Cadastrado</td>
                                </tr>
                            </tbody>
                        </table>
                
                <?php } else { ?>


              

                        <table class="table table-bordered ">
                            <thead>
                                <tr style="backgroud-color: #2D335B">
                                    <th>#</th>
                                    <th>Data Inicial</th>
						            <th>Data Final</th>
						            <th>Observações</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
                foreach ($results as $r) {
                    $dataInicial = date(('d/m/Y'), strtotime($r->dataInicial));
                    $dataFinal = date(('d/m/Y'), strtotime($r->dataFinal));
                    echo '<tr>';
                    echo '<td>' . $r->idOs . '</td>';
                    echo '<td>' . $dataInicial . '</td>';
                    echo '<td>' . $dataFinal . '</td>';
                    echo '<td>' . $r->observacoes . '</td>';

                    echo '<td><a href="' . base_url() . 'index.php/os/visualizar/' . $r->idOs . '" class="btn tip-top" title="Ver mais detalhes"><i class="icon-eye-open"></i></a>
                      <a href="' . base_url() . 'index.php/os/editar/' . $r->idOs . '" class="btn btn-info tip-top" title="Editar OS"><i class="icon-pencil icon-white"></i></a>
                  </td>';
                    echo '</tr>';
                } ?>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
            <?php  } ?>
        </div>
    </div>
</div>


<!-- Modal editar lançamento -->
<div id="modalEditar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formEditar" action="<?php echo base_url() ?>index.php/financeiro/editar" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Editar Lançamento</h3>
  </div>
  <div class="modal-body">
      <div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
      <div class="span12" style="margin-left: 0"> 
        <label for="descricao">Descrição</label>
        <input class="span12" id="descricaoEditar" type="text" name="descricao"  />
        <input id="urlAtualEditar" type="hidden" name="urlAtual" value=""  />
      </div>  
      <div class="span12" style="margin-left: 0"> 
        <div class="span12" style="margin-left: 0"> 
          <label for="fornecedor">Fornecedor / Empresa*</label>
          <input class="span12" id="fornecedorEditar" type="text" name="fornecedor"  />
        </div>
        
        
      </div>
      <div class="span12" style="margin-left: 0"> 
        <div class="span4" style="margin-left: 0">  
          <label for="valor">Valor*</label>
          <input type="hidden"  name="tipo" value="despesa" />  
          <input type="hidden"  id="idEditar" name="id" value="" /> 
          <input class="span12 money"  type="text" name="valor" id="valorEditar" />
        </div>
        <div class="span4" >
          <label for="vencimento">Data Vencimento*</label>
          <input class="span12 datepicker"  type="text" name="vencimento" id="vencimentoEditar"  />
        </div>
        <div class="span4">
          <label for="vencimento">Tipo*</label>
          <select class="span12" name="tipo" id="tipoEditar">
            <option value="receita">Receita</option>
            <option value="despesa">Despesa</option>
          </select>
        </div>
        
      </div>
      <div class="span12" style="margin-left: 0"> 
        <div class="span4" style="margin-left: 0">
          <label for="pago">Foi Pago?</label>
          &nbsp &nbsp &nbsp &nbsp<input  id="pagoEditar" type="checkbox" name="pago" value="1" /> 
        </div>
        <div id="divPagamentoEditar" class="span8" style=" display: none">

          <div class="span6">
            <label for="formaPgto">Forma Pgto</label>
            <select name="formaPgto" id="formaPgtoEditar"  class="span12">
              <option value="Dinheiro">Dinheiro</option>
              <option value="Cartão de Crédito">Cartão de Crédito</option>
              <option value="Débito">Débito</option>        
            </select>
          </div>
        </div>
        
      </div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelarEditar">Cancelar</button>
    <button class="btn btn-primary">Salvar Alterações</button>
  </div>
  </form>
</div>



<!-- Modal Excluir lançamento-->
<div id="modalExcluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Excluir Lançamento</h3>
  </div>
  <div class="modal-body">
    <h5 style="text-align: center">Deseja realmente excluir esse lançamento?</h5>
    <input name="id" id="idExcluir" type="hidden" value="" />
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true" id="btnCancelExcluir">Cancelar</button>
    <button class="btn btn-danger" id="btnExcluir">Excluir Lançamento</button>
  </div>
</div>


<script src="<?php echo base_url()?>js/jquery.validate.js"></script>
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
	jQuery(document).ready(function($) {

		$(".money").maskMoney();

		$('#pago').click(function(event) {
			document.getElementById('contapaga').readOnly = this.checked;
			var flag = $(this).is(':checked');
			if(flag == true){
				$('#divPagamento').show();
				$('#contapaga').val('<?php echo date("d/m/Y");?>');
			}
			else{
				$('#divPagamento').hide();
			}
		});

		
		$('#valor_parc, #qtdparcelas_parc, #formaPgto_parc, #entrada, #dia_pgto, #dia_base_pgto').click(function(event){
			valorParcelas();
		});
		
		$('#add_receita').mouseover(function(event){
			valorParcelas();
		});


    $('#pagoEditar').click(function(event) {
	  document.getElementById('vencimentoEditar').readOnly = this.checked;
      var flag = $(this).is(':checked');
      if(flag == true){
        $('#divPagamentoEditar').show();
        $('#vencimentoEditar').val('<?php echo date("d/m/Y");?>');
      }
      else{
        $('#divPagamentoEditar').hide();
      }
    });

    

    $(document).on('click', '.excluir', function(event) {
      $("#idExcluir").val($(this).attr('idLancamento'));
    });


    $(document).on('click', '.editar', function(event) {
      $("#idEditar").val($(this).attr('idLancamento'));
      $("#descricaoEditar").val($(this).attr('descricao'));
      $("#fornecedorEditar").val($(this).attr('cliente'));
      $("#valorEditar").val($(this).attr('valor'));
      $("#vencimentoEditar").val($(this).attr('vencimento'));
      $("#pagamentoEditar").val($(this).attr('pagamento'));
      $("#formaPgtoEditar").val($(this).attr('formaPgto'));
      $("#tipoEditar").val($(this).attr('tipo'));
      $("#urlAtualEditar").val($(location).attr('href'));
      var baixado = $(this).attr('baixado');
      if(baixado == 1){
        $("#pagoEditar").attr('checked', true);
        $("#divPagamentoEditar").show();
      }
      else{
        $("#pagoEditar").attr('checked', false); 
        $("#divPagamentoEditar").hide();
      }
      

    });

    $(document).on('click', '#btnExcluir', function(event) {
        var id = $("#idExcluir").val();
    
        $.ajax({
          type: "POST",
          url: "<?php echo base_url();?>index.php/financeiro/excluirLancamento",
          data: "id="+id,
          dataType: 'json',
          success: function(data)
          {
            if(data.result == true){
                $("#btnCancelExcluir").trigger('click');
                $("#divLancamentos").html('<div class="progress progress-striped active"><div class="bar" style="width: 100%;"></div></div>');
                $("#divLancamentos").load( $(location).attr('href')+" #divLancamentos" );
                
            }
            else{
                $("#btnCancelExcluir").trigger('click');
                alert('Ocorreu um erro ao tentar excluir produto.');
            }
          }
        });
        return false;
    });
 
    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });

	});

</script>