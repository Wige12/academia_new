<html>
  <head>
    <title>Relatório de Mensalidades</title>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/bootstrap-responsive.min.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/fullcalendar.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>css/blue.css" class="skin-color" />
    <script type="text/javascript"  src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

  <body style="background-color: transparent">

  <?php
			$seleciona = mysql_query("SELECT anoselecionado_rel_men FROM anoselecionado LIMIT 1");
			while($ln = mysql_fetch_array($seleciona)){
			$anoselecionado_rel_men = $ln['anoselecionado_rel_men'];
} ?>

      <div class="container-fluid">

          <div class="row-fluid">
              <div class="span12">

                  <div class="widget-box">
                      <div class="widget-title">
                          <h4 style="text-align: center">Mensalidades do ano <?php echo $anoselecionado_rel_men; ?></h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="font-size: 1.2em; padding: 5px;">Aluno</th>
                              <th style="font-size: 1.2em; padding: 5px;">Serviço</th>
                              <th style="font-size: 1.2em; padding: 5px;">Preço</th>
                              <th style="font-size: 1.2em; padding: 5px;">Jan</th>
                              <th style="font-size: 1.2em; padding: 5px;">Fev</th>
                              <th style="font-size: 1.2em; padding: 5px;">Mar</th>
                              <th style="font-size: 1.2em; padding: 5px;">Abr</th>
                              <th style="font-size: 1.2em; padding: 5px;">Mai</th>
                              <th style="font-size: 1.2em; padding: 5px;">Jun</th>
                              <th style="font-size: 1.2em; padding: 5px;">Jul</th>
                              <th style="font-size: 1.2em; padding: 5px;">Ago</th>
                              <th style="font-size: 1.2em; padding: 5px;">Set</th>
                              <th style="font-size: 1.2em; padding: 5px;">Out</th>
                              <th style="font-size: 1.2em; padding: 5px;">Nov</th>
                              <th style="font-size: 1.2em; padding: 5px;">Dez</th>
						</tr>
                      </thead>
                      <tbody>				
	    <?php
	    	$seleciona = mysql_query("SELECT * FROM mensalidades WHERE ano = ".$anoselecionado_rel_men." ORDER by id DESC");
			while($ln = mysql_fetch_array($seleciona)){
			$clientes_id = $ln['clientes_id'];
			$servico_id = $ln['servico_id'];
			$jan = $ln['jan'];
			$fev = $ln['fev'];
			$mar = $ln['mar'];
			$abr = $ln['abr'];
			$mai = $ln['mai'];
			$jun = $ln['jun'];
			$jul = $ln['jul'];
			$ago = $ln['ago'];
			$set = $ln['setembro'];
			$out = $ln['outubro'];
			$nov = $ln['nov'];
			$dez = $ln['dez'];
			
			if($jan == 0){$input_jan = "<center>NP</center>";}
			if($jan == 1){$input_jan = "<center>PG</center>";}
			if($jan == 2){$input_jan = "<center>AT</center>";}
			if($jan == 3){$input_jan = "<center>#</center>";}

			if($fev == 0){$input_fev = "<center>NP</center>";}
			if($fev == 1){$input_fev = "<center>PG</center>";}
			if($fev == 2){$input_fev = "<center>AT</center>";}
			if($fev == 3){$input_fev = "<center>#</center>";}

			if($mar == 0){$input_mar = "<center>NP</center>";}
			if($mar == 1){$input_mar = "<center>PG</center>";}
			if($mar == 2){$input_mar = "<center>AT</center>";}
			if($mar == 3){$input_mar = "<center>#</center>";}

			if($abr == 0){$input_abr = "<center>NP</center>";}
			if($abr == 1){$input_abr = "<center>PG</center>";}
			if($abr == 2){$input_abr = "<center>AT</center>";}
			if($abr == 3){$input_abr = "<center>#</center>";}

			if($mai == 0){$input_mai = "<center>NP</center>";}
			if($mai == 1){$input_mai = "<center>PG</center>";}
			if($mai == 2){$input_mai = "<center>AT</center>";}
			if($mai == 3){$input_mai = "<center>#</center>";}

			if($jun == 0){$input_jun = "<center>NP</center>";}
			if($jun == 1){$input_jun = "<center>PG</center>";}
			if($jun == 2){$input_jun = "<center>AT</center>";}
			if($jun == 3){$input_jun = "<center>#</center>";}

			if($jul == 0){$input_jul = "<center>NP</center>";}
			if($jul == 1){$input_jul = "<center>PG</center>";}
			if($jul == 2){$input_jul = "<center>AT</center>";}
			if($jul == 3){$input_jul = "<center>#</center>";}

			if($ago == 0){$input_ago = "<center>NP</center>";}
			if($ago == 1){$input_ago = "<center>PG</center>";}
			if($ago == 2){$input_ago = "<center>AT</center>";}
			if($ago == 3){$input_ago = "<center>#</center>";}

			if($set == 0){$input_set = "<center>NP</center>";}
			if($set == 1){$input_set = "<center>PG</center>";}
			if($set == 2){$input_set = "<center>AT</center>";}
			if($set == 3){$input_set = "<center>#</center>";}

			if($out == 0){$input_out = "<center>NP</center>";}
			if($out == 1){$input_out = "<center>PG</center>";}
			if($out == 2){$input_out = "<center>AT</center>";}
			if($out == 3){$input_out = "<center>#</center>";}

			if($nov == 0){$input_nov = "<center>NP</center>";}
			if($nov == 1){$input_nov = "<center>PG</center>";}
			if($nov == 2){$input_nov = "<center>AT</center>";}
			if($nov == 3){$input_nov = "<center>#</center>";}

			if($dez == 0){$input_dez = "<center>NP</center>";}
			if($dez == 1){$input_dez = "<center>PG</center>";}
			if($dez == 2){$input_dez = "<center>AT</center>";}
			if($dez == 3){$input_dez = "<center>#</center>";}
?>
        <tr>
        <?php
			$selecionar_cliente_innerjoin = mysql_query("SELECT nomeCliente FROM clientes INNER JOIN mensalidades ON idClientes = $clientes_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_cliente_innerjoin)){
				$nomeCliente = $ln['nomeCliente'];
		?>
			<td><?php echo $nomeCliente; ?></td>
		<?php }?>
            
		<?php
			$selecionar_servico_innerjoin = mysql_query("SELECT * FROM servicos INNER JOIN mensalidades ON idServicos = $servico_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_servico_innerjoin)){
				$nome = $ln['nome'];
				$preco = $ln['preco'];
		?>
			<td><?php echo $nome; ?></td>
			<td><?php echo $preco; ?></td>
		<?php }?>
            <td>
           			<?php echo $input_jan; ?>
            </td>
           
            <td>
           			<?php echo $input_fev; ?>
            </td>

            <td>
           			<?php echo $input_mar; ?>
            </td>

            <td>
           			<?php echo $input_abr; ?>
            </td>

            <td>
           			<?php echo $input_mai; ?>
            </td>

            <td>
           			<?php echo $input_jun; ?>
            </td>

            <td>
           			<?php echo $input_jul; ?>
            </td>

            <td>
           			<?php echo $input_ago; ?>
            </td>

            <td>
           			<?php echo $input_set; ?>
            </td>

            <td>
           			<?php echo $input_out; ?>
            </td>

            <td>
           			<?php echo $input_nov; ?>
            </td>

            <td>
           			<?php echo $input_dez; ?>
            </td>

        </tr>

		<?php } ?>
                      </tbody>
                  </table>

                  </div>

              </div>
                  <p style="text-align: left"><b>PG</b> = Pago</p>
                  <p style="text-align: left"><b>NP</b> = Não Pago</p>
                  <p style="text-align: left"><b>AT</b> = Mens. Atrasada</p>
                  <p style="text-align: left"><b>#</b> = Aluno não era matriculado</p>
                  
                  
                  <h5 style="text-align: right">Relatório gerado em: <?php echo date('d/m/Y');?></h5>

          </div>
      </div>
</div>
            <!-- Arquivos js-->

            <script src="<?php echo base_url();?>js/excanvas.min.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.flot.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.flot.resize.min.js"></script>
            <script src="<?php echo base_url();?>js/jquery.peity.min.js"></script>
            <script src="<?php echo base_url();?>js/fullcalendar.min.js"></script>
            <script src="<?php echo base_url();?>js/sosmc.js"></script>
            <script src="<?php echo base_url();?>js/dashboard.js"></script>
  </body>
</html>







