<?php

class Produtos extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('produtos_model', '', TRUE);
        $this->data['menuProdutos'] = 'Produtos';
    }

    function index(){
	   $this->gerenciar();
    }

    function gerenciar(){
        
        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/produtos/gerenciar/';
        $config['total_rows'] = $this->produtos_model->count('produtos');
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

	    $this->data['results'] = $this->produtos_model->get('produtos','idProdutos,descricao,unidade,precoCompra,precoVenda,estoque,estoqueMinimo','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'produtos/produtos';
       	$this->load->view('tema/topo',$this->data);	
    }


    function desativados(){
        
        $this->load->library('table');
        $this->load->library('pagination');
        
        
        $config['base_url'] = base_url().'index.php/produtos/desativados/';
        $config['total_rows'] = $this->produtos_model->countdesativados('produtos');
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

	    $this->data['results'] = $this->produtos_model->getdesativados('produtos','idProdutos,descricao,unidade,precoCompra,precoVenda,estoque,estoqueMinimo','',$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'produtos/produtosdesativados';
       	$this->load->view('tema/topo',$this->data);	
    }


    function adicionar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",","", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);
			    function randString($size){
			        $basic = '0123456789';
			        $return= "";
			        for($count= 0; $size > $count; $count++){
			            $return.= $basic[rand(0, strlen($basic) - 1)];
			        }
			        return $return;
			    }
            $data = array(
                'descricao' => set_value('descricao'),
                'unidade' => set_value('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => set_value('estoque'),
                'estoqueMinimo' => set_value('estoqueMinimo'),
                'codigo_barras' => randString(14)
            );

            if ($this->produtos_model->add('produtos', $data) == TRUE) {
                $this->session->set_flashdata('success','Produto adicionado com sucesso!');
                redirect(base_url() . 'index.php/produtos/adicionar/');
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured.</p></div>';
            }
        }
        $this->data['view'] = 'produtos/adicionarProduto';
        $this->load->view('tema/topo', $this->data);
     
    }

    function editar() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('produtos') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
            $precoCompra = $this->input->post('precoCompra');
            $precoCompra = str_replace(",","", $precoCompra);
            $precoVenda = $this->input->post('precoVenda');
            $precoVenda = str_replace(",", "", $precoVenda);
            $data = array(
                'descricao' => $this->input->post('descricao'),
                'unidade' => $this->input->post('unidade'),
                'precoCompra' => $precoCompra,
                'precoVenda' => $precoVenda,
                'estoque' => $this->input->post('estoque'),
                'estoqueMinimo' => $this->input->post('estoqueMinimo')
            );

            if ($this->produtos_model->edit('produtos', $data, 'idProdutos', $this->input->post('idProdutos')) == TRUE) {
                $this->session->set_flashdata('success','Produto editado com sucesso!');
                redirect(base_url() . 'index.php/produtos/editar/'.$this->input->post('idProdutos'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>An Error Occured</p></div>';
            }
        }

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        $this->data['view'] = 'produtos/editarProduto';
        $this->load->view('tema/topo', $this->data);
     
    }


    function visualizar() {
      

        $this->data['result'] = $this->produtos_model->getById($this->uri->segment(3));

        if($this->data['result'] == null){
            $this->session->set_flashdata('error','Produto não encontrado.');
            redirect(base_url() . 'index.php/produtos/editar/'.$this->input->post('idProdutos'));
        }

        $this->data['view'] = 'produtos/visualizarProduto';
        $this->load->view('tema/topo', $this->data);
     
    }
	
    function excluir(){

            if($this->session->userdata('nivel') != 1){
                $this->session->set_flashdata('error','Você não tem permissão para essa ação.');
                redirect('mapos');
            }
            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar excluir produto.');            
                redirect(base_url().'index.php/produtos/gerenciar/');
            }

            $this->db->where('idProdutos', $id);
            $this->db->set('ativo', 0);
            $this->db->update('produtos');             
            

            $this->session->set_flashdata('success','Produto excluido com sucesso!');            
            redirect(base_url().'index.php/produtos/gerenciar/');
    }


    function ativar(){

            if($this->session->userdata('nivel') != 1){
                $this->session->set_flashdata('error','Você não tem permissão para essa ação.');
                redirect('mapos');
            }
            
            $id =  $this->input->post('id');
            if ($id == null){

                $this->session->set_flashdata('error','Erro ao tentar reativar produto.');            
                redirect(base_url().'index.php/produtos/gerenciar/');
            }

            $this->db->where('idProdutos', $id);
            $this->db->set('ativo', 1);
            $this->db->update('produtos');             
            

            $this->session->set_flashdata('success','Produto reativado com sucesso!');            
            redirect(base_url().'index.php/produtos/gerenciar/');
    }

}

