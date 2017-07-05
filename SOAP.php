<?php
namespace silvablack\datasuscnes;

use SoapClient;
use SoapFault;
use yii\base\Component;

class SOAP extends Component{
  public $url;
  public $options = [];
  public $__client;

  public function init(){
    parent::init();
    if($this->url === null){
      throw new Exception("URL missing");
    }
    try{
      $__client =  new SoapClient($this->url,$this->options);
    }catch(SoapFault $e){
      throw new Exception('SOAP request error |'.$e->getMessage());
    }
  }

  public function __call($name, $params){
    try{
      return call_user_func_array([$this->__client,$name],$params);
    }catch(SoapFault $e){
      throw new Exception('SOAP request component call error |'.$e->getMessage());
    }
  }

}

?>
