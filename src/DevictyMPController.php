<?php

namespace Devicty\MercadoPago;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;

class DevictyMPController extends Controller
{
  
    private $access_token;
    private $public_key;
    private $client_id;
    private $client_secret;

    /**
     * @author Vitor Hugo
     * @version 1.0
     * @description Construtor da classe
     * @param string $public_key
     * @param string $access_token
     * @param string $client_id
     * @param string $client_secret
    */
    public function __construct($access_token, $public_key = null, $client_id = null, $client_secret = null)
    {
        //required
        $this->access_token = $access_token;
        //optional
        $this->public_key = $public_key;
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
    }


    /**
     * @author Vitor Hugo
     * @version 1.0
     * @description Define um getter & setter dinâmico para os atributos da classe
    */
    public function __call($methodName, $params = null)
    {
        //check if first 3 characters are "set"
        if (substr($methodName, 0, 3) == "set") {
                //get the name of the property
                $property = lcfirst(substr($methodName, 4));
                //check if the property exists
                if (property_exists($this, $property)) {
                    //set the property
                    $this->$property = $params[0];
                }else{ throw new \Exception("Property $property does not exist."); }
        }
        elseif(substr($methodName, 0, 3) == "get"){
                //get the name of the property
                $property = lcfirst(substr($methodName, 4));
                //check if the property exists
                if (property_exists($this, $property)) {
                    //set the property
                    return $this->$property;
                }else{ throw new \Exception("Property $property does not exist."); }
        }
        else{
            throw new \Exception("Method $methodName does not exist");
        }
    }


}
