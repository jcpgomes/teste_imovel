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

                if(isset($imoveis) && sizeof($imoveis) > 0):
                    ?>
                        <table class="table table-striped">
                            <thead>
                                <th> Titulo</th>
                                <th> Ações </th>
                            </thead>
                            <tbody>
                                <?php 
                                    foreach($imoveis as $imovel):
                                ?>
                                    <tr>
                                        <td><?php echo $imovel->titulo;?></td>
                                        <td>
                                            <?php echo anchor('imoveis/editar/'.$imovel->id, 'Editar');?> |
                                            <a class="excluir" href="<?php echo base_url() . 'imoveis/excluir/' . $imovel->id; ?>">Excluir</a>

                                        </td>
                                    </tr>
                                <?php 
                                    endforeach;
                                ?>
                            </tbody>
                        </table>
                        <p><?php echo $links; ?></p>
                    <?php
                else:
                    echo "<div class='msg-box'><p>Nenhuma imovel cadastrada!</p></div>";
                endif;
            ?>
            
        </div>
    </div>
</div>
<?php $this->load->view('imoveis/footer'); ?>