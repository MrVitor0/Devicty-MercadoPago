<?php

namespace Devicty\MercadoPago\Plans;

use Illuminate\Support\Facades\Http;

class SignatureController extends \Devicty\MercadoPago\DevictyMPController
{
   
    //@setup()
    protected $auto_recurring;
    protected $back_url;
    protected $reason;
    protected $payment_methods_allowed;

    //@find()
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
        ])->post('https://api.mercadopago.com/preapproval_plan', $data);
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
            ])->get("https://api.mercadopago.com/preapproval_plan/$id");
            return $response->json();
        };

        !empty($query) ?? $this->search_filters = $query;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->get_access_token(),
            'Content-Type' => 'application/json',
        ])->get('https://api.mercadopago.com/preapproval_plan/search', $this->search_filters);
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
        ])->put("https://api.mercadopago.com/preapproval_plan/$id", $data);
        return $response->json();
    }

}
