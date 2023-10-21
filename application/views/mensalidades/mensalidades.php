<?php
$dataatual = date('d/m/y');
$partes = explode("/", $dataatual);
$anoatual = "20".$partes[2];

$selecionaano = mysql_query("SELECT anoselecionado FROM anoselecionado LIMIT 1");
while($ln = mysql_fetch_array($selecionaano)){
	$anoselecionado = $ln['anoselecionado'];


	$seleciona = mysql_query("SELECT * FROM mensalidades WHERE ano = ".$anoselecionado." ORDER by id DESC LIMIT 30");
	$conta = mysql_num_rows($seleciona);
	if($conta <= 0){
		echo "";
		$anoanterior = $anoselecionado -1;
		$sel_apenas_ano_anterior = mysql_query("SELECT ano FROM mensalidades WHERE ano = ".$anoanterior."");
		$conta_ano = mysql_num_rows($sel_apenas_ano_anterior);
		if($anoselecionado == $anoatual){
			if($conta_ano <= 0){
				echo"					
				<script type='text/javascript'>
				$(document).ready(function(){
					$('#modalimportar_vazio').click();
				});
				</script>
				";
			}else{echo"					
			<script type='text/javascript'>
			$(document).ready(function(){
				$('#modalimportar').click();
			});
			</script>
			";
		}
	}
}
}
?>

<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
<a href="#modalAddNovo" data-toggle="modal" class="btn btn-success"><i class="icon-plus icon-white"></i> Adicionar Novo</a>

<?php if($this->session->userdata('nivel') == 1){?>
<a href="<?php echo base_url()?>index.php/mensalidades/mensalidadesPagas" class="btn btn-link" style="left:30%;position: relative;"><i class="icon-money icon-white"></i> Mensalidades Pagas</a>
<?php }?>

<a href="<?php echo base_url();?>index.php/servicos" class="btn btn-success" style="float:right;"><i class="icon-plus icon-white"></i> Serviços</a>

<?php
if (isset($_POST['selecionarano'])) {
	// Recupera os dados dos campos
	$selecionarano = $_POST['selecionarano'];

	$sql = mysql_query("UPDATE anoselecionado SET anoselecionado = '".$selecionarano."'");
	if ($sql){$this->session->set_flashdata('success',"Exibindo mensalidades do ano $selecionarano");
	redirect('mensalidades');
}
}

if (isset($_POST['importar'])) {
	// Recupera os dados dos campos
	$anoanterior = $_POST['anoanterior'];
	$anoselecionado = $_POST['anoselecionado'];

	$sql = mysql_query("INSERT INTO mensalidades (clientes_id, data_pagamento, servico_id) SELECT `clientes_id`, `data_pagamento`, `servico_id` FROM `mensalidades` WHERE ano = '".$anoanterior."'");
	$sql2 = mysql_query("UPDATE mensalidades SET ano = '".$anoselecionado."' WHERE ano =''");
	if ($sql && $sql2){$this->session->set_flashdata('success',"Mensalidades de $anoanterior importadas com sucesso!");
	redirect('mensalidades');
}
}

