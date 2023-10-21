<style>
label.p{
	display: inline;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<div class="widget-box">
    <?php if ($custom_error != '') {
        echo '<div class="alert alert-danger">' . $custom_error . '</div>';
    } ?>
<form action="<?php echo current_url(); ?>" id="formacompanhamento" method="post" class="form-horizontal" >
<?php echo form_hidden('id',$result->id) ?>
    <div class="widget-title">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#tab1">Resumo</a></li>
            <li><a data-toggle="tab" href="#tab2">Objetivo</a></li>
            <li><a data-toggle="tab" href="#tab3">Antropometria</a></li>
            <div class="buttons"></div>
            <li><a data-toggle="tab" href="#tab4">PAR-Q e Anamnese</a></li>
            <li><a data-toggle="tab" href="#tab5">Ficha Treinamento</a></li>
            <li style="float: right;"><button type="submit" style="margin-top: 3px;" class="btn btn-info"><i class="icon-save icon-white"></i> Gravar Alterações</button></li>
            <li style="float: right;"><?php
	$seleciona = mysql_query("SELECT nomeCliente FROM clientes WHERE idClientes = $result->clientes_id");
			while($ln = mysql_fetch_array($seleciona)){
			$nomeCliente = $ln['nomeCliente'];
			?>
				<h5><?php echo $nomeCliente;?></h5>
			<?php } ?></li>
        </ul>
        
    </div>

<div class="widget-content tab-content">
    	<!--Tab 1-->
<div id="tab1" class="tab-pane active">
	<div class="well"><label><i class="icon-ok"></i> <strong>Objetivo principal:</strong> <?php if($result->obj_1 == NULL){echo"Nenhum objetivo principal selecionado";}else{echo $result->obj_1;}?></label>
 
<br />

	<label><i class="icon-screenshot"></i> <strong>Meta de peso ideal:</strong><?php if($result->obj_peso <= 0){echo " Ainda não foi estabelecida uma meta de peso ideal";}else{?> <?php echo $result->obj_peso; ?> Kg<br /><?php }?> <?php if($result->obj_prazo <= 0 || $result->obj_peso <= 0){echo "";}else{?><i class="icon-time"></i>
<?php
	$data_prazo = new DateTime($result->obj_prazo_data);
	$data_hoje = new DateTime(date('Y-m-d'));

if($data_hoje > $data_prazo){
	echo "<span style='color:#b94a48;'><b class='badge btn-danger'>ATENÇÃO</b> O prazo estabelecido para o cumprimento da meta <b>já expirou</b></span> | ";
}elseif($data_hoje == $data_prazo){
	echo "<span style='color:#b94a48;'><b class='badge btn-danger'>ATENÇÃO</b> Hoje termina o prazo estabelecido para o cumprimento da meta</span> | ";
}else{
		$intervalo = $data_prazo->diff($data_hoje);

		if($intervalo->y > 0 && $intervalo->m > 0 && $intervalo->d > 0){echo "Faltam ";}
		elseif($intervalo->y > 0 && $intervalo->m > 0 && $intervalo->d == 0){echo "Faltam ";}
		elseif($intervalo->y > 0 && $intervalo->m == 0 && $intervalo->d > 0){echo "Faltam ";}
		elseif($intervalo->y == 0 && $intervalo->m > 0 &&  $intervalo->d > 0){echo "Faltam ";}
		elseif($intervalo->y > 1){echo "Faltam ";}
		elseif($intervalo->m > 1){echo "Faltam ";}
		elseif($intervalo->d > 1){echo "Faltam ";}

	
	elseif($intervalo->y == 1 && $intervalo->m == 0 && $intervalo->d == 0){echo "Falta ";}
	elseif($intervalo->y == 0 && $intervalo->m == 1 && $intervalo->d == 0){echo "Falta ";}
	elseif($intervalo->y == 0 && $intervalo->m == 0 && $intervalo->d == 1){echo "Falta ";}

	echo "<strong>";
	if($intervalo->y == 0){echo "";}else{if($intervalo->y > 1){echo $intervalo->y." anos";}else{echo $intervalo->y." ano";}}
	if($intervalo->y > 0 && $intervalo->m > 0 && $intervalo->d > 0){echo ", ";}
	elseif($intervalo->y > 0 && ($intervalo->m > 0 || $intervalo->d > 0)){echo " e ";}
	if($intervalo->m == 0){echo "";}else{if($intervalo->m > 1){echo $intervalo->m." meses";}else{echo $intervalo->m." mês";}}
	if($intervalo->m > 0 && $intervalo->d > 0){echo " e ";}
	if($intervalo->d == 0){echo "";}else{if($intervalo->d > 1){echo $intervalo->d." dias";}else{echo $intervalo->d." dia";}}
	echo "</strong>";
	echo " para o término do prazo estabelecido para o cumprimento da meta | ";
}
?>

<span style="color: #aaa;"><?php echo "<i class='icon-calendar'></i> ".$result->obj_prazo; if($result->obj_prazo == 1){echo " mês estipulado";}else{echo " meses estipulados";}?> - <?php if($result->obj_prazo_data == "0000-00-00"){echo "";}else{echo "prazo limite: ".date(('d/m/Y'),strtotime($result->obj_prazo_data));}}?></span></label>

<br />

	<label><i class="icon-signal"></i> <strong>Evolução: </strong>
	<?php
	$resultado = mysql_query("SELECT * FROM avaliacao WHERE acompanhamento_id = $result->id");
	$num_rows = mysql_num_rows($resultado);
	if ($num_rows == 0){
		echo "Não existem avaliações para este aluno";
	}elseif($num_rows == 1){
		foreach ($primeira_avaliacao as $ir) {
			if($ir->status_imc == NULL){
				echo 'Primeira pesagem: <strong>Valor não informado</strong>';
			}else{
		    echo 'Peso atual: <strong style="color:#5fb48b;">'.$ir->peso.' Kg</strong>';
		    }
	    }
	}elseif($num_rows == 2){
		foreach ($primeira_avaliacao as $ir) {
			$primeiropeso = $ir->peso;
			if($ir->status_imc == NULL){
				echo 'Primeira pesagem: <strong>Valor não informado</strong>';
			}else{
		    echo 'Primeira pesagem: <strong>'.$ir->peso.' Kg</strong>';
		    }
	    }

		foreach ($ultima_avaliacao as $ir) {
			$ultimopeso = $ir->peso;
			if($ir->status_imc == NULL){
				echo '| Última pesagem: <strong>Valor não informado</strong>';
			}else{
		    echo '| Peso atual: <strong style="color:#5fb48b;">'.$ir->peso.' Kg</strong>';
		    }
	    }

		if($ultimopeso != "0" && $primeiropeso != "0"){
			if($ultimopeso > $primeiropeso){
				$somapesos = $ultimopeso - $primeiropeso;
				echo ' | Você engordou <strong>'.$somapesos.' Kg</strong>';
			}elseif($ultimopeso < $primeiropeso){
				$somapesos = $primeiropeso - $ultimopeso;
				echo ' | Você emagreceu <strong>'.$somapesos.' Kg</strong>';
			}elseif($ultimopeso = $primeiropeso){
				echo ' | Seu peso não sofreu alterações';
			}
	    }else{
			echo "";
		}

	}elseif($num_rows >= 3){
		foreach ($primeira_avaliacao as $ir) {
			$primeiropeso = $ir->peso;
			if($ir->status_imc == NULL){
				echo 'Primeira pesagem: <strong>Valor não informado</strong>';
			}else{
		    echo 'Primeira pesagem: <strong>'.$ir->peso.' Kg</strong>';
		    }
	    }

		foreach ($penultima_avaliacao as $ir) {
			if($ir->status_imc == NULL){
				echo '| Última pesagem: <strong>Valor não informado</strong>';
			}else{
		    echo '| Penúltima pesagem: <strong>'.$ir->peso.' Kg</strong>';
		    }
	    }

		foreach ($ultima_avaliacao as $ir) {
			$ultimopeso = $ir->peso;
			if($ir->status_imc == NULL){
				echo '| Peso atual: <strong>Valor não informado</strong>';
			}else{
		    echo '| Peso atual: <strong style="color:#5fb48b;">'.$ir->peso.' Kg</strong>';
		    }
	    }

		if($ultimopeso != "0" && $primeiropeso != "0"){
			if($ultimopeso > $primeiropeso){
				$somapesos = $ultimopeso - $primeiropeso;
				echo ' | Você engordou <strong>'.$somapesos.' Kg</strong> desde a primeira pesagem';
			}elseif($ultimopeso < $primeiropeso){
				$somapesos = $primeiropeso - $ultimopeso;
				echo ' | Você emagreceu <strong>'.$somapesos.' Kg</strong> desde a primeira pesagem';
			}elseif($ultimopeso = $primeiropeso){
				echo ' | Seu peso é igual ao da primeira pesagem';
			}
	    }else{
			echo "";
		}
	}
	?>
	</label>
 
<br />

    <label><i class="icon-heart"></i> <strong>PAR-Q:</strong>
	<?php
    if($result->q1 == 1 || $result->q2 == 1 || $result->q3 == 1 || $result->q4 == 1 || $result->q5 == 1 || $result->q6 == 1 || $result->q7 == 1){echo "<span style='color: #b94a48;'>Existem contra indicações de atividades físicas no formulário de <b>PAR-Q</b> que devem ser observadas, acesse a guia <b>PAR-Q E ANAMNESE</b> para mais detalhes</span>";}else{echo "<span style='color: #5fb48b;'>Não existem contra indicações de atividades físicas no formulário de <b>PAR-Q</b></span>";}
    ?>
	</label>
 
<br />

    <label><i class="icon-user"></i> <strong>Última avaliação física:</strong>
    	<?php
    		if(empty($ultima_avaliacao)){echo "Não existem avaliações para este aluno";}else{
			foreach ($ultima_avaliacao as $ir) {
				if($ir->status_imc == NULL){
					echo 'Não foram inseridos dados na última avaliação física';
				}else{
					echo 'Peso: '.$ir->peso.'Kg. / Altura: '.$ir->altura.'m / <strong style="color:#5fb48b;">IMC: '.$ir->imc.' - '.$ir->status_imc.'</strong>';
				}
			}
    	}?>
    </label>
 
<br />

	<label style="margin-right:20px;"><i class="icon-adjust"></i> <strong>Avaliação da Composição Corporal: Protocolo Pollock (7 Dobras Cutâneas)</strong></label>
<a href="#modalComposicaoHomem" data-toggle="modal" class="btn btn-link" style="float: left;">Homem</a>
<a href="#modalComposicaoMulher" data-toggle="modal" class="btn btn-link" style="float: left;">Mulher</a>
<br />
</div>

<div class="well" style="margin-top: 25px;">
    <i class="icon-warning-sign"></i> O <strong>IMC</strong> é apenas uma referência de peso recomendado para cada indivíduo, Indicado para sedentários ou iniciantes de atividade física. <strong>Não recomendado</strong> para atletas ou praticantes avançados, por não distinguir massa magra de massa gorda.
</div>

</div>

<!--Tab 2-->
<div id="tab2" class="tab-pane" style="min-height: 300px">
    <div class="control-group" style="border-top-color:transparent;">
			<div class="span4" style="margin-bottom:10px"> 
				<div class="span12" style="margin-left: 0">  
				    <label for="obj_1">Qual o seu objetivo principal?</label>
						<div class="styled-select">
							<select name="obj_1" class="span12">
					   				<option selected=""><?php echo $result->obj_1;?></option>
					   				<option disabled style="color:#cdcdcd;">--------------------------------------------------------------</option>
					   				<option>Aumento da massa muscular</option>
									<option>Perder peso (Diminuição de gordura corporal)</option>
									<option>Aumento da flexibilidade óssea com alongamentos</option>
									<option>Qualidade de vida e diminuição do estresse</option>
									<option>Aumento da performance esportiva</option>
									<option>Recuperação de lesão</option>
							</select>
					  		</div>
				</div>
	    	</div>
        </div>

    <div class="control-group">
			<div class="span4" style="margin-bottom:10px"> 
				<div class="span12" style="margin-left: 0">  
				    <label for="obj_2">Qual o seu objetivo secundário?</label>
						<div class="styled-select">
							<select name="obj_2" class="span12">
					   				<option selected=""><?php echo $result->obj_2;?></option>
					   				<option disabled style="color:#cdcdcd;">--------------------------------------------------------------</option>
					   				<option>Aumento da massa muscular</option>
									<option>Perder peso (Diminuição de gordura corporal)</option>
									<option>Aumento da flexibilidade óssea com alongamentos</option>
									<option>Qualidade de vida e diminuição do estresse</option>
									<option>Aumento da performance esportiva</option>
									<option>Recuperação de lesão</option>
							</select>
					  		</div>
				</div>
        	</div>
        </div>

    <div class="control-group">
        	<div class="span12" style="margin-left: 0">
           		<label for="nascimento" class="control-label" style="width:auto;">Sua meta de peso ideal</label>
           		<div class="controls" style="margin-left: 160px;">
           			<input id="obj_peso" class="span1" type="text" name="obj_peso" value="<?php echo $result->obj_peso; ?>"/> <strong>Kg.</strong> <span style="color: #999;margin-left:10px;">(Deixar em branco caso o objetivo do aluno não seja ganhar ou perder peso)</span>
            	</div>
    		</div>
    	</div>

    <div class="control-group">
        	<div class="span12" style="margin-left: 0">
           		<label for="nascimento" class="control-label" style="width:auto;margin-right:10px;">Pretende alcançar o objetivo em quantos meses?</label>
           		<div class="controls">
           			<input id="obj_prazo" class="span1" type="text" name="obj_prazo" value="<?php echo $result->obj_prazo;?>"/> <span style="color: #999;margin-left:10px;"> <?php if($result->obj_prazo_data == "0000-00-00"){echo "";}else{echo "(Data Prazo: ".date(('d/m/Y'),strtotime($result->obj_prazo_data)).")";}?></span>
            	</div>
    		</div>
        </div>
</div>        
       
<!--Tab 3-->
<div id="tab3" class="tab-pane" style="min-height: 300px">
<a href="#modalNovaAvaliacao" data-toggle="modal" class="btn btn-info" style="float: left;"><i class="icon-plus"></i> Nova Avaliação</a>
<div class="well span4" style="padding: 5px;float:right;margin: 0">
<center>
	<strong >Composição Corporal:</strong>
	<a href="#modalComposicaoHomem" data-toggle="modal" class="btn btn-link">Homem</a>
	<a href="#modalComposicaoMulher" data-toggle="modal" class="btn btn-link">Mulher</a>
</center>
</div>
<br />
<br />
<?php if(!$results){?>
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-list"></i>
         </span>
        <h5>Avaliações</h5>

     </div>

				<div class="widget-content nopadding">
					<table class="table table-bordered ">
    					<tbody>
	        				<tr>
					            <td colspan="6"><div>Não existem avaliações para este aluno</div></td>
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
						        <tr>
						            <th style="text-align: left">Resumo da Avaliação Física de <?php
	$seleciona = mysql_query("SELECT nomeCliente FROM clientes WHERE idClientes = $result->clientes_id");
			while($ln = mysql_fetch_array($seleciona)){
			$nomeCliente = $ln['nomeCliente'];
			$partes = explode(' ', $nomeCliente);
			$primeiroNome = array_shift($partes);
			$ultimoNome = array_pop($partes);
			?>
				<?php echo $primeiroNome.' '.$ultimoNome;?>
			<?php } ?></th>
						            <th>Instrutor</th>
						            <th>Data da Avaliação</th>
						            <th style="width:90px"></th>
						        </tr>
						    </thead>
						    <tbody>
								<?php foreach ($results as $r) {
								    echo '<tr>';
									if($r->status_imc == NULL){
										echo '<td>Não foram inseridos dados</td>';
									}else{
								    echo '<td>'.'Peso: '.$r->peso.'Kg. / Altura: '.$r->altura.'m / <strong style="color:#5fb48b;">IMC: '.$r->imc.' - '.$r->status_imc.'</strong></td>';
								    }
								    echo '<td>'.$r->nome.'</td>';
								    echo "<td>".date(('d/m/Y'),strtotime($r->data_avaliacao))."</td>";
								    echo '<td><a href="'.base_url().'index.php/acompanhamento/avaliar/'.$r->idAvaliacao.'" class="btn"><i class="icon-pencil icon-white"></i></a>
								                      <a href="#modal-excluir" role="button" data-toggle="modal" avaliacao="'.$r->idAvaliacao.'" acompanhamento="'.$r->id.'" class="btn btn-danger"><i class="icon-trash icon-white"></i></a>  
								    </td>';
								    echo '</tr>';
								        }?>
									<tr class="well">
							            <td colspan="4"><i class="icon-warning-sign"></i> O <strong>IMC</strong> é apenas uma referência de peso recomendado para cada indivíduo, Indicado para sedentários ou iniciantes de atividade física. <strong>Não recomendado</strong> para atletas ou praticantes avançados, por não distinguir massa magra de massa gorda.</td>
									</tr>
							</tbody>
						</table>
					</div>
			</div>
<?php }?>
</div>


<!--Tab 4 PAR-Q e Anamnese-->
<div id="tab4" class="tab-pane" style="min-height: 300px">
        <div class="control-group">
			<div class="span12 well" style="margin-bottom:20px;"> 
				<div class="span4" style="margin-left: 0;">  
				    <label for="tel_emergencia">Telefone em caso de Emergência:</label>
				    <input id="tel_emergencia" class="span10" type="text" name="tel_emergencia" value="<?php echo $result->tel_emergencia;?>"/>
            	</div>
				<div class="span4" style="margin-left: 0">  
				    <label for="resp_emergencia">Responsável em caso de Emergência:</label>
				    <input id="resp_emergencia" class="span10" type="text" name="resp_emergencia" value="<?php echo $result->resp_emergencia;?>"/>
            	</div>
				<div class="span4" style="margin-left: 0;">  
				    <label for="tel_extra_emergencia">Telefone extra de Emergência:</label>
				    <input id="tel_extra_emergencia" class="span10" type="text" name="tel_extra_emergencia" value="<?php echo $result->tel_extra_emergencia;?>" placeholder="Ex: Ambulância, Bombeiros, Socorrista"/>
            	</div>
			</div>
		</div>

<div class="widget-box">
	<div class="widget-title">
        <span class="icon">
            <i class="icon-heart"></i>
         </span>
        <h5>PAR-Q Questionário de Prontidão para Atividade Física</h5>
     </div>

		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			        <tr>
			            <th>#</th>
			            <th>Questão</th>
			            <th>Sim</th>
			            <th>Não</th>
			        </tr>
			    </thead>
			    <tbody>
			        <?php
			        $q1sim = "";
			        $q1nao = "";
			        $q2sim = "";
			        $q2nao = "";
			        $q3sim = "";
			        $q3nao = "";
			        $q4sim = "";
			        $q4nao = "";
			        $q5sim = "";
			        $q5nao = "";
			        $q6sim = "";
			        $q6nao = "";
			        $q7sim = "";
			        $q7nao = "";
					$a1sim = "";
			        $a1nao = "";
			        $a2_1sim = "";
			        $a2_2sim = "";
			        $a2_3sim = "";
			        $a2_4sim = "";
			        $a2_5sim = "";
			        $a2_6sim = "";
			        $a2_7sim = "";
			        $a2_8sim = "";
			        $a2_9sim = "";
			        $a2_10sim = "";
			        $a2_11sim = "";
			        $a2_12sim = "";
			        $a3_1sim = "";
			        $a3_2sim = "";
			        $a5sim = "";
			        $a5nao = "";
			        $a6sim = "";
			        $a6nao = "";
			        $a7_2_1x = "";
			        $a7_2_2x = "";
			        $a7_2_3x = "";
			        $a7_2_mais = "";
			        $a8_2sim = "";
			        $a8_2nao = "";
			        $a9_1sempre = "";
			        $a9_2sempre = "";
			        $a9_3sempre = "";
			        $a9_4sempre = "";
			        $a9_1asvezes = "";
			        $a9_2asvezes = "";
			        $a9_3asvezes = "";
			        $a9_4asvezes = "";
			        $a9_1nunca = "";
			        $a9_2nunca = "";
			        $a9_3nunca = "";
			        $a9_4nunca = "";

			        if($result->q1 == 1){$q1sim ='checked=""';}else{}
			        if($result->q1 == 2){$q1nao ='checked=""';}else{}
			        if($result->q2 == 1){$q2sim ='checked=""';}else{}
			        if($result->q2 == 2){$q2nao ='checked=""';}else{}
			        if($result->q3 == 1){$q3sim ='checked=""';}else{}
			        if($result->q3 == 2){$q3nao ='checked=""';}else{}
			        if($result->q4 == 1){$q4sim ='checked=""';}else{}
			        if($result->q4 == 2){$q4nao ='checked=""';}else{}
			        if($result->q5 == 1){$q5sim ='checked=""';}else{}
			        if($result->q5 == 2){$q5nao ='checked=""';}else{}
			        if($result->q6 == 1){$q6sim ='checked=""';}else{}
			        if($result->q6 == 2){$q6nao ='checked=""';}else{}
			        if($result->q7 == 1){$q7sim ='checked=""';}else{}
			        if($result->q7 == 2){$q7nao ='checked=""';}else{}
			        if($result->a1 == 1){$a1sim ='checked=""';}else{}
			        if($result->a1 == 2){$a1nao ='checked=""';}else{}
			        if($result->a2_1 == 1){$a2_1sim ='checked=""';}else{}
			        if($result->a2_2 == 1){$a2_2sim ='checked=""';}else{}
			        if($result->a2_3 == 1){$a2_3sim ='checked=""';}else{}
			        if($result->a2_4 == 1){$a2_4sim ='checked=""';}else{}
			        if($result->a2_5 == 1){$a2_5sim ='checked=""';}else{}
			        if($result->a2_6 == 1){$a2_6sim ='checked=""';}else{}
			        if($result->a2_7 == 1){$a2_7sim ='checked=""';}else{}
			        if($result->a2_8 == 1){$a2_8sim ='checked=""';}else{}
			        if($result->a2_9 == 1){$a2_9sim ='checked=""';}else{}
			        if($result->a2_10 == 1){$a2_10sim ='checked=""';}else{}
			        if($result->a2_11 == 1){$a2_11sim ='checked=""';}else{}
			        if($result->a2_12 == 1){$a2_12sim ='checked=""';}else{}
			        if($result->a3_1 == 1){$a3_1sim ='checked=""';}else{}
			        if($result->a3_2 == 1){$a3_2sim ='checked=""';}else{}
			        if($result->a5 == 1){$a5sim ='checked=""';}else{}
			        if($result->a5 == 2){$a5nao ='checked=""';}else{}
			        if($result->a6 == 1){$a6sim ='checked=""';}else{}
			        if($result->a6 == 2){$a6nao ='checked=""';}else{}
			        if($result->a7_2 == 1){$a7_2_1x ='checked=""';}else{}
			        if($result->a7_2 == 2){$a7_2_2x ='checked=""';}else{}
			        if($result->a7_2 == 3){$a7_2_3x ='checked=""';}else{}
			        if($result->a7_2 == 4){$a7_2_mais ='checked=""';}else{}
			        if($result->a8_2 == 1){$a8_2sim ='checked=""';}else{}
			        if($result->a8_2 == 2){$a8_2nao ='checked=""';}else{}
			        if($result->a9_1 == 1){$a9_1sempre ='checked=""';}else{}
			        if($result->a9_2 == 1){$a9_2sempre ='checked=""';}else{}
			        if($result->a9_3 == 1){$a9_3sempre ='checked=""';}else{}
			        if($result->a9_4 == 1){$a9_4sempre ='checked=""';}else{}
			        if($result->a9_1 == 3){$a9_1asvezes ='checked=""';}else{}
			        if($result->a9_2 == 3){$a9_2asvezes ='checked=""';}else{}
			        if($result->a9_3 == 3){$a9_3asvezes ='checked=""';}else{}
			        if($result->a9_4 == 3){$a9_4asvezes ='checked=""';}else{}
			        if($result->a9_1 == 2){$a9_1nunca ='checked=""';}else{}
			        if($result->a9_2 == 2){$a9_2nunca ='checked=""';}else{}
			        if($result->a9_3 == 2){$a9_3nunca ='checked=""';}else{}
			        if($result->a9_4 == 2){$a9_4nunca ='checked=""';}else{}

			        ?>
			        <tr>
			            <td>1.</td>
			            <td>O seu médico já lhe disse alguma vez que você tem um problema cardíaco?</td>
			            <td><center><input type="radio" name="q1" value="1" <?php echo $q1sim;?>/></center></td>
			            <td><center><input type="radio" name="q1" value="2" <?php echo $q1nao;?>/></center></td>
					</tr>

			        <tr>
			            <td>2.</td>
			            <td>Você tem dores no peito com freqüência ou causada pela prática atividades físicas?</td>
			            <td><center><input type="radio" name="q2" value="1" <?php echo $q2sim;?>/></center></td>
			            <td><center><input type="radio" name="q2" value="2" <?php echo $q2nao;?>/></center></td>
					</tr>
					
					<tr>
			            <td>3.</td>
			            <td>Você tende a perder a consciência ou cair, como resultado de tonteira ou desmaio?</td>
			            <td><center><input type="radio" name="q3" value="1" <?php echo $q3sim;?>/></center></td>
			            <td><center><input type="radio" name="q3" value="2" <?php echo $q3nao;?>/></center></td>
					</tr>
					
					<tr>
			            <td>4.</td>
			            <td>Algum médico já lhe disse que a sua pressão arterial estava muito alta?</td>
			            <td><center><input type="radio" name="q4" value="1" <?php echo $q4sim;?>/></center></td>
			            <td><center><input type="radio" name="q4" value="2" <?php echo $q4nao;?>/></center></td>
					</tr>
					
					<tr>
			            <td>5.</td>
			            <td>Algum médico já lhe disse que você tem um problema ósseo ou articular, ex: artrite, que se tenha agravado com o exercício ou que possa piorar com ele?</td>
			            <td><center><input type="radio" name="q5" value="1" <?php echo $q5sim;?>/></center></td>
			            <td><center><input type="radio" name="q5" value="2" <?php echo $q5nao;?>/></center></td>
					</tr>
					
					<tr>
			            <td>6.</td>
			            <td>Existe alguma boa razão física, não mencionada aqui, para que você não siga um programa de atividade física, mesmo que você queira?</td>
			            <td><center><input type="radio" name="q6" value="1" <?php echo $q6sim;?>/></center></td>
			            <td><center><input type="radio" name="q6" value="2" <?php echo $q6nao;?>/></center></td>
					</tr>
					
					<tr>
			            <td>7.</td>
			            <td>Você tem mais de 65 anos de idade e não está acostumado a exercícios intensos?</td>
			            <td><center><input type="radio" name="q7" value="1" <?php echo $q7sim;?>/></center></td>
			            <td><center><input type="radio" name="q7" value="2" <?php echo $q7nao;?>/></center></td>
					</tr>
					<tr style="color: #b94a48;background-color:#f2dede;">
						<td><i class="icon-warning-sign"></i></td>
			            <td colspan="3"><b>ATENÇÃO!</b> Se apenas uma das questões acima for respondida com um <b>sim</b>, seria recomendada uma avaliação médica antes do início do programa.</td>
					</tr>


			    </tbody>
			</table>
		</div>
</div>

<br />

<div class="widget-box">
	<div class="widget-title">
        <span class="icon">
            <i class="icon-heart"></i>
         </span>
        <h5>Ficha de Anamnese</h5>

     </div>

	<div class="widget-content nopadding">
		<table class="table table-bordered">
			<tbody>
			<tr>
			<td>1.</td>
			<td>
				<label>Você desmaia com frequência ou tem episódios importantes de vertigem?</label>
				<div class="span11">
		    		<div class="span1"><input type="radio" name="a1" id="a1nao" value="2" <?php echo $a1nao;?>/> <label style="display: inline" for="a1nao">Não</label></div>
		    		<div class="span1"><input type="radio" name="a1" id="a1sim" value="1" <?php echo $a1sim;?>/> <label style="display: inline" for="a1sim">Sim</label></div>
		    	</div>
		    </td>
			</tr>
			
			<tr>
			<td>2.</td>
			<td>
		        <label>Um médico já disse que você tinha algum dos problemas que se seguem?</label>
			   	<div class="span6">
				    <div class="span6"><input type="checkbox" name="a2_1" id="a2_1" value="1" <?php echo $a2_1sim;?>/> <label class="p" for="a2_1">Doença ou problemas cardíacos</label></div>
				    <div class="span6"><input type="checkbox" name="a2_2" id="a2_2" value="1" <?php echo $a2_3sim;?>/> <label class="p" for="a2_2">Derrame cerebral</label></div>
				</div>
				<div class="span6">
				    <div class="span6"><input type="checkbox" name="a2_3" id="a2_3" value="1" <?php echo $a2_3sim;?>/> <label style="display: inline" for="a2_3">Epilepsia</label></div>
				    <div class="span6"><input type="checkbox" name="a2_4" id="a2_4" value="1" <?php echo $a2_4sim;?>/> <label class="p" for="a2_4">Colesterol elevado</label></div>
				</div>
				<div class="span6">
				    <div class="span6"><input type="checkbox" name="a2_5" id="a2_5" value="1" <?php echo $a2_5sim;?>/> <label class="p" for="a2_5">Enfisema</label></div>
				    <div class="span6"><input type="checkbox" name="a2_6" id="a2_6" value="1" <?php echo $a2_6sim;?>/> <label class="p" for="a2_6">Diabetes</label></div>
				</div>
				<div class="span6">
				    <div class="span6"><input type="checkbox" name="a2_7" id="a2_7" value="1" <?php echo $a2_7sim;?>/> <label class="p" for="a2_7">Asma</label></div>
				    <div class="span6"><input type="checkbox" name="a2_8" id="a2_8" value="1" <?php echo $a2_8sim;?>/> <label class="p" for="a2_8">Bronquite</label></div>
				</div>
				<div class="span6">
				    <div class="span6"><input type="checkbox" name="a2_9" id="a2_9" value="1" <?php echo $a2_9sim;?>/> <label class="p" for="a2_9">Hipertensão</label></div>
				    <div class="span6"><input type="checkbox" name="a2_10" id="a2_10" value="1" <?php echo $a2_10sim;?>/> <label class="p" for="a2_10">Câncer</label></div>
				</div>
				<div class="span6">
				    <div class="span6"><input type="checkbox" name="a2_11" id="a2_11" value="1" <?php echo $a2_11sim;?>/> <label class="p" for="a2_11">Angina (dor no peito)</label></div>
				    <div class="span6"><input type="checkbox" name="a2_12" id="a2_12" value="1" <?php echo $a2_12sim;?>/> <label class="p" for="a2_12">Distúrbios da Tireoide</label></div>
		    	</div>
		    </td>
			</tr>

			<tr>
			<td>3.</td>
			<td>
				<label>Possui algum dos sintomas abaixo?</label>
			    <div class="span6">
				    <div class="span12"><input type="checkbox" name="a3_1" id="a3_1" value="1" <?php echo $a3_1sim;?>/> <label class="p" for="a3_1">Dor nas costas</label></div>
				</div>
			    <div class="span6">
				    <div class="span12"><input type="checkbox" name="a3_2" id="a3_2" value="1" <?php echo $a3_2sim;?>/> <label class="p" for="a3_2">Dor nas articulações, tendões ou músculo. Por favor, explique:</label> </div>
				    <input class="span12" type="text" name="a3_3" value="<?php echo $result->a3_3;?>" maxlength="255"/>
			    </div>
		    </td>
			</tr>

			<tr>
			<td>4.</td>
			<td>
		    	<label>Liste os medicamentos que você está tomando (nome e motivo)</label>
		        <div class="span6">
		        	<input class="span12" type="text" name="a4" value="<?php echo $result->a4;?>" maxlength="255"/>
		        </div>
		    </td>
			</tr>
			
			<tr>
			<td>5.</td>
			<td>
				<label>Algum parente próximo teve ataque cardíaco ou outro problema relacionado com o coração?</label>
				<div class="span11">
					<div class="span1"><input type="radio" name="a5" id="a5nao" value="2" <?php echo $a5nao;?>/> <label class="p" for="a5nao">Não</label></div>
					<div class="span1"><input type="radio" name="a5" id="a5sim" value="1" <?php echo $a5sim;?>/> <label class="p" for="a5sim">Sim</label></div>
				</div>
		    </td>
			</tr>
			
			<tr>
			<td>6.</td>
			<td>
		    	<label>Você fuma?</label>
		    	<div class="span11">
					    <div class="span1"><input type="radio" name="a6" id="a6nao" value="2" <?php echo $a6nao;?>/> <label class="p" for="a6nao">Não</label></div>
					    <div class="span1"><input type="radio" name="a6" id="a6sim" value="1" <?php echo $a6sim;?>/> <label class="p" for="a6sim">Sim</label></div>
					    <input class="span1" type="number" name="a6_1" id="a6_1" value="<?php echo $result->a6_1;?>" class="span1" min="0" max="999"/> <label class="p" for="a6_1">Cigarros por dia</label>
	    		</div>
		    </td>
			</tr>
			
			<tr>
			<td>7.</td>
			<td>
		    	<label>Atualmente você tem praticado algum exercício físico?</label>
		        <div class="span8">
		        	<label for="a7_1"><b>a.</b> Se sim, especifique:</label>
		           	<input type="text" name="a7_1" id="a7_1" class="span6" value="<?php echo $result->a7_1;?>" placeholder="Ex: Corrida, caminhada, bicileta, natação, etc." maxlength="255"/><br /><br />
		           	<label><b>b.</b> Quantas vezes por semana?</label>
		           	<div class="span2"><input type="radio" name="a7_2" id="a7_2_1x" value="1" <?php echo $a7_2_1x;?>/> <label class="p" for="a7_2_1x">1 vez</label></div>
					<div class="span2"><input type="radio" name="a7_2" id="a7_2_2x" value="2" <?php echo $a7_2_2x;?>/> <label class="p" for="a7_2_2x">2 vezes</label></div>
					<div class="span2"><input type="radio" name="a7_2" id="a7_2_3x" value="3" <?php echo $a7_2_3x;?>/> <label class="p" for="a7_2_3x">3 vezes</label></div>
					<div class="span3"><input type="radio" name="a7_2" id="a7_2_mais" value="4" <?php echo $a7_2_mais;?>/> <label class="p" for="a7_2_mais">Mais de 3 vezes</label></div>
		    	</div>
		    </td>
			</tr>
			
			<tr>
			<td>8.</td>
			<td>
		    	<label>Quantas horas por dia você dorme?</label>
		    	<div class="span11">
		        	<input class="span1" type="number" name="a8_1" value="<?php echo $result->a8_1;?>" min="0" max="24"/><br /><br />
		        	<label><b>a.</b> Você acorda descansado?</label>
		        	<div class="span1"><input type="radio" name="a8_2" id="a8_2nao" value="2" <?php echo $a8_2nao;?>/> <label class="p" for="a8_2nao">Não</label></div>
					<div class="span1"><input type="radio" name="a8_2" id="a8_2sim" value="1" <?php echo $a8_2sim;?>/> <label class="p" for="a8_2sim">Sim</label></div>
		    	</div>
		    </td>
			</tr>
			
			<tr>
			<td>9.</td>
			<td>
        	<div class="span11">
           		<label>Com que frequência você sente algum desses sintomas?</label>
           	<div class="span8">	
           		<label><b>a.</b> Fica irritato(a) com frequência</label>
           		<div class="span2"><input type="radio" name="a9_1" id="a9_1sempre" value="1" <?php echo $a9_1sempre;?>/> <label class="p" for="a9_1sempre">Sempre</label></div>
			    <div class="span2"><input type="radio" name="a9_1" id="a9_1asvezes" value="3" <?php echo $a9_1asvezes;?>/> <label class="p" for="a9_1asvezes">Às vezes</label></div>
			    <div class="span2"><input type="radio" name="a9_1" id="a9_1nunca" value="2" <?php echo $a9_1nunca;?>/> <label class="p" for="a9_1nunca">Nunca</label></div>
			</div>
			
			<div class="span8">
			  	<label><b>b.</b>  Mal humor</label>
           		<div class="span2"><input type="radio" name="a9_2" id="a9_2sempre" value="1" <?php echo $a9_2sempre;?>/> <label class="p" for="a9_2sempre">Sempre</label></div>
			    <div class="span2"><input type="radio" name="a9_2" id="a9_2asvezes" value="3" <?php echo $a9_2asvezes;?>/> <label class="p" for="a9_2asvezes">Às vezes</label></div>
			    <div class="span2"><input type="radio" name="a9_2" id="a9_2nunca" value="2" <?php echo $a9_2nunca;?>/> <label class="p" for="a9_2nunca">Nunca</label></div>
			</div>
			
			<div class="span8">
			    <label><b>c.</b> Dor de cabeça</label>
           		<div class="span2"><input type="radio" name="a9_3" id="a9_3sempre" value="1" <?php echo $a9_3sempre;?>/> <label class="p" for="a9_3sempre">Sempre</label></div>
			    <div class="span2"><input type="radio" name="a9_3" id="a9_3asvezes" value="3" <?php echo $a9_3asvezes;?>/> <label class="p" for="a9_3asvezes">Às vezes</label></div>
			    <div class="span2"><input type="radio" name="a9_3" id="a9_3nunca" value="2" <?php echo $a9_3nunca;?>/> <label class="p" for="a9_3nunca">Nunca</label></div>
			</div>
			
			<div class="span8">					    
			    <label><b>d.</b> Desânimo</label>
           		<div class="span2"><input type="radio" name="a9_4" id="a9_4sempre" value="1" <?php echo $a9_4sempre;?>/> <label class="p" for="a9_4sempre">Sempre</label></div>
			    <div class="span2"><input type="radio" name="a9_4" id="a9_4asvezes" value="3" <?php echo $a9_4asvezes;?>/> <label class="p" for="a9_4asvezes">Às vezes</label></div>
			    <div class="span2"><input type="radio" name="a9_4" id="a9_4nunca" value="2" <?php echo $a9_4nunca;?>/> <label class="p" for="a9_4nunca">Nunca</label></div>
			</div>
    		</div>
		    </td>
			</tr>

			</tbody>
		</table>
	</div>
</div>
<div class="form-actions" style="border:1px solid #e5e5e5">
    <div class="span12">
        <div class="span6 offset6">
            <button type="submit" style="margin-top: 3px;float: right;" class="btn btn-info"><i class="icon-save icon-white"></i> Gravar Alterações</button>
        </div>
    </div>
</div>
</div>

<!--Tab 5 Ficha Treinamento-->
<div id="tab5" class="tab-pane" style="min-height: 300px">
<a href="#modalImprimirFicha" data-toggle="modal" class="btn btn-link" style="float: left;"><i class="icon-print"></i> Imprimir Ficha de Treino</a>
<br />
<div class="widget-box">
		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			    	<tr>
			    		<th colspan="4"><h5>SEGUNDA-FEIRA</h5></th>
			    	</tr>
			        <tr>
			            <th style="text-align: left;width:50%">EXERCÍCIO</th>
			            <th>SÉRIES</th>
			            <th>REPETIÇÕES</th>
			            <th>CARGA</th>
			        </tr>
			    </thead>
			    <tbody>
					<tr>
						<td><input type="text" maxlength="40" name="seg_exe1" class="span12" value="<?php echo $result->seg_exe1;?>" placeholder="Exemplo: Peito - Supino Reto" autofocus=""/></td>
						<td><input type="text" name="seg_serie1" class="span12" value="<?php echo $result->seg_serie1;?>" placeholder="Ex: 3"/></td>
						<td><input type="text" name="seg_rep1" class="span12" value="<?php echo $result->seg_rep1;?>" placeholder="Ex: 10/12"/></td>
						<td><input type="text" name="seg_obs1" class="span12" value="<?php echo $result->seg_obs1;?>" placeholder="Ex: 20Kg"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40"  name="seg_exe2" class="span12" value="<?php echo $result->seg_exe2;?>"/></td>
						<td><input type="text" name="seg_serie2" class="span12" value="<?php echo $result->seg_serie2;?>"/></td>
						<td><input type="text" name="seg_rep2" class="span12" value="<?php echo $result->seg_rep2;?>"/></td>
						<td><input type="text" name="seg_obs2" class="span12" value="<?php echo $result->seg_obs2;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe3" class="span12" value="<?php echo $result->seg_exe3;?>"/></td>
						<td><input type="text" name="seg_serie3" class="span12" value="<?php echo $result->seg_serie3;?>"/></td>
						<td><input type="text" name="seg_rep3" class="span12" value="<?php echo $result->seg_rep3;?>"/></td>
						<td><input type="text" name="seg_obs3" class="span12" value="<?php echo $result->seg_obs3;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe4" class="span12" value="<?php echo $result->seg_exe4;?>"/></td>
						<td><input type="text" name="seg_serie4" class="span12" value="<?php echo $result->seg_serie4;?>"/></td>
						<td><input type="text" name="seg_rep4" class="span12" value="<?php echo $result->seg_rep4;?>"/></td>
						<td><input type="text" name="seg_obs4" class="span12" value="<?php echo $result->seg_obs4;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe5" class="span12" value="<?php echo $result->seg_exe5;?>"/></td>
						<td><input type="text" name="seg_serie5" class="span12" value="<?php echo $result->seg_serie5;?>"/></td>
						<td><input type="text" name="seg_rep5" class="span12" value="<?php echo $result->seg_rep5;?>"/></td>
						<td><input type="text" name="seg_obs5" class="span12" value="<?php echo $result->seg_obs5;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe6" class="span12" value="<?php echo $result->seg_exe6;?>"/></td>
						<td><input type="text" name="seg_serie6" class="span12" value="<?php echo $result->seg_serie6;?>"/></td>
						<td><input type="text" name="seg_rep6" class="span12" value="<?php echo $result->seg_rep6;?>"/></td>
						<td><input type="text" name="seg_obs6" class="span12" value="<?php echo $result->seg_obs6;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe7" class="span12" value="<?php echo $result->seg_exe7;?>"/></td>
						<td><input type="text" name="seg_serie7" class="span12" value="<?php echo $result->seg_serie7;?>"/></td>
						<td><input type="text" name="seg_rep7" class="span12" value="<?php echo $result->seg_rep7;?>"/></td>
						<td><input type="text" name="seg_obs7" class="span12" value="<?php echo $result->seg_obs7;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe8" class="span12" value="<?php echo $result->seg_exe8;?>"/></td>
						<td><input type="text" name="seg_serie8" class="span12" value="<?php echo $result->seg_serie8;?>"/></td>
						<td><input type="text" name="seg_rep8" class="span12" value="<?php echo $result->seg_rep8;?>"/></td>
						<td><input type="text" name="seg_obs8" class="span12" value="<?php echo $result->seg_obs8;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe9" class="span12" value="<?php echo $result->seg_exe9;?>"/></td>
						<td><input type="text" name="seg_serie9" class="span12" value="<?php echo $result->seg_serie9;?>"/></td>
						<td><input type="text" name="seg_rep9" class="span12" value="<?php echo $result->seg_rep9;?>"/></td>
						<td><input type="text" name="seg_obs9" class="span12" value="<?php echo $result->seg_obs9;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="seg_exe10" class="span12" value="<?php echo $result->seg_exe10;?>"/></td>
						<td><input type="text" name="seg_serie10" class="span12" value="<?php echo $result->seg_serie10;?>"/></td>
						<td><input type="text" name="seg_rep10" class="span12" value="<?php echo $result->seg_rep10;?>"/></td>
						<td><input type="text" name="seg_obs10" class="span12" value="<?php echo $result->seg_obs10;?>"/></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<div class="widget-box">
		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			    	<tr>
			    		<th colspan="4"><h5>TERÇA-FEIRA</h5></th>
			    	</tr>
			        <tr>
			            <th style="text-align: left;width:50%">EXERCÍCIO</th>
			            <th>SÉRIES</th>
			            <th>REPETIÇÕES</th>
			            <th>CARGA</th>
			        </tr>
			    </thead>
			    <tbody>
					<tr>
						<td><input type="text" maxlength="40" name="ter_exe1" class="span12" value="<?php echo $result->ter_exe1;?>"/></td>
						<td><input type="text" name="ter_serie1" class="span12" value="<?php echo $result->ter_serie1;?>"/></td>
						<td><input type="text" name="ter_rep1" class="span12" value="<?php echo $result->ter_rep1;?>"/></td>
						<td><input type="text" name="ter_obs1" class="span12" value="<?php echo $result->ter_obs1;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe2" class="span12" value="<?php echo $result->ter_exe2;?>"/></td>
						<td><input type="text" name="ter_serie2" class="span12" value="<?php echo $result->ter_serie2;?>"/></td>
						<td><input type="text" name="ter_rep2" class="span12" value="<?php echo $result->ter_rep2;?>"/></td>
						<td><input type="text" name="ter_obs2" class="span12" value="<?php echo $result->ter_obs2;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe3" class="span12" value="<?php echo $result->ter_exe3;?>"/></td>
						<td><input type="text" name="ter_serie3" class="span12" value="<?php echo $result->ter_serie3;?>"/></td>
						<td><input type="text" name="ter_rep3" class="span12" value="<?php echo $result->ter_rep3;?>"/></td>
						<td><input type="text" name="ter_obs3" class="span12" value="<?php echo $result->ter_obs3;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe4" class="span12" value="<?php echo $result->ter_exe4;?>"/></td>
						<td><input type="text" name="ter_serie4" class="span12" value="<?php echo $result->ter_serie4;?>"/></td>
						<td><input type="text" name="ter_rep4" class="span12" value="<?php echo $result->ter_rep4;?>"/></td>
						<td><input type="text" name="ter_obs4" class="span12" value="<?php echo $result->ter_obs4;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe5" class="span12" value="<?php echo $result->ter_exe5;?>"/></td>
						<td><input type="text" name="ter_serie5" class="span12" value="<?php echo $result->ter_serie5;?>"/></td>
						<td><input type="text" name="ter_rep5" class="span12" value="<?php echo $result->ter_rep5;?>"/></td>
						<td><input type="text" name="ter_obs5" class="span12" value="<?php echo $result->ter_obs5;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe6" class="span12" value="<?php echo $result->ter_exe6;?>"/></td>
						<td><input type="text" name="ter_serie6" class="span12" value="<?php echo $result->ter_serie6;?>"/></td>
						<td><input type="text" name="ter_rep6" class="span12" value="<?php echo $result->ter_rep6;?>"/></td>
						<td><input type="text" name="ter_obs6" class="span12" value="<?php echo $result->ter_obs6;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe7" class="span12" value="<?php echo $result->ter_exe7;?>"/></td>
						<td><input type="text" name="ter_serie7" class="span12" value="<?php echo $result->ter_serie7;?>"/></td>
						<td><input type="text" name="ter_rep7" class="span12" value="<?php echo $result->ter_rep7;?>"/></td>
						<td><input type="text" name="ter_obs7" class="span12" value="<?php echo $result->ter_obs7;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe8" class="span12" value="<?php echo $result->ter_exe8;?>"/></td>
						<td><input type="text" name="ter_serie8" class="span12" value="<?php echo $result->ter_serie8;?>"/></td>
						<td><input type="text" name="ter_rep8" class="span12" value="<?php echo $result->ter_rep8;?>"/></td>
						<td><input type="text" name="ter_obs8" class="span12" value="<?php echo $result->ter_obs8;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe9" class="span12" value="<?php echo $result->ter_exe9;?>"/></td>
						<td><input type="text" name="ter_serie9" class="span12" value="<?php echo $result->ter_serie9;?>"/></td>
						<td><input type="text" name="ter_rep9" class="span12" value="<?php echo $result->ter_rep9;?>"/></td>
						<td><input type="text" name="ter_obs9" class="span12" value="<?php echo $result->ter_obs9;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="ter_exe10" class="span12" value="<?php echo $result->ter_exe10;?>"/></td>
						<td><input type="text" name="ter_serie10" class="span12" value="<?php echo $result->ter_serie10;?>"/></td>
						<td><input type="text" name="ter_rep10" class="span12" value="<?php echo $result->ter_rep10;?>"/></td>
						<td><input type="text" name="ter_obs10" class="span12" value="<?php echo $result->ter_obs10;?>"/></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<div class="widget-box">
		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			    	<tr>
			    		<th colspan="4"><h5>QUARTA-FEIRA</h5></th>
			    	</tr>
			        <tr>
			            <th style="text-align: left;width:50%">EXERCÍCIO</th>
			            <th>SÉRIES</th>
			            <th>REPETIÇÕES</th>
			            <th>CARGA</th>
			        </tr>
			    </thead>
			    <tbody>
					<tr>
						<td><input type="text" maxlength="40" name="qua_exe1" class="span12" value="<?php echo $result->qua_exe1;?>"/></td>
						<td><input type="text" name="qua_serie1" class="span12" value="<?php echo $result->qua_serie1;?>"/></td>
						<td><input type="text" name="qua_rep1" class="span12" value="<?php echo $result->qua_rep1;?>"/></td>
						<td><input type="text" name="qua_obs1" class="span12" value="<?php echo $result->qua_obs1;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe2" class="span12" value="<?php echo $result->qua_exe2;?>"/></td>
						<td><input type="text" name="qua_serie2" class="span12" value="<?php echo $result->qua_serie2;?>"/></td>
						<td><input type="text" name="qua_rep2" class="span12" value="<?php echo $result->qua_rep2;?>"/></td>
						<td><input type="text" name="qua_obs2" class="span12" value="<?php echo $result->qua_obs2;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe3" class="span12" value="<?php echo $result->qua_exe3;?>"/></td>
						<td><input type="text" name="qua_serie3" class="span12" value="<?php echo $result->qua_serie3;?>"/></td>
						<td><input type="text" name="qua_rep3" class="span12" value="<?php echo $result->qua_rep3;?>"/></td>
						<td><input type="text" name="qua_obs3" class="span12" value="<?php echo $result->qua_obs3;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe4" class="span12" value="<?php echo $result->qua_exe4;?>"/></td>
						<td><input type="text" name="qua_serie4" class="span12" value="<?php echo $result->qua_serie4;?>"/></td>
						<td><input type="text" name="qua_rep4" class="span12" value="<?php echo $result->qua_rep4;?>"/></td>
						<td><input type="text" name="qua_obs4" class="span12" value="<?php echo $result->qua_obs4;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe5" class="span12" value="<?php echo $result->qua_exe5;?>"/></td>
						<td><input type="text" name="qua_serie5" class="span12" value="<?php echo $result->qua_serie5;?>"/></td>
						<td><input type="text" name="qua_rep5" class="span12" value="<?php echo $result->qua_rep5;?>"/></td>
						<td><input type="text" name="qua_obs5" class="span12" value="<?php echo $result->qua_obs5;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe6" class="span12" value="<?php echo $result->qua_exe6;?>"/></td>
						<td><input type="text" name="qua_serie6" class="span12" value="<?php echo $result->qua_serie6;?>"/></td>
						<td><input type="text" name="qua_rep6" class="span12" value="<?php echo $result->qua_rep6;?>"/></td>
						<td><input type="text" name="qua_obs6" class="span12" value="<?php echo $result->qua_obs6;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe7" class="span12" value="<?php echo $result->qua_exe7;?>"/></td>
						<td><input type="text" name="qua_serie7" class="span12" value="<?php echo $result->qua_serie7;?>"/></td>
						<td><input type="text" name="qua_rep7" class="span12" value="<?php echo $result->qua_rep7;?>"/></td>
						<td><input type="text" name="qua_obs7" class="span12" value="<?php echo $result->qua_obs7;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe8" class="span12" value="<?php echo $result->qua_exe8;?>"/></td>
						<td><input type="text" name="qua_serie8" class="span12" value="<?php echo $result->qua_serie8;?>"/></td>
						<td><input type="text" name="qua_rep8" class="span12" value="<?php echo $result->qua_rep8;?>"/></td>
						<td><input type="text" name="qua_obs8" class="span12" value="<?php echo $result->qua_obs8;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe9" class="span12" value="<?php echo $result->qua_exe9;?>"/></td>
						<td><input type="text" name="qua_serie9" class="span12" value="<?php echo $result->qua_serie9;?>"/></td>
						<td><input type="text" name="qua_rep9" class="span12" value="<?php echo $result->qua_rep9;?>"/></td>
						<td><input type="text" name="qua_obs9" class="span12" value="<?php echo $result->qua_obs9;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qua_exe10" class="span12" value="<?php echo $result->qua_exe10;?>"/></td>
						<td><input type="text" name="qua_serie10" class="span12" value="<?php echo $result->qua_serie10;?>"/></td>
						<td><input type="text" name="qua_rep10" class="span12" value="<?php echo $result->qua_rep10;?>"/></td>
						<td><input type="text" name="qua_obs10" class="span12" value="<?php echo $result->qua_obs10;?>"/></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<div class="widget-box">
		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			    	<tr>
			    		<th colspan="4"><h5>QUINTA-FEIRA</h5></th>
			    	</tr>
			        <tr>
			            <th style="text-align: left;width:50%">EXERCÍCIO</th>
			            <th>SÉRIES</th>
			            <th>REPETIÇÕES</th>
			            <th>CARGA</th>
			        </tr>
			    </thead>
			    <tbody>
					<tr>
						<td><input type="text" maxlength="40" name="qui_exe1" class="span12" value="<?php echo $result->qui_exe1;?>"/></td>
						<td><input type="text" name="qui_serie1" class="span12" value="<?php echo $result->qui_serie1;?>"/></td>
						<td><input type="text" name="qui_rep1" class="span12" value="<?php echo $result->qui_rep1;?>"/></td>
						<td><input type="text" name="qui_obs1" class="span12" value="<?php echo $result->qui_obs1;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe2" class="span12" value="<?php echo $result->qui_exe2;?>"/></td>
						<td><input type="text" name="qui_serie2" class="span12" value="<?php echo $result->qui_serie2;?>"/></td>
						<td><input type="text" name="qui_rep2" class="span12" value="<?php echo $result->qui_rep2;?>"/></td>
						<td><input type="text" name="qui_obs2" class="span12" value="<?php echo $result->qui_obs2;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe3" class="span12" value="<?php echo $result->qui_exe3;?>"/></td>
						<td><input type="text" name="qui_serie3" class="span12" value="<?php echo $result->qui_serie3;?>"/></td>
						<td><input type="text" name="qui_rep3" class="span12" value="<?php echo $result->qui_rep3;?>"/></td>
						<td><input type="text" name="qui_obs3" class="span12" value="<?php echo $result->qui_obs3;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe4" class="span12" value="<?php echo $result->qui_exe4;?>"/></td>
						<td><input type="text" name="qui_serie4" class="span12" value="<?php echo $result->qui_serie4;?>"/></td>
						<td><input type="text" name="qui_rep4" class="span12" value="<?php echo $result->qui_rep4;?>"/></td>
						<td><input type="text" name="qui_obs4" class="span12" value="<?php echo $result->qui_obs4;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe5" class="span12" value="<?php echo $result->qui_exe5;?>"/></td>
						<td><input type="text" name="qui_serie5" class="span12" value="<?php echo $result->qui_serie5;?>"/></td>
						<td><input type="text" name="qui_rep5" class="span12" value="<?php echo $result->qui_rep5;?>"/></td>
						<td><input type="text" name="qui_obs5" class="span12" value="<?php echo $result->qui_obs5;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe6" class="span12" value="<?php echo $result->qui_exe6;?>"/></td>
						<td><input type="text" name="qui_serie6" class="span12" value="<?php echo $result->qui_serie6;?>"/></td>
						<td><input type="text" name="qui_rep6" class="span12" value="<?php echo $result->qui_rep6;?>"/></td>
						<td><input type="text" name="qui_obs6" class="span12" value="<?php echo $result->qui_obs6;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe7" class="span12" value="<?php echo $result->qui_exe7;?>"/></td>
						<td><input type="text" name="qui_serie7" class="span12" value="<?php echo $result->qui_serie7;?>"/></td>
						<td><input type="text" name="qui_rep7" class="span12" value="<?php echo $result->qui_rep7;?>"/></td>
						<td><input type="text" name="qui_obs7" class="span12" value="<?php echo $result->qui_obs7;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe8" class="span12" value="<?php echo $result->qui_exe8;?>"/></td>
						<td><input type="text" name="qui_serie8" class="span12" value="<?php echo $result->qui_serie8;?>"/></td>
						<td><input type="text" name="qui_rep8" class="span12" value="<?php echo $result->qui_rep8;?>"/></td>
						<td><input type="text" name="qui_obs8" class="span12" value="<?php echo $result->qui_obs8;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe9" class="span12" value="<?php echo $result->qui_exe9;?>"/></td>
						<td><input type="text" name="qui_serie9" class="span12" value="<?php echo $result->qui_serie9;?>"/></td>
						<td><input type="text" name="qui_rep9" class="span12" value="<?php echo $result->qui_rep9;?>"/></td>
						<td><input type="text" name="qui_obs9" class="span12" value="<?php echo $result->qui_obs9;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="qui_exe10" class="span12" value="<?php echo $result->qui_exe10;?>"/></td>
						<td><input type="text" name="qui_serie10" class="span12" value="<?php echo $result->qui_serie10;?>"/></td>
						<td><input type="text" name="qui_rep10" class="span12" value="<?php echo $result->qui_rep10;?>"/></td>
						<td><input type="text" name="qui_obs10" class="span12" value="<?php echo $result->qui_obs10;?>"/></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<div class="widget-box">
		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			    	<tr>
			    		<th colspan="4"><h5>SEXTA-FEIRA</h5></th>
			    	</tr>
			        <tr>
			            <th style="text-align: left;width:50%">EXERCÍCIO</th>
			            <th>SÉRIES</th>
			            <th>REPETIÇÕES</th>
			            <th>CARGA</th>
			        </tr>
			    </thead>
			    <tbody>
					<tr>
						<td><input type="text" maxlength="40" name="sex_exe1" class="span12" value="<?php echo $result->sex_exe1;?>"/></td>
						<td><input type="text" name="sex_serie1" class="span12" value="<?php echo $result->sex_serie1;?>"/></td>
						<td><input type="text" name="sex_rep1" class="span12" value="<?php echo $result->sex_rep1;?>"/></td>
						<td><input type="text" name="sex_obs1" class="span12" value="<?php echo $result->sex_obs1;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe2" class="span12" value="<?php echo $result->sex_exe2;?>"/></td>
						<td><input type="text" name="sex_serie2" class="span12" value="<?php echo $result->sex_serie2;?>"/></td>
						<td><input type="text" name="sex_rep2" class="span12" value="<?php echo $result->sex_rep2;?>"/></td>
						<td><input type="text" name="sex_obs2" class="span12" value="<?php echo $result->sex_obs2;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe3" class="span12" value="<?php echo $result->sex_exe3;?>"/></td>
						<td><input type="text" name="sex_serie3" class="span12" value="<?php echo $result->sex_serie3;?>"/></td>
						<td><input type="text" name="sex_rep3" class="span12" value="<?php echo $result->sex_rep3;?>"/></td>
						<td><input type="text" name="sex_obs3" class="span12" value="<?php echo $result->sex_obs3;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe4" class="span12" value="<?php echo $result->sex_exe4;?>"/></td>
						<td><input type="text" name="sex_serie4" class="span12" value="<?php echo $result->sex_serie4;?>"/></td>
						<td><input type="text" name="sex_rep4" class="span12" value="<?php echo $result->sex_rep4;?>"/></td>
						<td><input type="text" name="sex_obs4" class="span12" value="<?php echo $result->sex_obs4;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe5" class="span12" value="<?php echo $result->sex_exe5;?>"/></td>
						<td><input type="text" name="sex_serie5" class="span12" value="<?php echo $result->sex_serie5;?>"/></td>
						<td><input type="text" name="sex_rep5" class="span12" value="<?php echo $result->sex_rep5;?>"/></td>
						<td><input type="text" name="sex_obs5" class="span12" value="<?php echo $result->sex_obs5;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe6" class="span12" value="<?php echo $result->sex_exe6;?>"/></td>
						<td><input type="text" name="sex_serie6" class="span12" value="<?php echo $result->sex_serie6;?>"/></td>
						<td><input type="text" name="sex_rep6" class="span12" value="<?php echo $result->sex_rep6;?>"/></td>
						<td><input type="text" name="sex_obs6" class="span12" value="<?php echo $result->sex_obs6;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe7" class="span12" value="<?php echo $result->sex_exe7;?>"/></td>
						<td><input type="text" name="sex_serie7" class="span12" value="<?php echo $result->sex_serie7;?>"/></td>
						<td><input type="text" name="sex_rep7" class="span12" value="<?php echo $result->sex_rep7;?>"/></td>
						<td><input type="text" name="sex_obs7" class="span12" value="<?php echo $result->sex_obs7;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe8" class="span12" value="<?php echo $result->sex_exe8;?>"/></td>
						<td><input type="text" name="sex_serie8" class="span12" value="<?php echo $result->sex_serie8;?>"/></td>
						<td><input type="text" name="sex_rep8" class="span12" value="<?php echo $result->sex_rep8;?>"/></td>
						<td><input type="text" name="sex_obs8" class="span12" value="<?php echo $result->sex_obs8;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe9" class="span12" value="<?php echo $result->sex_exe9;?>"/></td>
						<td><input type="text" name="sex_serie9" class="span12" value="<?php echo $result->sex_serie9;?>"/></td>
						<td><input type="text" name="sex_rep9" class="span12" value="<?php echo $result->sex_rep9;?>"/></td>
						<td><input type="text" name="sex_obs9" class="span12" value="<?php echo $result->sex_obs9;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sex_exe10" class="span12" value="<?php echo $result->sex_exe10;?>"/></td>
						<td><input type="text" name="sex_serie10" class="span12" value="<?php echo $result->sex_serie10;?>"/></td>
						<td><input type="text" name="sex_rep10" class="span12" value="<?php echo $result->sex_rep10;?>"/></td>
						<td><input type="text" name="sex_obs10" class="span12" value="<?php echo $result->sex_obs10;?>"/></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<div class="widget-box">
		<div class="widget-content nopadding">
			<table class="table table-bordered ">
			    <thead>
			    	<tr>
			    		<th colspan="4"><h5>SÁBADO</h5></th>
			    	</tr>
			        <tr>
			            <th style="text-align: left;width:50%">EXERCÍCIO</th>
			            <th>SÉRIES</th>
			            <th>REPETIÇÕES</th>
			            <th>CARGA</th>
			        </tr>
			    </thead>
			    <tbody>
					<tr>
						<td><input type="text" maxlength="40" name="sab_exe1" class="span12" value="<?php echo $result->sab_exe1;?>"/></td>
						<td><input type="text" name="sab_serie1" class="span12" value="<?php echo $result->sab_serie1;?>"/></td>
						<td><input type="text" name="sab_rep1" class="span12" value="<?php echo $result->sab_rep1;?>"/></td>
						<td><input type="text" name="sab_obs1" class="span12" value="<?php echo $result->sab_obs1;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe2" class="span12" value="<?php echo $result->sab_exe2;?>"/></td>
						<td><input type="text" name="sab_serie2" class="span12" value="<?php echo $result->sab_serie2;?>"/></td>
						<td><input type="text" name="sab_rep2" class="span12" value="<?php echo $result->sab_rep2;?>"/></td>
						<td><input type="text" name="sab_obs2" class="span12" value="<?php echo $result->sab_obs2;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe3" class="span12" value="<?php echo $result->sab_exe3;?>"/></td>
						<td><input type="text" name="sab_serie3" class="span12" value="<?php echo $result->sab_serie3;?>"/></td>
						<td><input type="text" name="sab_rep3" class="span12" value="<?php echo $result->sab_rep3;?>"/></td>
						<td><input type="text" name="sab_obs3" class="span12" value="<?php echo $result->sab_obs3;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe4" class="span12" value="<?php echo $result->sab_exe4;?>"/></td>
						<td><input type="text" name="sab_serie4" class="span12" value="<?php echo $result->sab_serie4;?>"/></td>
						<td><input type="text" name="sab_rep4" class="span12" value="<?php echo $result->sab_rep4;?>"/></td>
						<td><input type="text" name="sab_obs4" class="span12" value="<?php echo $result->sab_obs4;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe5" class="span12" value="<?php echo $result->sab_exe5;?>"/></td>
						<td><input type="text" name="sab_serie5" class="span12" value="<?php echo $result->sab_serie5;?>"/></td>
						<td><input type="text" name="sab_rep5" class="span12" value="<?php echo $result->sab_rep5;?>"/></td>
						<td><input type="text" name="" class="span12" value="<?php echo $result->sab_obs5;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe6" class="span12" value="<?php echo $result->sab_exe6;?>"/></td>
						<td><input type="text" name="sab_serie6" class="span12" value="<?php echo $result->sab_serie6;?>"/></td>
						<td><input type="text" name="sab_rep6" class="span12" value="<?php echo $result->sab_rep6;?>"/></td>
						<td><input type="text" name="sab_obs6" class="span12" value="<?php echo $result->sab_obs6;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe7" class="span12" value="<?php echo $result->sab_exe7;?>"/></td>
						<td><input type="text" name="sab_serie7" class="span12" value="<?php echo $result->sab_serie7;?>"/></td>
						<td><input type="text" name="sab_rep7" class="span12" value="<?php echo $result->sab_rep7;?>"/></td>
						<td><input type="text" name="sab_obs7" class="span12" value="<?php echo $result->sab_obs7;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe8" class="span12" value="<?php echo $result->sab_exe8;?>"/></td>
						<td><input type="text" name="sab_serie8" class="span12" value="<?php echo $result->sab_serie8;?>"/></td>
						<td><input type="text" name="sab_rep8" class="span12" value="<?php echo $result->sab_rep8;?>"/></td>
						<td><input type="text" name="sab_obs8" class="span12" value="<?php echo $result->sab_obs8;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe9" class="span12" value="<?php echo $result->sab_exe9;?>"/></td>
						<td><input type="text" name="sab_serie9" class="span12" value="<?php echo $result->sab_serie9;?>"/></td>
						<td><input type="text" name="sab_rep9" class="span12" value="<?php echo $result->sab_rep9;?>"/></td>
						<td><input type="text" name="sab_obs9" class="span12" value="<?php echo $result->sab_obs9;?>"/></td>
					</tr>

					<tr>
						<td><input type="text" maxlength="40" name="sab_exe10" class="span12" value="<?php echo $result->sab_exe10;?>"/></td>
						<td><input type="text" name="sab_serie10" class="span12" value="<?php echo $result->sab_serie10;?>"/></td>
						<td><input type="text" name="sab_rep10" class="span12" value="<?php echo $result->sab_rep10;?>"/></td>
						<td><input type="text" name="sab_obs10" class="span12" value="<?php echo $result->sab_obs10;?>"/></td>
					</tr>
				</tbody>
			</table>
		</div>
</div>

<div class="form-actions" style="border:1px solid #e5e5e5">
    <div class="span12">
        <div class="span6 offset6">
            <button type="submit" style="margin-top: 3px;float: right;" class="btn btn-info"><i class="icon-save icon-white"></i> Gravar Alterações</button>
        </div>
    </div>
</div>
</div>
</div>
</form>

</div>

<!-- Modal adicionar novo -->
<div id="modalNovaAvaliacao" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formnovaavaliacao" action="<?php echo base_url(); ?>acompanhamento/avaliar" method="post">
  
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Nova Avaliação</h3>
  </div>
  <div class="modal-body">
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span12" style="margin-left: 0">
    			<?php echo form_hidden('id',$result->id) ?>
    			<?php echo form_hidden('clientes_id',$result->clientes_id) ?>
    			<label for="instrutor">Instrutor que realizará a avaliação</label>
    			<input class="span12" id="instrutor" type="text" name="instrutor" value=""/>
    			<input id="usuarios_id" class="span12" type="hidden" name="usuarios_id" value=""  />
    		</div>
    	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-success" id="btnContinuar"><i class="icon-share-alt icon-white"></i> Continuar</button>
  </div>
  </form>
</div>

<!-- Modal Excluir Avaliação-->
<div id="modal-excluir" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form action="<?php echo base_url() ?>index.php/acompanhamento/excluirAvaliacao" method="post" >
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h5 id="myModalLabel">Remover Avaliação</h5>
  </div>
  <div class="modal-body">
    <input type="hidden" id="idavaliacao" name="id" value="" />
    <input type="hidden" id="idacompanhamento" name="idacompanhamento" value="" />
    <h5 style="text-align: center">Deseja realmente remover esta avaliação?</h5>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn btn-danger">Excluir</button>
  </div>
  </form>
</div>

<!-- Modal Imprimir Ficha-->
<div id="modalImprimirFicha" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formImprimirFicha" action="<?php echo base_url() ?>acompanhamento/fichaTreino" method="post">
  
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Gerar Ficha de Treino</h3>
  </div>
  <div class="modal-body">
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span12" style="margin-left: 0">
    			<?php echo form_hidden('id',$result->id) ?>
    			<?php echo form_hidden('clientes_id',$result->clientes_id) ?>
    			<label for="objetivo">Objetivo</label>
    			<input class="span12" type="text" id="objetivo" name="objetivo" placeholder="Ex: Hipertrofia" value="<?php if($result->obj_1 == NULL){echo"Nenhum objetivo principal selecionado";}else{echo $result->obj_1;}?>"/>
    			<label for="instrutor_ficha">Instrutor</label>
    			<input type="text" class="span12" id="instrutor_ficha" name="instrutor_ficha" value=""/>
    			<input id="usuarios_id_ficha" class="span12" type="hidden" name="usuarios_id_ficha" value=""  />
    			<label for="inicio">Início</label>
    			<input class="span3 datepicker" type="text" id="inicio" name="inicio" value=""/>
    		</div>
    	</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <button class="btn" id="btnContinuar"><i class="icon-print icon-white"></i> Gerar Ficha</button>
  </div>
  </form>
</div>

<!-- Modal Composicao Homem-->
<div id="modalComposicaoHomem" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Porcentagem de Gordura de 7 Pontos - Protocolo Pollock (HOMEM)</h3>
  </div>
  <div class="modal-body">
	<div class="span12" style="margin-left: 0">
	<?php
		$resultado = mysql_query("SELECT * FROM avaliacao WHERE acompanhamento_id = $result->id");
		$num_rows = mysql_num_rows($resultado);
		if ($num_rows == 0){
			echo "Não existem avaliações para este aluno<br>";
		}else{
			foreach ($ultima_avaliacao as $ir) {
				$ultimopeso = $ir->peso;
				if($ir->status_imc == NULL){
					echo '<span style="color:#b94a48">A última avaliação do aluno não foi preenchida corretamente, acesse a página de edição da última avaliação física na guia <b>Antropometria</b> e insira os dados</span>';
				}else{
					
$sql = mysql_query("Select nascimento From clientes Where idClientes = $result->clientes_id");
	while($ln = mysql_fetch_array($sql)){
		$nascimento_completo = date(('d/m/Y'),strtotime($ln['nascimento']));
	    $data = $nascimento_completo;
	    list($dia, $mes, $ano) = explode('/', $data);
	    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

		if($ln['nascimento'] == "0000-00-00"){$idade = 0;}else{$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);}
}
					$peso = $ir->peso;
					$dobra_triceps = $ir->dobra_triceps;
					$dobra_subescapular = $ir->dobra_subescapular;
					$dobra_suprailiaca = $ir->dobra_supra_iliaca;
					$dobra_abdominal = $ir->dobra_abdominal;
					$dobra_axilar = $ir->dobra_axilar_media;
					$dobra_peito = $ir->dobra_torax;
					$dobra_coxa = $ir->dobra_coxa_medial;

					$soma_7dobras = ($dobra_triceps + $dobra_subescapular + $dobra_suprailiaca + $dobra_abdominal + $dobra_axilar + $dobra_peito + $dobra_coxa);
					$soma_7dobras_quadrado = pow($soma_7dobras, 2);

					$dens_corp_mas = 1.1120-(0.00043499*$soma_7dobras)+(0.00000055*$soma_7dobras_quadrado)-(0.00028826*$idade);

					$gordura_mas_Pollock_7dobras = ((4.95 / $dens_corp_mas) - 4.5) * 100;
					$porcento_gordura = $gordura_mas_Pollock_7dobras / 100;
					$peso_gordo = $peso * $porcento_gordura;
					$peso_magro = $peso - $peso_gordo;
					$peso_residual = $peso * 0.24;

				echo '<div class="span12" style="margin-bottom:10px;">';
					echo '<div class="span4">';
					    echo '<i class="icon-ok"></i> Tríceps: <strong>'.$dobra_triceps.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Subescapular: <strong>'.$dobra_subescapular.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Supra-Ilíaca: <strong>'.$dobra_suprailiaca.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Abdominal: <strong>'.$dobra_abdominal.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Axilar: <strong>'.$dobra_axilar.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Peito: <strong>'.$dobra_peito.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Coxa: <strong>'.$dobra_coxa.' mm</strong><br/>';
				    echo '</div>';
				    echo '<div class="span8">';
					    echo '<i class="icon-ok"></i> Gênero: <strong>Masculino</strong><br/>';
					    echo '<i class="icon-ok"></i> Peso: <strong>'.$peso.' Kg</strong><br/>';
					    if($idade == 0){echo "<i class='icon-ok'></i> Idade: <span style='color:#b94a48'><strong>Não cadastrado</strong></span>";}else{echo '<i class="icon-ok"></i> Idade: <strong>'.$idade.' anos</strong><br/>';}
				    echo '</div>';
				echo '</div>';

				  //validação
				  if(($dobra_peito == 0) || ($dobra_abdominal == 0) || ($dobra_coxa == 0) || ($dobra_triceps == 0) || ($dobra_subescapular == 0) || ($dobra_suprailiaca == 0) || ($dobra_axilar == 0)){
				  		echo "<span style='color:#b94a48'>As medidas das <strong>dobras cutâneas</strong> não foram preenchidas corretamente, acesse a página de edição da última avaliação física na guia <b>Antropometria</b> para mais detalhes</span>";
				  }else{
					  if(($idade>100)||($idade<15)){
						echo "<span style='color:#b94a48'>- O aluno deve ter <b>idade</b> entre 15 e 100 anos, altere em <strong>Alunos > Editar Aluno</strong></span><br/>";
					  }
					  if(($peso>600)||($peso<35)){
						echo "<span style='color:#b94a48'>- O aluno <b>deve pesar</b> entre 35 e 600 Kgs</span><br/>";
					  }
					  if($dobra_peito>100 || $dobra_peito<1){
						echo "<span style='color:#b94a48'>- A medida do <b>peitoral</b> deve ser entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_abdominal>100 || $dobra_abdominal<1){
						echo "<span style='color:#b94a48'>- A medida do <b>abdominal</b> deve ser entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_coxa>100 || $dobra_coxa<1){
						echo "<span style='color:#b94a48'>- A medida da <b>coxa</b> deve ser entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_triceps>100 || $dobra_triceps<1){
						echo"<span style='color:#b94a48'>- A medida do <b>triceps</b> deve ser entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_subescapular>100 || $dobra_subescapular<1){
						echo "<span style='color:#b94a48'>- A medida do <b>subesapular</b> deve ser entre 1 e 100 mm</span></span><br/>";
					  }
					  if($dobra_suprailiaca>100 || $dobra_suprailiaca<1){
						echo "<span style='color:#b94a48'>- A medida do <b>suprailíaco</b> deve ser entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_axilar>100 || $dobra_axilar<1){
						echo "<span style='color:#b94a48'>- A medida da <b>axila</b> deve ser entre 1 e 100 mm<br/>";
					  }
					  
					  if(($dobra_axilar<100) && ($dobra_axilar>1) && ($dobra_suprailiaca<100) && ($dobra_suprailiaca>1) && ($dobra_subescapular<100) && ($dobra_subescapular>1) && ($dobra_triceps<100) && ($dobra_triceps>1) && ($dobra_coxa<100) && ($dobra_coxa>1) && ($dobra_abdominal<100) && ($dobra_abdominal>1) && ($dobra_peito<100) && ($dobra_peito>1) && ($peso<600)&&($peso>35) && ($idade<100)&&($idade>15)){
						echo "<br/>Gordura Corporal: <strong style='color:#c94e48'>".number_format($gordura_mas_Pollock_7dobras, 2, ',', '.')." %</strong><br/>";
						echo "Peso Gordo: <strong style='color:#c94e48'>".number_format($peso_gordo, 2, ',', '.')." Kg</strong><br/>";
						echo "Peso Magro: <strong style='color:#c94e48'>".number_format($peso_magro, 2, ',', '.')." Kg</strong><br/>";
						echo "Peso Residual: <strong style='color:#c94e48'>".number_format($peso_residual, 2, ',', '.')." Kg</strong><br/>";

						
					  }
					}
				}
			}
		}
		
	?>
