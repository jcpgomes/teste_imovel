<?php
    class Imovel_model extends CI_Model {
        function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function get_count() {
            return $this->db->count_all('imoveis');
        }

        public function get($limit, $start, $user_id){
            //echo($user_id);
            if($user_id > 0) {
                $this->db->where('usuario_id', $user_id);
            }
            //$this->db->join('usuarios', 'imoveis.usuario_id = usuarios.id');
            $this->db->limit($limit, $start);
            $this->db->order_by('imoveis.id', 'desc');
            $query = $this->db->get('imoveis');
            if($query->num_rows() > 0):
                return $query->result();
            else:
                return NULL;
            endif;
        }

        public function salvar($dados) {
            if(isset($dados['id']) && $dados['id'] > 0):
                $this->db->where('id', $dados['id']);
                unset($dados['id']);
                $this->db->update('imoveis', $dados);
                return $this->db->affected_rows();
            else:
                $this->db->insert('imoveis', $dados);
                return $this->db->insert_id();
            endif;
        }

        public function excluir($id=0) {
            $this->db->where('id', $id);
            $this->db->delete('imoveis');
            return $this->db->affected_rows();
        }

        public function get_single($id=0) {
            $this->db->where('id', $id);
            $query = $this->db->get('imoveis', 1);
            if($query->num_rows() == 1):
                $row = $query->row();
                return $row;
            else:
                return NULL;
            endif;
        }

        public function usuario_responsavel() {
            
        }
        
    }
?>