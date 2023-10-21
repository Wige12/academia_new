<?php
if (isset($_POST['fecharCaixa'])) {
	// Recupera os dados dos campos
	
	$data = $_POST['data'];
    try {
          $data = explode('/', $data);
          $data = $data[2].'-'.$data[1].'-'.$data[0];

         } catch (Exception $e) {
          $data = date('Y/m/d'); 
    	}

	$caixanum = $_POST['caixanum'];
	$usuario = $_POST['usuario'];
	$hora = $_POST['hora'];
	$entrada = $_POST['entrada'];
	$saida = $_POST['saida'];
	$total = $_POST['total'];

		$sql = mysql_query("UPDATE caixa SET usuariofechamento = '".$usuario."', datafechamento = '".$data."', horafechamento = '".$hora."', entrada = '".$entrada."', saida = '".$saida."', total = '".$total."' WHERE id = $caixanum");
		$sql2 = mysql_query("UPDATE status_caixa SET status = '0'");
		$sql3 = mysql_query("UPDATE lancamentos SET aparece_no_caixa = '0'");
		if ($sql && $sql2){$this->session->set_flashdata('success',"Caixa número $caixanum fechado com sucesso!");
		redirect('');
		}
}
?>

<!--[if lt IE 9]><script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/excanvas.min.js"></script><![endif]-->

<script language="javascript" type="text/javascript" src="<?php echo base_url();?>js/dist/jquery.jqplot.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>js/dist/jquery.jqplot.min.css" />

<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.pieRenderer.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>js/dist/plugins/jqplot.donutRenderer.min.js"></script>


<!--Action boxes-->
	<div class="alert alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
			<?php $caixa = mysql_query("SELECT id FROM caixa ORDER BY id DESC LIMIT 1");
				while($ln = mysql_fetch_array($caixa)){
				$id_caixa = $ln['id'];
				echo "O caixa Nº <b>#".$id_caixa."</b> está aberto.";
			}?>
	</div>
	
<a href="#modalFecharCaixa" id="FecharCaixa" data-toggle="modal" role="button" class="btn btn-link tip-bottom" title="Fechar Caixa" style="position: absolute;top:3px;right:10px;"><i class="icon-plus icon-white"></i> Fechar Caixa</a>

  <div class="container-fluid">
    <div class="quick-actions_homepage">
      <ul class="quick-actions">
        <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/clientes"> <i class="icon-group"></i> Clientes</a> </li>
        <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/produtos"> <i class="icon-barcode"></i> Produtos</a> </li>
        <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/mensalidades"> <i class="icon-tag"></i> Mensalidades (F1)</a> </li>
        <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/vendas"><i class="icon-shopping-cart"></i> Vendas (F5)</a></li>
        <li class="bg_ls"> <a href="<?php echo base_url()?>index.php/financeiro/lancamentos"><i class="icon-money"></i> Lançamentos (F9)</a></li>

      </ul>
    </div>
  </div>


<!--End-Action boxes-->
<div class="row-fluid" style="margin-top: 0">
<div class="span12" style="margin-left: 0;">
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-calendar"></i>
         </span>
        <h5>Mensalidades pendentes com vencimento esta semana</h5>

     </div>
<div class="widget-content nopadding">
    	<?php
			$seleciona = mysql_query("SELECT anoselecionado FROM anoselecionado LIMIT 1");
			while($ln = mysql_fetch_array($seleciona)){
			$anoselecionado = $ln['anoselecionado'];
		} ?>

<?php
	$dataatual = date('d/m/y');
		$partes = explode("/", $dataatual);
		$diaatual = $partes[0];
		$mesatual = $partes[1];
		$anoatual = "20".$partes[2];

