<?php

namespace silvablack\datasuscnes;
use silvablack\datasuscnes\SOAP;


class DATASUS extends SOAP{
    public $url = [
      'ESTABLISHMENT'=> 'https://servicos.saude.gov.br/cnes/EstabelecimentoSaudeService/v1r0?wsdl',
      'LINK_PROFESSIONAL'=> 'https://servicos.saude.gov.br/cnes/VinculacaoProfissionalService/v1r0?wsdl',
      'PROFESSIONAL'=>'https://servicos.saude.gov.br/cnes/ProfissionalSaudeService/v1r0?wsdl',
      'BED'=>'https://servicos.saude.gov.br/cnes/LeitoService/v1r0?wsdl',
      'EQUIPMENT'=>'https://servicos.saude.gov.br/cnes/EquipamentoService/v1r0?wsdl',
      'CNES'=>'https://servicos.saude.gov.br/cnes/CnesService/v1r0?wsdl'
    ];

    public $options = [
      'login'=>'CNES.PUBLICO',
      'password'=>'cnes#2015public'
    ];

    public function getCnes(){
      $call = new SOAP();
      return $call;
    }



}

?>
