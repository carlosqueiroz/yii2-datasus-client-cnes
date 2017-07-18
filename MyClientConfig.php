<?php
// my-soap-config.php
namespace silvablack\datasuscnes;

use Phpro\SoapClient\CodeGenerator\Config\Config;
use Phpro\SoapClient\CodeGenerator\Rules;
use Phpro\SoapClient\CodeGenerator\Assembler;


class MyClientConfig{
  public function __construct(){
    Config::create()
        ->setWsdl('https://servicos.saude.gov.br/cnes/CnesService/v1r0?wsdl')
        ->setDestination('src/SoapTypes')
        ->setNamespace('SoapTypes')
        ->addSoapOption('features', SOAP_SINGLE_ELEMENT_ARRAYS)
        ->addRule(new Rules\AssembleRule(new Assembler\GetterAssembler()))
        ->addRule(new Rules\TypenameMatchesRule(
            new Rules\AssembleRule(new Assembler\RequestAssembler()),
            '/Request$/'
        ))
        ->addRule(new Rules\TypenameMatchesRule(
            new Rules\AssembleRule(new Assembler\ResultAssembler()),
            '/Response$/'
        ))
    ;
  }
}
