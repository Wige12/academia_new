<?php
if (isset($_POST['selecionarano_rel_men'])) {
	// Recupera os dados dos campos
	$selecionarano_rel_men = $_POST['selecionarano_rel_men'];

		$sql = mysql_query("UPDATE anoselecionado SET anoselecionado_rel_men = '".$selecionarano_rel_men."'");
		if ($sql){$this->session->set_flashdata('success',"O relatório será gerado com o ano $selecionarano_rel_men");
		redirect('relatorios/mensalidades');
		}
}

if (isset($_POST['selecionarano_rel_men_pagas'])) {
	// Recupera os dados dos campos
	$selecionarano_rel_men_pagas = $_POST['selecionarano_rel_men_pagas'];

		$sql = mysql_query("UPDATE anoselecionado SET anoselecionado_rel_men_pagas = '".$selecionarano_rel_men_pagas."'");
		if ($sql){$this->session->set_flashdata('success',"O relatório será gerado com o ano $selecionarano_rel_men_pagas");
		redirect('relatorios/mensalidades');
		}
}
?>
<div class="row-fluid" style="margin-top: 0">
    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Todas as Mensalidades</h5>

                	<form action="" method="post" enctype="multipart/form-data">
							<select name="selecionarano_rel_men" onchange="this.form.submit()" style="width: 80px;float: right;margin: 3px 5px 0 0;">
								<?php
									$seleciona = mysql_query("SELECT anoselecionado_rel_men FROM anoselecionado LIMIT 1");
									while($ln = mysql_fetch_array($seleciona)){
									$anoselecionado_rel_men = $ln['anoselecionado_rel_men'];
									?>
									<option><?php echo $anoselecionado_rel_men; ?></option>
								<?php ;} ?>
									<option disabled="">-------</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>
									<option>2019</option>
									<option>2020</option>
							</select>
					</form>

            </div>
            <div class="widget-content">
                <ul class="site-stats">
                    <li><a href="<?php echo base_url()?>index.php/relatorios/mensalidadesRapid"><i class="icon-money"></i> <small>Todas as Mensalidades</small></a></li>
                    
                </ul>
            </div>
        </div>
    </div>



    <div class="span4">
        <div class="widget-box">
            <div class="widget-title">
                <span class="icon">
                    <i class="icon-list-alt"></i>
                </span>
                <h5>Mensalidades Pagas</h5>
                	<form action="" method="post" enctype="multipart/form-data">
							<select name="selecionarano_rel_men_pagas" onchange="this.form.submit()" style="width: 80px;float: right;margin: 3px 5px 0 0;">
								<?php
									$seleciona = mysql_query("SELECT anoselecionado_rel_men_pagas FROM anoselecionado LIMIT 1");
									while($ln = mysql_fetch_array($seleciona)){
									$anoselecionado_rel_men_pagas = $ln['anoselecionado_rel_men_pagas'];
									?>
									<option><?php echo $anoselecionado_rel_men_pagas; ?></option>
								<?php ;} ?>
									<option disabled="">-------</option>
									<option>2016</option>
									<option>2017</option>
									<option>2018</option>
									<option>2019</option>
									<option>2020</option>
							</select>
					</form>

            </div>
            <div class="widget-content">
                <ul class="site-stats">
                    <li><a href="<?php echo base_url()?>index.php/relatorios/imprimirmenPagas"><i class="icon-money"></i> <small>Mensalidades Pagas</small></a></li>
                    
                </ul>
            </div>
        </div>
    </div>
</div>