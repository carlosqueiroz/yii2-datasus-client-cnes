<?php
namespace silvablack\datasuscnes;

use SoapHeader;
use stdClass;
use SoapVar;
use silvablack\datasuscnes\XMLSerializer;

class BuildAuthHeader extends SoapHeader{
  private $WSSE_NS = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd';
  private $PASSWORD_TYPE = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wssusername-token-profile-1.0#PasswordText';
  private $WSU_NS = 'http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-utility-1.0.xsd';
  private $WSU_ID = 'Id-0001334008436683-000000002c4a1908-1';
  function __construct($user, $psw) {
    /*
    $root = new SimpleXMLElement('<root/>');
    $secutiry = $root->addChild('wsse:Security',null,$wsse_ns);

    $usernameToken = $secutiry->addChild('wsse:UsernameToken',null,$wsse_ns);
    $usernameToken->addChild('wsse:Username',$user,$wsse_ns);
    $usernameToken->addChild('wsse:Password',$psw,$wsse_ns)->addAttribute('Type',$this->password_type);

    $root->registerXPathNamespace('wsse',$wsse_ns);
    $full = $root->xpath('/root/wsse:Secutiry');
    $auth = $full[0]->asXML();

    parent::__construct($wsse_ns,'Secutiry',new SoapVar($auth,XSD_ANYXML),true);
    */
    $auth = new stdClass();
    $auth->Username = new SoapVar($user, XSD_STRING, NULL, $this->WSSE_NS, NULL, $this->WSSE_NS);
    $auth->Password = new SoapVar('<wsse:Password Type="'.$this->PASSWORD_TYPE.'">'.$psw.'</wsse:Password>', XSD_ANYXML);

    $username_token = new stdClass();
    //$username_token->UsernameToken = new SoapVar('<wsse:UsernameToken wsu:Id="'.$this->WSU_ID.'" xmlns:wsu="'.$this->WSU_NS.'"></wsse:UsernameToken>',XSD_ANYXML);
    //$username_token->UsernameToken = new SoapVar($auth, SOAP_ENC_OBJECT, NULL, WSSE_NS, 'UsernameToken', WSSE_NS);
    $username_token->UsernameToken = new SoapVar($auth, SOAP_ENC_OBJECT, NULL, WSSE_NS, 'UsernameToken wsu:Id="'.$this->WSU_ID.'" xmlns:wsu="'.$this->WSU_NS.'"', $this->WSSE_NS);



    $security_sv = new SoapVar(
        new SoapVar($username_token, SOAP_ENC_OBJECT, NULL, $this->WSSE_NS, 'UsernameToken', $this->WSSE_NS),
        SOAP_ENC_OBJECT, NULL, $this->WSSE_NS, 'Security', $this->WSSE_NS);
    parent::__construct($this->WSSE_NS, 'Security', $security_sv, true);
}
}

?>
