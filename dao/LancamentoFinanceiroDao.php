<?php
class LancamentoFinanceiroDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function saveLancamentoFinanceiro(LancamentoFinanceiroTO $lanFinTO) {
		if(!$lanFinTO->cod_conta_contabil)
			$lanFinTO->cod_conta_contabil = 'NULL';

		if(!$lanFinTO->cod_natureza_operacao)
			$lanFinTO->cod_natureza_operacao = 'NULL';

		if(!$lanFinTO->cod_origem_despesa)
			$lanFinTO->cod_origem_despesa = 'NULL';

		if(!$lanFinTO->dta_emissao)
			$lanFinTO->dta_emissao = 'NULL';
		else
			$lanFinTO->dta_emissao = "'". $lanFinTO->dta_emissao . "'";

		if(!$lanFinTO->dta_competencia)
			$lanFinTO->dta_competencia = 'NULL';
		else
			$lanFinTO->dta_competencia = "'". $lanFinTO->dta_competencia . "'";

		if(!$lanFinTO->dta_vencimento)
			$lanFinTO->dta_vencimento = 'NULL';
		else
			$lanFinTO->dta_vencimento = "'". $lanFinTO->dta_vencimento . "'";

		if(!$lanFinTO->dta_pagamento)
			$lanFinTO->dta_pagamento = 'NULL';
		else
			$lanFinTO->dta_pagamento = "'". $lanFinTO->dta_pagamento . "'";

		$sql = "INSERT INTO tb_lancamento_financeiro (num_nota_fatura, num_lancamento_contabil, num_documento_banco, dsc_lancamento, vlr_previsto, vlr_realizado, dta_emissao, dta_competencia, dta_vencimento, dta_pagamento, cod_natureza_operacao, cod_conta_contabil, cod_tipo_lancamento, cod_origem_despesa, dsc_observacao, flg_lancamento_aberto, cod_empreendimento) 
			VALUES ('". $lanFinTO->num_nota_fatura ."', '". $lanFinTO->num_lancamento_contabil ."', '". $lanFinTO->num_documento_banco ."', '". $lanFinTO->dsc_lancamento ."', ". $lanFinTO->vlr_previsto .", ". $lanFinTO->vlr_realizado .", ". $lanFinTO->dta_emissao .", ". $lanFinTO->dta_competencia .", ". $lanFinTO->dta_vencimento .", ". $lanFinTO->dta_pagamento .", ". $lanFinTO->cod_natureza_operacao .", ". $lanFinTO->cod_conta_contabil .", ". $lanFinTO->cod_tipo_lancamento .", ". $lanFinTO->cod_origem_despesa .", '". $lanFinTO->dsc_observacao ."', ". $lanFinTO->flg_lancamento_aberto .", ". $lanFinTO->cod_empreendimento .");";

		//Flight::halt(500, $sql);die;

		$insert = $this->conn->prepare($sql);

