<?php
class Acompanhamento_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

/* ############### GET GERAIS ############### */
    function get($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        $this->db->order_by('id','asc');
        $this->db->limit($perpage,$start);
        if($where){
            $this->db->where($where);
        }
        
        $query = $this->db->get();
        
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getByIdLogado($id){
        $this->db->where('idUsuarios',$id);
        $this->db->limit(1);
        return $this->db->get('usuarios')->row();	
    }

    function getById($id){
        $this->db->where('idClientes',$id);
        $this->db->limit(1);
        return $this->db->get('clientes')->row();
    }

/* ############### ACOMPANHAMENTO ############### */
    function getByIdAcompanhamento($id){
		$this->db->where('id',$id);
        $this->db->limit(1);
        return $this->db->get('acompanhamento')->row();
    }

	function countacompanhamento($table){
		return $this->db->count_all($table);
	}

/* ############### ADD E EDIT (ACOMPANHAMENTO E AVALIAÇÃO) ############### */
    function add($table,$data,$returnId = false){
        $this->db->insert($table, $data);         
        if ($this->db->affected_rows() == '1')
		{
        	if($returnId == true){
            	return $this->db->insert_id($table);
        	}
			return TRUE;
		}
		return FALSE;
    }

    function edit($table,$data,$id){
        $this->db->where('id',$id);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		return FALSE;       
    }

/* ############### AVALIAÇÃO ############### */
    function getAvaliacao($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('acompanhamento', 'acompanhamento.id = '.$table.'.acompanhamento_id');
        $this->db->join('usuarios', 'usuarios.idUsuarios = '.$table.'.usuarios_id');
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getAvaliacao_primeira_avaliacao($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('acompanhamento', 'acompanhamento.id = '.$table.'.acompanhamento_id');
        $this->db->join('usuarios', 'usuarios.idUsuarios = '.$table.'.usuarios_id');
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        $this->db->order_by('idAvaliacao','asc');
        $this->db->limit('1');
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getAvaliacao_penultima_avaliacao($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('acompanhamento', 'acompanhamento.id = '.$table.'.acompanhamento_id');
        $this->db->join('usuarios', 'usuarios.idUsuarios = '.$table.'.usuarios_id');
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        $this->db->order_by('idAvaliacao','desc');
        $this->db->limit('1','1');
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getAvaliacao_ultima_avaliacao($table,$fields,$where='',$perpage=0,$start=0,$one=false,$array='array'){
        $this->db->select($fields);
        $this->db->from($table);
        $this->db->join('acompanhamento', 'acompanhamento.id = '.$table.'.acompanhamento_id');
        $this->db->join('usuarios', 'usuarios.idUsuarios = '.$table.'.usuarios_id');
        $this->db->join('clientes', 'clientes.idClientes = '.$table.'.clientes_id');
        $this->db->order_by('idAvaliacao','desc');
        $this->db->limit('1');
        if($where){
            $this->db->where($where);
        }
        $query = $this->db->get();
        $result =  !$one  ? $query->result() : $query->row();
        return $result;
    }

    function getDadosAvaliacao($id){
		$this->db->where('idAvaliacao',$id);
        $this->db->limit(1);
        return $this->db->get('avaliacao')->row();
    }

    function edit_avaliacao($table,$data,$id){
        $this->db->where('idAvaliacao',$id);
        $this->db->update($table, $data);
        if ($this->db->affected_rows() >= 0)
		{
			return TRUE;
		}
		return FALSE;       
    }

/* ############### AUTOCOMPLETE ############### */
    public function autoCompleteCliente($q){
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nomeCliente', $q);
        $this->db->where('ativo',1);
        $query = $this->db->get('clientes');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nomeCliente'],'id'=>$row['idClientes']);
            }
            echo json_encode($row_set);
        }
    }

    public function autoCompleteUsuario($q){
        $this->db->select('*');
        $this->db->limit(5);
        $this->db->like('nome', $q);
        $this->db->where('situacao',1);
        $query = $this->db->get('usuarios');
        if($query->num_rows > 0){
            foreach ($query->result_array() as $row){
                $row_set[] = array('label'=>$row['nome'],'id'=>$row['idUsuarios']);
            }
            echo json_encode($row_set);
        }
    }
}