if(isset($_POST['addnovo'])) {
	// Recupera os dados dos campos
	$clientes_id = $_POST['clientes_id'];
	$cliente = $_POST['cliente'];
	$ano = $_POST['ano'];
	$vencimento = $_POST['vencimento'];
	$idServico = $_POST["idServico"];
	$servico = $_POST["servico"];

	if($clientes_id == 0){
		$this->session->set_flashdata('error',"É necessário cadastrar o aluno <b>$cliente</b> para lançar as mensalidades. Acesse o menu <b>Alunos > Adicionar Aluno</b>");
		redirect('mensalidades');
	}elseif($idServico == 0){
		$this->session->set_flashdata('error',"É necessário cadastrar o serviço <b>$servico</b> para lançar as mensalidades. Clique no botão <b>+Serviços</b>");
		redirect('mensalidades');
	}else{
		$dataatual = date('d/m/y');
		$partes = explode("/", $dataatual);
		$mesatual = $partes[1];

		$ultimomes = $mesatual - 1;

		if ($mesatual == "1"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '0','0','0','0','0','0','0','0','0','0','0','0','0')");
		}
		if ($ultimomes == "1"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','0','0','0','0','0','0','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "2"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','0','0','0','0','0','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "3"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','0','0','0','0','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "4"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','0','0','0','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "5"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','0','0','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "6"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','0','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "7"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','3','0','0','0','0','0','0')");
		}
		elseif($ultimomes == "8"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','3','3','0','0','0','0','0')");
		}
		elseif($ultimomes == "9"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','3','3','3','0','0','0','0')");
		}
		elseif($ultimomes == "10"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','3','3','3','3','0','0','0')");
		}
		elseif($ultimomes == "11"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','3','3','3','3','3','0','0')");
		}
		elseif($mesatual == "12"){
			$sql = mysql_query("INSERT INTO mensalidades VALUES ('', '".$clientes_id."', '".$ano."', '".$vencimento."', '".$idServico."', '3','3','3','3','3','3','3','3','3','3','3','0','0')");
		}

		if ($sql){$this->session->set_flashdata('success',"Mensalidades de <b>$cliente</b> lançadas com sucesso - O código do aluno é: <b style='color:#B23636;font-size:18px;'>".$clientes_id."</b>");
			redirect('mapos/pesquisarAluno?termo='.$clientes_id);}
		}
	}
	?>

	<div class="widget-box">
		<div class="widget-title">
			<span class="icon">
				<i class="icon-tags"></i>
			</span>
			<h5>Mensalidades</h5>

			<div id="search" style="left:140px;top:2px;max-width:65%;">
				<form action="<?php echo base_url()?>index.php/mapos/pesquisarAluno" style="float: left;">
					<input type="text" name="termo" placeholder="Nome ou código do aluno" style="width: 250px;background: #fff;border: 1px solid #ddd;color: green;" autofocus="" />
					<button type="submit"  class="tip-bottom" title="Pesquisar" style="border: 1px solid #ddd;background:#999;"><i class="icon-search icon-white"></i></button>

				</form>
				<div>
					<h5>Filtrar: <i class="icon-filter"></i> <a href="<?php echo base_url()?>index.php/mapos/pesquisarAluno?termo=naopagas" class="btn-link">Não Pagas</a> · <i class="icon-filter"></i> <a href="<?php echo base_url()?>index.php/mapos/pesquisarAluno?termo=pagas" class="btn-link">Pagas</a> · <i class="icon-filter"></i> <a href="<?php echo base_url()?>index.php/mapos/pesquisarAluno?termo=desistentes" class="btn-link">Desistência</a> · <i class="icon-filter"></i> <a href="<?php echo base_url()?>index.php/mapos/pesquisarAluno" class="btn-link">Todas</a></h5>
				</div>
			</div>



			<form action="" method="post" enctype="multipart/form-data">
				<select name="selecionarano" onchange="this.form.submit()" style="width: 80px;float: right;margin: 3px 5px 0 0;">
					<?php
					$seleciona = mysql_query("SELECT anoselecionado FROM anoselecionado LIMIT 1");
					while($ln = mysql_fetch_array($seleciona)){
						$anoselecionado = $ln['anoselecionado'];
						?>
						<option><?php echo $anoselecionado; ?></option>
						<?php ;} ?>
						<option disabled="">-------</option>
						<option>2016</option>
						<option>2017</option>
						<option>2018</option>
						<option>2019</option>
						<option>2020</option>
						<option>2021</option>
						<option>2022</option>
						<option>2023</option>
						<option>2024</option>
						<option>2025</option>
						<option>2026</option>
						<option>2027</option>
						<option>2028</option>
						<option>2029</option>
						<option>2030</option>
					</select>
				</form> 
			</div>

			<div class="widget-content nopadding">
				<?php
				$dataatual = date('d/m/y');
				$partes = explode("/", $dataatual);
				$mesatual = $partes[1];

				if($mesatual == 1){$essemes = 'jan';$nomedomes='Janeiro';}
				elseif($mesatual == 2){$essemes = 'fev';$nomedomes='Fevereiro';}
				elseif($mesatual == 3){$essemes = 'mar';$nomedomes='Março';}
				elseif($mesatual == 4){$essemes = 'abr';$nomedomes='Abril';}
				elseif($mesatual == 5){$essemes = 'mai';$nomedomes='Maio';}
				elseif($mesatual == 6){$essemes = 'jun';$nomedomes='Junho';}
				elseif($mesatual == 7){$essemes = 'jul';$nomedomes='Julho';}
				elseif($mesatual == 8){$essemes = 'ago';$nomedomes='Agosto';}
				elseif($mesatual == 9){$essemes = 'setembro';$nomedomes='Setembro';}
				elseif($mesatual == 10){$essemes = 'outubro';$nomedomes='Outubro';}
				elseif($mesatual == 11){$essemes = 'nov';$nomedomes='Novembro';}
				else{$essemes = 'dez';$nomedomes='Dezembro';}

				$contaativos = mysql_query('SELECT * FROM mensalidades WHERE ano = '.$anoselecionado.'');
				$contapagoss = mysql_query('SELECT * FROM mensalidades WHERE ano = '.$anoselecionado.' and '.$essemes.' = 1');
				$contanaopagos = mysql_query('SELECT * FROM mensalidades WHERE ano = '.$anoselecionado.' and '.$essemes.' = 0');
				$ativos = mysql_num_rows($contaativos);
				$pagos = mysql_num_rows($contapagoss);
				$naopagos = mysql_num_rows($contanaopagos);

				?>

				<center>
					<div style="background-color: #fff;">
						<br/><br/><h3>Digite o <b>código</b> ou <b>nome do aluno</b> no campo de pesquisa acima.</h3><br/>

						<table class='table table-bordered' id='tabela-mensalidades' style="border-bottom: 1px solid #ddd;border-top: 1px solid #ddd;border-right: 1px solid #ddd;max-width: 500px">
							<thead>
								<tr style='backgroud-color: #2D335B'>
									<th>Mês Atual</th>
									<th>Ativas</th>
									<th>Pagas</th>
									<th>Não Pagas</th>
								</tr>
							</thead>
							<tbody>
								<tr style="color:#468847;font-weight: bold;">
									<td><center><?php echo $nomedomes; ?></center></td>
									<td><center><?php echo $ativos; ?></center></td>
									<td><center><?php echo $pagos; ?></center></td>
									<td><center style="color:#b94a48"><?php echo $naopagos; ?></center></td>
								</tr>
							</tbody>
						</table>

						<br/><br/>

						<div class="alert alert-info" style="margin-bottom: 0;">
							<h3><i class="icon-calendar"></i> Mensalidades do ano <?php echo $anoselecionado; ?></h3></div>
						</div>
					</center>

					<!-- Modal adicionar novo -->
					<div id="modalAddNovo" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<form id="formAddNovo" action="" method="post">

							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h3 id="myModalLabel">Adicionar Mensalidade</h3>
							</div>
							<div class="modal-body">

								<div class="span12 alert alert-info" style="margin-left: 0"> Obrigatório o preenchimento de todos os campos.</div>

								<div class="span12" style="margin-left: 0"> 
									<div class="span12" style="margin-left: 0"> 
										<label for="cliente">Aluno</label>
										<input class="span12" id="cliente" type="text" name="cliente" value=""/>
										<input id="clientes_id" class="span12" type="hidden" name="clientes_id" value=""  />
									</div>
								</div>

								<div class="span12" style="margin-left: 0">
									<input type="hidden" name="idServico" id="idServico"/>
									<label for="">Serviço</label>
									<input type="text" class="span12" name="servico" id="servico" placeholder="Digite o nome do serviço" />
								</div>	

								<div class="span12" style="margin-left: 0"> 
									<div class="span4" style="margin-left: 0">  
										<label for="ano">Ano</label>
										<div class="styled-select">
											<select name="ano" class="span11">
												<option selected=""><?php echo $anoatual; ?></option>
												<option disabled="">-------</option>
												<option>2016</option>
												<option>2017</option>
												<option>2018</option>
												<option>2019</option>
												<option>2020</option>
											</select>
										</div>
									</div>

									<div class="span4" style="margin-left: 0">  
										<label for="">Data Base Pagamento</label>
										<input type="text" class="span12" name="vencimento" id="vencimento" maxlength="2"/>

									</div>
								</div>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
								<input type="submit" name="addnovo" class="btn btn-success" value="Salvar"></input>
							</div>
						</form>
					</div>




					<?php
					$anoanterior = $anoselecionado - 1;
					?>
					<!-- Modal Importar-->
					<a href="#modal-importar" data-toggle="modal" id="modalimportar" class=""></a>
					<div id="modal-importar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<form action="" method="post" >
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
								<h5 id="myModalLabel">Importar Mensalidades de <?php echo $anoanterior;?></h5>
							</div>
							<div class="modal-body">
								<input type="hidden" name="anoanterior" value="<?php echo $anoanterior ?>" />
								<input type="hidden" name="anoselecionado" value="<?php echo $anoselecionado ?>" />
								<h5 style="text-align: center">Deseja importar as mensalidades ativas do ano anterior?</h5>
							</div>
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
								<input type="submit" class="btn btn-success" name="importar" value="Importar">
							</div>
						</form>
					</div>


					<!-- Modal Importar Vazio-->
					<a href="#modal-importar_vazio" data-toggle="modal" id="modalimportar_vazio" class=""></a>
					<div id="modal-importar_vazio" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h5 id="myModalLabel">Importar Mensalidades</h5>
						</div>
						<div class="modal-body">
							<h5 style="text-align: center">Não existem mensalidades no ano anterior (<?php echo $anoanterior;?>) para serem importadas!</h5>
						</div>
						<div class="modal-footer">
							<button class="btn" data-dismiss="modal" aria-hidden="true">Fechar</button>
						</div>
					</div>

					<link rel="stylesheet" href="<?php echo base_url()?>assets/css/jquery.fancybox.min.css" />
					<script src="<?php echo base_url()?>assets/js/jquery.fancybox.min.js"></script>

					<script type="text/javascript">
						var submited = false;
						function checkSubmit() {
							if (!submited) {
								submited = true;
								return true;
							}
							else {
								return false;
							}
						}

						$(document).ready(function(){

							$(document).on('click', 'a', function(event) {
								var os = $(this).attr('os');
								$('#idOs').val(os);

							});

							$("#cliente").autocomplete({
								source: "<?php echo base_url(); ?>index.php/os/autoCompleteCliente",
								minLength: 2,
								select: function( event, ui ) {

									$("#clientes_id").val(ui.item.id);
									$("#servico").focus();
								}
							})

							$("#servico").autocomplete({
								source: "<?php echo base_url(); ?>index.php/os/autoCompleteServico",
								minLength: 2,
								select: function( event, ui ) {

									$("#idServico").val(ui.item.id);
								}
							});

							$("#formAddNovo").validate({
								rules:{
									cliente: {required:true},
									servico: {required:true},
									vencimento: {required:true},
								},
								messages:{
									cliente: {required: 'Campo Requerido.'},
									servico: {required: 'Campo Requerido.'},
									vencimento: {required: 'Campo Requerido.'},
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

						});
					</script>