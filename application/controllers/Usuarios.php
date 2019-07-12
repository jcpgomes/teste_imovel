<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->model('usuario_model', 'usuario');
    }

	public function index()
	{
        redirect('login', 'reflesh');
    }
    
    public function login() {

        $this->form_validation->set_rules('username', 'NOME', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('password', 'SENHA', 'trim|required|min_length[6]');

        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());               
            endif;
        else:
            $dados_form = $this->input->post();
            $usuario = $this->usuario->autenticarUsuario($dados_form);
            if($usuario):
                $this->session->set_userdata('logged', TRUE);
                $this->session->set_userdata('usuario', $usuario);
                redirect("imoveis", 'refresh');
            else:
                set_msg('<p>Usuário inexistente!</p>');
            endif;
        endif;

        $dados['titulo'] = "Cadastrar imovel - Fazer login";
        $dados['h2'] = "Fazer login";
        $this->load->view('login', $dados);
    }

    public function registrar () {

        $this->form_validation->set_rules('username', 'NOME', 'trim|required|min_length[5]');
        $this->form_validation->set_rules('email', 'EMAIL', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'SENHA', 'trim|required|min_length[6]');
        $this->form_validation->set_rules('password2', 'REPITA A SENHA', 'trim|required|min_length[6]|matches[password]');

        if($this->form_validation->run() == FALSE):
            if(validation_errors()):
                set_msg(validation_errors());               
            endif;
        else:
            $dados_form = $this->input->post();
            $dados_insert['username'] = $dados_form['username'];
            $dados_insert['email'] = $dados_form['email'];
            //$dados_insert['password'] = password_hash($dados_form['password'], PASSWORD_DEFAULT);
            $dados_insert['password'] = $dados_form['password'];

            if($id = $this->usuario->salvar($dados_insert)):
                set_msg("Usuário registrada com sucesso!");
                redirect('login', 'reflesh');
            else:
                set_msg("Erro! Usuário não cadastrada.");
            endif;
        endif;
        $dados['titulo'] = "Cadastrar imovel - registrar usuario";
        $dados['h2'] = "Cadastrar";
        $this->load->view('registrar', $dados);
    }
}