<link rel="stylesheet" href="<?php echo base_url();?>js/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css" />
<script type="text/javascript" src="<?php echo base_url()?>js/jquery-ui/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>js/jquery.validate.js"></script>
    <?php if ($custom_error != '') {
        echo '<div class="alert alert-danger">' . $custom_error . '</div>';
    ;} ?>

<form action="<?php echo base_url(); ?>acompanhamento/editar_avaliacao" id="formAvaliacao" method="post" class="form-horizontal">
<?php echo form_hidden('id',$results->idAvaliacao)?>
<?php echo form_hidden('id_acompanhamento',$results->acompanhamento_id)?>
<div class="widget-box">
	<div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Mapeamento Corporal - Perímetros</h5>
        <div class="buttons span6">

		    <div class="span12">
		        <div class="span6 offset6">
		        	<a href="<?php echo base_url() ?>index.php/acompanhamento/editar/<?php echo $results->acompanhamento_id;?>" id="" class="btn" style="float: right;margin:-5px 10px 0 0;"><i class="icon-arrow-left"></i> Voltar</a>
		        </div>
		    </div>
        </div>
     </div>

<div class="widget-content">
<div class="span12 well" style="margin-bottom:20px;"> 
	<div class="span4" style="margin-left: 0;">  
	    <label class="control-label" for="peso">Peso Atual</label>
	    <div class="controls">
	        <input type="text" class="span9 money" name="peso" id="peso" value="<?php if ($results->peso == 0){echo "";} else{echo $results->peso;} ?>" autofocus="" placeholder="Kg"/>
	    </div>
	</div>
	<div class="span4" style="margin-left: 0">  
	    <label class="control-label" for="altura">Altura</label>
	    <div class="controls">
	        <input type="text" class="span9 money" name="altura" id="altura" value="<?php if ($results->altura == 0){echo "";} else{echo $results->altura;} ?>" placeholder="metros"/>
	    </div>
	</div>
	<div class="span4" style="margin-left: 50px;">  
	    <label class="control-label" style="width: auto;"><strong>IMC: <span id="imc">00,00</span> - <span id="status" style="color:#5fb48b;">TIPO</span></strong></label>
	    <input type="hidden" id="inputimc" name="inputimc" value=""/>
	    <input type="hidden" id="inputstatus" name="inputstatus" value=""/>
	</div>
	<p style="float:right;top:30px;color:#aaa;position: relative;font-size: 11px;"><i><b>Fonte:</b> Tabela IMC - Ministério da Saúde</i></p>
