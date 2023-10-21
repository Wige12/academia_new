<!DOCTYPE html>
<html>
<head>
    <title>Ficha de Treino</title>
    <meta charset="UTF- />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/blue.css" class="skin-color" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css
    <script type="text/javascript"  src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body style="background-color: transparent;">
			<div class="span12" style="height:60px;margin-bottom: 10px;">
				<div class="span4" style="border-right: 1px solid #000;float: left;padding-top:2px;"><h2>FICHA DE TREINO</h2></div>
				<div style="width: 350px;">
				<?php
					$seleciona_logo = mysql_query("SELECT url_logo FROM emitente");
					while($ln = mysql_fetch_array($seleciona_logo)){
						$url_logo = $ln['url_logo'];
				?>
				<img src="<?php echo $url_logo;?>" width="60px" style="margin-left: 20px;float: left;margin-right: 10px;">
				<?php }
					$seleciona = mysql_query("SELECT * FROM emitente LIMIT 1");
					while($ln = mysql_fetch_array($seleciona)){
						$nome = $ln['nome'];
						$telefone = $ln['telefone'];
				?>
				<small><?php echo $nome;?></small><br />
				<small><b>Fone:</b> <?php echo $telefone;?></small>
				<?php }?>	
				</div>
				</div>

	<?php
		$clientes_id = $_POST['clientes_id'];
		$objetivo = $_POST['objetivo'];
		$instrutor_ficha = $_POST['instrutor_ficha'];
		$inicio = $_POST['inicio'];

		$seleciona = mysql_query("SELECT nomeCliente FROM clientes WHERE idClientes = ".$clientes_id);
		while($ln = mysql_fetch_array($seleciona)){
			$nome = $ln['nomeCliente'];
	?>
	<div style="border-bottom: 1px dotted #ccc;padding-bottom: 5px;">
		<div class="span4" style="float: left;"><strong>Aluno:</strong> <?php echo $nome;?></div>
		<div class="span4" style="float: left;"><strong>Professor:</strong> <?php echo $instrutor_ficha;?></div>
		<div class="span4" style="float: left;"><strong>Objetivo:</strong> <?php echo $objetivo;?></div>
		<div class="span4" style="float: left;"><strong>Início:</strong> <?php echo $inicio;?></div>
	</div>
	<?php }?>