</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>
</div>

<!-- Modal Composicao Mulher-->
<div id="modalComposicaoMulher" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Porcentagem de Gordura de 7 Pontos - Protocolo Pollock (MULHER)</h3>
  </div>
  <div class="modal-body">
	<div class="span12" style="margin-left: 0">
	<?php
		$resultado = mysql_query("SELECT * FROM avaliacao WHERE acompanhamento_id = $result->id");
		$num_rows = mysql_num_rows($resultado);
		if ($num_rows == 0){
			echo "Não existem avaliações para este aluno<br>";
		}else{
			foreach ($ultima_avaliacao as $ir) {
				$ultimopeso = $ir->peso;
				if($ir->status_imc == NULL){
					echo '<span style="color:#b94a48">A última avaliação do aluno não foi preenchida corretamente, acesse a página de edição da última avaliação física na guia <b>Antropometria</b> e insira os dados</span>';
				}else{

$sql = mysql_query("Select nascimento From clientes Where idClientes = $result->clientes_id");
	while($ln = mysql_fetch_array($sql)){
		$nascimento_completo = date(('d/m/Y'),strtotime($ln['nascimento']));
	    $data = $nascimento_completo;
	    list($dia, $mes, $ano) = explode('/', $data);
	    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);

		if($ln['nascimento'] == "0000-00-00"){$idade = 0;}else{$idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);}
}
					$peso = $ir->peso;
					$dobra_triceps = $ir->dobra_triceps;
					$dobra_subescapular = $ir->dobra_subescapular;
					$dobra_suprailiaca = $ir->dobra_supra_iliaca;
					$dobra_abdominal = $ir->dobra_abdominal;
					$dobra_axilar = $ir->dobra_axilar_media;
					$dobra_peito = $ir->dobra_torax;
					$dobra_coxa = $ir->dobra_coxa_medial;

					$soma_7dobras = ($dobra_triceps + $dobra_subescapular + $dobra_suprailiaca + $dobra_abdominal + $dobra_axilar + $dobra_peito + $dobra_coxa);
					$soma_7dobras_quadrado = pow($soma_7dobras, 2);

					$dens_corp_fem = 1.097-(0.00046971*$soma_7dobras)+(0.00000056*$soma_7dobras_quadrado)-(0.00012828*$idade);

					$gordura_fem_Pollock_7dobras = ((4.95 / $dens_corp_fem) - 4.5) * 100;
					$porcento_gordura = $gordura_fem_Pollock_7dobras / 100;
					$peso_gordo = $peso * $porcento_gordura;
					$peso_magro = $peso - $peso_gordo;
					$peso_residual = $peso * 0.24;
				echo '<div class="span12" style="margin-bottom:10px;">';
					echo '<div class="span4">';
					    echo '<i class="icon-ok"></i> Tríceps: <strong>'.$dobra_triceps.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Subescapular: <strong>'.$dobra_subescapular.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Supra-Ilíaca: <strong>'.$dobra_suprailiaca.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Abdominal: <strong>'.$dobra_abdominal.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Axilar: <strong>'.$dobra_axilar.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Peito: <strong>'.$dobra_peito.' mm</strong><br/>';
					    echo '<i class="icon-ok"></i> Coxa: <strong>'.$dobra_coxa.' mm</strong><br/>';
				    echo '</div>';
				    echo '<div class="span8">';
					    echo '<i class="icon-ok"></i> Gênero: <strong>Feminino</strong><br/>';
					    echo '<i class="icon-ok"></i> Peso: <strong>'.$peso.' Kg</strong><br/>';
					    if($idade == 0){echo "<i class='icon-ok'></i> Idade: <span style='color:#b94a48'><strong>Não cadastrado</strong></span>";}else{echo '<i class="icon-ok"></i> Idade: <strong>'.$idade.' anos</strong><br/>';}
				    echo '</div>';
				echo '</div>';

				  //validação
				  if(($dobra_peito == 0) || ($dobra_abdominal == 0) || ($dobra_coxa == 0) || ($dobra_triceps == 0) || ($dobra_subescapular == 0) || ($dobra_suprailiaca == 0) || ($dobra_axilar == 0)){
				  		echo "<span style='color:#b94a48'>As medidas das <strong>dobras cutâneas</strong> não foram preenchidas corretamente, acesse a página de edição da última avaliação física na guia <b>Antropometria</b> para mais detalhes</span>";
				  }else{
					  if(($idade>100)||($idade<15)){
						echo "<span style='color:#b94a48'>- O aluno deve ter <b>idade</b> entre 15 e 100 anos, altere em <strong>Alunos > Editar Aluno</strong></span><br/>";
					  }
					  if(($peso>600)||($peso<35)){
						echo "<span style='color:#b94a48'>- O aluno <b>deve pesar</b> entre 35 e 600 Kgs</span><br/>";
					  }
					  if($dobra_peito>100 || $dobra_peito<1){
						echo "<span style='color:#b94a48'>- A medida do <b>peitoral</b> deve ser entre entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_abdominal>100 || $dobra_abdominal<1){
						echo "<span style='color:#b94a48'>- A medida do <b>abdominal</b> deve ser entre entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_coxa>100 || $dobra_coxa<1){
						echo "<span style='color:#b94a48'>- A medida da <b>coxa</b> deve ser entre entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_triceps>100 || $dobra_triceps<1){
						echo"<span style='color:#b94a48'>- A medida do <b>triceps</b> deve ser entre entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_subescapular>100 || $dobra_subescapular<1){
						echo "<span style='color:#b94a48'>- A medida do <b>subesapular</b> deve ser entre entre 1 e 100 mm</span></span><br/>";
					  }
					  if($dobra_suprailiaca>100 || $dobra_suprailiaca<1){
						echo "<span style='color:#b94a48'>- A medida do <b>suprailíaco</b> deve ser entre entre 1 e 100 mm</span><br/>";
					  }
					  if($dobra_axilar>100 || $dobra_axilar<1){
						echo "<span style='color:#b94a48'>- A medida da <b>axila</b> deve ser entre entre 1 e 100 mm<br/>";
					  }
					  
					  if(($dobra_axilar<100) && ($dobra_axilar>1) && ($dobra_suprailiaca<100) && ($dobra_suprailiaca>1) && ($dobra_subescapular<100) && ($dobra_subescapular>1) && ($dobra_triceps<100) && ($dobra_triceps>1) && ($dobra_coxa<100) && ($dobra_coxa>1) && ($dobra_abdominal<100) && ($dobra_abdominal>1) && ($dobra_peito<100) && ($dobra_peito>1) && ($peso<600)&&($peso>35) && ($idade<100)&&($idade>15)){
						echo "<br/>Gordura Corporal: <strong style='color:#c94e48'>".number_format($gordura_fem_Pollock_7dobras, 2, ',', '.')." %</strong><br/>";
						echo "Peso Gordo: <strong style='color:#c94e48'>".number_format($peso_gordo, 2, ',', '.')." Kg</strong><br/>";
						echo "Peso Magro: <strong style='color:#c94e48'>".number_format($peso_magro, 2, ',', '.')." Kg</strong><br/>";
						echo "Peso Residual: <strong style='color:#c94e48'>".number_format($peso_residual, 2, ',', '.')." Kg</strong><br/>";
					  }
					}
				}
			}
		}
		
	?>
