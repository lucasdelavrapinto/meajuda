<?php

function jsonReturn($data){
	header("Content-Type: application/json; Charset=UTF-8");
	echo json_encode($data);
	return exit();
}

class HomeController extends BaseController {
	public function showWelcome()
	{
		$date = new Datetime('now');
		$month = $date->format('m');
		$lancamentos = Lancamento::orderby('data', 'desc')
										->whereMonth('data', '=', $month)
										->get();
		return View::make('sistema.index')->with('lancamentos', $lancamentos);
	}

	public function buscaLancamentos()
	{
		$lancamentos = Lancamento::orderby('data', 'desc')->get();
		return $lancamentos;
	}

	public function getLancament()
	{
		$lancamentos = Lancamento::orderby('id', 'desc')
		->groupBy('conta')
		->toArray();
		return $lancamentos;

	}

	public function cadastrarLancamento()
	{
		function strReplace($variable){
			if(strlen($variable) >= 7){
				$b = str_replace('.','',$variable);
				$a = str_replace(',','.',$b);
			}else{
				$a = str_replace(',','.',$variable);
			}
			return $a;
		}

		$data_passada = Input::get('data');
		$data = date('Y-m-d', strtotime(str_replace('/','-', $data_passada)));

		$descricao = Input::get('descricao');
		$tipo = Input::get('tipo');
		$conta = Input::get('conta');

		$valor_passado = Input::get('valor'); //R$ 123,45
		$vlr = str_replace('R$ ','', $valor_passado);
		$valor = strReplace($vlr);

		if (Input::get('tipo') == null) {
			$tipo = "saida";
		}

		if (Input::get('conta') == null) {
			$conta = "Geral";
		}

		if (Input::get('descricao') == null) {
			$descricao = "Não Informado";
		}

		$lancamento = new Lancamento();
		$lancamento->data = $data;
		$lancamento->descricao = $descricao;
		$lancamento->tipo = $tipo;
		$lancamento->conta = $conta;
		$lancamento->valor = $valor;
		$lancamento->save();

		return 'ok';

	}

	public function cadastrarConta()
	{
		$conta = new Conta();
		$conta->nome = $_POST['input'];
		$conta->save();
		return 'ok';

	}

	public function deletaLancamento($id)
	{
		$id = Crypt::decrypt($id);
		$lancamento = Lancamento::find($id);
		if ($lancamento) {
			$lancamento->delete();
			return Redirect::back();
		}

	}

	public function alteraData()
	{

		$novadata = date('Y-m-d', strtotime(str_replace('/','-', Input::get('minhanovadata'))));

		$id = Input::get('meuid');
		$lancamento = Lancamento::find($id);
		$lancamento->data = $novadata;
		$lancamento->save();
		return 'ok';

	}

	public function deletarLancamentosAll()
	{
		Lancamento::truncate();
		return 'ok';
	}

	public function deletarContasAll()
	{
		Conta::truncate();
		return 'ok';
	}




}
