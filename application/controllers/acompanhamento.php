<?php
class Acompanhamento extends CI_Controller {

    function __construct() {
        parent::__construct();
        if ((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->load->helper(array('form', 'codegen_helper'));
        $this->load->model('acompanhamento_model', '', TRUE);
        $this->data['menuAcompanhamento'] = 'Acompanhamento';
    }

/* ############### ACOMPANHAMENTO ############### */
    function index(){
	   $this->acompanhamento();
    }

    function acompanhamento(){
        
        $this->load->library('table');
        $this->load->library('pagination');  
        
        $config['base_url'] = base_url().'acompanhamento/acompanhamento';
        $config['total_rows'] = $this->acompanhamento_model->countacompanhamento('acompanhamento');
        $config['per_page'] = 10000;
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

		$this->data['results'] = $this->acompanhamento_model->get('acompanhamento','*','',$config['per_page'],$this->uri->segment(3));

	    $this->data['view'] = 'acompanhamento/acompanhamento';
       	$this->load->view('tema/topo',$this->data);	
    }

/* ############### ADICIONAR ACOMPANHAMENTO ############### */
    function adicionar(){
        $this->data['usuario'] = $this->acompanhamento_model->getByIdLogado($this->session->userdata('id'));

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('adicionaracompanhamento') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        }else {
        if($this->input->post('clientes_id') == 0){
				$this->session->set_flashdata('error',"É necessário cadastrar o aluno <b>".$this->input->post('cliente')."</b> para iniciar o acompanhamento. Acesse o menu <b>Alunos > Adicionar Aluno</b>");
				redirect('acompanhamento');
		}else{
            $data = array(
                'clientes_id' => $this->input->post('clientes_id'),
                'last_update' => date('y/m/d')
            );

            if (is_numeric($id = $this->acompanhamento_model->add('acompanhamento', $data, true)) ) {
                $this->session->set_flashdata('success','Acompanhamento do Aluno <b>'.$this->input->post('cliente').'</b> iniciado.');
                redirect('acompanhamento/editar/'.$id);

            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
       }
        }
         
        $this->data['view'] = 'acompanhamento/acompanhamento';
        $this->load->view('tema/topo', $this->data);
    }

/* ############### EDITAR ACOMPANHAMENTO ############### */
    function editar() {
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';

        if ($this->form_validation->run('acompanhamento') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
        	if($this->input->post('obj_prazo')>0){
	        	$obj_prazo = strtotime("+".$this->input->post('obj_prazo')."months");
				$obj_prazo_data = date('Y/m/d',$obj_prazo);	
			}else{
				$obj_prazo_data = date('0000/00/00');
			}
            $data = array(
                'obj_1' => $this->input->post('obj_1'),
                'obj_2' => $this->input->post('obj_2'),
                'obj_peso' => $this->input->post('obj_peso'),
                'obj_prazo' => $this->input->post('obj_prazo'),
                'obj_prazo_data' => $obj_prazo_data,
                'q1' => $this->input->post('q1'),
                'q2' => $this->input->post('q2'),
                'q3' => $this->input->post('q3'),
                'q4' => $this->input->post('q4'),
                'q5' => $this->input->post('q5'),
                'q6' => $this->input->post('q6'),
                'q7' => $this->input->post('q7'),
                'tel_emergencia' => $this->input->post('tel_emergencia'),
                'resp_emergencia' => $this->input->post('resp_emergencia'),
                'tel_extra_emergencia' => $this->input->post('tel_extra_emergencia'),
                'a1' => $this->input->post('a1'),
                'a2_1' => $this->input->post('a2_1'),
                'a2_2' => $this->input->post('a2_2'),
                'a2_3' => $this->input->post('a2_3'),
                'a2_4' => $this->input->post('a2_4'),
                'a2_5' => $this->input->post('a2_5'),
                'a2_6' => $this->input->post('a2_6'),
                'a2_7' => $this->input->post('a2_7'),
                'a2_8' => $this->input->post('a2_8'),
                'a2_9' => $this->input->post('a2_9'),
                'a2_10' => $this->input->post('a2_10'),
                'a2_11' => $this->input->post('a2_11'),
                'a2_12' => $this->input->post('a2_12'),
                'a3_1' => $this->input->post('a3_1'),
                'a3_2' => $this->input->post('a3_2'),
                'a3_3' => $this->input->post('a3_3'),
                'a4' => $this->input->post('a4'),
                'a5' => $this->input->post('a5'),
                'a6' => $this->input->post('a6'),
                'a6_1' => $this->input->post('a6_1'),
                'a7_1' => $this->input->post('a7_1'),
                'a7_2' => $this->input->post('a7_2'),
                'a8_1' => $this->input->post('a8_1'),
                'a8_2' => $this->input->post('a8_2'),
                'a9_1' => $this->input->post('a9_1'),
                'a9_2' => $this->input->post('a9_2'),
                'a9_3' => $this->input->post('a9_3'),
                'a9_4' => $this->input->post('a9_4'),
                'seg_exe1' => $this->input->post('seg_exe1'),
				'seg_exe2' => $this->input->post('seg_exe2'),
				'seg_exe3' => $this->input->post('seg_exe3'),
				'seg_exe4' => $this->input->post('seg_exe4'),
				'seg_exe5' => $this->input->post('seg_exe5'),
				'seg_exe6' => $this->input->post('seg_exe6'),
				'seg_exe7' => $this->input->post('seg_exe7'),
				'seg_exe8' => $this->input->post('seg_exe8'),
				'seg_exe9' => $this->input->post('seg_exe9'),
				'seg_exe10' => $this->input->post('seg_exe10'),
				'seg_serie1' => $this->input->post('seg_serie1'),
				'seg_serie2' => $this->input->post('seg_serie2'),
				'seg_serie3' => $this->input->post('seg_serie3'),
				'seg_serie4' => $this->input->post('seg_serie4'),
				'seg_serie5' => $this->input->post('seg_serie5'),
				'seg_serie6' => $this->input->post('seg_serie6'),
				'seg_serie7' => $this->input->post('seg_serie7'),
				'seg_serie8' => $this->input->post('seg_serie8'),
				'seg_serie9' => $this->input->post('seg_serie9'),
				'seg_serie10' => $this->input->post('seg_serie10'),
				'seg_rep1' => $this->input->post('seg_rep1'),
				'seg_rep2' => $this->input->post('seg_rep2'),
				'seg_rep3' => $this->input->post('seg_rep3'),
				'seg_rep4' => $this->input->post('seg_rep4'),
				'seg_rep5' => $this->input->post('seg_rep5'),
				'seg_rep6' => $this->input->post('seg_rep6'),
				'seg_rep7' => $this->input->post('seg_rep7'),
				'seg_rep8' => $this->input->post('seg_rep8'),
				'seg_rep9' => $this->input->post('seg_rep9'),
				'seg_rep10' => $this->input->post('seg_rep10'),
				'seg_obs1' => $this->input->post('seg_obs1'),
				'seg_obs2' => $this->input->post('seg_obs2'),
				'seg_obs3' => $this->input->post('seg_obs3'),
				'seg_obs4' => $this->input->post('seg_obs4'),
				'seg_obs5' => $this->input->post('seg_obs5'),
				'seg_obs6' => $this->input->post('seg_obs6'),
				'seg_obs7' => $this->input->post('seg_obs7'),
				'seg_obs8' => $this->input->post('seg_obs8'),
				'seg_obs9' => $this->input->post('seg_obs9'),
				'seg_obs10' => $this->input->post('seg_obs10'),
				'ter_exe1' => $this->input->post('ter_exe1'),
				'ter_exe2' => $this->input->post('ter_exe2'),
				'ter_exe3' => $this->input->post('ter_exe3'),
				'ter_exe4' => $this->input->post('ter_exe4'),
				'ter_exe5' => $this->input->post('ter_exe5'),
				'ter_exe6' => $this->input->post('ter_exe6'),
				'ter_exe7' => $this->input->post('ter_exe7'),
				'ter_exe8' => $this->input->post('ter_exe8'),
				'ter_exe9' => $this->input->post('ter_exe9'),
				'ter_exe10' => $this->input->post('ter_exe10'),
				'ter_serie1' => $this->input->post('ter_serie1'),
				'ter_serie2' => $this->input->post('ter_serie2'),
				'ter_serie3' => $this->input->post('ter_serie3'),
				'ter_serie4' => $this->input->post('ter_serie4'),
				'ter_serie5' => $this->input->post('ter_serie5'),
				'ter_serie6' => $this->input->post('ter_serie6'),
				'ter_serie7' => $this->input->post('ter_serie7'),
				'ter_serie8' => $this->input->post('ter_serie8'),
				'ter_serie9' => $this->input->post('ter_serie9'),
				'ter_serie10' => $this->input->post('ter_serie10'),
				'ter_rep1' => $this->input->post('ter_rep1'),
				'ter_rep2' => $this->input->post('ter_rep2'),
				'ter_rep3' => $this->input->post('ter_rep3'),
				'ter_rep4' => $this->input->post('ter_rep4'),
				'ter_rep5' => $this->input->post('ter_rep5'),
				'ter_rep6' => $this->input->post('ter_rep6'),
				'ter_rep7' => $this->input->post('ter_rep7'),
				'ter_rep8' => $this->input->post('ter_rep8'),
				'ter_rep9' => $this->input->post('ter_rep9'),
				'ter_rep10' => $this->input->post('ter_rep10'),
				'ter_obs1' => $this->input->post('ter_obs1'),
				'ter_obs2' => $this->input->post('ter_obs2'),
				'ter_obs3' => $this->input->post('ter_obs3'),
				'ter_obs4' => $this->input->post('ter_obs4'),
				'ter_obs5' => $this->input->post('ter_obs5'),
				'ter_obs6' => $this->input->post('ter_obs6'),
				'ter_obs7' => $this->input->post('ter_obs7'),
				'ter_obs8' => $this->input->post('ter_obs8'),
				'ter_obs9' => $this->input->post('ter_obs9'),
				'ter_obs10' => $this->input->post('ter_obs10'),
				'qua_exe1' => $this->input->post('qua_exe1'),
				'qua_exe2' => $this->input->post('qua_exe2'),
				'qua_exe3' => $this->input->post('qua_exe3'),
				'qua_exe4' => $this->input->post('qua_exe4'),
				'qua_exe5' => $this->input->post('qua_exe5'),
				'qua_exe6' => $this->input->post('qua_exe6'),
				'qua_exe7' => $this->input->post('qua_exe7'),
				'qua_exe8' => $this->input->post('qua_exe8'),
				'qua_exe9' => $this->input->post('qua_exe9'),
				'qua_exe10' => $this->input->post('qua_exe10'),
				'qua_serie1' => $this->input->post('qua_serie1'),
				'qua_serie2' => $this->input->post('qua_serie2'),
				'qua_serie3' => $this->input->post('qua_serie3'),
				'qua_serie4' => $this->input->post('qua_serie4'),
				'qua_serie5' => $this->input->post('qua_serie5'),
				'qua_serie6' => $this->input->post('qua_serie6'),
				'qua_serie7' => $this->input->post('qua_serie7'),
				'qua_serie8' => $this->input->post('qua_serie8'),
				'qua_serie9' => $this->input->post('qua_serie9'),
				'qua_serie10' => $this->input->post('qua_serie10'),
				'qua_rep1' => $this->input->post('qua_rep1'),
				'qua_rep2' => $this->input->post('qua_rep2'),
				'qua_rep3' => $this->input->post('qua_rep3'),
				'qua_rep4' => $this->input->post('qua_rep4'),
				'qua_rep5' => $this->input->post('qua_rep5'),
				'qua_rep6' => $this->input->post('qua_rep6'),
				'qua_rep7' => $this->input->post('qua_rep7'),
				'qua_rep8' => $this->input->post('qua_rep8'),
				'qua_rep9' => $this->input->post('qua_rep9'),
				'qua_rep10' => $this->input->post('qua_rep10'),
				'qua_obs1' => $this->input->post('qua_obs1'),
				'qua_obs2' => $this->input->post('qua_obs2'),
				'qua_obs3' => $this->input->post('qua_obs3'),
				'qua_obs4' => $this->input->post('qua_obs4'),
				'qua_obs5' => $this->input->post('qua_obs5'),
				'qua_obs6' => $this->input->post('qua_obs6'),
				'qua_obs7' => $this->input->post('qua_obs7'),
				'qua_obs8' => $this->input->post('qua_obs8'),
				'qua_obs9' => $this->input->post('qua_obs9'),
				'qua_obs10' => $this->input->post('qua_obs10'),
				'qui_exe1' => $this->input->post('qui_exe1'),
				'qui_exe2' => $this->input->post('qui_exe2'),
				'qui_exe3' => $this->input->post('qui_exe3'),
				'qui_exe4' => $this->input->post('qui_exe4'),
				'qui_exe5' => $this->input->post('qui_exe5'),
				'qui_exe6' => $this->input->post('qui_exe6'),
				'qui_exe7' => $this->input->post('qui_exe7'),
				'qui_exe8' => $this->input->post('qui_exe8'),
				'qui_exe9' => $this->input->post('qui_exe9'),
				'qui_exe10' => $this->input->post('qui_exe10'),
				'qui_serie1' => $this->input->post('qui_serie1'),
				'qui_serie2' => $this->input->post('qui_serie2'),
				'qui_serie3' => $this->input->post('qui_serie3'),
				'qui_serie4' => $this->input->post('qui_serie4'),
				'qui_serie5' => $this->input->post('qui_serie5'),
				'qui_serie6' => $this->input->post('qui_serie6'),
				'qui_serie7' => $this->input->post('qui_serie7'),
				'qui_serie8' => $this->input->post('qui_serie8'),
				'qui_serie9' => $this->input->post('qui_serie9'),
				'qui_serie10' => $this->input->post('qui_serie10'),
				'qui_rep1' => $this->input->post('qui_rep1'),
				'qui_rep2' => $this->input->post('qui_rep2'),
				'qui_rep3' => $this->input->post('qui_rep3'),
				'qui_rep4' => $this->input->post('qui_rep4'),
				'qui_rep5' => $this->input->post('qui_rep5'),
				'qui_rep6' => $this->input->post('qui_rep6'),
				'qui_rep7' => $this->input->post('qui_rep7'),
				'qui_rep8' => $this->input->post('qui_rep8'),
				'qui_rep9' => $this->input->post('qui_rep9'),
				'qui_rep10' => $this->input->post('qui_rep10'),
				'qui_obs1' => $this->input->post('qui_obs1'),
				'qui_obs2' => $this->input->post('qui_obs2'),
				'qui_obs3' => $this->input->post('qui_obs3'),
				'qui_obs4' => $this->input->post('qui_obs4'),
				'qui_obs5' => $this->input->post('qui_obs5'),
				'qui_obs6' => $this->input->post('qui_obs6'),
				'qui_obs7' => $this->input->post('qui_obs7'),
				'qui_obs8' => $this->input->post('qui_obs8'),
				'qui_obs9' => $this->input->post('qui_obs9'),
				'qui_obs10' => $this->input->post('qui_obs10'),
				'sex_exe1' => $this->input->post('sex_exe1'),
				'sex_exe2' => $this->input->post('sex_exe2'),
				'sex_exe3' => $this->input->post('sex_exe3'),
				'sex_exe4' => $this->input->post('sex_exe4'),
				'sex_exe5' => $this->input->post('sex_exe5'),
				'sex_exe6' => $this->input->post('sex_exe6'),
				'sex_exe7' => $this->input->post('sex_exe7'),
				'sex_exe8' => $this->input->post('sex_exe8'),
				'sex_exe9' => $this->input->post('sex_exe9'),
				'sex_exe10' => $this->input->post('sex_exe10'),
				'sex_serie1' => $this->input->post('sex_serie1'),
				'sex_serie2' => $this->input->post('sex_serie2'),
				'sex_serie3' => $this->input->post('sex_serie3'),
				'sex_serie4' => $this->input->post('sex_serie4'),
				'sex_serie5' => $this->input->post('sex_serie5'),
				'sex_serie6' => $this->input->post('sex_serie6'),
				'sex_serie7' => $this->input->post('sex_serie7'),
				'sex_serie8' => $this->input->post('sex_serie8'),
				'sex_serie9' => $this->input->post('sex_serie9'),
				'sex_serie10' => $this->input->post('sex_serie10'),
				'sex_rep1' => $this->input->post('sex_rep1'),
				'sex_rep2' => $this->input->post('sex_rep2'),
				'sex_rep3' => $this->input->post('sex_rep3'),
				'sex_rep4' => $this->input->post('sex_rep4'),
				'sex_rep5' => $this->input->post('sex_rep5'),
				'sex_rep6' => $this->input->post('sex_rep6'),
				'sex_rep7' => $this->input->post('sex_rep7'),
				'sex_rep8' => $this->input->post('sex_rep8'),
				'sex_rep9' => $this->input->post('sex_rep9'),
				'sex_rep10' => $this->input->post('sex_rep10'),
				'sex_obs1' => $this->input->post('sex_obs1'),
				'sex_obs2' => $this->input->post('sex_obs2'),
				'sex_obs3' => $this->input->post('sex_obs3'),
				'sex_obs4' => $this->input->post('sex_obs4'),
				'sex_obs5' => $this->input->post('sex_obs5'),
				'sex_obs6' => $this->input->post('sex_obs6'),
				'sex_obs7' => $this->input->post('sex_obs7'),
				'sex_obs8' => $this->input->post('sex_obs8'),
				'sex_obs9' => $this->input->post('sex_obs9'),
				'sex_obs10' => $this->input->post('sex_obs10'),
				'sab_exe1' => $this->input->post('sab_exe1'),
				'sab_exe2' => $this->input->post('sab_exe2'),
				'sab_exe3' => $this->input->post('sab_exe3'),
				'sab_exe4' => $this->input->post('sab_exe4'),
				'sab_exe5' => $this->input->post('sab_exe5'),
				'sab_exe6' => $this->input->post('sab_exe6'),
				'sab_exe7' => $this->input->post('sab_exe7'),
				'sab_exe8' => $this->input->post('sab_exe8'),
				'sab_exe9' => $this->input->post('sab_exe9'),
				'sab_exe10' => $this->input->post('sab_exe10'),
				'sab_serie1' => $this->input->post('sab_serie1'),
				'sab_serie2' => $this->input->post('sab_serie2'),
				'sab_serie3' => $this->input->post('sab_serie3'),
				'sab_serie4' => $this->input->post('sab_serie4'),
				'sab_serie5' => $this->input->post('sab_serie5'),
				'sab_serie6' => $this->input->post('sab_serie6'),
				'sab_serie7' => $this->input->post('sab_serie7'),
				'sab_serie8' => $this->input->post('sab_serie8'),
				'sab_serie9' => $this->input->post('sab_serie9'),
				'sab_serie10' => $this->input->post('sab_serie10'),
				'sab_rep1' => $this->input->post('sab_rep1'),
				'sab_rep2' => $this->input->post('sab_rep2'),
				'sab_rep3' => $this->input->post('sab_rep3'),
				'sab_rep4' => $this->input->post('sab_rep4'),
				'sab_rep5' => $this->input->post('sab_rep5'),
				'sab_rep6' => $this->input->post('sab_rep6'),
				'sab_rep7' => $this->input->post('sab_rep7'),
				'sab_rep8' => $this->input->post('sab_rep8'),
				'sab_rep9' => $this->input->post('sab_rep9'),
				'sab_rep10' => $this->input->post('sab_rep10'),
				'sab_obs1' => $this->input->post('sab_obs1'),
				'sab_obs2' => $this->input->post('sab_obs2'),
				'sab_obs3' => $this->input->post('sab_obs3'),
				'sab_obs4' => $this->input->post('sab_obs4'),
				'sab_obs5' => $this->input->post('sab_obs5'),
				'sab_obs6' => $this->input->post('sab_obs6'),
				'sab_obs7' => $this->input->post('sab_obs7'),
				'sab_obs8' => $this->input->post('sab_obs8'),
				'sab_obs9' => $this->input->post('sab_obs9'),
				'sab_obs10' => $this->input->post('sab_obs10'),
                'last_update' => date('y/m/d')
            );

            if ($this->acompanhamento_model->edit('acompanhamento', $data, $this->input->post('id')) == TRUE) {
                $this->session->set_flashdata('success','Alterações salvas com sucesso!');
                redirect(base_url() . 'index.php/acompanhamento/editar/'.$this->input->post('id'));
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro</p></div>';
            }
        }
        $this->data['result'] = $this->acompanhamento_model->getByIdAcompanhamento($this->uri->segment(3));

		$this->data['results'] = $this->acompanhamento_model->getAvaliacao('avaliacao','*','avaliacao.acompanhamento_id = '.$this->data['result']->id,$this->uri->segment(3));
		
		$this->data['primeira_avaliacao'] = $this->acompanhamento_model->getAvaliacao_primeira_avaliacao('avaliacao','*','avaliacao.acompanhamento_id = '.$this->data['result']->id,$this->uri->segment(3));

		$this->data['penultima_avaliacao'] = $this->acompanhamento_model->getAvaliacao_penultima_avaliacao('avaliacao','*','avaliacao.acompanhamento_id = '.$this->data['result']->id,$this->uri->segment(3));

		$this->data['ultima_avaliacao'] = $this->acompanhamento_model->getAvaliacao_ultima_avaliacao('avaliacao','*','avaliacao.acompanhamento_id = '.$this->data['result']->id,$this->uri->segment(3));
        
        $this->data['view'] = 'acompanhamento/editarAcompanhamento';
        $this->load->view('tema/topo', $this->data);
    }

/* ############### EXCLUIR ACOMPANHAMENTO ############### */
    function excluir(){
        
        $id =  $this->input->post('id');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir o Acompanhamento.');            
            redirect(base_url().'index.php/acompanhamento/');
        }

        $this->db->where('id', $id);
        $this->db->delete('acompanhamento');
        
        $this->db->where('acompanhamento_id', $id);
        $this->db->delete('avaliacao');
        $this->session->set_flashdata('success','Acompanhamento removido com sucesso!');            
        redirect(base_url().'index.php/acompanhamento/');

    }

/* ############### AVALIAÇÃO ############### */
    function avaliar(){
        $this->data['usuario'] = $this->acompanhamento_model->getByIdLogado($this->session->userdata('id'));

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        
        if ($this->form_validation->run('adicionaravaliacao') == false) {
           $this->data['custom_error'] = (validation_errors() ? true : false);
        }else {
        if($this->input->post('usuarios_id') == 0){
				$this->session->set_flashdata('error',"É necessário cadastrar o Funcionário / Instrutor <b>".$this->input->post('instrutor')."</b> para iniciar uma avaliação. Acesse o menu <b>Configurações > Funcionários</b>");
				redirect('acompanhamento/editar/'.$this->input->post('id'));
		}else{
            $data = array(
                'acompanhamento_id' => $this->input->post('id'),
                'usuarios_id' => $this->input->post('usuarios_id'),
                'clientes_id' => $this->input->post('clientes_id'),
                'data_avaliacao' => date('y/m/d')
            );
            $data_last_update = array(
				'last_update' => date('y/m/d')
			);
            if (is_numeric($id = $this->acompanhamento_model->add('avaliacao', $data, true)) ) {
            	$this->acompanhamento_model->edit('acompanhamento', $data_last_update,$this->input->post('id') );
                $this->session->set_flashdata('success','Avaliação iniciada com sucesso.');
                redirect('acompanhamento/avaliar/'.$id);
            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
       }
        }
       
        $this->data['results'] = $this->acompanhamento_model->getDadosAvaliacao($this->uri->segment(3));
         
        $this->data['view'] = 'acompanhamento/avaliaracompanhamento';
        $this->load->view('tema/topo', $this->data);
    }

/* ############### EDITAR AVALIAÇÃO ############### */
    function editar_avaliacao(){
        $this->data['usuario'] = $this->acompanhamento_model->getByIdLogado($this->session->userdata('id'));

            $data = array(
                'peso' => $this->input->post('peso'),
				'altura' => $this->input->post('altura'),
				'imc' => $this->input->post('inputimc'),
				'status_imc' => $this->input->post('inputstatus'),
				'pescoco' => $this->input->post('pescoco'),
				'torax' => $this->input->post('torax'),
				'abdominal' => $this->input->post('abdominal'),
				'cintura' => $this->input->post('cintura'),
				'quadril' => $this->input->post('quadril'),
				'braco_rel_esq' => $this->input->post('braco_rel_esq'),
				'braco_rel_dir' => $this->input->post('braco_rel_dir'),
				'braco_con_esq' => $this->input->post('braco_con_esq'),
				'braco_con_dir' => $this->input->post('braco_con_dir'),
				'antebraco_esq' => $this->input->post('antebraco_esq'),
				'antebraco_dir' => $this->input->post('antebraco_dir'),
				'coxa_esq' => $this->input->post('coxa_esq'),
				'coxa_dir' => $this->input->post('coxa_dir'),
				'perna_esq' => $this->input->post('perna_esq'),
				'perna_dir' => $this->input->post('perna_dir'),
				'dobra_triceps' => $this->input->post('dobra_triceps'),
				'dobra_abdominal' => $this->input->post('dobra_abdominal'),
				'dobra_pant_medial' => $this->input->post('dobra_pant_medial'),
				'dobra_biceps' => $this->input->post('dobra_biceps'),
				'dobra_supra_iliaca' => $this->input->post('dobra_supra_iliaca'),
				'dobra_subescapular' => $this->input->post('dobra_subescapular'),
				'dobra_coxa_medial' => $this->input->post('dobra_coxa_medial'),
				'dobra_torax' => $this->input->post('dobra_torax'),
				'dobra_axilar_media' => $this->input->post('dobra_axilar_media'),
				'dobra_supra_espinal' => $this->input->post('dobra_supra_espinal')
            );
            $data_last_update = array(
				'last_update' => date('y/m/d')
			);
			$this->acompanhamento_model->edit('acompanhamento', $data_last_update,$this->input->post('id_acompanhamento') );
			
			$id =  $this->input->post('id');
            if ($this->acompanhamento_model->edit_avaliacao('avaliacao',$data,$id, true)) {

            $this->session->set_flashdata('success','Alterações salvas com sucesso.');
                redirect('acompanhamento/avaliar/'.$this->input->post('id'));
            } else {
                
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        $this->data['results'] = $this->acompanhamento_model->getDadosAvaliacao($this->uri->segment(3));
        
        $this->data['view'] = 'acompanhamento/avaliaracompanhamento';
        $this->load->view('tema/topo', $this->data);
    }

/* ############### EXCLUIR AVALIAÇÃO ############### */
    function excluirAvaliacao(){

        $id =  $this->input->post('id');
        $idAcompanhamento =  $this->input->post('idacompanhamento');
        if ($id == null){

            $this->session->set_flashdata('error','Erro ao tentar excluir Avaliação.');            
            redirect(base_url().'index.php/acompanhamento/editar/'.$idAcompanhamento);
        }

        $this->db->where('idAvaliacao', $id);
        $this->db->delete('avaliacao');

        $this->session->set_flashdata('success','Avaliação removida com sucesso!');            
        redirect(base_url().'index.php/acompanhamento/editar/'.$idAcompanhamento);

    }

/* ############### FICHA TREINAMENTO ############### */
    public function fichaTreino(){
        if($this->input->post('usuarios_id_ficha') == 0){
				$this->session->set_flashdata('error',"É necessário cadastrar o Instrutor <b>".$this->input->post('instrutor_ficha')."</b> para gerar a Ficha de Treino. Acesse o menu <b>Configurações > Funcionários</b>");
				redirect('acompanhamento/editar/'.$this->input->post('id'));
		}else{
			$id = $this->input->post('id');
			$data['ficha'] = $this->acompanhamento_model->getByIdAcompanhamento($id);
			$this->load->helper('mpdf');
	        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
	        $html = $this->load->view('acompanhamento/ficha', $data, true);
	        pdf_create($html, 'ficha', TRUE);
    	}
    }

/* ############### AUTOCOMPLETE ############### */
	public function autoCompleteCliente(){
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->acompanhamento_model->autoCompleteCliente($q);
        }
    }

    public function autoCompleteUsuario(){
        if (isset($_GET['term'])){
            $q = strtolower($_GET['term']);
            $this->acompanhamento_model->autoCompleteUsuario($q);
        }
    }
}