</div>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>
</div>
<script src="<?php echo base_url();?>js/maskphone.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$("#tel_emergencia").mask("(99) 9999?9-9999");
	$("#tel_extra_emergencia").mask("(99) 9999?9-9999");
	
      $("#instrutor").autocomplete({
            source: "<?php echo base_url(); ?>index.php/acompanhamento/autoCompleteUsuario",
            minLength: 1,
            select: function( event, ui ) {
                 $("#usuarios_id").val(ui.item.id);
            }
      })

      $("#instrutor_ficha").autocomplete({
            source: "<?php echo base_url(); ?>index.php/acompanhamento/autoCompleteUsuario",
            minLength: 1,
            select: function( event, ui ) {
                 $("#usuarios_id_ficha").val(ui.item.id);
            }
      })
      
$("#formnovaavaliacao").validate({
  rules:{
     instrutor: {required:true}
  },
  messages:{
     instrutor: {required: 'Campo Requerido.'}
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

$("#formImprimirFicha").validate({
  rules:{
     objetivo: {required:true},
     instrutor_ficha: {required:true},
     inicio: {required:true}
  },
  messages:{
     objetivo: {required: 'Campo Requerido.'},
     instrutor_ficha: {required: 'Campo Requerido.'},
     inicio: {required: 'Campo Requerido.'}
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
        var avaliacao = $(this).attr('avaliacao');
        var acompanhamento = $(this).attr('acompanhamento');
        $('#idavaliacao').val(avaliacao);
        $('#idacompanhamento').val(acompanhamento);

    });
    $(".datepicker" ).datepicker({ dateFormat: 'dd/mm/yy' });
});
      </script>
      