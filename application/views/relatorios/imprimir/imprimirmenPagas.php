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
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css"/>
    <script type="text/javascript"  src="<?php echo base_url();?>js/jquery-1.10.2.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body style="background-color: transparent">
<?php 
		$seleciona = mysql_query("SELECT anoselecionado_rel_men_pagas FROM anoselecionado LIMIT 1");
		while($ln = mysql_fetch_array($seleciona)){
		$anoselecionado_rel_men_pagas = $ln['anoselecionado_rel_men_pagas'];
		}
?>
      <div class="widget-title" style="border: 1px solid #ddd;">
        <h5>Mensalidades pagas no ano de <?php echo $anoselecionado_rel_men_pagas; ?></h5>

     </div>				
<?php
	$dataatual = date('d/m/y');
	$partes = explode("/", $dataatual);
	$diaatual = $partes[0];
	$mesatual = $partes[1];
	$anoatual = "20".$partes[2];

$corjan = "";
$corfev = "";
$cormar = "";
$corabr = "";
$cormai = "";
$corjun = "";
$corjul = "";
$corago = "";
$corset = "";
$corout = "";
$cornov = "";
$cordez = "";
	
if($mesatual == 1){$corjan = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 2){$corfev = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 3){$cormar = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 4){$corabr = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 5){$cormai = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 6){$corjun = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 7){$corjul = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 8){$corago = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 9){$corset = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 10){$corout = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 11){$cornov = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}
if($mesatual == 12){$cordez = "class='icon-calendar' style='float:right;font-size:25px;margin:5px 10px 0 0;'";}

			$seleciona = mysql_query("SELECT * FROM total_pago_mes WHERE ano = ".$anoselecionado_rel_men_pagas."");
			while($ln = mysql_fetch_array($seleciona)){
			$ano = $ln['ano'];
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
}; ?>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Janeiro</h5><i <?php echo $corjan;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $jan; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Fevereiro</h5><i <?php echo $corfev;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $fev; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title" ><h5>Março</h5><i <?php echo $cormar;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $mar; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Abril</h5><i <?php echo $corabr;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $abr; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Maio</h5><i <?php echo $cormai;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $mai; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Junho</h5><i <?php echo $corjun;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $jun; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Julho</h5><i <?php echo $corjul;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $jul; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Agosto</h5><i <?php echo $corago;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $ago; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Setembro</h5><i <?php echo $corset;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $set; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Outubro</h5><i <?php echo $corout;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $out; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Novembro</h5><i <?php echo $cornov;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $nov; ?></h3>
		</div>

		<div class="span3 box-mensalidades-recebidas" style="width: 30%;float: left;margin-left: 10px;">
			<div class="widget-title"><h5>Dezembro</h5><i <?php echo $cordez;?>></i></div>
			<br />
			<h3 align="center">R$ <?php echo $dez; ?></h3>
		</div>



<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
                  <h5 style="text-align: right">Relatório gerado em: <?php echo date('d/m/Y');?></h5>





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