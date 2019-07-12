<?php
    class Usuario_model extends CI_Model {
        public function __construct() {
            $this->load->database();
        }

        public function salvar($dados) {
            if(isset($dados['id']) && $dados['id'] > 0):
                $this->db->where('id', $dados['id']);
                unset($dados['id']);
                $this->db->update('usuarios', $dados);
                return $this->db->affected_rows();
            else:
                $this->db->insert('usuarios', $dados);
                return $this->db->insert_id();
            endif;
        }

        public function get_usuario($campo, $option_name) {
            $this->db->where($campo, $option_name);
            $query = $this->db->get('usuarios', 1);
            if($query->num_rows() == 1 ) {
                $row = $query->row();
                return $row->option_name;
            }
            else {
                return NULL;
            }
        }

        public function autenticarUsuario($dados) {
            $this->db->where('username', $dados['username']);
            $this->db->where('password', $dados['password']);
            $usuario = $this->db->get('usuarios')->row_array();
            return $usuario;
        }
    }
?>