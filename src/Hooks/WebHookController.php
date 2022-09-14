<?php

namespace Devicty\MercadoPago\Hooks;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WebHookController 
{   
    
    /**
     * @author Vitor Hugo
     * @version 1.0
     * @param Request $request
     */
    public function receive(Request $request){
      //CREATE new file in hooks folder and save
      $configurations = (new \App\Models\tb_configurations)->first();
      $InvoiceController = new \Devicty\MercadoPago\Plans\InvoiceController($configurations->destiktok);
      $InvoiceController->set_search_filters([
          'payment_id' => (string)$request->id
      ]);
      
      while(empty(($data = $InvoiceController->find()['results'])) ){
        sleep(30);
      }

      if(!empty($data[0]['external_reference'])){
          //find client by external_reference
          $client = (new \App\Models\tb_clients)->where('uniqueToken', $data[0]['external_reference'])->first();
          //update client
          $client->paymentstatus = 1;
          $client->desplantype = 1;
          $client->preapproval_id = $data[0]['id'];
          $client->save();
      }

      $file = fopen("hooks/".time().".txt", "w");
      fwrite($file, json_encode([
        "data" => $data,
        "request" => $request->all(),
        'search_filters' => $InvoiceController->get_search_filters()
      ]));
      fclose($file);
    
    }

}
