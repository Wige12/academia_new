<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>

<?php $situacao = $this->input->get('situacao');
	  $periodo = $this->input->get('periodo');	
 ?>

<style type="text/css">
	
	label.error{
		color: #b94a48;
	}

	input.error{
    border-color: #b94a48;
  }
  input.valid{
    border-color: #5bb75b;
  }


</style>

<div class="span5" style="margin-left: 0">
	<a href="#modalReceita" data-toggle="modal" role="button" class="btn btn-success tip-bottom" title="Cadastrar nova receita"><i class="icon-plus icon-white"></i> Nova Receita</a>
	<a href="#modalDespesa" data-toggle="modal" role="button" class="btn btn-danger tip-bottom" title="Cadastrar nova despesa"><i class="icon-plus icon-white"></i> Nova Despesa</a>
</div>
<div class="span7">
	<form action="<?php echo current_url(); ?>" method="get" >
		<div class="span4" style="margin-left: 0">
			<label>Período <i class="icon-info-sign tip-top" title="Lançamentos com vencimento no período."></i></label>
			<select name="periodo" class="span12">
				<option value="dia">Dia</option>
				<option value="semana" <?php if($periodo == 'semana'){ echo 'selected';} ?>>Semana</option>
				<option value="mes" <?php if($periodo == 'mes'){ echo 'selected';} ?>>Mês</option>
				<option value="anterior" <?php if($periodo == 'anterior'){ echo 'selected';} ?>>Ano Anterior</option>
				<option value="ano" <?php if($periodo == 'ano'){ echo 'selected';} ?>>Ano Atual</option>
				<option value="proximo" <?php if($periodo == 'proximo'){ echo 'selected';} ?>>Próximo Ano</option>
			</select>
		</div>
		<div class="span4">
			<label>Situação <i class="icon-info-sign tip-top" title="Lançamentos com situação específica ou todos."></i></label>
			<select name="situacao" class="span12">
				<option value="todos">Todos</option>
				<option value="previsto" <?php if($situacao == 'previsto'){ echo 'selected';} ?>>Previsto</option>
				<option value="atrasado" <?php if($situacao == 'atrasado'){ echo 'selected';} ?>>Atrasado</option>
				<option value="realizado" <?php if($situacao == 'realizado'){ echo 'selected';} ?>>Realizado</option>
			</select>
		</div>
		<div class="span4" >
			&nbsp
			<button type="submit" class="span12 btn btn-primary">Filtrar</button>
		</div>
		
	</form>
</div>

<div class="span12" style="margin-left: 0;">

<?php

if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-money"></i>
         </span>
        <h5>Lançamentos Financeiros</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Tipo</th>
            <th>Cliente / Fornecedor</th>
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
            <i class="icon-money"></i>
         </span>
        <h5>Lançamentos Financeiros</h5>

     </div>

<div class="widget-content nopadding">


<table class="table table-bordered " id="divLancamentos">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>#</th>
            <th>Tipo</th>
            <th>Cliente / Fornecedor</th>
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
        foreach ($results as $r) {
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
    		<td colspan="6" style="text-align: right; color: green"> <strong>Total Receitas:</strong></td>
    		<td colspan="2" style="text-align: left; color: green"><strong>R$ <?php echo number_format($totalReceita,2,',','.') ?></strong></td>
    	</tr>
    	<tr>
    		<td colspan="6" style="text-align: right; color: red"> <strong>Total Despesas:</strong></td>
    		<td colspan="2" style="text-align: left; color: red"><strong>R$ <?php echo number_format($totalDespesa,2,',','.') ?></strong></td>
    	</tr>
    	<tr>
    		<td colspan="6" style="text-align: right"> <strong>Saldo:</strong></td>
    		<td colspan="2" style="text-align: left;"><strong>R$ <?php echo number_format($totalReceita - $totalDespesa,2,',','.') ?></strong></td>
    	</tr>
    </tfoot>
</table>
</div>
</div>

</div>
	
<?php echo $this->pagination->create_links();}?>



<!-- Modal nova receita -->
<div id="modalReceita" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formReceita" action="<?php echo base_url() ?>index.php/financeiro/adicionarReceita" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Adicionar Receita</h3>
  </div>
  <div class="modal-body">
  		
  		<div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="descricao">Descrição*</label>
    		<input class="span12" id="descricao" type="text" name="descricao"  />
    		<input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />
    	</div>	
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span12" style="margin-left: 0"> 
    			<label for="cliente">Cliente*</label>
    			<input class="span12" id="cliente" type="text" name="cliente" />
    		</div>
    		
    		
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span4" style="margin-left: 0">  
    			<label for="valor">Valor*</label>
    			<input type="hidden" id="tipo" name="tipo" value="receita" />	
    			<input class="span12 money" id="valor" type="text" name="valor" />
    		</div>
    		
	      <div class="span4">  
	        <label for="desconto">Desconto</label>
	        <input class="span6" id="desconto" type="text" name="desconto" value="" placeholder="em %" style="float: left;" />
	        <input class="btn btn-inverse" onclick="mostrarValor();" type="button" name="valor_desconto" value="Aplicar" placeholder="em %" style="float: left;margin-left:5px;" />
	      </div>
      
	    	<div class="span4">
	    		<label for="vencimento">Data Vencimento*</label>
	    		<input class="span12 datepicker" id="vencimento" type="text" name="vencimento" />
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
		    	<a href="#modalReceitaParcelada" id="abrirmodalreceitaparcelada" data-toggle="modal" style="display: none;" role="button"> </a>
		    
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
    <button id="cancelar_nova_receita" class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-success">Adicionar Receita</button>
  </div>
  </form>
