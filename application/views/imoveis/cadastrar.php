<?php $this->load->view('imoveis/header'); ?>
<div class="container container-content">
    <div class="row">
        <div class="column col-3">
            <div class="list-group">
                <a class="list-group-item" href="<?php echo base_url('imoveis/cadastrar');?>"> Cadastrar</a>
                <a class="list-group-item" href="<?php echo base_url('imoveis/listar');?>"> Listar</a>
            </div>
        </div>
        <div class="column col-9">
            <h4 class="content_h2"> <?php echo $h4; ?></h4>
            <?php
                if($msg = get_msg()):
                    echo '<div class="msg-box">'.$msg.'</div>';
                endif;

                echo form_open_multipart(); ?>

                <div class="row">
                    <div class="column col-12">
                    <div class="form-group">
                            <?php   
                                echo form_label('Tipo de imovel', 'cep');
                                $options = array(
                                    'Casa'         => 'Casa',
                                    'Apartamento'  => 'Apartamento',
                                    'Sala comencial' => 'Sala comencial',
                            );
                                echo form_dropdown('type', $options, 'Casa', array('class' => 'form-control', 'id' => 'type'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php   
                                echo form_label('Titulo', 'titulo');
                                echo form_input('titulo', set_value('titulo'), array('autofocus' => 'autofocus', 'class' => 'form-control', 'id' => 'titulo'));
                            ?>
                        </div>
                    </div>
                    <div class="column col-6">
                        <div class="form-group">
                            <?php   
                                echo form_label('Cep', 'cep');
                                echo form_input('cep', set_value('cep'), array('class' => 'form-control', 'id' => 'cep'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php   
                                echo form_label('Rua', 'rua');
                                echo form_input('rua', set_value('rua'), array('class' => 'form-control', 'id' => 'rua'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php   
                                echo form_label('Número', 'numero');
                                echo form_input('numero', set_value('numero'), array('class' => 'form-control', 'id' => 'numero'));
                            ?>
                        </div>

                        <div class="form-group">
                            <?php   
                                echo form_label('Preço do imovel R$', 'preco_imovel');
                                echo form_input('preco_imovel', set_value('preco_imovel'), array('class' => 'form-control', 'id' => 'numero'));
                            ?>
                        </div>
                    </div>
                    <div class="column col-6">
                        <div class="form-group">
                            <?php   
                                echo form_label('Bairro', 'bairro');
                                echo form_input('bairro', set_value('bairro'), array('autofocus' => 'autofocus', 'class' => 'form-control', 'id' => 'bairro'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php   
                                echo form_label('Cidade', 'cidade');
                                echo form_input('cidade', set_value('cidade'), array('class' => 'form-control', 'id' => 'cidade'));
                            ?>
                        </div>

                        <div class="form-group">
                            <?php   
                                echo form_label('UF', 'uf');
                                echo form_input('uf', set_value('uf'), array('class' => 'form-control', 'id' => 'uf'));
                            ?>
                        </div>
                        <div class="form-group">
                            <?php   
                                echo form_label('Quantidade de quartos', 'qtd_quarto');
                                echo form_input('qtd_quarto', set_value('qtd_quarto'), array('class' => 'form-control', 'id' => 'qtd_quarto'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php   
                        echo form_label('Descrição do imovel', 'descricao');
                        echo form_textarea('descricao', set_value('descricao'), array('class' => 'form-control'));
                    ?>
                </div>
                <div class="dados_condominio row">
                    <div class="column col-6">
                        <div class="form-group">
                            <?php   
                                echo form_label('Taxa condomino', 'taxa_consominio');
                                echo form_input('taxa_consominio', set_value('taxa_consominio'), array('class' => 'form-control', 'id' => 'taxa_consominio'));
                            ?>
                        </div>
                    </div>
                    <div class="column col-6">
                        <div class="form-group">
                            <?php   
                                echo form_label('Valor gás', 'valor_gas');
                                echo form_input('valor_gas', set_value('valor_gas'), array('class' => 'form-control', 'id' => 'valor_gas'));
                            ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php 
                        echo form_submit('enviar', 'Salvar noticia', array('class' => 'btn btn-primary'));
                        echo form_close();
                    ?>
                </div>            
        </div>
    </div>
</div>
<?php $this->load->view('imoveis/footer'); ?>