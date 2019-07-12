<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imoveis extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library("pagination");
        $this->load->library('form_validation');
        $this->load->model('imovel_model', 'imovel');
        $this->load->model('usuario_model', 'usuario');
    }

	public function index()
	{
        redirect('listar', 'reflesh');
    }
    
    public function listar() {
        verifica_login();
        $session = $this->session->userdata();
        $dados['username'] = $session['usuario']['username'];
        $dados['titulo'] = "Listagem de imoveis";
        $dados['h4'] = "listagem de imoveis";
        $dados['tela'] = "listar";
        $user_id = $session['usuario']['id'];
        $config = array();
        $config["base_url"] = base_url() . "imoveis/listar";
        $config["total_rows"] = $this->imovel->get_count();
        $config["per_page"] = 2;
        $config['prev_link'] = '<';
        $config['first_link'] = '<<';
        $config['last_link'] = '>>';
        $config['next_link'] = '>';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tag_close']  = '<span aria-hidden="true"></span></span></li>';
        // $config['next_tag_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tag_close']  = '</span></li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tag_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tag_close']  = '</span></li>';
        
        
        //$config["uri_segment"] =2;
        //var_dump($config);
        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? ($this->uri->segment(3) - 1) : 0;
        //$page = 0;
        $dados["links"] = $this->pagination->create_links();

        $dados['imoveis'] = $this->imovel->get($config["per_page"], $page, $user_id);
        /* echo "<pre>";
        print_r($dados['imoveis']); */
		$this->load->view('imoveis/listar', $dados);
    }

    public function cadastrar() {
        verifica_login();
        $session = $this->session->userdata();
        $user_id = $session['usuario']['id'];
        $dados['username'] = $session['usuario']['username'];

        $this->form_validation->set_rules('cep', 'Cep', 'trim|required');
        $this->form_validation->set_rules('rua', 'Rua', 'trim|required');
        $this->form_validation->set_rules('numero', 'Número', 'trim|required');
        $this->form_validation->set_rules('bairro', 'bairro', 'trim|required');
        $this->form_validation->set_rules('cidade', 'cidade', 'trim|required');
        $this->form_validation->set_rules('uf', 'UF', 'trim|required');
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required');

        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());               
            endif;
        else:
            $dados_form = $this->input->post();

            $dados_insert['type'] = $dados_form['type'];
            $dados_insert['cep'] = $dados_form['cep'];
            $dados_insert['rua'] = $dados_form['rua'];
            $dados_insert['numero'] = $dados_form['numero'];
            $dados_insert['rua'] = $dados_form['rua'];
            $dados_insert['cidade'] = $dados_form['cidade'];
            $dados_insert['titulo'] = $dados_form['titulo'];
            $dados_insert['usuario_id'] = $user_id;
            $dados_update['bairro'] = $dados_form['bairro'];
            $dados_update['uf'] = $dados_form['uf'];
            $dados_update['descricao'] = $dados_form['descricao']; 
            $dados_update['preco_imovel'] = $dados_form['preco_imovel'];
            $dados_update['qtd_quarto'] = $dados_form['qtd_quarto']; 
            
            if($dados_form['type'] != "Casa") {
                $dados_update['taxa_consominio'] = $dados_form['taxa_consominio']; 
                $dados_update['valor_gas'] = $dados_form['valor_gas']; 
            }

            if($id = $this->imovel->salvar($dados_insert)):
                set_msg("Imovel registrada com sucesso!");
                redirect('imoveis/listar', 'reflesh');
            else:
                set_msg("Erro! Imovel não cadastrada.");
            endif;
        endif;
        
        $dados['titulo'] = "Cadastrar imoveis";
        $dados['h4'] = "Cadastrar imoveis";
        $dados['tela'] = "Cadastrar";
        $this->load->view('imoveis/cadastrar', $dados);

    }

    public function logout() {
        $this->session->unset_userdata('logged');
        $this->session->unset_userdata('usuario');
        set_msg('<p>Você saiu do sistema!</p>');
        redirect("usuarios/login", "refreshs");
    }

    public function excluir($id) {
        if($this->imovel->excluir($id)):
            set_msg("<p>Imovel excluida com sucesso!</p>");
            redirect('imoveis/listar', 'reflesh');
        else:
            set_msg("<p>Erro! nenhuma notícia excluida.</p>");
        endif;
    }

    public function editar () {
        verifica_login();

        $id = $this->uri->segment(3);

        if($id > 0):
            if($imovel = $this->imovel->get_single($id)):
                $dados['imovel'] = $imovel;
                $dados_update['id'] = $imovel->id;
            else:
                set_msg("<p>Imovel inexistente! Escolha um imovel para editar!</p>");
                redirect('imoveis/listar', 'reflesh');
            endif;
        else:
            set_msg("<p>Você deve escolher um imovel para editar!</p>");
            redirect('imoveis/listar', 'reflesh');
        endif;

        $this->form_validation->set_rules('cep', 'Cep', 'trim|required');
        $this->form_validation->set_rules('rua', 'Rua', 'trim|required');
        $this->form_validation->set_rules('numero', 'Número', 'trim|required');
        $this->form_validation->set_rules('bairro', 'bairro', 'trim|required');
        $this->form_validation->set_rules('cidade', 'cidade', 'trim|required');
        $this->form_validation->set_rules('uf', 'UF', 'trim|required');
        $this->form_validation->set_rules('titulo', 'Titulo', 'trim|required');

        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());               
            endif;
        else:

            $dados_form = $this->input->post();

            $dados_update['titulo'] = $dados_form['titulo'];
            $dados_update['type'] = $dados_form['type'];
            $dados_update['cep'] = $dados_form['cep'];
            $dados_update['rua'] = $dados_form['rua'];
            $dados_update['numero'] = $dados_form['numero'];
            $dados_update['rua'] = $dados_form['rua'];
            $dados_update['cidade'] = $dados_form['cidade'];
            $dados_update['bairro'] = $dados_form['bairro'];
            $dados_update['uf'] = $dados_form['uf'];
            $dados_update['descricao'] = $dados_form['descricao'];
            $dados_update['preco_imovel'] = $dados_form['preco_imovel'];
            $dados_update['qtd_quarto'] = $dados_form['qtd_quarto']; 

            if($imovel->type != "Casa") {
                $dados_update['taxa_consominio'] = $dados_form['taxa_consominio']; 
                $dados_update['valor_gas'] = $dados_form['valor_gas']; 
            }

            if($id = $this->imovel->salvar($dados_update)):
                set_msg("Imovel registrada com sucesso!");
                redirect('imoveis/listar', 'reflesh');
            else:
                set_msg("Erro! Imovel não cadastrada.");
            endif;

        endif;
        $session = $this->session->userdata();
        $dados['username'] = $session['usuario']['username'];
        $dados['titulo'] = "Editar imoveis";
        $dados['h4'] = "Editar imoveis";
        $dados['tela'] = "Editar";
        $this->load->view('imoveis/editar', $dados);
    }
}