</div>

	<div class="control-group">
	    <label class="control-label" for="pescoco">Pescoço</label>
	    <div class="controls">
	        <input type="text" class="span2 money" name="pescoco" id="pescoco" value="<?php if ($results->pescoco == 0){echo "";} else{echo $results->pescoco;} ?>" placeholder="cm"/>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="torax">Tórax</label>
	    <div class="controls">
	        <input type="text" class="span2 money" name="torax" id="torax" value="<?php if ($results->torax == 0){echo "";} else{echo $results->torax;} ?>" placeholder="cm"/>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="abdominal">Abdominal</label>
	    <div class="controls">
	        <input type="text" class="span2 money" name="abdominal" id="abdominal" value="<?php if ($results->abdominal == 0){echo "";} else{echo $results->abdominal;} ?>" placeholder="cm"/>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="cintura">Cintura</label>
	    <div class="controls">
	        <input type="text" class="span2 money" name="cintura" id="cintura" value="<?php if ($results->cintura == 0){echo "";} else{echo $results->cintura;} ?>" placeholder="cm"/>
	    </div>
	</div>

	<div class="control-group">
	    <label class="control-label" for="quadril">Quadril</label>
	    <div class="controls">
	        <input type="text" class="span2 money" name="quadril" id="quadril" value="<?php if ($results->quadril == 0){echo "";} else{echo $results->quadril;} ?>" placeholder="cm"/>
	    </div>
	</div>

	<div class="control-group" style="margin-top: 5px;border: none;">
		<label class="span6"><center><h5 class="badge" style="background-color: #c30000">Esquerdo</h5></center></label>
		<label class="span6"><center><h5 class="badge" style="background-color: #c30000">Direito</h5></center></label>
	</div>
	
	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="braco_rel_esq">Braço Relaxado Esq.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="braco_rel_esq" id="braco_rel_esq" value="<?php if ($results->braco_rel_esq == 0){echo "";} else{echo $results->braco_rel_esq;} ?>" placeholder="cm"/>
	    </div>
	</div>
	<div class="span6">
	    <label class="control-label" for="braco_rel_dir">Braço Relaxado Dir.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="braco_rel_dir" id="braco_rel_dir" value="<?php if ($results->braco_rel_dir == 0){echo "";} else{echo $results->braco_rel_dir;} ?>" placeholder="cm"/>
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="braco_con_esq">Braço Forçado Esq.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="braco_con_esq" id="braco_con_esq" value="<?php if ($results->braco_con_esq == 0){echo "";} else{echo $results->braco_con_esq;} ?>" placeholder="cm"/>
	    </div>
	</div>
	<div class="span6">
	    <label class="control-label" for="braco_con_dir">Braço Forçado Dir.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="braco_con_dir" id="braco_con_dir" value="<?php if ($results->braco_con_dir == 0){echo "";} else{echo $results->braco_con_dir;} ?>" placeholder="cm"/>
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="antebraco_esq">Antebraço Esq.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="antebraco_esq" id="antebraco_esq" value="<?php if ($results->antebraco_esq == 0){echo "";} else{echo $results->antebraco_esq;} ?>" placeholder="cm"/>
	    </div>
	</div>
	<div class="span6">
	    <label class="control-label" for="antebraco_dir">Antebraço Dir.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="antebraco_dir" id="antebraco_dir" value="<?php if ($results->antebraco_dir == 0){echo "";} else{echo $results->antebraco_dir;} ?>" placeholder="cm"/>
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="coxa_esq">Coxa Esq.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="coxa_esq" id="coxa_esq" value="<?php if ($results->coxa_esq == 0){echo "";} else{echo $results->coxa_esq;} ?>" placeholder="cm"/>
	    </div>
	</div>
	<div class="span6">
	    <label class="control-label" for="coxa_dir">Coxa Dir.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="coxa_dir" id="coxa_dir" value="<?php if ($results->coxa_dir == 0){echo "";} else{echo $results->coxa_dir;} ?>" placeholder="cm"/>
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="perna_esq">Perna Esq.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="perna_esq" id="perna_esq" value="<?php if ($results->perna_esq == 0){echo "";} else{echo $results->perna_esq;} ?>" placeholder="cm"/>
	    </div>
	</div>
	<div class="span6">
	    <label class="control-label" for="perna_dir">Perna Dir.</label>
	    <div class="controls">
	        <input type="text" class="span5 money" name="perna_dir" id="perna_dir" value="<?php if ($results->perna_dir == 0){echo "";} else{echo $results->perna_dir;} ?>" placeholder="cm"/>
	    </div>
	</div>
	</div>

</div>
</div>
<br />
<div class="widget-box">
	<div class="widget-title">
        <span class="icon">
            <i class="icon-user"></i>
         </span>
        <h5>Dobras Cutâneas</h5>
     </div>

<div class="widget-content">

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="dobra_triceps">Tríceps</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_triceps" id="dobra_triceps" value="<?php if ($results->dobra_triceps == 0){echo "";} else{echo $results->dobra_triceps;} ?>"/> mm
	    </div>
	</div>

	<div class="span6">
	    <label class="control-label" for="dobra_subescapular">Subescapular</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_subescapular" id="dobra_subescapular" value="<?php if ($results->dobra_subescapular == 0){echo "";} else{echo $results->dobra_subescapular;} ?>"/> mm
	    </div>
	</div>
	</div>


	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="dobra_abdominal">Abdominal</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_abdominal" id="dobra_abdominal" value="<?php if ($results->dobra_abdominal == 0){echo "";} else{echo $results->dobra_abdominal;} ?>"/> mm
	    </div>
	</div>

	<div class="span6">
	    <label class="control-label" for="dobra_coxa_medial">Coxa Medial</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_coxa_medial" id="dobra_coxa_medial" value="<?php if ($results->dobra_coxa_medial == 0){echo "";} else{echo $results->dobra_coxa_medial;} ?>"/> mm
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="dobra_pant_medial">Panturrilha</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_pant_medial" id="dobra_pant_medial" value="<?php if ($results->dobra_pant_medial == 0){echo "";} else{echo $results->dobra_pant_medial;} ?>"/> mm
	    </div>
	</div>

	<div class="span6">
	    <label class="control-label" for="dobra_torax">Tórax / Peito</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_torax" id="dobra_torax" value="<?php if ($results->dobra_torax == 0){echo "";} else{echo $results->dobra_torax;} ?>"/> mm
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="dobra_biceps">Bíceps</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_biceps" id="dobra_biceps" value="<?php if ($results->dobra_biceps == 0){echo "";} else{echo $results->dobra_biceps;} ?>"/> mm
	    </div>
	</div>

	<div class="span6">
	    <label class="control-label" for="dobra_axilar_media">Axilar Média</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_axilar_media" id="dobra_axilar_media" value="<?php if ($results->dobra_axilar_media == 0){echo "";} else{echo $results->dobra_axilar_media;} ?>"/> mm
	    </div>
	</div>
	</div>

	<div class="control-group">
	<div class="span6">
	    <label class="control-label" for="dobra_supra_iliaca">Supra Ilíaca</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_supra_iliaca" id="dobra_supra_iliaca" value="<?php if ($results->dobra_supra_iliaca == 0){echo "";} else{echo $results->dobra_supra_iliaca;} ?>"/> mm
	    </div>
	</div>

	<div class="span6">
	    <label class="control-label" for="dobra_supra_espinal">Supra Espinal</label>
	    <div class="controls">
	        <input type="text" class="span5" name="dobra_supra_espinal" id="dobra_supra_espinal" value="<?php if ($results->dobra_supra_espinal == 0){echo "";} else{echo $results->dobra_supra_espinal;} ?>"/> mm
	    </div>
	</div>
	</div>

