<?php
ini_set('soap.wsdl_cache_enabled', 0);
ini_set('soap.wsdl_cache_ttl', 900);
ini_set('default_socket_timeout', 15);
require(__DIR__ . '/vendor/autoload.php');
require(__DIR__ . '/vendor/yiisoft/yii2/Yii.php');

//use silvablack\datasuscnes\SOAP;
use silvablack\datasuscnes\MyClient;

/*
$client = new SOAP();
echo "<hr> *** client->consultarEstabelecimentoSaude *** <br>";
print_r($client->consultarEstabelecimentoSaude(['CodigoCNES'=>2333031]));
*/

$my = new MyClient();
var_dump($my->helloWorld());


?>
