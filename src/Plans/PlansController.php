<?php

namespace Devicty\MercadoPago\Plans;

use Illuminate\Support\Facades\Http;

class PlansController extends \Devicty\MercadoPago\DevictyMPController
{
   
    protected $auto_recurring;
    protected $back_url;
    protected $card_token_id;
    protected $external_reference;
    protected $payer_email;
    protected $preapproval_plan_id;
    protected $reason;
    protected $status;
    protected $search_filters;
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @access public
    */
    public function setup(){
        $data = [];
        foreach($this as $key => $value){
            if($value != null && $key != "search_filters"){
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


    /**
     * @author Vitor Hugo
     * @version 1.0
     * @access public
     * @param string $id
     * @param array $id
     * @return JSON
    */
    public function find($id = null, $query = []){

        if(!empty($id)){
            $response = Http::withHeaders([
                'Authorization' => 'Bearer '.$this->get_access_token(),
                'Content-Type' => 'application/json',
            ])->get("https://api.mercadopago.com/preapproval/$id");
            return $response->json();
        };

        !empty($query) ?? $this->search_filters = $query;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->get_access_token(),
            'Content-Type' => 'application/json',
        ])->get('https://api.mercadopago.com/preapproval/search', $this->search_filters);
        return $response->json();
    }


    /**
     * @author Vitor Hugo
     * @version 1.0
     * @access public
     * @param string $id
     * @return JSON
    */
    public function update($id){

        $data = [];
        foreach($this as $key => $value){
            if($value != null && $key != "search_filters"){
                $data[$key] = $value;
            }
        }
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->get_access_token(),
            'Content-Type' => 'application/json',
        ])->put("https://api.mercadopago.com/preapproval/$id", $data);
        return $response->json();
    }

}
