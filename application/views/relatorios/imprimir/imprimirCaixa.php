  <head>
    <title>Relatório Caixas</title>
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
                      <div class="widget-title">
                          <h4 style="text-align: center">Relatório de Caixas</h4>
                      </div>
                      <div class="widget-content nopadding">

                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th style="font-size: 1.2em; padding: 5px;">Usuário Abertura</th>
                              <th style="font-size: 1.2em; padding: 5px;">Usuário Fechamento</th>
                              <th style="font-size: 1.2em; padding: 5px;">Abertura</th>
                              <th style="font-size: 1.2em; padding: 5px;">Fechamento</th>
                              <th style="font-size: 1.2em; padding: 5px;">Entradas</th>
                              <th style="font-size: 1.2em; padding: 5px;">Saídas</th>
                              <th style="font-size: 1.2em; padding: 5px;">Total</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                          $totalEntrada = 0;
                          $totalSaida = 0;
                          $saldo = 0;
                          foreach ($caixa as $c) {
                              $abertura = date('d/m/Y', strtotime($c->dataabertura));
                              $get_fechamento = $c->datafechamento;
                              if ($get_fechamento == "0000-00-00"){$fechamento = "<span style='color:green'><b>Caixa aberto</b></span>";}else{$fechamento = date('d/m/Y', strtotime($c->datafechamento));}
                              
                              $userfechamento = $c->usuariofechamento;
                              if ($userfechamento == ""){$usuariofechamento = "<span style='color:green'><b>Caixa aberto</b></span>";}else{$usuariofechamento = $c->usuariofechamento;}
                              
                              $totalEntrada += $c->entrada;
                              $totalSaida += $c->saida;
                              echo '<tr>';
                              echo '<td>' . $c->usuarioabertura . '</td>';
                              echo '<td>' . $usuariofechamento . '</td>';
                              echo '<td>' . $abertura . '</td>';
                              echo '<td>' . $fechamento . '</td>';
                              echo '<td style="color:green">' . $c->entrada . '</td>';
                              echo '<td style="color:red">' . $c->saida . '</td>';
                              echo '<td>' . $c->total . '</td>';
                              echo '</tr>';
                          }
                          ?>
                           <tr>
                            <td colspan="5" style="text-align: right; color: green"> <strong>Total Receitas:</strong></td>
                            <td colspan="2" style="text-align: left; color: green"><strong>R$ <?php echo number_format($totalEntrada,2,',','.') ?></strong></td>
                          </tr>
                          <tr>
                            <td colspan="5" style="text-align: right; color: red"> <strong>Total Despesas:</strong></td>
                            <td colspan="2" style="text-align: left; color: red"><strong>R$ <?php echo number_format($totalSaida,2,',','.') ?></strong></td>
                          </tr>
                          <tr>
                            <td colspan="5" style="text-align: right"> <strong>Saldo:</strong></td>
                            <td colspan="2" style="text-align: left;"><strong>R$ <?php echo number_format($totalEntrada - $totalSaida,2,',','.') ?></strong></td>
                          </tr>
                      </tbody>                  
</table> 


				</div>
			</div>
                  <h5 style="text-align: right">Data do Relatório: <?php echo date('d/m/Y');?></h5>

			          </div>
			      </div>
			</div>




            <!-- Arquivos js-->

            <script src="<?php echo base_url();?>js/excanvas.min.js"></script>
            <script src="<?php echo base_url();?>js/bootstrap.min.js"></script>
            <script src="<?php echo base_url();?>js/sosmc.js"></script>
            <script src="<?php echo base_url();?>js/dashboard.js"></script>
  </body>
</html>