if ($mesatual == "1"){$essemes = 'jan';};
if ($mesatual == "2"){$essemes = 'fev';};
if ($mesatual == "3"){$essemes = 'mar';};
if ($mesatual == "4"){$essemes = 'abr';};
if ($mesatual == "5"){$essemes = 'mai';};
if ($mesatual == "6"){$essemes = 'jun';};
if ($mesatual == "7"){$essemes = 'jul';};
if ($mesatual == "8"){$essemes = 'ago';};
if ($mesatual == "9"){$essemes = 'setembro';};
if ($mesatual == "10"){$essemes = 'outubro';};
if ($mesatual == "11"){$essemes = 'nov';};
if ($mesatual == "12"){$essemes = 'dez';};

				$sabado = 6; //sabado = 6º dia = fim da semana.
				$dia_atual=date('w'); //pego o dia atual
				$dias_que_faltam_para_o_sabado = $sabado - $dia_atual;

				$inicio = strtotime("-$dia_atual days");
				$fim = strtotime("+$dias_que_faltam_para_o_sabado days");

				$primdiasemana = date('d',$inicio); //data inicial
				$ultmodiasemana = date('d',$fim); //data final

	$seleciona = mysql_query("SELECT * FROM mensalidades WHERE (data_pagamento BETWEEN '".$primdiasemana."' and '".$ultmodiasemana."') and ano = ".$anoselecionado." and $essemes = 0 ORDER by id DESC");
		$conta = mysql_num_rows($seleciona);
			    if($conta <= 0){
			    	echo "<center><div><h3>Não existem mensalidades pendentes com vencimento esta semana</h3></div></center>";
				}else{
					echo "
					<table class='table table-bordered' id='tabela-mensalidades'>
						<thead>
							<tr style='backgroud-color: #2D335B'>
							    <th style='width: 200px'>Aluno</th>
							    <th>Vencimento</th>
							    <th>Status</th>
							    <th>Serviço</th>
							    <th>Valor</th>
							</tr>
						</thead>
					";
			while($ln = mysql_fetch_array($seleciona)){
			$id = $ln['id'];
			$clientes_id = $ln['clientes_id'];
			$servico_id = $ln['servico_id'];

			
			?>
    <tbody>
        <tr>

		<?php
			$selecionar_cliente_innerjoin = mysql_query("SELECT nomeCliente FROM clientes INNER JOIN mensalidades ON idClientes = $clientes_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_cliente_innerjoin)){
				$nomeCliente = $ln['nomeCliente'];
		?>
			<td><?php echo $nomeCliente; ?></td>
		<?php }?>          
		<?php
			$selecionar_mensalidade = mysql_query("SELECT data_pagamento FROM mensalidades WHERE id = $id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_mensalidade)){
				$data_pagamento = $ln['data_pagamento'];
		?>
			<td><?php echo $data_pagamento.'/'.$mesatual.'/'.$anoatual; ?></td>
			<td><?php if ($data_pagamento < $diaatual){echo '<b style="color:#bd362f;">Atrasado</b>';}else{echo 'Pendente';}; ?></td>
		<?php }?> 
		<?php
			$selecionar_servico_innerjoin = mysql_query("SELECT * FROM servicos INNER JOIN mensalidades ON idServicos = $servico_id LIMIT 1");
			while($ln = mysql_fetch_array($selecionar_servico_innerjoin)){
				$nome = $ln['nome'];
				$preco = $ln['preco'];
		?>
            <td><?php echo $nome;?></td>
            <td>R$ <?php echo $preco;?></td>
		<?php }?> 
        </tr>
    </tbody>
    
<?php } echo "</table>";} ?>
</div>

</div>
</div>
</div>



<!--End-Action boxes-->
<div class="row-fluid" style="margin-top: 0">
<div class="span12" style="margin-left: 0;">
	<div class="widget-box">
     <div class="widget-title">
        <span class="icon">
            <i class="icon-money"></i>
         </span>
        <h5>Pagamentos pendentes para esta semana</h5>

     </div>

<div class="widget-content nopadding">

