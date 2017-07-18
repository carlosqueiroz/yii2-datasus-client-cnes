<?php
namespace silvablack\datasuscnes;

use yii\base\Component;
use SoapClient;
use SoapFault;
use Exception;
use silvablack\datasuscnes\BuildAuthHeader;

class SOAP extends Component{
  public $url;
  public $options = [];
  public $__client;

  public function init(){
    parent::init();
    /*if($this->url === null){
      throw new Exception("URL missing",401);
    }*/
    $login = 'CNES.PUBLICO';
    $password = 'cnes#2015public';
    $wsse_header = new BuildAuthHeader($login,$password);
    echo "<hr> *** wsse_header *** <br>";
    print_r($wsse_header);
    try{
      $this->__client =  new SoapClient('https://servicos.saude.gov.br/cnes/CnesService/v1r0?wsdl',[
        'trace'=>1,
        'exception'=>0
      ]);
      $this->__client->__setSoapHeaders([$wsse_header]);
      echo "<hr> *** this->__client init() *** <br>";
      print_r($this->__client);
    }catch(SoapFault $e){
      echo "<hr> *** SoapFault e init() *** <br>";
      print_r($e);
      throw new Exception('SOAP request error |'.$e->getMessage(),400);
    }
  }

  public function __call($name, $args)
  {
    echo "<hr> *** args *** <br>";
    print_r($args);
      try {
          return $this->__client->__soapCall($name,$args);
          echo "<hr> *** this->__client *** <br>";
          print_r($this->__client);
      } catch (SoapFault $e) {
        echo "<hr> *** SoapFault e *** <br>";
        print_r($e);
          throw new Exception($e->getMessage(), (int) $e->getCode(), $e);
      }
  }

  public function header(){
    return '<wsse:Security xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wsswssecurity-secext-1.0.xsd">
 <wsse:UsernameToken wsu:Id="Id-0001334008436683-000000002c4a1908-1"
xmlns:wsu="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd">
 <wsse:Username>CNES.PUBLICO</wsse:Username>
 <wsse:Password Type="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wssusername-token-profile-1.0#PasswordText">cnes#2015public</wsse:Password>
 </wsse:UsernameToken>
 </wsse:Security>';
  }

}

?>