</div>


<!-- Modal nova receita parcelada -->
<div id="modalReceitaParcelada" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formReceita_parc" action="<?php echo base_url() ?>index.php/financeiro/adicionarReceita_parc" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Adicionar Receita Parcelada</h3>
  </div>
  <div class="modal-body">
  		
  		<div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="descricao_parc">Descrição*</label>
    		<input class="span12" id="descricao_parc" type="text" name="descricao_parc" />
    		<input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>" />
    	</div>	
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span12" style="margin-left: 0"> 
    			<label for="cliente_parc">Cliente*</label>
    			<input class="span12" id="cliente_parc" type="text" name="cliente_parc" />
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
	    		<input class="span12 money" id="entrada" type="text" name="entrada" value="0" />
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
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-success" id="add_receita">Adicionar Receita</button>
  </div>
  </form>
</div>

<!-- Modal nova despesa -->
<div id="modalDespesa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formDespesa" action="<?php echo base_url() ?>index.php/financeiro/adicionarDespesa" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Adicionar Despesa</h3>
  </div>
  <div class="modal-body">
  		<div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="descricao">Descrição</label>
    		<input class="span12" id="descricao" type="text" name="descricao"  />
    		<input id="urlAtual" type="hidden" name="urlAtual" value="<?php echo current_url() ?>"  />
    	</div>	
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span12" style="margin-left: 0"> 
    			<label for="fornecedor">Fornecedor / Empresa*</label>
    			<input class="span12" id="fornecedor" type="text" name="fornecedor"  />
    		</div>
    		
    		
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span4" style="margin-left: 0">  
    			<label for="valor">Valor*</label>
    			<input type="hidden"  name="tipo" value="despesa" />	
    			<input class="span12 money"  type="text" name="valor"  />
    		</div>
	    	<div class="span4" >
	    		<label for="vencimento">Data Vencimento*</label>
	    		<input class="span12 datepicker"  type="text" name="vencimento" id="contapaga"/>
	    	</div>
	    	
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span4" style="margin-left: 0">
    			<label for="pago">Foi Pago?</label>
	    		&nbsp &nbsp &nbsp &nbsp<input  id="pago" type="checkbox" name="pago" value="1" />	
    		</div>
    		<div id="divPagamento" class="span8" style=" display: none">

	    		<div class="span6">
		    		<label for="formaPgto">Forma Pgto</label>
		    		<select name="formaPgto"  class="span12">
		    			<option value="Dinheiro">Dinheiro</option>
		    			<option value="Cartão de Crédito">Cartão de Crédito</option>
		    			<option value="Débito">Débito</option>  			
		    		</select>
		    	</div>
	    	</div>
    		
    	</div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Adicionar Despesa</button>
  </div>
  </form>
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
				$('#cancelar_nova_receita').trigger('click');
				$('#abrirmodalreceitaparcelada').trigger('click');
				$("#descricao_parc").val($("#descricao").val());
				$("#cliente_parc").val($("#cliente").val());
				$("#valor_parc").val($("#valor").val());
				$("#qtdparcelas_parc").val($("#qtdparcelas").val());		
			valorParcelas();
			}
			else{
				if(parcelas == 1){
					$('#cancelar_nova_receita').trigger('click');
					$('#abrirmodalreceitaparcelada').trigger('click');
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


		$("#formReceita").validate({
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
          }
    });


		$("#formReceita_parc").validate({
          rules:{
 			descricao_parc: {required:true},
			cliente_parc: {required:true},
			valor_parc: {required:true},
			entrada: {required:true},
			dia_pgto: {required:true},
			dia_base_pgto: {required:true}
          },
          messages:{
          	descricao_parc: {required: 'Campo Requerido.'},
			cliente_parc: {required: 'Campo Requerido.'},
			valor_parc: {required: 'Campo Requerido.'},
			entrada: {required: 'Campo Requerido.'},
			dia_pgto: {required: 'Campo Requerido.'},
			dia_base_pgto: {required: 'Campo Requerido.'}
          }
    });



		$("#formDespesa").validate({
          rules:{
             descricao: {required:true},
             fornecedor: {required:true},
             valor: {required:true},
             vencimento: {required:true}
      
          },
          messages:{
             descricao: {required: 'Campo Requerido.'},
             fornecedor: {required: 'Campo Requerido.'},
             valor: {required: 'Campo Requerido.'},
             vencimento: {required: 'Campo Requerido.'}
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