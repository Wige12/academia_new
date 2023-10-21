  <head>
    <title>Etiquetas</title>
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



      <div class="container-fluid">
          <div class="row-fluid">
              <div class="span12">
                  <div class="widget-box">
					<div class="widget-content nopadding">
						<?php 
							function limitarTexto($texto, $limite){
							  $contador = strlen($texto);
							  if ( $contador >= $limite ) {      
							      $texto = substr($texto, 0, strrpos(substr($texto, 0, $limite), ' ')) . '...';
							      return $texto;
							  }
							  else{
							    return $texto;
							  }
							} 

							require_once('assets/barcode/barcode.php');
							foreach ($produtos as $p) {
						?>
					<div style="width:200px;height:auto;border:1px dashed #777;margin:2px 0 0 2px;float:left;padding:5px;">
						<div style="width:100%;height:20px;">
						<?php $string = $p->descricao;?>
							<div style="width:100%;height:20px;"><?php print(limitarTexto($string, $limite = 26));?></div>
						</div>
						<div style="width:100%;height:20px;">Cod: <b><?php echo $p->codigo_barras;?></b><br />
						Preço: R$ <b><?php $precoVenda = str_replace(".",",", $p->precoVenda); echo $precoVenda;?></b></div>
						<?php
							$idProduto = $p->codigo_barras;
							new barCodeGenrator($idProduto,2,'assets/barcode/'.$idProduto.'.gif', 170,42, false);
							echo "<img src='assets/barcode/".$idProduto.".gif' width='200px' />";
						?>
					</div>					
						<?php }?>
                 	</div>
              	</div>
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

