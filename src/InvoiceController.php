<?php

namespace Devicty\MercadoPago;

use Illuminate\Support\Facades\Http;

class InvoiceController extends DevictyMPController
{
    protected $search_filters;

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
            ])->get("https://api.mercadopago.com/authorized_payments/$id");
            return $response->json();
        };

        !empty($query) ?? $this->search_filters = $query;
        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.$this->get_access_token(),
            'Content-Type' => 'application/json',
        ])->get('https://api.mercadopago.com/authorized_payments/search', $this->search_filters);
        return $response->json();
    }


}
