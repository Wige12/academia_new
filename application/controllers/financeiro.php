<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Financeiro extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
        	redirect('mapos/login');
        }
        $this->load->model('financeiro_model','',TRUE);
        $this->data['menuFinanceiro'] = 'financeiro';
        $this->load->helper(array('codegen_helper'));
	}
	public function index(){
		$this->lancamentos();
	}

	public function lancamentos(){
		
		$where = '';
		$periodo = $this->input->get('periodo');
		$situacao = $this->input->get('situacao');


		// busca lançamentos do dia 
		if($periodo == null || $periodo == 'dia'){
			
				if(! isset($situacao) || $situacao == 'todos'){
				
					$where = 'data_vencimento = "'.date('Y-m-d'.'"');

				}
				else{
					if($situacao == 'previsto'){
						$where = 'data_vencimento = "'.date('Y-m-d'.'"').' AND baixado = "0"'; 
					}
					else{
						if($situacao == 'atrasado'){
							$where = 'data_vencimento = "'.date('Y-m-d'.'"').' AND baixado = "0"'; 
						}
						else{
							if($situacao == 'realizado'){
							$where = 'data_vencimento = "'.date('Y-m-d'.'"').' AND baixado = "1"'; 
						}
						else{
							$where = 'data_vencimento = "'.date('Y-m-d'.'"');
						}
						}
					}
				}
		
		

		} // fim lançamentos dia


		else{

			// busca lançamentos da semana
			if($periodo == 'semana'){
				$semana = $this->getThisWeek();

				if(! isset($situacao) || $situacao == 'todos'){
				
					$where = 'data_vencimento BETWEEN "'.$semana[0].'" AND "'.$semana[1].'"'; 

				}
				else{
					if($situacao == 'previsto'){
						$where = 'data_vencimento BETWEEN "'.date('Y-m-d').'" AND "'.$semana[1].'" AND baixado = "0"'; 
					}
					else{
						if($situacao == 'atrasado'){
							$where = 'data_vencimento BETWEEN "'.$semana[0].'" AND "'.date('Y-m-d').'" AND baixado = "0"'; 
						}
						else{
							$where = 'data_vencimento BETWEEN "'.$semana[0].'" AND "'.$semana[1].'" AND baixado = "1"';
						}
					}
				}
			
			} // fim lançamentos da semana
			else{

				// busca lançamento do mês


				if($periodo == 'mes'){
					
					$mes = $this->getThisMonth();
					
					if(! isset($situacao) || $situacao == 'todos'){
				
						$where = 'data_vencimento BETWEEN "'.$mes[0].'" AND "'.$mes[1].'"'; 

					}
					else{
						if($situacao == 'previsto'){
							$where = 'data_vencimento BETWEEN "'.date('Y-m-d').'" AND "'.$mes[1].'" AND baixado = "0"'; 
						}
						else{
							if($situacao == 'atrasado'){
								$where = 'data_vencimento BETWEEN "'.$mes[0].'" AND "'.date('Y-m-d').'" AND baixado = "0"'; 
							}
							else{
								$where = 'data_vencimento BETWEEN "'.$mes[0].'" AND "'.$mes[1].'" AND baixado = "1"';
							}
						}
					}
				}

				// busca lançamentos do ano
				else{
					$ano = $this->getThisYear();
					
					if(! isset($situacao) || $situacao == 'todos'){
				
						$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.$ano[1].'"';

					}
					else{
						if($situacao == 'previsto'){
							$where = 'data_vencimento BETWEEN "'.date('Y-m-d').'" AND "'.$ano[1].'" AND baixado = "0"'; 
						}
						else{
							if($situacao == 'atrasado'){
								$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.date('Y-m-d').'" AND baixado = "0"'; 
							}
							else{
								$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.$ano[1].'" AND baixado = "1"';
							}
						}
					}	
				}
			}
		}
		

		if($periodo == 'anterior'){
					$ano = $this->getLastYear();
					if(! isset($situacao) || $situacao == 'todos'){
				
						$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.$ano[1].'"';

					}
					else{
						if($situacao == 'previsto'){
							$where = 'data_vencimento BETWEEN "'.date('Y-m-d').'" AND "'.$ano[1].'" AND baixado = "0"'; 
						}
						else{
							if($situacao == 'atrasado'){
								$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.date('Y-m-d').'" AND baixado = "0"'; 
							}
							else{
								$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.$ano[1].'" AND baixado = "1"';
							}
						}
					}	
				}


		if($periodo == 'proximo'){
					$ano = $this->getNextYear();
					if(! isset($situacao) || $situacao == 'todos'){
				
						$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.$ano[1].'"';

					}
					else{
						if($situacao == 'previsto'){
							$where = 'data_vencimento BETWEEN "'.date('Y-m-d').'" AND "'.$ano[1].'" AND baixado = "0"'; 
						}
						else{
							if($situacao == 'atrasado'){
								$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.date('Y-m-d').'" AND baixado = "0"'; 
							}
							else{
								$where = 'data_vencimento BETWEEN "'.$ano[0].'" AND "'.$ano[1].'" AND baixado = "1"';
							}
						}
					}	
				}


		$this->load->library('pagination');
        
        $config['base_url'] = base_url().'financeiro/lancamentos';
        $config['total_rows'] = $this->financeiro_model->count('lancamentos');
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
        $this->pagination->initialize($config); 	

		$this->data['results'] = $this->financeiro_model->get('lancamentos','idLancamentos,descricao,valor,data_vencimento,baixado,cliente_fornecedor,tipo,forma_pgto',$where,$config['per_page'],$this->uri->segment(3));
       
	    $this->data['view'] = 'financeiro/lancamentos';
       	$this->load->view('tema/topo',$this->data);
	}


	function adicionarReceita_parc() {

        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');
        if ($this->form_validation->run('receita_parc') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {
			$qtdparcelas_parc = $this->input->post('qtdparcelas_parc');
			$entrada = $this->input->post('entrada');
			$valor_parc = $this->input->post('valor_parc');
			$valorparcelas = ($valor_parc - $entrada) / $qtdparcelas_parc;

			if($entrada >= $valor_parc){
				$this->session->set_flashdata('error','O valor da entrada não pode ser maior ou igual ao valor total da receita!');
				redirect($urlAtual);
			}
			
			$dia_pgto = $this->input->post('dia_pgto');
			$dia_base_pgto = $this->input->post('dia_base_pgto');

            try {
                $dia_pgto = explode('/', $dia_pgto);
                $dia_pgto = $dia_pgto[2].'-'.$dia_pgto[1].'-'.$dia_pgto[0];
                
                $dia_base_pgto = explode('/', $dia_base_pgto);
                $dia_base_pgto = $dia_base_pgto[2].'-'.$dia_base_pgto[1].'-'.$dia_base_pgto[0];

            } catch (Exception $e) {
               $dia_pgto = date('Y/m/d');
               $dia_base_pgto = date('Y/m/d');
            }

		if($entrada == 0){
			$loops = 1;
			while ($loops <= $qtdparcelas_parc){

            $myDateTimeISO = $dia_base_pgto;
            $loopsmes = $loops - 1;
			$addThese = $loopsmes;
			$myDateTime = new DateTime($myDateTimeISO);
			$myDayOfMonth = date_format($myDateTime,'j');
			date_modify($myDateTime,"+$addThese months");

			//Find out if the day-of-month has dropped
			$myNewDayOfMonth = date_format($myDateTime,'j');
			if ($myDayOfMonth > 28 && $myNewDayOfMonth < 4){
			//If so, fix by going back the number of days that have spilled over
			    date_modify($myDateTime,"-$myNewDayOfMonth days");
			}

			$data = array(
                'descricao' => $this->input->post('descricao_parc'),
				'valor' => $valorparcelas,
				'data_vencimento' => date_format($myDateTime,"Y-m-d"),
				'baixado' => 0,
				'cliente_fornecedor' => $this->input->post('cliente_parc'),
				'forma_pgto' => $this->input->post('formaPgto_parc'),
				'tipo' => $this->input->post('tipo_parc')
            );

            if ($this->financeiro_model->add('lancamentos',$data) == TRUE) {
                $this->session->set_flashdata('success','Receita adicionada com sucesso!');

            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
			$loops++;
			}

			redirect($urlAtual);

		}else{
			$data1 = array(
                'descricao' => $this->input->post('descricao_parc'),
				'valor' => $entrada,
				'data_vencimento' => $dia_pgto,
				'baixado' => 1,
				'cliente_fornecedor' => $this->input->post('cliente_parc'),
				'forma_pgto' => $this->input->post('formaPgto_parc'),
				'tipo' => $this->input->post('tipo_parc')
            );
			$this->financeiro_model->add1('lancamentos',$data1);
			
			$loops = 1;
			while ($loops <= $qtdparcelas_parc){
            $myDateTimeISO = $dia_base_pgto;
            $loopsmes = $loops - 1;
			$addThese = $loopsmes;
			$myDateTime = new DateTime($myDateTimeISO);
			$myDayOfMonth = date_format($myDateTime,'j');
			date_modify($myDateTime,"+$addThese months");

			//Find out if the day-of-month has dropped
			$myNewDayOfMonth = date_format($myDateTime,'j');
			if ($myDayOfMonth > 28 && $myNewDayOfMonth < 4){
			//If so, fix by going back the number of days that have spilled over
			    date_modify($myDateTime,"-$myNewDayOfMonth days");
			}
			$data = array(
                'descricao' => $this->input->post('descricao_parc').' - Parcela ['.$loops.'/'.$qtdparcelas_parc.']',
				'valor' => $this->input->post('valorparcelas'),
				'data_vencimento' => date_format($myDateTime,"Y-m-d"),
				'baixado' => 0,
				'cliente_fornecedor' => $this->input->post('cliente_parc'),
				'forma_pgto' => $this->input->post('formaPgto_parc'),
				'tipo' => $this->input->post('tipo_parc')
            );

            if ($this->financeiro_model->add('lancamentos',$data) == TRUE) {
                $this->session->set_flashdata('success','Receita adicionada com sucesso!');
            }
             else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
			$loops++;
			}

			redirect($urlAtual);
			
		}
}

        $this->session->set_flashdata('error','Ocorreu um erro ao tentar adicionar receita.');
        redirect($urlAtual);
        
        
        
        
        
        
        
        
        
        
        
        
    }



	function adicionarReceita() {
		
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');
        if ($this->form_validation->run('receita') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {


            $vencimento = $this->input->post('vencimento');

            try {
                
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2].'-'.$vencimento[1].'-'.$vencimento[0];
            } catch (Exception $e) {
               $vencimento = date('Y/m/d'); 
            }

            $data = array(
                'descricao' => set_value('descricao'),
				'valor' => set_value('valor'),
				'data_vencimento' => $vencimento,
				'baixado' => $this->input->post('recebido'),
				'cliente_fornecedor' => set_value('cliente'),
				'forma_pgto' => $this->input->post('formaPgto'),
				'tipo' => set_value('tipo')
            );

            if ($this->financeiro_model->add('lancamentos',$data) == TRUE) {
                $this->session->set_flashdata('success','Receita adicionada com sucesso!');
                redirect($urlAtual);
            } else {
                $this->data['custom_error'] = '<div class="form_error"><p>Ocorreu um erro.</p></div>';
            }
        }

        $this->session->set_flashdata('error','Ocorreu um erro ao tentar adicionar receita.');
        redirect($urlAtual);
        
    }


    function adicionarDespesa() {
    	
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');
        if ($this->form_validation->run('despesa') == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');

            try {
                
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2].'-'.$vencimento[1].'-'.$vencimento[0];

            } catch (Exception $e) {
               $vencimento = date('Y/m/d'); 
            }

            $data = array(
                'descricao' => set_value('descricao'),
				'valor' => set_value('valor'),
				'data_vencimento' => $vencimento,
				'baixado' => $this->input->post('pago'),
				'cliente_fornecedor' => set_value('fornecedor'),
				'forma_pgto' => $this->input->post('formaPgto'),
				'tipo' => set_value('tipo')
            );

            if ($this->financeiro_model->add('lancamentos',$data) == TRUE) {
                $this->session->set_flashdata('success','Despesa adicionada com sucesso!');
                redirect($urlAtual);
            } else {
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar adicionar despesa!');
                redirect($urlAtual);
            }
        }

        $this->session->set_flashdata('error','Ocorreu um erro ao tentar adicionar despesa.');
        redirect($urlAtual);
        
        
    }


    public function editar(){
    	
        $this->load->library('form_validation');
        $this->data['custom_error'] = '';
        $urlAtual = $this->input->post('urlAtual');

        $this->form_validation->set_rules('descricao', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('fornecedor', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('valor', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('vencimento', '', 'trim|required|xss_clean');
        $this->form_validation->set_rules('pagamento', '', 'trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $this->data['custom_error'] = (validation_errors() ? '<div class="form_error">' . validation_errors() . '</div>' : false);
        } else {

            $vencimento = $this->input->post('vencimento');

            try {
                
                $vencimento = explode('/', $vencimento);
                $vencimento = $vencimento[2].'-'.$vencimento[1].'-'.$vencimento[0];

            } catch (Exception $e) {
               $vencimento = date('Y/m/d'); 
            }

            $data = array(
                'descricao' => $this->input->post('descricao'),
                'valor' => $this->input->post('valor'),
                'data_vencimento' => $vencimento,
                'baixado' => $this->input->post('pago'),
                'cliente_fornecedor' => $this->input->post('fornecedor'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => $this->input->post('tipo'),
				'aparece_no_caixa' => $this->input->post('pago')
            );

            if ($this->financeiro_model->edit('lancamentos',$data,'idLancamentos',$this->input->post('id')) == TRUE) {
                $this->session->set_flashdata('success','lançamento editado com sucesso!');
                redirect($urlAtual);
            } else {
                $this->session->set_flashdata('error','Ocorreu um erro ao tentar editar lançamento!');
                redirect($urlAtual);
            }
        }

        $this->session->set_flashdata('error','Ocorreu um erro ao tentar editar lançamento.');
        redirect($urlAtual);

        $data = array(
                'descricao' => $this->input->post('descricao'),
                'valor' => $this->input->post('valor'),
                'data_vencimento' => $this->input->post('vencimento'),
                'baixado' => $this->input->post('pago'),
                'cliente_fornecedor' => set_value('fornecedor'),
                'forma_pgto' => $this->input->post('formaPgto'),
                'tipo' => $this->input->post('tipo')
            );
        print_r($data);

    }

    public function excluirLancamento()
    {
    	$id = $this->input->post('id');


    	if($id == null || ! is_numeric($id)){
    		$json = array('result'=>  false);
    		echo json_encode($json);
    	}
    	else{

    		$result = $this->financeiro_model->delete('lancamentos','idLancamentos',$id); 
    		if($result){
    			$json = array('result'=>  true);
    			echo json_encode($json);
    		}
    		else{
    			$json = array('result'=>  false);
    			echo json_encode($json);
    		}
    		
    	}
    }




	protected function getThisYear() {
        $dias = date("z");
        $primeiro = date("Y-m-d", strtotime("-".($dias)." day"));
        $ultimo = date("Y-m-d", strtotime("+".( 364 - $dias)." day"));
        return array($primeiro,$ultimo);
    }

	protected function getLastYear() {
        $dias = date("z");
        $primeiro = date("Y-m-d", strtotime("-".( 365 + $dias)." day"));
        $ultimo = date("Y-m-d", strtotime("-".( 1 + $dias)." day"));
        return array($primeiro,$ultimo);
    }

	protected function getNextYear() {
        $dias = date("z");
        $primeiro = date("Y-m-d", strtotime("+".( 366 - $dias)." day"));
        $ultimo = date("Y-m-d", strtotime("+".( 730 - $dias)." day"));
        return array($primeiro,$ultimo);
    }

    protected function getThisWeek(){

        return array(date("Y/m/d", strtotime("last sunday", strtotime("now"))),date("Y/m/d", strtotime("next saturday", strtotime("now"))));
    }

    protected function getLastSevenDays() {

        return array(date("Y-m-d", strtotime("-7 day", strtotime("now"))), date("Y-m-d", strtotime("now")));
    }

    protected function getThisMonth(){

        $mes = date('m');
        $ano = date('Y'); 
        $qtdDiasMes = date('t');
        $inicia = $ano."-".$mes."-01";

        $ate = $ano."-".$mes."-".$qtdDiasMes;
        return array($inicia, $ate);
    }

}