<table class="table table-bordered ">
    <thead>
        <tr style="backgroud-color: #2D335B">
            <th>Tipo</th>
            <th>Aluno / Fornecedor</th>
            <th>Vencimento</th>
            <th>Status</th>
            <th>Valor</th>
        </tr>
    </thead>
    <tbody>
       <?php
			$totalReceita = '0';
			$totalDespesa = '0';	       	

				$sabado = 6; //sabado = 6º dia = fim da semana.
				$dia_atual=date('w'); //pego o dia atual
				$dias_que_faltam_para_o_sabado = $sabado - $dia_atual;

				$inicio = strtotime("-$dia_atual days");
				$fim = strtotime("+$dias_que_faltam_para_o_sabado days");

				$primdiasemana = date('Y-m-d',$inicio); //data inicial
				$ultmodiasemana = date('Y-m-d',$fim); //data final

		$sql = mysql_query("SELECT * FROM lancamentos WHERE (data_vencimento BETWEEN '".$primdiasemana."' and '".$ultmodiasemana."') and baixado = 0 ORDER by data_vencimento ASC");
				$conta = mysql_num_rows($sql);
			    if($conta != 0){
		
		while ($ln = mysql_fetch_array($sql)){
			$tipo = $ln['tipo'];
			$valor = $ln['valor'];
			if($tipo == 'receita'){ $labeltipo = '<center><span class="label label-success">Receita</span></center>'; $totalReceita += $valor;} else{$labeltipo = '<center><span class="label label-important">Despesa</span></center>'; $totalDespesa += $valor;}

			$cliente_fornecedor = $ln['cliente_fornecedor'];
			$data_vencimento = date(('d/m/Y'),strtotime($ln['data_vencimento']));
			$status = "Pendente";

	               echo '<tr>';
	               echo '<td>'.$labeltipo.'</td>';
	               echo '<td>'.$cliente_fornecedor.'</td>';
	               echo '<td>'.$data_vencimento.'</td>';
	               echo '<td>'.$status.'</td>';
	               echo '<td> R$ '.$valor.'</td>';
	               echo '</tr>';

	       }}else{
					echo '<tr>';
					echo '<td colspan="5"> Não existem lançamentos para essa semana</td>';
					echo '</tr>';
		   }
       ?>

    </tbody>
</table>
</div>
</div>
</div>
</div>


<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-barcode"></i></span><h5>Produtos Com Estoque Mínimo</h5></div>
<div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Produto</th>
                            <th>Preço de Venda</th>
                            <th>Estoque</th>
                            <th>Estoque Mínimo</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        if($produtos != null){
                            foreach ($produtos as $p) {
                                echo '<tr>';
                                echo '<td>'.$p->idProdutos.'</td>';
                                echo '<td>'.$p->descricao.'</td>';
                                echo '<td>R$ '.$p->precoVenda.'</td>';
                                echo '<td>'.$p->estoque.'</td>';
                                echo '<td>'.$p->estoqueMinimo.'</td>';
                                echo '<td> <a href="'.base_url().'index.php/produtos/editar/'.$p->idProdutos.'" class="btn btn-info"> <i class="icon-pencil" ></i> </a></td>';
                                echo '</tr>';
                            }
                        }
                        else{
                            echo '<tr><td colspan="6">Nenhum produto com estoque baixo.</td></tr>';
                        }    

                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row-fluid" style="margin-top: 0">
    <div class="span12">
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-gift"></i></span><h5>Aniversariantes do mês</h5></div>
            <div class="widget-content nopadding">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Aniversário</th>
                            <th>Idade</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						$sql = mysql_query("Select * From clientes Where MONTH(nascimento) = MONTH(CURDATE()) ORDER BY nascimento DESC");
						$conta = mysql_num_rows($sql);
			    			if($conta != 0){
								while($ln = mysql_fetch_array($sql)){
									$idClientes = $ln['idClientes']; 
									$nome = $ln['nomeCliente']; 
									$telefone = $ln['telefone']; 
									$nascimento_cliente = date(('d'),strtotime($ln['nascimento'])); 
									$nascimento_completo = date(('d/m/Y'),strtotime($ln['nascimento'])); 

									    // Declara a data! :P
									    $data = $nascimento_completo;
									   
									    // Separa em dia, mês e ano
									    list($dia, $mes, $ano) = explode('/', $data);
									   
									    // Descobre que dia é hoje e retorna a unix timestamp
									    $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
									    // Descobre a unix timestamp da data de nascimento do fulano
									    $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
									   
									    // Depois apenas fazemos o cálculo já citado :)
									    $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
							
					               echo '<tr>';
					               echo '<td>'.$nome.'</td>';
					               echo '<td><center>'.$telefone.'</center></td>';
					               echo '<td><center>dia '.$nascimento_cliente.'</center></td>';
					               echo '<td><center>'.$idade.' anos</center></td>';
					               echo '<td><center><a href="'.base_url().'index.php/clientes/visualizar/'.$idClientes.'" class="btn tip-top" title="Ver mais detalhes"> <i class="icon-eye-open" ></i> </a></td>';
					               echo '</center></tr>';

					       }}else{
									echo '<tr>';
									echo '<td colspan="5"> Não existem aniversariantes nesta semana</td>';
									echo '</tr>';
						   }
						?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<div class="row-fluid" style="margin-top: 0">

    <div class="span12">
        
        <div class="widget-box">
            <div class="widget-title"><span class="icon"><i class="icon-signal"></i></span><h5>Estatísticas do Sistema</h5></div>
            <div class="widget-content">
                <div class="row-fluid">           
                    <div class="span12">
                        <ul class="site-stats">
                            <li class="bg_lh"><i class="icon-group"></i> <strong><?php echo $this->db->count_all('clientes');?></strong> <small>Alunos Cadastrados</small></li>
                            <li class="bg_lh"><i class="icon-barcode"></i> <strong><?php echo $this->db->count_all('produtos');?></strong> <small>Produtos Cadastrados</small></li>
                            <li class="bg_lh"><i class="icon-shopping-cart"></i> <strong><?php echo $this->db->count_all('vendas');?></strong> <small>Vendas Realizadas</small></li>
                            <li class="bg_lh"><i class="icon-wrench"></i> <strong><?php echo $this->db->count_all('lancamentos');?></strong> <small>Transações</small></li>
                            
                        </ul>
                 
                    </div>
            
                </div>
            </div>
        </div>
    </div>