		if($insert->execute())
			return $this->conn->lastInsertId();
		else
			return false;
	}

	public function updateLancamentoFinanceiro(LancamentoFinanceiroTO $lanFinTO) {
		if(!$lanFinTO->cod_conta_contabil)
			$lanFinTO->cod_conta_contabil = 'NULL';

		if(!$lanFinTO->cod_natureza_operacao)
			$lanFinTO->cod_natureza_operacao = 'NULL';

		if(!$lanFinTO->cod_origem_despesa)
			$lanFinTO->cod_origem_despesa = 'NULL';

		if(!$lanFinTO->dta_emissao)
			$lanFinTO->dta_emissao = 'NULL';
		else
			$lanFinTO->dta_emissao = "'". $lanFinTO->dta_emissao . "'";

		if(!$lanFinTO->dta_competencia)
			$lanFinTO->dta_competencia = 'NULL';
		else
			$lanFinTO->dta_competencia = "'". $lanFinTO->dta_competencia . "'";

		if(!$lanFinTO->dta_vencimento)
			$lanFinTO->dta_vencimento = 'NULL';
		else
			$lanFinTO->dta_vencimento = "'". $lanFinTO->dta_vencimento . "'";

		if(!$lanFinTO->dta_pagamento)
			$lanFinTO->dta_pagamento = 'NULL';
		else
			$lanFinTO->dta_pagamento = "'". $lanFinTO->dta_pagamento . "'";

		if(!$lanFinTO->vlr_previsto)
			$lanFinTO->vlr_previsto = 'NULL';

		if(!$lanFinTO->vlr_realizado)
			$lanFinTO->vlr_realizado = 'NULL';

		$sql = "UPDATE tb_lancamento_financeiro
				SET num_nota_fatura = '". 			$lanFinTO->num_nota_fatura ."',
					num_lancamento_contabil = '". 	$lanFinTO->num_lancamento_contabil ."',
					num_documento_banco = '". 		$lanFinTO->num_documento_banco ."',
					dsc_lancamento = '". 			$lanFinTO->dsc_lancamento ."',
					vlr_previsto = ". 				$lanFinTO->vlr_previsto .",
					vlr_realizado = ". 				$lanFinTO->vlr_realizado .",
					dta_emissao = ". 				$lanFinTO->dta_emissao .",
					dta_competencia = ". 			$lanFinTO->dta_competencia .",
					dta_vencimento = ". 			$lanFinTO->dta_vencimento .",
					dta_pagamento = ". 				$lanFinTO->dta_pagamento .",
					cod_natureza_operacao = ". 		$lanFinTO->cod_natureza_operacao .",
					cod_conta_contabil = ". 		$lanFinTO->cod_conta_contabil .",
					cod_tipo_lancamento = ". 		$lanFinTO->cod_tipo_lancamento .",
					cod_origem_despesa = ". 		$lanFinTO->cod_origem_despesa .",
					dsc_observacao = '". 			$lanFinTO->dsc_observacao ."',
					flg_lancamento_aberto = ". 		$lanFinTO->flg_lancamento_aberto ."
				WHERE cod_lancamento_financeiro = ". $lanFinTO->cod_lancamento_financeiro;

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}

	public function getLancamentosFinanceiros($busca=null){
		$sql = "SELECT 
					tlf.cod_lancamento_financeiro,
					tlf.num_nota_fatura,
					tlf.num_lancamento_contabil,
					tlf.num_documento_banco,
					tlf.dsc_lancamento,
					tlf.vlr_previsto,
					tlf.vlr_realizado,
					tlf.dta_emissao,
					tlf.dta_competencia,
					tlf.dta_vencimento,
					tlf.dta_pagamento,
					tlf.cod_natureza_operacao,
					tlf.cod_conta_contabil,
					tlf.cod_tipo_lancamento,
					tlf.cod_origem_despesa,
					tlf.dsc_observacao,
					CAST(tlf.flg_lancamento_aberto AS UNSIGNED) AS flg_lancamento_aberto,
					CAST(tlf.flg_excluido AS UNSIGNED) AS flg_excluido,
					tlf.cod_usuario_ultima_atualizacao,
					ccb.num_item AS num_conta_contabil, 
					ccb.dsc_item AS dsc_conta_contabil, 
					nop.num_item AS num_natureza_operacao, 
					nop.dsc_item AS dsc_natureza_operacao,
					tor.dsc_origem
				FROM tb_lancamento_financeiro 	AS tlf
				LEFT JOIN tb_plano_conta 		AS ccb ON ccb.cod_item = tlf.cod_conta_contabil
				LEFT JOIN tb_plano_conta 		AS nop ON nop.cod_item = tlf.cod_natureza_operacao
				LEFT JOIN tb_origem				AS tor ON tor.cod_origem = tlf.cod_origem_despesa";
		
		$nolimit = false;
		$limit = 5;
		$offset = 0;
		$order = "asc";
		$search = "";

		if(is_array($busca) && count($busca) > 0) {
			if(isset($busca['nolimit'])) {
				$nolimit = true;
				unset($busca['nolimit']);
			}

			if(isset($busca['limit'])) {
				$limit = $busca['limit'];
				unset($busca['limit']);
			}	

			if(isset($busca['offset'])) {
				$offset = $busca['offset'];
				unset($busca['offset']);
			}	

			if(isset($busca['order'])) {
				$order = $busca['order'];
				unset($busca['order']);
			}	

			if(isset($busca['search'])) {
				$search = $busca['search'];
				unset($busca['search']);
			}

			if($search != "") {
				$sql .= " WHERE dsc_lancamento LIKE '%$search%' OR dsc_conta_contabil LIKE '%$search%' OR dsc_natureza_operacao LIKE '%$search%'";

				if(count($busca) > 0) {
					$where = prepareWhere($busca);
					$sql .= " AND " . $where;
				}
			}
			else if(count($busca) > 0) {
				$where = prepareWhere($busca);
				$sql .= " WHERE " . $where;
			}
		}

		$sql .= " ORDER BY dta_vencimento ASC, dta_pagamento ASC, num_lancamento_contabil ASC";

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$result = $select->fetchALL(PDO::FETCH_ASSOC);

				if($order != "asc")
					$result = array_reverse($result);

				$sizeOfResult = count($result);

				if(!$nolimit)
					$result = array_slice($result, $offset, $limit);

				$data = array();
				$data['total'] 	= $sizeOfResult;
				$data['rows'] 	= $result;

				return $data;
			}
			else
				return false;
		}
		else
			return false;

	}

	public function getSaldoAnterior($dta_referencia) {
		$sql = "SELECT 
					ROUND(SUM(vlr_credito),2) AS vlr_credito,
					ROUND(SUM(vlr_debito),2) AS vlr_debito,
					ROUND(SUM(vlr_credito) - SUM(vlr_debito),2) AS vlr_saldo
				FROM (
					SELECT
						CASE WHEN dta_pagamento <> '' THEN 
							dta_pagamento
						ELSE
							CASE WHEN dta_vencimento <> '' THEN
								dta_vencimento
							END
						END AS dta_lancamento,
						CASE WHEN vlr_realizado > 0 THEN
							ROUND(SUM(vlr_realizado),2)
						ELSE
							ROUND(SUM(vlr_previsto),2)
						END AS vlr_credito,
						0 AS vlr_debito
					FROM tb_lancamento_financeiro
					WHERE flg_excluido = 0
						AND cod_tipo_lancamento = 1
					GROUP BY dta_lancamento

					UNION ALL

					SELECT
						CASE WHEN dta_pagamento <> '' THEN 
							dta_pagamento
						ELSE
							CASE WHEN dta_vencimento <> '' THEN
								dta_vencimento
							END
						END AS dta_lancamento,
						0 as vlr_credito,
						CASE WHEN vlr_realizado > 0 THEN
							ROUND(SUM(vlr_realizado),2)
						ELSE
							ROUND(SUM(vlr_previsto),2)
						END AS vlr_debito
					FROM tb_lancamento_financeiro
					WHERE flg_excluido = 0
						AND cod_tipo_lancamento = 2
					GROUP BY dta_lancamento
				) AS vwl
				WHERE dta_lancamento < '$dta_referencia'
				ORDER BY dta_lancamento ASC";

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				return parse_arr_values($select->fetchALL(PDO::FETCH_ASSOC), 'all');
			}
			else
				return false;
		}
		else
			return false;
	}

	public function deleteLancamentoFinanceiro($cod_lancamento_financeiro, $cod_usuario) {
		$sql = "UPDATE tb_lancamento_financeiro 
				SET flg_excluido = 1, cod_usuario_ultima_atualizacao = ". $cod_usuario ."
				WHERE cod_lancamento_financeiro = ". $cod_lancamento_financeiro;

		$insert = $this->conn->prepare($sql);

		return $insert->execute();
	}
}