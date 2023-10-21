<!DOCTYPE html>
<html>
<head>
    <title>Carn&ecirc;</title>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/blue.css" class="skin-color" />
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css"/>
    <script type="text/javascript"  src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body style="background-color: transparent;">
<?php
			$id = $_GET['id'];
		
			$seleciona = mysql_query("SELECT * FROM mensalidades WHERE id = ".$id."");
			while($ln = mysql_fetch_array($seleciona)){
				$clientes_id = $ln['clientes_id'];
				$servico_id = $ln['servico_id'];

$x = 1; 

while($x <= 12) {
?>
	<div class="span12" style="border: 1px solid #000;margin-bottom:4px;height: 20%;max-height: 20%;">
		<div class="span4" style="float: left;width: 50%;border-right: 1px dashed #000;">
			<div style="width: 90%;margin: 0 auto;">
			<div style="width: 100%;height:auto;margin-bottom: 10px;">
				<div style="width: 37%;height: 60px;float: left;margin-top: 10px;border-right: 1px solid #000;"><h4>Controle de<br/>Pagamento</h4></div>
				<?php
					$seleciona_logo = mysql_query("SELECT url_logo FROM emitente");
					while($ln = mysql_fetch_array($seleciona_logo)){
						$url_logo = $ln['url_logo'];
				?>
				<div style="width: 19%;height:60px;margin-right: 20px;float: left;margin-top: 10px;margin-left: 5px"><img src="<?php echo $url_logo;?>" width="100%;"></div>

				<div style="width:auto;height: 60px;float: left;margin-top: 10px;padding-left: 10px;">
				<?php } ?>
				<?php
					$id = $_GET['id'];
				
					$seleciona = mysql_query("SELECT * FROM emitente LIMIT 1");
					while($ln = mysql_fetch_array($seleciona)){
						$nome = $ln['nome'];
						$telefone = $ln['telefone'];
				?>
				<small><?php echo $nome;?></small><br/>
				<small><b>Fone:</b> <?php echo $telefone;?></small>
				<?php }?>	
				</div>
			</div>
<?php
			$selecionar_cliente_innerjoin = mysql_query("SELECT nomeCliente FROM clientes INNER JOIN mensalidades ON idClientes = $clientes_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_cliente_innerjoin)){
				$nomeCliente = $ln['nomeCliente'];
?>

				<label><?php echo $nomeCliente ;?></label>
<?php } ?>
				<br />
<?php
			$selecionar_servico_innerjoin = mysql_query("SELECT * FROM servicos INNER JOIN mensalidades ON idServicos = $servico_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_servico_innerjoin)){
				$nome = $ln['nome'];
				$preco = $ln['preco'];
?>


				<label><b>Servi&ccedil;o</b>: <?php echo $nome;?></label>
				<br />
				<label><b>Valor</b>: R$ <?php echo $preco;?></label>
<?php } ?>
				<br />
				<label><b>Data do Pagamento</b>: _____/_____/_____</label>
				<br /><br />
				<div style="width: 100%"><p align="center">__________________________________<br />Assinatura</p></div>	
			</div>
		</div>
		<div class="span4" style="float: left;width: 49%;">
			<div style="width: 90%;margin: 0 auto;">
			<div style="width: 100%;height:auto;margin-bottom: 10px;">
				<div style="width: 37%;height: 60px;float: left;margin-top: 10px;border-right: 1px solid #000;"><h4>Controle de<br/>Pagamento</h4></div>
				<?php
					$seleciona_logo = mysql_query("SELECT url_logo FROM emitente");
					while($ln = mysql_fetch_array($seleciona_logo)){
						$url_logo = $ln['url_logo'];
				?>
				<div style="width: 19%;height:60px;margin-right: 20px;float: left;margin-top: 10px;margin-left: 5px"><img src="<?php echo $url_logo;?>" width="100%;"></div>

				<div style="width:auto;height: 60px;float: left;margin-top: 10px;padding-left: 10px;">
				<?php } ?>
				<?php
						$id = $_GET['id'];
					
						$seleciona = mysql_query("SELECT * FROM emitente LIMIT 1");
						while($ln = mysql_fetch_array($seleciona)){
							$nome = $ln['nome'];
							$telefone = $ln['telefone'];
				?>
				<small><?php echo $nome;?></small><br/>
				<small><b>Fone:</b> <?php echo $telefone;?></small>
				<?php }?>	
				</div>
			</div>
<?php
			$selecionar_cliente_innerjoin = mysql_query("SELECT nomeCliente FROM clientes INNER JOIN mensalidades ON idClientes = $clientes_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_cliente_innerjoin)){
				$nomeCliente = $ln['nomeCliente'];
?>
				<label><b>Nome</b>: <?php echo $nomeCliente ;?></label>
<?php } ?>
				<br />
<?php
			$selecionar_servico_innerjoin = mysql_query("SELECT * FROM servicos INNER JOIN mensalidades ON idServicos = $servico_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_servico_innerjoin)){
				$nome = $ln['nome'];
				$preco = $ln['preco'];
?>


				<label><b>Servi&ccedil;o</b>: <?php echo $nome;?></label>
				<br />
				<label><b>Valor</b>: R$ <?php echo $preco;?></label>
<?php } ?>

				<br />
				<label><b>Data do Pagamento</b>: _____/_____/_____</label>
				<br /><br />
				<div style="width: 100%"><p align="center">__________________________________<br />Assinatura</p></div>	
			</div>
		</div>
	</div>
	
	
<?php
   $x++;
} 

}; ?>
	</body>
</html>












