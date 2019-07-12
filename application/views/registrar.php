<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>" />
        <title><?php echo $titulo; ?></title>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css'); ?>" />
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="column col-3">&nbsp;</div>
                <div class="column col-6">
                    <h2><?php echo $h2; ?></h2>
                    <?php
                        if($msg = get_msg()):
                            echo '<div class="msg-box">'.$msg.'</div>';
                        endif;
                    ?>
                    <?php  echo form_open(); ?>
                    <div class="form-group">
                        <?php   
                            echo form_label('Nome para login', 'username');
                            echo form_input('username', set_value('username'), array('autofocus' => 'autofocus', 'class' => 'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <?php   
                            echo form_label('Email do administrador do site', 'email');
                            echo form_input('email', set_value('email'), array('class' => 'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <?php  
                            echo form_label('Senha', 'password');
                            echo form_password('password', set_value('password'), array('class' => 'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <?php 
                            echo form_label('Repita a senha', 'password2');
                            echo form_password('password2', set_value('password2'), array('class' => 'form-control'));
                        ?>
                    </div>
                    <div class="form-group">
                        <a href="login" class="pull-left ">Voltar</a>
                        <?php 
                            echo form_submit('enviar', 'Salvar dados', array('class' => 'btn btn-primary pull-right'));
                            echo form_close();
                        ?>
                    </div>
                </div>
                <div class="column col-3">&nbsp;</div>
            </div>
        </div>
    </body>
</html>