<?php

namespace silvablack\datasuscnes;

use Phpro\SoapClient\RequestInterface;
use Phpro\SoapClient\Client;
use silvablack\datasuscnes\MyClientConfig;


class MyClient extends Client
{
  public function __construct(){
    new MyClientConfig();
  }
    /**
     * @param RequestInterface $request
     *
     * @return ResultInterface
     * @throws \Phpro\SoapClient\Exception\SoapException
     */
    public function helloWorld(RequestInterface $request)
    {
        return $this->call('HelloWorld', $request);
    }
}

?>