<div class="form-actions" style="border:1px solid #e5e5e5">
    <div class="span12">
        <div class="span6 offset6">
            <button type="submit" style="margin-top: 3px;float: right;" class="btn btn-info"><i class="icon-save icon-white"></i> Gravar Alterações</button>
        	<a href="<?php echo base_url() ?>index.php/acompanhamento/editar/<?php echo $results->acompanhamento_id;?>" id="" class="btn" style="float: right;margin:3px 10px 0 0;"> Cancelar</a>
        </div>
    </div>
</div>

</div>
</div>

</form>

<script src="<?php echo base_url();?>js/maskmoney.js"></script>
<script>
$(document).ready(function(){
	$(".money").maskMoney();
});

$("#formAvaliacao").validate({
          rules:{
            peso: {required:true},
			altura: {required:true},
			pescoco: {required:true},
			torax: {required:true},
			abdominal: {required:true},
			cintura: {required:true},
			quadril: {required:true},
			braco_rel_esq: {required:true},
			braco_rel_dir: {required:true},
			braco_con_esq: {required:true},
			braco_con_dir: {required:true},
			antebraco_esq: {required:true},
			antebraco_dir: {required:true},
			coxa_esq: {required:true},
			coxa_dir: {required:true},
			perna_esq: {required:true},
			perna_dir: {required:true}
          },
          messages:{
            peso: {required: 'Campo Requerido.'},
			altura: {required: 'Campo Requerido.'},
			pescoco: {required: 'Campo Requerido.'},
			torax: {required: 'Campo Requerido.'},
			abdominal: {required: 'Campo Requerido.'},
			cintura: {required: 'Campo Requerido.'},
			quadril: {required: 'Campo Requerido.'},
			braco_rel_esq: {required: 'Campo Requerido.'},
			braco_rel_dir: {required: 'Campo Requerido.'},
			braco_con_esq: {required: 'Campo Requerido.'},
			braco_con_dir: {required: 'Campo Requerido.'},
			antebraco_esq: {required: 'Campo Requerido.'},
			antebraco_dir: {required: 'Campo Requerido.'},
			coxa_esq: {required: 'Campo Requerido.'},
			coxa_dir: {required: 'Campo Requerido.'},
			perna_esq: {required: 'Campo Requerido.'},
			perna_dir: {required: 'Campo Requerido.'}
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



function calcula_imc(){
var altura = document.getElementById('altura').value;
var peso = document.getElementById('peso').value;

if (altura > 0 && peso > 0){
var quadrado = (altura * altura);
var calculo = (peso/quadrado);

if(calculo<18.5){
$("#imc").text(parseFloat(calculo.toFixed(2)));
$("#inputimc").val(parseFloat(calculo.toFixed(2)));
$("#status").text("MAGRO");
$("#inputstatus").val("MAGRO");
}
else if(calculo>=18.5 && calculo<24.9){
$("#imc").text(parseFloat(calculo.toFixed(2)));
$("#inputimc").val(parseFloat(calculo.toFixed(2)));
$("#status").text("NORMAL");
$("#inputstatus").val("NORMAL");
}
else if(calculo>=25 && calculo<29.9) {
$("#imc").text(parseFloat(calculo.toFixed(2)));
$("#inputimc").val(parseFloat(calculo.toFixed(2)));
$("#status").text("SOBREPESO");
$("#inputstatus").val("SOBREPESO");
}
else if(calculo>=30 && calculo<39.9) {
$("#imc").text(parseFloat(calculo.toFixed(2)));
$("#inputimc").val(parseFloat(calculo.toFixed(2)));
$("#status").text("OBESIDADE");
$("#inputstatus").val("OBESIDADE");
}
else if (calculo>40){
$("#imc").text(parseFloat(calculo.toFixed(2)));
$("#inputimc").val(parseFloat(calculo.toFixed(2)));
$("#status").text("OBESIDADE GRAVE");
$("#inputstatus").val("OBESIDADE GRAVE");
}
}
}
window.setInterval('calcula_imc()', 1);
</script>
      