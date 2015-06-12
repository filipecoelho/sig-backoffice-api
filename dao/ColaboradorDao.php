<?php
class ColaboradorDao{

	private $conn;

	public function __construct() {
		$this->conn = Conexao::getInstance();
	} 

	public function getColaboradores(){
		$sql = "SELECT 
					col.cod_colaborador, 
				    col.num_matricula, 
				    col.nme_colaborador, 
				    col.flg_portador_necessidades_especiais, 
				    col.cod_empresa_contratante,
				    col.cod_contrato,
				    emp.nme_fantasia,
				    col.cod_contrato,
				    org.dsc_origem,
				    col.cod_regime_contratacao,
				    trc.dsc_regime_contratacao,
					col.cod_departamento,
				    dpt.nme_departamento,
				    col.flg_cm, 
				    col.cod_local_trabalho,
				    ltr.nme_local_trabalho,
				    col.cod_grade_horario,
				    grh.nme_grade_horario,
				    col.flg_ativo, 
				    col.dta_admissao,
				    col.dta_demissao,
				    col.num_ctps,
				    col.num_serie_ctps,
				    col.cod_estado_ctps,
				    est_ctps.sgl_estado,
				    col.dta_emissao_ctps,
					col.num_rg,
					col.num_cpf,
				    col.num_pis,
				    col.num_titulo_eleitor,
				    col.num_zona_eleitoral,
				    col.num_secao_eleitoral,
				    col.num_reservista,
				    col.dsc_endereco,
				    col.num_endereco,
				    col.nme_bairro,
				    col.dsc_complemento,
				    cid_mor.nme_cidade,
				    col.cod_cidade_moradia,
				    col.cod_estado_moradia,
				    est_mor.sgl_estado,
				    col.cod_cidade_naturalidade,
				    col.cod_estado_naturalidade,
				    col.cod_estado_moradia,
				    col.num_cep,
				    col.dta_nascimento,
				    cid_nat.nme_cidade,
				    est_nat.sgl_estado,
				    col.num_cnh,
				    col.nme_categoria_cnh,
				    col.dta_validade_cnh,
				    col.flg_sexo,
				    col.cod_banco,
				    bnc.nme_banco,
				    col.num_agencia,
				    col.num_digito_agencia,
				    col.num_conta_corrente,
				    col.num_digito_conta_corrente,
					col.cod_sindicato,
				    sdc.cod_sindicato,
				    col.pth_arquivo_cnh,
				    col.pth_arquivo_rg,
				    col.pth_arquivo_foto,
				    col.pth_arquivo_cpf,
				    col.pth_arquivo_entidade,
				    col.pth_arquivo_curriculo,
				    col.pth_arquivo_reservista,
				    col.cod_entidade,
				    ent.nme_entidade,
				    col.num_entidade
				FROM tb_colaborador 			AS col
				LEFT JOIN tb_empresa 			AS emp 			ON emp.cod_empresa 						= col.cod_empresa_contratante
				LEFT JOIN tb_origem 			AS org			ON org.cod_origem 						= col.cod_contrato
				LEFT JOIN tb_regime_contratacao AS trc 			ON trc.cod_regime_contratacao 			= col.cod_regime_contratacao
				LEFT JOIN tb_departamento 		AS dpt			ON dpt.cod_departamento 				= col.cod_departamento
				LEFT JOIN tb_local_trabalho   	AS ltr 			ON ltr.cod_local_trabalho 				= col.cod_local_trabalho
				LEFT JOIN tb_grade_horario		AS grh 			ON grh.cod_grade_horario				= col.cod_grade_horario
				LEFT JOIN tb_estado				AS est_ctps	 	ON est_ctps.cod_estado 					= col.cod_estado_ctps
				LEFT JOIN tb_cidade				AS cid_mor 		ON cid_mor.cod_cidade					= col.cod_cidade_moradia
				LEFT JOIN tb_estado				AS est_mor  	ON est_mor.cod_estado					= col.cod_estado_moradia
				LEFT JOIN tb_cidade				AS cid_nat		ON cid_nat.cod_cidade					= col.cod_cidade_naturalidade
				LEFT JOIN tb_estado				AS est_nat		ON est_nat.cod_estado					= col.cod_estado_naturalidade
				LEFT JOIN tb_banco				AS bnc			ON bnc.cod_banco						= col.cod_banco
				LEFT JOIN tb_sindicato			AS sdc			ON sdc.cod_sindicato					= col.cod_sindicato
				LEFT JOIN tb_entidade			AS ent			ON ent.cod_entidade						= col.cod_entidade";

		if(isset($_GET['limit']))
			$limit = $_GET['limit'];
		else
			$limit = 5;

		if(isset($_GET['offset']))
			$offset = $_GET['offset'];
		else
			$offset = 0;

		if(isset($_GET['order']))
			$order = $_GET['order'];
		else
			$order = "asc";

		if(isset($_GET['search']))
			$search = $_GET['search'];
		else
			$search = "";

		if($search != "")
			$sql .= " WHERE nme_colaborador LIKE '%$search%' OR nme_fantasia LIKE '%$search%' OR nme_departamento LIKE '%$search%'";

		$select = $this->conn->prepare($sql);
		if($select->execute()){
			if($select->rowCount()>0) {
				$result = $select->fetchALL(PDO::FETCH_ASSOC);

				if($order != "asc")
					$result = array_reverse($result);

				$sizeOfResult = count($result);

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
}
?>