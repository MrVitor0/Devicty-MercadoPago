# Devicty MPDevKit

- How Works?
> Devicty MPDevKit is a library that allows you to integrate MercadoPago in your application, it is very easy to use and has a lot of features.

- Features
> - [x] Plans Fully Integrated
> - [x] Subscriptions Fully Integrated
> - [x] Invoices Fully Integrated
> - [ ]  Preferences Fully Integrated

- How to use?
> - [x] Plans 
- Create a plan
```php
  $PlansController = new \Devicty\MercadoPago\PlansController($YOUR_ACCESS_TOKEN);
  //Add optional parameters if you want, like:
  $PlansController->set_payer_email('Payer@Example.com');
  $PlansController->set_external_reference('PayerID_Example');
  $PlansController->set_reason('YX Plan Example');
  $PlansController->set_back_url('https://' . $_SERVER['HTTP_HOST'] . '/success');
  $PlansController->set_auto_recurring([
      'frequency' => 1,
      'frequency_type' => 'months',
      'transaction_amount' => 10,
      'currency_id' => 'BRL',
  ]);
  //Call setup function, response will be gived in json format
  $response = $PlansController->setup();  
```
- Get a plan
```php
  $PlansController = new \Devicty\MercadoPago\PlansController($YOUR_ACCESS_TOKEN);
  //Call get function, response will be gived in json format
  $response = $PlansController->find($PLAN_ID);
```
- Get all plans
```php
  $PlansController = new \Devicty\MercadoPago\PlansController($YOUR_ACCESS_TOKEN);
  //pass optional parameters if you want, like:
  $PlansController->set_search_filters([
    "limit" => 10,
  ]);
  //Call get function, response will be gived in json format
  $response = $PlansController->find();
```
- Update a plan
```php
  $PlansController = new \Devicty\MercadoPago\PlansController($YOUR_ACCESS_TOKEN);
  //Set parameters to update, like:
   $PlansController->set_status('cancelled');
  //Call update function, response will be gived in json format
  $response = $PlansController->update($PLAN_ID);
```

- Installation
> - [x] Manual Installation (Download the repository and add the files to your project)
> - [ ] Composer `composer require devicty/mpdevkit`
> - [ ] Cocoapods
> - [ ] Carthage




