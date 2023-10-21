<?php

class Clientes extends CI_Controller {
    

    function __construct() {
        parent::__construct();
            if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('mapos/login');
            }
            $this->load->helper(array('codegen_helper'));
            $this->load->model('clientes_model','',TRUE);
            $this->data['menuClientes'] = 'clientes';
	}	
	
	function index(){
		$this->gerenciar();
	}


	function gerenciar(){
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/clientes/gerenciar/';
        $config['total_rows'] = $this->clientes_model->count('clientes');
        $config['per_page'] = 100;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config); 	
        
	    $this->data['results'] = $this->clientes_model->get('clientes','idClientes,nomeCliente,nascimento,telefone,telefone2,rua,numero,bairro,cidade,estado,cep,update','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'clientes/clientes';
       	$this->load->view('tema/topo',$this->data);
    }


	function desativados(){
        $this->load->library('table');
        $this->load->library('pagination');
        
   
        $config['base_url'] = base_url().'index.php/clientes/desativados/';
        $config['total_rows'] = $this->clientes_model->countdesativados('clientes');
        $config['per_page'] = 100;
        $config['next_link'] = 'Próxima';
        $config['prev_link'] = 'Anterior';
        $config['full_tag_open'] = '<div class="pagination alternate"><ul>';
        $config['full_tag_close'] = '</ul></div>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li><a style="color: #2D335B"><b>';
        $config['cur_tag_close'] = '</b></a></li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['first_link'] = 'Primeira';
        $config['last_link'] = 'Última';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        
        $this->pagination->initialize($config); 	
        
	    $this->data['results'] = $this->clientes_model->getdesativados('clientes','idClientes,nomeCliente,nascimento,telefone,telefone2,rua,numero,bairro,cidade,estado,cep,update','',$config['per_page'],$this->uri->segment(3));
       	
       	$this->data['view'] = 'clientes/clientesdesativados';
       	$this->load->view('tema/topo',$this->data);
	}

	
    function adicionar() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        	  $nascimento = $this->input->post('nascimento');

            try {  
                $nascimento = explode('/', $nascimento);
                $nascimento = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];

            } catch (Exception $e) {
               $nascimento = date('Y/m/d'); 
            }
            $data = array(
                'nomeCliente' => set_value('nomeCliente'),
                'nascimento' => $nascimento,
                'telefone' => set_value('telefone'),
                'telefone2' => set_value('telefone2'),
                'rua' => set_value('rua'),
                'numero' => set_value('numero'),
                'bairro' => set_value('bairro'),
                'cidade' => set_value('cidade'),
                'estado' => set_value('estado'),
                'cep' => set_value('cep'),
                'update' => set_value('update'),
                'dataCadastro' => date('Y-m-d')
            );

            if ($this->clientes_model->add('clientes', $data) == TRUE) {
                $this->session->set_flashdata('success','Cliente adicionado com sucesso!');
                redirect(base_url() . 'index.php/clientes/clientes/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }
        $this->data['view'] = 'clientes/adicionarCliente';
        $this->load->view('tema/topo', $this->data);

    }

    function editar() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('clientes') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        	$nascimento = $this->input->post('nascimento');

            try {  
                $nascimento = explode('/', $nascimento);
                $nascimento = $nascimento[2].'-'.$nascimento[1].'-'.$nascimento[0];

            } catch (Exception $e) {
               $nascimento = date('Y/m/d'); 
            }
            $data = array(
                'nomeCliente' => $this->input->post('nomeCliente'),
                'nascimento' => $nascimento,
                'telefone' => $this->input->post('telefone'),
                'telefone2' => $this->input->post('telefone2'),
                'rua' => $this->input->post('rua'),
                'numero' => $this->input->post('numero'),
                'bairro' => $this->input->post('bairro'),
                'cidade' => $this->input->post('cidade'),
                'estado' => $this->input->post('estado'),
                'cep' => $this->input->post('cep'),
                'update' => $this->input->post('update')
            );

            if ($this->clientes_model->edit('clientes', $data, 'idClientes', $this->input->post('idClientes')) == TRUE) {
                $this->session->set_flashdata('success','Cliente editado com sucesso!');
                redirect(base_url() . 'index.php/clientes/clientes');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }


        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['view'] = 'clientes/editarCliente';
        $this->load->view('tema/topo', $this->data);

    }

    public function visualizar(){

        $this->data['custom_error'] = '';
        $this->data['result'] = $this->clientes_model->getById($this->uri->segment(3));
        $this->data['results'] = $this->clientes_model->getOsByCliente($this->uri->segment(3));
        $this->data['transacoes'] = $this->clientes_model->getLancamentosByCliente($this->uri->segment(3));
        $this->data['view'] = 'clientes/visualizar';
        $this->load->view('tema/topo', $this->data);

        
    }
	
    public function excluir(){

            if($this->session->userdata('nivel') != 1){
                $this->session->set_flashdata('error','Você não tem permissão para essa ação.');
                redirect('mapos');
            }
            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir cliente.');            
                redirect(base_url().'index.php/clientes/gerenciar/');
            }

            $this->db->where('idClientes', $id);
            $this->db->set('ativo', 0);
            $this->db->update('clientes');


            $this->session->set_flashdata('success','Cliente excluido com sucesso!');            
            redirect(base_url().'index.php/clientes/gerenciar/');
    }



    public function ativar(){

            if($this->session->userdata('nivel') != 1){
                $this->session->set_flashdata('error','Você não tem permissão para essa ação.');
                redirect('mapos');
            }
            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar reativar cliente.');            
                redirect(base_url().'index.php/clientes/gerenciar/');
            }

            $this->db->where('idClientes', $id);
            $this->db->set('ativo', 1);
            $this->db->update('clientes');


            $this->session->set_flashdata('success','Cliente excluido com sucesso!');            
            redirect(base_url().'index.php/clientes/gerenciar/');
    }
}