<div style="float: left;margin-top: 10px;width: 50%">
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th colspan = "4" style="background-color: #f5f5f5;padding-bottom:1;padding-top:1;"><center><h5>SEGUNDA-FEIRA</h5></center></th>
    	</tr>
        <tr style="background-color: #f5f5f5">
            <th style="text-align: left;width:20%;padding-bottom:1;padding-top:1;">exercício</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">sér.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">rep.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">obs.</th>
        </tr>
    </thead>
    <tbody>
		<tr>
						<?php if($ficha->seg_exe1 != "" && $ficha->seg_serie1 != "" && $ficha->seg_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;height:20px;overflow:hidden">'.$ficha->seg_exe1.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe1 != "" && $ficha->seg_serie1 != "" && $ficha->seg_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie1.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe1 != "" && $ficha->seg_serie1 != "" && $ficha->seg_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep1.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe1 != "" && $ficha->seg_serie1 != "" && $ficha->seg_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs1.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe2 != "" && $ficha->seg_serie2 != "" && $ficha->seg_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe2.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe2 != "" && $ficha->seg_serie2 != "" && $ficha->seg_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie2.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe2 != "" && $ficha->seg_serie2 != "" && $ficha->seg_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep2.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe2 != "" && $ficha->seg_serie2 != "" && $ficha->seg_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs2.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe3 != "" && $ficha->seg_serie3 != "" && $ficha->seg_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe3.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe3 != "" && $ficha->seg_serie3 != "" && $ficha->seg_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie3.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe3 != "" && $ficha->seg_serie3 != "" && $ficha->seg_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep3.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe3 != "" && $ficha->seg_serie3 != "" && $ficha->seg_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs3.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe4 != "" && $ficha->seg_serie4 != "" && $ficha->seg_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe4.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe4 != "" && $ficha->seg_serie4 != "" && $ficha->seg_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie4.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe4 != "" && $ficha->seg_serie4 != "" && $ficha->seg_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep4.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe4 != "" && $ficha->seg_serie4 != "" && $ficha->seg_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs4.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe5 != "" && $ficha->seg_serie5 != "" && $ficha->seg_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe5.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe5 != "" && $ficha->seg_serie5 != "" && $ficha->seg_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie5.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe5 != "" && $ficha->seg_serie5 != "" && $ficha->seg_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep5.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe5 != "" && $ficha->seg_serie5 != "" && $ficha->seg_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs5.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe6 != "" && $ficha->seg_serie6 != "" && $ficha->seg_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe6.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe6 != "" && $ficha->seg_serie6 != "" && $ficha->seg_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie6.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe6 != "" && $ficha->seg_serie6 != "" && $ficha->seg_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep6.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe6 != "" && $ficha->seg_serie6 != "" && $ficha->seg_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs6.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe7 != "" && $ficha->seg_serie7 != "" && $ficha->seg_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe7.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe7 != "" && $ficha->seg_serie7 != "" && $ficha->seg_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie7.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe7 != "" && $ficha->seg_serie7 != "" && $ficha->seg_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep7.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe7 != "" && $ficha->seg_serie7 != "" && $ficha->seg_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs7.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe8 != "" && $ficha->seg_serie8 != "" && $ficha->seg_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe8.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe8 != "" && $ficha->seg_serie8 != "" && $ficha->seg_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie8.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe8 != "" && $ficha->seg_serie8 != "" && $ficha->seg_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep8.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe8 != "" && $ficha->seg_serie8 != "" && $ficha->seg_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs8.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe9 != "" && $ficha->seg_serie9 != "" && $ficha->seg_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe9.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe9 != "" && $ficha->seg_serie9 != "" && $ficha->seg_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie9.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe9 != "" && $ficha->seg_serie9 != "" && $ficha->seg_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep9.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe9 != "" && $ficha->seg_serie9 != "" && $ficha->seg_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs9.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->seg_exe10 != "" && $ficha->seg_serie10 != "" && $ficha->seg_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_exe10.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe10 != "" && $ficha->seg_serie10 != "" && $ficha->seg_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_serie10.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe10 != "" && $ficha->seg_serie10 != "" && $ficha->seg_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_rep10.'</td>';}else{echo "";}?>
						<?php if($ficha->seg_exe10 != "" && $ficha->seg_serie10 != "" && $ficha->seg_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->seg_obs10.'</td>';}else{echo "";}?>
					</tr>
	</tbody> 
</table>
</div>

<div style="float: left;margin-left: 10px;margin-top: 10px;width: 50%">
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th colspan = "4" style="background-color: #f5f5f5;padding-bottom:1;padding-top:1;"><center><h5>TERÇA-FEIRA</h5></center></th>
    	</tr>
        <tr style="background-color: #f5f5f5">
            <th style="text-align: left;width:20%;padding-bottom:1;padding-top:1;">exercício</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">sér.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">rep.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">obs.</th>
        </tr>
    </thead>
    <tbody>
		<tr>
						<?php if($ficha->ter_exe1 != "" && $ficha->ter_serie1 != "" && $ficha->ter_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe1.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe1 != "" && $ficha->ter_serie1 != "" && $ficha->ter_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie1.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe1 != "" && $ficha->ter_serie1 != "" && $ficha->ter_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep1.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe1 != "" && $ficha->ter_serie1 != "" && $ficha->ter_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs1.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe2 != "" && $ficha->ter_serie2 != "" && $ficha->ter_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe2.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe2 != "" && $ficha->ter_serie2 != "" && $ficha->ter_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie2.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe2 != "" && $ficha->ter_serie2 != "" && $ficha->ter_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep2.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe2 != "" && $ficha->ter_serie2 != "" && $ficha->ter_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs2.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe3 != "" && $ficha->ter_serie3 != "" && $ficha->ter_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe3.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe3 != "" && $ficha->ter_serie3 != "" && $ficha->ter_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie3.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe3 != "" && $ficha->ter_serie3 != "" && $ficha->ter_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep3.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe3 != "" && $ficha->ter_serie3 != "" && $ficha->ter_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs3.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe4 != "" && $ficha->ter_serie4 != "" && $ficha->ter_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe4.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe4 != "" && $ficha->ter_serie4 != "" && $ficha->ter_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie4.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe4 != "" && $ficha->ter_serie4 != "" && $ficha->ter_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep4.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe4 != "" && $ficha->ter_serie4 != "" && $ficha->ter_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs4.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe5 != "" && $ficha->ter_serie5 != "" && $ficha->ter_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe5.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe5 != "" && $ficha->ter_serie5 != "" && $ficha->ter_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie5.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe5 != "" && $ficha->ter_serie5 != "" && $ficha->ter_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep5.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe5 != "" && $ficha->ter_serie5 != "" && $ficha->ter_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs5.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe6 != "" && $ficha->ter_serie6 != "" && $ficha->ter_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe6.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe6 != "" && $ficha->ter_serie6 != "" && $ficha->ter_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie6.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe6 != "" && $ficha->ter_serie6 != "" && $ficha->ter_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep6.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe6 != "" && $ficha->ter_serie6 != "" && $ficha->ter_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs6.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe7 != "" && $ficha->ter_serie7 != "" && $ficha->ter_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe7.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe7 != "" && $ficha->ter_serie7 != "" && $ficha->ter_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie7.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe7 != "" && $ficha->ter_serie7 != "" && $ficha->ter_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep7.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe7 != "" && $ficha->ter_serie7 != "" && $ficha->ter_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs7.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe8 != "" && $ficha->ter_serie8 != "" && $ficha->ter_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe8.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe8 != "" && $ficha->ter_serie8 != "" && $ficha->ter_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie8.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe8 != "" && $ficha->ter_serie8 != "" && $ficha->ter_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep8.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe8 != "" && $ficha->ter_serie8 != "" && $ficha->ter_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs8.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe9 != "" && $ficha->ter_serie9 != "" && $ficha->ter_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe9.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe9 != "" && $ficha->ter_serie9 != "" && $ficha->ter_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie9.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe9 != "" && $ficha->ter_serie9 != "" && $ficha->ter_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep9.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe9 != "" && $ficha->ter_serie9 != "" && $ficha->ter_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs9.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->ter_exe10 != "" && $ficha->ter_serie10 != "" && $ficha->ter_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_exe10.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe10 != "" && $ficha->ter_serie10 != "" && $ficha->ter_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_serie10.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe10 != "" && $ficha->ter_serie10 != "" && $ficha->ter_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_rep10.'</td>';}else{echo "";}?>
						<?php if($ficha->ter_exe10 != "" && $ficha->ter_serie10 != "" && $ficha->ter_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->ter_obs10.'</td>';}else{echo "";}?>
					</tr>
	</tbody>  
</table>
</div>

<div style="float: left;width: 50%">
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th colspan = "4" style="background-color: #f5f5f5;padding-bottom:1;padding-top:1;"><center><h5>QUARTA-FEIRA</h5></center></th>
    	</tr>
        <tr style="background-color: #f5f5f5">
            <th style="text-align: left;width:20%;padding-bottom:1;padding-top:1;">exercício</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">sér.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">rep.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">obs.</th>
        </tr>
    </thead>
    <tbody>
		<tr>
						<?php if($ficha->qua_exe1 != "" && $ficha->qua_serie1 != "" && $ficha->qua_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe1.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe1 != "" && $ficha->qua_serie1 != "" && $ficha->qua_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie1.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe1 != "" && $ficha->qua_serie1 != "" && $ficha->qua_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep1.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe1 != "" && $ficha->qua_serie1 != "" && $ficha->qua_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs1.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe2 != "" && $ficha->qua_serie2 != "" && $ficha->qua_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe2.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe2 != "" && $ficha->qua_serie2 != "" && $ficha->qua_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie2.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe2 != "" && $ficha->qua_serie2 != "" && $ficha->qua_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep2.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe2 != "" && $ficha->qua_serie2 != "" && $ficha->qua_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs2.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe3 != "" && $ficha->qua_serie3 != "" && $ficha->qua_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe3.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe3 != "" && $ficha->qua_serie3 != "" && $ficha->qua_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie3.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe3 != "" && $ficha->qua_serie3 != "" && $ficha->qua_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep3.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe3 != "" && $ficha->qua_serie3 != "" && $ficha->qua_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs3.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe4 != "" && $ficha->qua_serie4 != "" && $ficha->qua_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe4.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe4 != "" && $ficha->qua_serie4 != "" && $ficha->qua_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie4.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe4 != "" && $ficha->qua_serie4 != "" && $ficha->qua_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep4.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe4 != "" && $ficha->qua_serie4 != "" && $ficha->qua_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs4.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe5 != "" && $ficha->qua_serie5 != "" && $ficha->qua_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe5.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe5 != "" && $ficha->qua_serie5 != "" && $ficha->qua_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie5.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe5 != "" && $ficha->qua_serie5 != "" && $ficha->qua_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep5.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe5 != "" && $ficha->qua_serie5 != "" && $ficha->qua_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs5.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe6 != "" && $ficha->qua_serie6 != "" && $ficha->qua_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe6.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe6 != "" && $ficha->qua_serie6 != "" && $ficha->qua_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie6.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe6 != "" && $ficha->qua_serie6 != "" && $ficha->qua_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep6.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe6 != "" && $ficha->qua_serie6 != "" && $ficha->qua_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs6.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe7 != "" && $ficha->qua_serie7 != "" && $ficha->qua_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe7.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe7 != "" && $ficha->qua_serie7 != "" && $ficha->qua_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie7.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe7 != "" && $ficha->qua_serie7 != "" && $ficha->qua_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep7.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe7 != "" && $ficha->qua_serie7 != "" && $ficha->qua_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs7.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe8 != "" && $ficha->qua_serie8 != "" && $ficha->qua_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe8.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe8 != "" && $ficha->qua_serie8 != "" && $ficha->qua_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie8.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe8 != "" && $ficha->qua_serie8 != "" && $ficha->qua_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep8.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe8 != "" && $ficha->qua_serie8 != "" && $ficha->qua_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs8.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe9 != "" && $ficha->qua_serie9 != "" && $ficha->qua_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe9.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe9 != "" && $ficha->qua_serie9 != "" && $ficha->qua_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie9.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe9 != "" && $ficha->qua_serie9 != "" && $ficha->qua_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep9.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe9 != "" && $ficha->qua_serie9 != "" && $ficha->qua_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs9.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qua_exe10 != "" && $ficha->qua_serie10 != "" && $ficha->qua_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_exe10.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe10 != "" && $ficha->qua_serie10 != "" && $ficha->qua_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_serie10.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe10 != "" && $ficha->qua_serie10 != "" && $ficha->qua_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_rep10.'</td>';}else{echo "";}?>
						<?php if($ficha->qua_exe10 != "" && $ficha->qua_serie10 != "" && $ficha->qua_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qua_obs10.'</td>';}else{echo "";}?>
					</tr>
	</tbody>  
</table>
</div>

<div style="float: left;margin-left: 10px;width: 50%">
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th colspan = "4" style="background-color: #f5f5f5;padding-bottom:1;padding-top:1;"><center><h5>QUINTA-FEIRA</h5></center></th>
    	</tr>
        <tr style="background-color: #f5f5f5">
            <th style="text-align: left;width:20%;padding-bottom:1;padding-top:1;">exercício</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">sér.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">rep.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">obs.</th>
        </tr>
    </thead>
    <tbody>
		<tr>
						<?php if($ficha->qui_exe1 != "" && $ficha->qui_serie1 != "" && $ficha->qui_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe1.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe1 != "" && $ficha->qui_serie1 != "" && $ficha->qui_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie1.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe1 != "" && $ficha->qui_serie1 != "" && $ficha->qui_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep1.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe1 != "" && $ficha->qui_serie1 != "" && $ficha->qui_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs1.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe2 != "" && $ficha->qui_serie2 != "" && $ficha->qui_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe2.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe2 != "" && $ficha->qui_serie2 != "" && $ficha->qui_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie2.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe2 != "" && $ficha->qui_serie2 != "" && $ficha->qui_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep2.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe2 != "" && $ficha->qui_serie2 != "" && $ficha->qui_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs2.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe3 != "" && $ficha->qui_serie3 != "" && $ficha->qui_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe3.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe3 != "" && $ficha->qui_serie3 != "" && $ficha->qui_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie3.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe3 != "" && $ficha->qui_serie3 != "" && $ficha->qui_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep3.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe3 != "" && $ficha->qui_serie3 != "" && $ficha->qui_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs3.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe4 != "" && $ficha->qui_serie4 != "" && $ficha->qui_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe4.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe4 != "" && $ficha->qui_serie4 != "" && $ficha->qui_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie4.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe4 != "" && $ficha->qui_serie4 != "" && $ficha->qui_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep4.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe4 != "" && $ficha->qui_serie4 != "" && $ficha->qui_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs4.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe5 != "" && $ficha->qui_serie5 != "" && $ficha->qui_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe5.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe5 != "" && $ficha->qui_serie5 != "" && $ficha->qui_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie5.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe5 != "" && $ficha->qui_serie5 != "" && $ficha->qui_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep5.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe5 != "" && $ficha->qui_serie5 != "" && $ficha->qui_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs5.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe6 != "" && $ficha->qui_serie6 != "" && $ficha->qui_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe6.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe6 != "" && $ficha->qui_serie6 != "" && $ficha->qui_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie6.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe6 != "" && $ficha->qui_serie6 != "" && $ficha->qui_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep6.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe6 != "" && $ficha->qui_serie6 != "" && $ficha->qui_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs6.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe7 != "" && $ficha->qui_serie7 != "" && $ficha->qui_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe7.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe7 != "" && $ficha->qui_serie7 != "" && $ficha->qui_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie7.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe7 != "" && $ficha->qui_serie7 != "" && $ficha->qui_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep7.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe7 != "" && $ficha->qui_serie7 != "" && $ficha->qui_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs7.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe8 != "" && $ficha->qui_serie8 != "" && $ficha->qui_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe8.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe8 != "" && $ficha->qui_serie8 != "" && $ficha->qui_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie8.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe8 != "" && $ficha->qui_serie8 != "" && $ficha->qui_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep8.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe8 != "" && $ficha->qui_serie8 != "" && $ficha->qui_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs8.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe9 != "" && $ficha->qui_serie9 != "" && $ficha->qui_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe9.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe9 != "" && $ficha->qui_serie9 != "" && $ficha->qui_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie9.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe9 != "" && $ficha->qui_serie9 != "" && $ficha->qui_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep9.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe9 != "" && $ficha->qui_serie9 != "" && $ficha->qui_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs9.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->qui_exe10 != "" && $ficha->qui_serie10 != "" && $ficha->qui_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_exe10.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe10 != "" && $ficha->qui_serie10 != "" && $ficha->qui_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_serie10.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe10 != "" && $ficha->qui_serie10 != "" && $ficha->qui_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_rep10.'</td>';}else{echo "";}?>
						<?php if($ficha->qui_exe10 != "" && $ficha->qui_serie10 != "" && $ficha->qui_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->qui_obs10.'</td>';}else{echo "";}?>
					</tr>
	</tbody>  
</table>
</div>

<div style="float: left;width: 50%">
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th colspan = "4" style="background-color: #f5f5f5;padding-bottom:1;padding-top:1;"><center><h5>SEXTA-FEIRA</h5></center></th>
    	</tr>
        <tr style="background-color: #f5f5f5">
            <th style="text-align: left;width:20%;padding-bottom:1;padding-top:1;">exercício</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">sér.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">rep.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">obs.</th>
        </tr>
    </thead>
    <tbody>
		<tr>
						<?php if($ficha->sex_exe1 != "" && $ficha->sex_serie1 != "" && $ficha->sex_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe1.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe1 != "" && $ficha->sex_serie1 != "" && $ficha->sex_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie1.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe1 != "" && $ficha->sex_serie1 != "" && $ficha->sex_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep1.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe1 != "" && $ficha->sex_serie1 != "" && $ficha->sex_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs1.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe2 != "" && $ficha->sex_serie2 != "" && $ficha->sex_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe2.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe2 != "" && $ficha->sex_serie2 != "" && $ficha->sex_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie2.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe2 != "" && $ficha->sex_serie2 != "" && $ficha->sex_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep2.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe2 != "" && $ficha->sex_serie2 != "" && $ficha->sex_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs2.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe3 != "" && $ficha->sex_serie3 != "" && $ficha->sex_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe3.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe3 != "" && $ficha->sex_serie3 != "" && $ficha->sex_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie3.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe3 != "" && $ficha->sex_serie3 != "" && $ficha->sex_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep3.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe3 != "" && $ficha->sex_serie3 != "" && $ficha->sex_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs3.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe4 != "" && $ficha->sex_serie4 != "" && $ficha->sex_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe4.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe4 != "" && $ficha->sex_serie4 != "" && $ficha->sex_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie4.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe4 != "" && $ficha->sex_serie4 != "" && $ficha->sex_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep4.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe4 != "" && $ficha->sex_serie4 != "" && $ficha->sex_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs4.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe5 != "" && $ficha->sex_serie5 != "" && $ficha->sex_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe5.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe5 != "" && $ficha->sex_serie5 != "" && $ficha->sex_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie5.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe5 != "" && $ficha->sex_serie5 != "" && $ficha->sex_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep5.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe5 != "" && $ficha->sex_serie5 != "" && $ficha->sex_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs5.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe6 != "" && $ficha->sex_serie6 != "" && $ficha->sex_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe6.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe6 != "" && $ficha->sex_serie6 != "" && $ficha->sex_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie6.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe6 != "" && $ficha->sex_serie6 != "" && $ficha->sex_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep6.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe6 != "" && $ficha->sex_serie6 != "" && $ficha->sex_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs6.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe7 != "" && $ficha->sex_serie7 != "" && $ficha->sex_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe7.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe7 != "" && $ficha->sex_serie7 != "" && $ficha->sex_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie7.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe7 != "" && $ficha->sex_serie7 != "" && $ficha->sex_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep7.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe7 != "" && $ficha->sex_serie7 != "" && $ficha->sex_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs7.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe8 != "" && $ficha->sex_serie8 != "" && $ficha->sex_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe8.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe8 != "" && $ficha->sex_serie8 != "" && $ficha->sex_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie8.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe8 != "" && $ficha->sex_serie8 != "" && $ficha->sex_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep8.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe8 != "" && $ficha->sex_serie8 != "" && $ficha->sex_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs8.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe9 != "" && $ficha->sex_serie9 != "" && $ficha->sex_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe9.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe9 != "" && $ficha->sex_serie9 != "" && $ficha->sex_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie9.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe9 != "" && $ficha->sex_serie9 != "" && $ficha->sex_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep9.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe9 != "" && $ficha->sex_serie9 != "" && $ficha->sex_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs9.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sex_exe10 != "" && $ficha->sex_serie10 != "" && $ficha->sex_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_exe10.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe10 != "" && $ficha->sex_serie10 != "" && $ficha->sex_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_serie10.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe10 != "" && $ficha->sex_serie10 != "" && $ficha->sex_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_rep10.'</td>';}else{echo "";}?>
						<?php if($ficha->sex_exe10 != "" && $ficha->sex_serie10 != "" && $ficha->sex_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sex_obs10.'</td>';}else{echo "";}?>
					</tr>
	</tbody>  
</table>
</div>

<div style="float: left;margin-left: 10px;width: 50%">
<table class="table table-bordered">
    <thead>
    	<tr>
    		<th colspan = "4" style="background-color: #f5f5f5;padding-bottom:1;padding-top:1;"><center><h5>SÁBADO</h5></center></th>
    	</tr>
        <tr style="background-color: #f5f5f5">
            <th style="text-align: left;width:20%;padding-bottom:1;padding-top:1;">exercício</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">sér.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">rep.</th>
            <th style="width:5%;padding-bottom:1;padding-top:1;">obs.</th>
        </tr>
    </thead>
    <tbody>
		<tr>
						<?php if($ficha->sab_exe1 != "" && $ficha->sab_serie1 != "" && $ficha->sab_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe1.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe1 != "" && $ficha->sab_serie1 != "" && $ficha->sab_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie1.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe1 != "" && $ficha->sab_serie1 != "" && $ficha->sab_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep1.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe1 != "" && $ficha->sab_serie1 != "" && $ficha->sab_rep1 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs1.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe2 != "" && $ficha->sab_serie2 != "" && $ficha->sab_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe2.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe2 != "" && $ficha->sab_serie2 != "" && $ficha->sab_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie2.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe2 != "" && $ficha->sab_serie2 != "" && $ficha->sab_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep2.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe2 != "" && $ficha->sab_serie2 != "" && $ficha->sab_rep2 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs2.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe3 != "" && $ficha->sab_serie3 != "" && $ficha->sab_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe3.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe3 != "" && $ficha->sab_serie3 != "" && $ficha->sab_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie3.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe3 != "" && $ficha->sab_serie3 != "" && $ficha->sab_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep3.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe3 != "" && $ficha->sab_serie3 != "" && $ficha->sab_rep3 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs3.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe4 != "" && $ficha->sab_serie4 != "" && $ficha->sab_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe4.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe4 != "" && $ficha->sab_serie4 != "" && $ficha->sab_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie4.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe4 != "" && $ficha->sab_serie4 != "" && $ficha->sab_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep4.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe4 != "" && $ficha->sab_serie4 != "" && $ficha->sab_rep4 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs4.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe5 != "" && $ficha->sab_serie5 != "" && $ficha->sab_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe5.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe5 != "" && $ficha->sab_serie5 != "" && $ficha->sab_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie5.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe5 != "" && $ficha->sab_serie5 != "" && $ficha->sab_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep5.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe5 != "" && $ficha->sab_serie5 != "" && $ficha->sab_rep5 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs5.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe6 != "" && $ficha->sab_serie6 != "" && $ficha->sab_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe6.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe6 != "" && $ficha->sab_serie6 != "" && $ficha->sab_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie6.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe6 != "" && $ficha->sab_serie6 != "" && $ficha->sab_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep6.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe6 != "" && $ficha->sab_serie6 != "" && $ficha->sab_rep6 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs6.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe7 != "" && $ficha->sab_serie7 != "" && $ficha->sab_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe7.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe7 != "" && $ficha->sab_serie7 != "" && $ficha->sab_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie7.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe7 != "" && $ficha->sab_serie7 != "" && $ficha->sab_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep7.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe7 != "" && $ficha->sab_serie7 != "" && $ficha->sab_rep7 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs7.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe8 != "" && $ficha->sab_serie8 != "" && $ficha->sab_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe8.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe8 != "" && $ficha->sab_serie8 != "" && $ficha->sab_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie8.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe8 != "" && $ficha->sab_serie8 != "" && $ficha->sab_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep8.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe8 != "" && $ficha->sab_serie8 != "" && $ficha->sab_rep8 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs8.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe9 != "" && $ficha->sab_serie9 != "" && $ficha->sab_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe9.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe9 != "" && $ficha->sab_serie9 != "" && $ficha->sab_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie9.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe9 != "" && $ficha->sab_serie9 != "" && $ficha->sab_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep9.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe9 != "" && $ficha->sab_serie9 != "" && $ficha->sab_rep9 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs9.'</td>';}else{echo "";}?>
					</tr>

		<tr>
						<?php if($ficha->sab_exe10 != "" && $ficha->sab_serie10 != "" && $ficha->sab_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_exe10.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe10 != "" && $ficha->sab_serie10 != "" && $ficha->sab_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_serie10.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe10 != "" && $ficha->sab_serie10 != "" && $ficha->sab_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_rep10.'</td>';}else{echo "";}?>
						<?php if($ficha->sab_exe10 != "" && $ficha->sab_serie10 != "" && $ficha->sab_rep10 != ""){echo '<td  style="padding-bottom:1;padding-top:1;">'.$ficha->sab_obs10.'</td>';}else{echo "";}?>
					</tr>
	</tbody>  
</table>
</div>
</body>
</html>












