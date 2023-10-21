<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Relatorios extends CI_Controller{
    public function __construct() {
        parent::__construct();
        if((!$this->session->userdata('session_id')) || (!$this->session->userdata('logado'))){
            redirect('mapos/login');
        }
        if($this->session->userdata('nivel') != 1){
            $this->session->set_flashdata('error','Você não tem permissão para essa ação.');
            redirect('mapos');
        }
        $this->load->model('Relatorios_model','',TRUE);
        $this->data['menuRelatorios'] = 'Relatórios';

    }

    public function clientes(){
        $this->data['view'] = 'relatorios/rel_clientes';
       	$this->load->view('tema/topo',$this->data);
    }

    public function produtos(){
        $this->data['view'] = 'relatorios/rel_produtos';
       	$this->load->view('tema/topo',$this->data);
    }

    public function clientesCustom(){
        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');

        $data['clientes'] = $this->Relatorios_model->clientesCustom($dataInicial,$dataFinal);

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirClientes', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirClientes', $data, true);
        pdf_create($html, 'relatorio_clientes' . date('d/m/y'), TRUE);
    
    }

    public function clientesRapid(){
        $data['clientes'] = $this->Relatorios_model->clientesRapid();
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirClientes', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirClientes', $data, true);
        pdf_create($html, 'relatorio_clientes' . date('d/m/y'), TRUE);
    }

    public function servicos(){
        $this->data['view'] = 'relatorios/rel_servicos';
       	$this->load->view('tema/topo',$this->data);

    }

    public function servicosCustom(){
        $precoInicial = $this->input->get('precoInicial');
        $precoFinal = $this->input->get('precoFinal');
        $data['servicos'] = $this->Relatorios_model->servicosCustom($precoInicial,$precoFinal);
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirServicos', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirServicos', $data, true);
        pdf_create($html, 'relatorio_servicos' . date('d/m/y'), TRUE);
    }

    public function servicosRapid(){

        $data['servicos'] = $this->Relatorios_model->servicosRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirServicos', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirServicos', $data, true);
        pdf_create($html, 'relatorio_servicos' . date('d/m/y'), TRUE);
    }
    
    public function produtosRapid(){

        $data['produtos'] = $this->Relatorios_model->produtosRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirProdutos', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirProdutos', $data, true);
        pdf_create($html, 'relatorio_produtos' . date('d/m/y'), TRUE);
    }

    public function produtosRapidMin(){
        $data['produtos'] = $this->Relatorios_model->produtosRapidMin();

        $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/imprimir/imprimirProdutos', $data, true);
        pdf_create($html, 'relatorio_produtos' . date('d/m/y'), TRUE);   
    }

    public function produtosCustom(){
        $precoInicial = $this->input->get('precoInicial');
        $precoFinal = $this->input->get('precoFinal');
        $estoqueInicial = $this->input->get('estoqueInicial');
        $estoqueFinal = $this->input->get('estoqueFinal');

        $data['produtos'] = $this->Relatorios_model->produtosCustom($precoInicial,$precoFinal,$estoqueInicial,$estoqueFinal);

        $this->load->helper('mpdf');
        $html = $this->load->view('relatorios/imprimir/imprimirProdutos', $data, true);
        pdf_create($html, 'relatorio_produtos' . date('d/m/y'), TRUE);
    }

    public function etiquetas(){
        $de = $this->input->get('de_id');
        $ate = $this->input->get('ate_id');

			if($de <= $ate){
		        $data['produtos'] = $this->Relatorios_model->etiquetas($de,$ate);
		        $this->load->helper('mpdf');
		        $html = $this->load->view('relatorios/imprimir/imprimirEtiquetas', $data, true);
		        pdf_create($html, 'etiquetas_'.$de.'_'.$ate, TRUE);
		    }else{
				$this->session->set_flashdata('error','O campo "<b>De</b>" não pode ser maior doque o campo "<b>Até</b>"!');
                redirect('produtos');
			}   
    }

    public function mensalidades(){
        $this->data['view'] = 'relatorios/rel_mensalidades';
       	$this->load->view('tema/topo',$this->data);
    }

    public function mensalidadesRapid(){
        $data['os'] = $this->Relatorios_model->mensalidadesRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirMensalidades', $data, true);
        pdf_create($html, 'relatorio_os' . date('d/m/y'), TRUE);
    }

    public function imprimirmenPagas(){
    	$data['servicos'] = $this->Relatorios_model->imprimirmenPagas();
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirmenPagas', $data, true);
        pdf_create($html, 'relatorio_Mensalidades_Pagas' . date('d/m/y'), TRUE);
    }
    
    public function carne(){
        $id = $this->input->get('id');
    	$data['carne'] = $this->Relatorios_model->carne();
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('mensalidades/carne', $data, true);
        pdf_create($html, 'carnê', TRUE);
    }
    
    public function orcamentos(){
        $this->data['view'] = 'relatorios/rel_os';
       	$this->load->view('tema/topo',$this->data);
    }

    public function osRapid(){
        $data['os'] = $this->Relatorios_model->osRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirOs', $data, true);
        pdf_create($html, 'relatorio_os' . date('d/m/y'), TRUE);
    }

    public function osCustom(){
        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');
        $cliente = $this->input->get('cliente');
        $responsavel = $this->input->get('responsavel');
        $status = $this->input->get('status');
        $data['os'] = $this->Relatorios_model->osCustom($dataInicial,$dataFinal,$cliente,$responsavel,$status);
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirOs', $data, true);
        pdf_create($html, 'relatorio_os' . date('d/m/y'), TRUE);
    }

    public function caixa(){
        $this->data['view'] = 'relatorios/rel_caixa';
        $this->load->view('tema/topo',$this->data);
    }

    public function caixaRapid(){
        $data['caixa'] = $this->Relatorios_model->caixaRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirCaixa', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirCaixa', $data, true);
        pdf_create($html, 'caixa_mes_' . date('m/Y'), TRUE);
    }

    public function caixaCustom(){
        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');

        $data['caixa'] = $this->Relatorios_model->caixaCustom($dataInicial,$dataFinal);
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirFinanceiro', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirCaixa', $data, true);
        
        $data_ini = date('d/m/Y', strtotime($dataInicial));
        $data_fin = date('d/m/Y', strtotime($dataFinal));
        pdf_create($html, 'caixa_de_'.$data_ini.'_ate_'.$data_fin, TRUE);
    }

    public function financeiro(){

        $this->data['view'] = 'relatorios/rel_financeiro';
        $this->load->view('tema/topo',$this->data);
    }

    public function financeiroRapid(){
        $data['lancamentos'] = $this->Relatorios_model->financeiroRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirFinanceiro', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirFinanceiro', $data, true);
        pdf_create($html, 'relatorio_financeiro' . date('d/m/y'), TRUE);
    }

    public function financeiroCustom(){

        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');
        $tipo = $this->input->get('tipo');
        $situacao = $this->input->get('situacao');

        $data['lancamentos'] = $this->Relatorios_model->financeiroCustom($dataInicial,$dataFinal,$tipo,$situacao);
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirFinanceiro', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirFinanceiro', $data, true);
        pdf_create($html, 'relatorio_financeiro' . date('d/m/y'), TRUE);
    }

    public function vendas(){
        $this->data['view'] = 'relatorios/rel_vendas';
        $this->load->view('tema/topo',$this->data);
    }

    public function vendasRapid(){
        $data['vendas'] = $this->Relatorios_model->vendasRapid();

        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirVendas', $data, true);
        pdf_create($html, 'relatorio_vendas' . date('d/m/y'), TRUE);
    }

    public function vendasCustom(){
        $dataInicial = $this->input->get('dataInicial');
        $dataFinal = $this->input->get('dataFinal');
        $cliente = $this->input->get('cliente');
        $responsavel = $this->input->get('responsavel');

        $data['vendas'] = $this->Relatorios_model->vendasCustom($dataInicial,$dataFinal,$cliente,$responsavel);
        $this->load->helper('mpdf');
        //$this->load->view('relatorios/imprimir/imprimirOs', $data);
        $html = $this->load->view('relatorios/imprimir/imprimirVendas', $data, true);
        pdf_create($html, 'relatorio_vendas' . date('d/m/y'), TRUE);
    }
}
