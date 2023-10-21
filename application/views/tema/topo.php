<?php
if (isset($_POST['abrirCaixa'])) {
	// Recupera os dados dos campos
	
	$data = $_POST['data'];
    try {
          $data = explode('/', $data);
          $data = $data[2].'-'.$data[1].'-'.$data[0];

         } catch (Exception $e) {
          $data = date('Y/m/d'); 
    	}

	$usuario = $_POST['usuario'];
	$hora = $_POST['hora'];
	$saldoinicial = $_POST['saldoinicial'];

		$sql = mysql_query("INSERT INTO caixa VALUES ('', '".$usuario."', '".$data."', '".$hora."', '".$saldoinicial."', '', '', '', '', '', '')");
		$sql2 = mysql_query("UPDATE status_caixa SET status = '1'");
		if ($sql && $sql2){redirect('');
		}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title><?php
	$emitente = mysql_query("SELECT nome FROM emitente ORDER BY id ASC LIMIT 1");
	while($ln = mysql_fetch_array($emitente)){
	echo $ln['nome'];
}?>
</title>
<link href="<?php echo base_url();?>assets/img/favicon.png" rel="shortcut icon" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-style.css" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/matrix-media.css" />
<link href="<?php echo base_url();?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/fullcalendar.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript"  src="<?php echo base_url();?>assets/js/shortcut.js"></script>
<script type="text/javascript">
shortcut.add("escape", function() {location.href='<?php echo base_url();?>';});
shortcut.add("F1", function() {location.href='<?php echo base_url();?>index.php/mensalidades';});
shortcut.add("F2", function() {});
shortcut.add("F3", function() {});
shortcut.add("F4", function() {});
shortcut.add("F5", function() {location.href='<?php echo base_url();?>index.php/vendas';});
shortcut.add("F6", function() {});
shortcut.add("F7", function() {});
shortcut.add("F8", function() {});
shortcut.add("F9", function() {location.href='<?php echo base_url();?>index.php/financeiro/lancamentos';});
shortcut.add("F10", function() {});
shortcut.add("F11", function() {});
shortcut.add("F12", function() {});
</script>
<script type="text/javascript">
function showTimer() {
	var time=new Date();
	var hour=time.getHours();
	var minute=time.getMinutes();
	var second=time.getSeconds();
	
	if(hour<10) hour ="0"+hour;
	if(minute<10) minute="0"+minute;
	if(second<10) second="0"+second;
	
	var st=hour+":"+minute+":"+second; document.getElementById("timer").innerHTML=st; }
	
	function initTimer() {

	// O metodo nativo setInterval executa uma determinada funcao em um determinado tempo
	setInterval(showTimer,1000); }
</script>
</head>
<body onLoad="initTimer();">
<!--Header-part-->
<div id="header">
  <h1><a href="">Sistema Caixa</a></h1>
</div>
<!--close-Header-part--> 

<!--top-Header-menu-->
<div id="user-nav" class="navbar navbar-inverse">
  <ul class="nav">
	<li style="margin-right: 100px;margin-top: 10px;"><span class="text" style="font-size:13px;color: #fff;"><i class="icon-calendar"></i>

<?php
setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
date_default_timezone_set('America/Sao_Paulo');

$uppercaseMonth = ucfirst(gmstrftime('%B'));
echo utf8_encode(strftime( '%A, %d de ' .$uppercaseMonth. ' de %Y', strtotime('today')));
?>

<i class="icon-time"></i> <span id="timer"></span></span></li>
    <li class=""><a href="#modalSuporte" title="Ajuda e Suporte" data-toggle="modal"> <span class="text"><i class="icon-phone icon-white"></i> Suporte</span></a></li>
    <li class="">
    	<a title="Minha Conta" href="<?php echo base_url();?>index.php/mapos/minhaConta">
			<span class="text">
				<i class="icon-user icon-white"></i> 
			    <?php
				$user_logado = mysql_query("SELECT * FROM (`usuarios`) WHERE `idUsuarios` = '".$this->session->userdata('id')."' LIMIT 1");
				while($ln = mysql_fetch_array($user_logado)){
				$nome = $ln['nome'];
				echo $nome;
				};
			?>
			</span>
		</a>
	</li>
    <li class=""><a title="" href="<?php echo base_url();?>index.php/mapos/sair"> <span class="text">Sair</span></a></li>
  </ul>
</div>

<!-- Modal Suporte -->
<div id="modalSuporte" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="width:450px;margin-left:-225px;">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Contate o Desenvolvedor</h3>
  </div>
  <div class="modal-body">
  		<div class="alert alert-info" style="margin-left: 0"> De <b>Segunda</b> à <b>Sexta</b> - <b>09:00</b> às <b>18:00</b></div>
    		<h4><strong>Dhuan Sistemas Comerciais</strong></h4>
    		<p><i class="icon-phone"></i> (62) 9933-16875 <small>(WhatsApp)</small></p>
    		<p><i class="icon-envelope"></i> dhuanklesgy@gmail.com</p>
    		<p><i class="icon-map-marker"></i> Goiania - GO</p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
  </div>
</div>

<?php
	$caixa = mysql_query("SELECT * FROM caixa ORDER BY id DESC LIMIT 1");
	while($ln = mysql_fetch_array($caixa)){
	$id_caixa = $ln['id'];
	
	$status_caixa = mysql_query("SELECT * FROM status_caixa");
	while($ln = mysql_fetch_array($status_caixa)){
	$status = $ln['status'];
?>
<!--start-top-serch-->
<?php if($status == 1){?>
<div id="search">
  <form action="<?php echo base_url()?>index.php/mapos/pesquisar">
    <input type="text" name="termo" placeholder="Pesquisar..."/>
    <button type="submit"  class="tip-bottom" title="Pesquisar"><i class="icon-search icon-white"></i></button>
    
  </form>
</div>
<?php }?>
<!--close-top-serch--> 

<!--sidebar-menu-->

<div id="sidebar"> <a href="#" class="visible-phone"><i class="icon icon-list"></i> Menu</a>
  <ul>
    <li class="<?php if(isset($menuPainel)){echo 'active';};?>"><a href="<?php echo base_url()?>"><i class="icon icon-home"></i> <span>Resumo</span></a></li>

<?php if($status == 1){?>
    <li class="<?php if(isset($menuClientes)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/clientes"><i class="icon icon-group"></i> <span>Alunos</span></a></li>
    <li class="<?php if(isset($menuMensalidades)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/mensalidades"><i class="icon icon-calendar"></i> <span>Mensalidades</span></a></li>
    <li class="<?php if(isset($menuAcompanhamento)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/acompanhamento"><i class="icon icon-check"></i> <span>Acompanhamento</span></a></li>
    <li class="<?php if(isset($menuProdutos)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/produtos"><i class="icon icon-barcode"></i> <span>Produtos</span></a></li>
    <li class="<?php if(isset($menuVendas)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/vendas"><i class="icon icon-shopping-cart"></i> <span>Vendas</span></a></li>
    
    <li class="<?php if(isset($menuFinanceiro)){echo 'active';};?>"><a href="<?php echo base_url()?>index.php/financeiro/lancamentos"><i class="icon icon-money"></i> <span>Financeiro</span></a></li>

    <?php if($this->session->userdata('nivel') == 1){?>
    <li class="submenu <?php if(isset($menuRelatorios)){echo 'active open';};?>" >
      <a href="#"><i class="icon icon-list-alt"></i> <span>Relatórios</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
      <ul>
        <li><a href="<?php echo base_url()?>index.php/relatorios/caixa">Caixa</a></li>
        <li><a href="<?php echo base_url()?>index.php/relatorios/clientes">Alunos / Matrículas</a></li>
        <li><a href="<?php echo base_url()?>index.php/relatorios/mensalidades">Mensalidades</a></li>    
        <li><a href="<?php echo base_url()?>index.php/relatorios/servicos">Serviços</a></li>
        <li><a href="<?php echo base_url()?>index.php/relatorios/vendas">Vendas</a></li>
        <li><a href="<?php echo base_url()?>index.php/relatorios/financeiro">Financeiro</a></li>

        <li><a href="<?php echo base_url()?>index.php/relatorios/produtos">Produtos</a></li>
        <li><a href="<?php echo base_url()?>index.php/relatorios/orcamentos">Orçamentos</a></li>
      </ul>
    </li>
    <li class="submenu <?php if(isset($menuConfiguracoes)){echo 'active open';};?>">
      <a href="#"><i class="icon icon-cog"></i> <span>Configurações</span> <span class="label"><i class="icon-chevron-down"></i></span></a>
      <ul>
        <li><a href="<?php echo base_url()?>index.php/mapos/emitente">Personalizar</a></li>
        <li><a href="<?php echo base_url()?>index.php/mapos/emitente">Emitente</a></li>
        <li><a href="<?php echo base_url()?>index.php/usuarios">Funcionários</a></li>
        <li><a href="<?php echo base_url()?>index.php/mapos/backup">Backup</a></li>
      </ul>
    </li>
    <?php }}?>
  </ul>
</div>
<div id="content">
  <div id="content-header">
    <div id="breadcrumb">
    <a href="<?php echo base_url()?>" title="Resumo" class="tip-bottom"><i class="icon-home"></i> Resumo</a>
    	<?php if($this->uri->segment(1) != null){?>
    		<a class="tip-bottom" title="<?php if (ucfirst($this->uri->segment(1)) == "Mapos"){echo "Painel";}elseif (ucfirst($this->uri->segment(1)) == "Os"){echo "Orçamento";}elseif (ucfirst($this->uri->segment(1)) == "Clientes"){echo "Alunos";}else{echo ucfirst($this->uri->segment(1));}?>"><?php if (ucfirst($this->uri->segment(1)) == "Mapos"){echo "Painel";}elseif (ucfirst($this->uri->segment(1)) == "Os"){echo "Orçamento";}elseif (ucfirst($this->uri->segment(1)) == "Clientes"){echo "Alunos";}elseif (ucfirst($this->uri->segment(1)) == "Usuarios"){echo "Funcionários";}else{echo ucfirst($this->uri->segment(1));}?>
    		</a> 
    	<?php if($this->uri->segment(2) != null){?><a class="current tip-bottom" title="<?php if(ucfirst($this->uri->segment(2)) == 'Os'){echo 'Orçamento';}elseif(ucfirst($this->uri->segment(2)) == 'Clientes'){echo 'Alunos';}else{echo ucfirst($this->uri->segment(2));} ?>"><?php if(ucfirst($this->uri->segment(2)) == 'Os'){echo 'Orçamento';}elseif(ucfirst($this->uri->segment(2)) == 'Clientes'){echo 'Alunos';}else{echo ucfirst($this->uri->segment(2));}} ?></a> <?php }?>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row-fluid">
      <div class="span12">
      
<?php if($status == 1){?>

          <?php if($this->session->flashdata('error') != null){?>
                            <div class="alert alert-danger">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('error');?>
                           </div>
                      <?php }?>

                      <?php if($this->session->flashdata('success') != null){?>
                            <div class="alert alert-success">
                              <button type="button" class="close" data-dismiss="alert">&times;</button>
                              <?php echo $this->session->flashdata('success');?>
                           </div>
                      <?php }?>
                          
                      <?php if(isset($view)){echo $this->load->view($view);}?>

<?php }
else{?>
<script type='text/javascript'>
		$(document).ready(function(){
			$('#AbrirCaixa').click();
	});
</script>
	
 <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Caixa fechado</h5></div>
            <div class="widget-content" style="min-height: 150px;">
            <br />
            <br />
            <br />
            <center>Para utilizar o sistema, é necessário que o caixa esteja aberto&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="#modalAbrirCaixa" id="AbrirCaixa" data-toggle="modal" role="button" class="btn btn-success tip-bottom" title="Abrir Caixa"><i class="icon-plus icon-white"></i> Abrir Caixa</a></center>
            
            </div>
</div>

<!-- Modal Abrir Caixa -->
<div id="modalAbrirCaixa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formAbrirCaixa" action="" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Abrir Caixa</h3>
  </div>
  <div class="modal-body">
  		
  		<div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento dos campos com asterisco.</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="caixanum"><?php $caixa_num = $id_caixa + 1; echo '<h4>Abertura de Caixa Nº #'.$caixa_num.'</h4>' ?></label>
    		<input type="hidden" name="caixanum" value="<?php $caixa_num = $id_caixa + 1; echo $caixa_num ?>" />
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="usuario">Usuário</label>
    		<input class="span12" type="text" name="usuario" value="<?php echo $usuario->nome?>" readonly/>
    	</div>
    	<div class="span4" style="margin-left: 0"> 
    		<label for="data">Data</label>
    		<input class="span12" type="text" name="data" value="<?php echo date('d/m/Y'); ?>" readonly/>
    	</div>
    	<div class="span4" style="margin-left:50px"> 
    		<label for="hora">Hora</label>
    		<input class="span12" type="text" name="hora" value="<?php echo date('h:i:s');?>" readonly/>
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span4" style="margin-left: 0"> 
    			<label for="saldoinicial">Saldo inicial (Troco)</label>
    			<input class="span12 money" id="saldoinicial" type="text" name="saldoinicial" autofocus/>
    		</div>
    	</div>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <input type="submit" class="btn btn-success" name="abrirCaixa" value="Abrir Caixa" />
  </div>
  </form>
</div>

 <script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script>
    $(document).ready(function(){
        $(".money").maskMoney();
    });
</script>
<?php }}} ?>
      </div>
    </div>
  </div>
</div>
<!--Footer-part-->
<div class="row-fluid">
  <div id="footer" class="span12" style="color:#757575;"> <span id="year"></span> &copy; Desenvolvido por <a href="https://www.linkedin.com/in/dhuanklescastro/?originalSubdomain=br" target="_blank" style="color: #aaa">Dhuan</a> | <img src="<?php echo base_url();?>assets/img/whatsapp.png" style="margin-top: -1px"> (62) 9933-16875 - dhuanklesgyn@gmail.com | Versão 1.4.1</div>
<script>
    var d = new Date();
    var n = d.getFullYear();
    document.getElementById("year").innerHTML = n;

</script>
</div>
<!--end-Footer-part-->


<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script> 
<script src="<?php echo base_url();?>assets/js/matrix.js"></script>

</body>
</html>