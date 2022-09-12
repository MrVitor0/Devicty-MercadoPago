<?php

namespace Devicty\MercadoPago;

use Illuminate\Support\Facades\Http;

class PlansController extends DevictyMPController
{
   
    protected $auto_recurring;
    protected $back_url;
    protected $card_token_id;
    protected $external_reference;
    protected $payer_email;
    protected $preapproval_plan_id;
    protected $reason;
    protected $status;


    /**
     * @author Vitor Hugo
     * @version 1.0
     * @access public
    */
    public function setup_signature(){

        $data = [];
        foreach($this as $key => $value){
            if($value != null){
                $data[$key] = $value;
            }
        }
    
        //guzzle http post
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->get_access_token(),
            'Content-Type' => 'application/json',
        ])->post('https://api.mercadopago.com/preapproval', $data);

        return $response->json();
    }


}