</div>

<?php
	$caixa = mysql_query("SELECT * FROM caixa ORDER BY id DESC LIMIT 1");
	while($ln = mysql_fetch_array($caixa)){
	$id_caixa = $ln['id'];
?>
<!-- Modal Fechar Caixa -->
<div id="modalFecharCaixa" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <form id="formFecharCaixa" action="" method="post">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Fechar Caixa</h3>
  </div>
  <div class="modal-body">

    	<div class="span12" style="margin-left: 0"> 
    		<label for="caixanum"><?php echo '<h4>Fechamento do Caixa Nº #'.$id_caixa.'</h4>' ?></label>
    		<input type="hidden" name="caixanum" value="<?php  echo $id_caixa ?>" />
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<label for="usuario">Usuário</label>
    		<input class="span12" type="text" name="usuario" value="<?php echo $usuario->nome?>" readonly/>
    	</div>
    	<div class="span6" style="margin-left: 0"> 
    		<label for="data">Data</label>
    		<input class="span12" type="text" name="data" value="<?php echo date('d/m/Y'); ?>" readonly/>
    	</div>
    	<div class="span6""> 
    		<label for="hora">Hora</label>
    		<input class="span12" type="text" name="hora" value="<?php echo date('h:i:s');?>" readonly/>
    	</div>
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span6" style="margin-left: 0"> 
    			<label for="entrada" style="color: green">Entradas</label>

			<?php
				$datahoje = date('Y-m-d');
				$totalreceitadia = mysql_query("SELECT SUM(valor) FROM lancamentos WHERE baixado = '1' and tipo = 'receita' and data_vencimento = '".$datahoje."' and aparece_no_caixa = '1'");
				while($ln = mysql_fetch_array($totalreceitadia)){
				$somareceitadia = $ln['SUM(valor)'];
				
				$totaldespesadia = mysql_query("SELECT SUM(valor) FROM lancamentos WHERE baixado = '1' and tipo = 'despesa' and data_vencimento = '".$datahoje."' and aparece_no_caixa = '1'");
				while($ln = mysql_fetch_array($totaldespesadia)){
				$somadespesadia = $ln['SUM(valor)'];
				
				
				$totalcaixa = $somareceitadia - $somadespesadia;
			?>
    			<input class="span12 money" id="entrada" type="text" name="entrada" readonly value="<?php echo $somareceitadia;?>"/>

    		</div>
    		<div class="span6"> 
    			<label for="saida" style="color: red">Saídas</label>
    			<input class="span12 money" id="saida" type="text" name="saida" readonly value="<?php echo $somadespesadia;?>"/>
    		</div>
    	</div>
    	
    	<div class="span12" style="margin-left: 0"> 
    		<div class="span5" style="float: right;"> 
    			<label for="total">Total</label>
    			<input class="span12 money" id="total" type="text" name="total" readonly value="<?php echo $totalcaixa;?>"/>
    		</div>
    	</div>
			<?php }}?>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancelar</button>
    <input type="submit" class="btn btn-success" name="fecharCaixa" value="Fechar Caixa" />
  </div>
  </form>
</div>
<?php }?>
 <script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script>
    $(document).ready(function(){
        $(".money").maskMoney();
    });
</script>