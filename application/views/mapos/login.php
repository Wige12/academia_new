<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Entrar</title>
<link href="<?php echo base_url();?>assets/img/favicon.png" rel="shortcut icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="<?php echo base_url()?>css/bootstrap.min.css" />
        <script src="<?php echo base_url()?>js/jquery-1.10.2.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
<style>

body{background:#2e363f;}

#container_center{width: 390px;height:430px;z-index: 1;position: absolute;margin: auto;top: 0;right: 0;bottom: 0;left: 0;}

#container_login{width: 390px;height:215px;background-color: #fafbfa;z-index: 1;position: absolute;border-radius: 4px;box-shadow: 0 2px 3px rgba(0,0,0,0.25);-webkit-animation: popin 0.3s;animation: popin 0.3s;}

.top-bar{color: #5e697c;padding: 10px 20px 5px;font-size: 17px;text-align: left;font-family: open sans}
input[type="text"], input[type="password"]{width: 350px;padding: 5px;font-size: 13px;border: 1px solid #E0E4E8;box-shadow: none;border-radius: 3px;-webkit-transition: all 0.2s;-moz-transition: all 0.2s;transition: all 0.2s;font-weight: 400;font-size:14px;height:35px;color: #515967;outline: none;transition: all 0.3s;}

input[type="text"], input[type="password"] {height:27px;}
input[type="text"]:focus, input[type="password"]:focus {outline: none;border: 1px solid #5b7da8;box-shadow: 0 0 0 1px #5b7da8;transition: all 0.3s;color: #515967;}

input[type="submit"]{padding: 7px 0;width: 350px;max-width: none;margin: 10px 0 0 0;font-weight:bold;background-color: #5b7da8;border-bottom: 1px solid rgba(0,0,0,0.2);border-top: 1px solid #5b7da8;border-right: 1px solid #5b7da8;border-left: 1px solid #5b7da8;color: white;border-radius: 3px;font-weight: 600;-webkit-transition: all ease 0.3s;-moz-transition: all ease 0.3s;transition: all ease 0.3s;outline: none;}

</style>

</head>


<body>
<div id="container_center">
<center>
	<img src="<?php echo base_url()?>assets/img/logo.png" alt="Logo" />
</center>
<br />
<div id="container_login">
<p class="top-bar"><strong>Entrar</strong></p> 
<center>
<form  class="form-vertical" id="formLogin" method="post" action="<?php echo base_url()?>index.php/mapos/verificarLogin">
      <?php if($this->session->flashdata('error') != null){?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $this->session->flashdata('error');?>
           </div>
      <?php }?>
<input type="text" name="email" placeholder="Email" autofocus="" />
<br />
<input type="password" name="senha" placeholder="senha" style="margin: 10px 0 0 -3px;" />

<input type="submit" name="" value="Acessar" />
</form>
</center>

</div>
</div>
        <script src="<?php echo base_url()?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url()?>js/jquery.validate.js"></script>

        <script type="text/javascript">
            $(document).ready(function(){

                $('#email').focus();
                $("#formLogin").validate({
                     rules :{
                          email: { required: true, email: true},
                          senha: { required: true}
                    },
                    messages:{
                          email: { required: '', email: 'Insira Email válido'},
                          senha: { required: ''}
                    },
                   submitHandler: function( form ){       
                         var dados = $( form ).serialize();
                         
                    
                        $.ajax({
                          type: "POST",
                          url: "<?php echo base_url();?>index.php/mapos/verificarLogin?ajax=true",
                          data: dados,
                          dataType: 'json',
                          success: function(data)
                          {
                            if(data.result == true){
                                window.location.href = "<?php echo base_url();?>index.php/mapos";
                            }
                            else{
                                $('#call-modal').trigger('click');
                            }
                          }
                          });

                          return false;
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



        <a href="#notification" id="call-modal" role="button" class="btn" data-toggle="modal" style="display: none ">notification</a>

        <div id="notification" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h4 id="myModalLabel">Ops!</h4>
          </div>
          <div class="modal-body">
            <h5 style="text-align: center">Os dados de acesso estão incorretos, por favor tente novamente!</h5>
          </div>
          <div class="modal-footer">
            <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">Fechar</button>

          </div>
        </div>


    </body>

</html>