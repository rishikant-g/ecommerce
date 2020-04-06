<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// require __DIR__ . '/../bootstrap.php';
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;


//second part
use PayPal\Api\PaymentExecution;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/create-payment',function(){
    

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AbqHXXnE7vC_EB7HgGoYjj67Ch6QBh-4j67GltCAQTWSbeXK9rJk9P4mzItVp-TdPPfpBo_G1RuJ5XY9',
        'ELdGU-yMgJuubmwV0yJLMNU3HUciIbOa29tc5E3fmccpQ3UWy2ZfxkRLIQKOYCeloCgOUWJwAqfnKG0x'
    )
    );




    $payer = new Payer();
    $payer->setPaymentMethod("paypal");
    $item1 = new Item();
$item1->setName('Ground Coffee 40 oz')
    ->setCurrency('INR')
    ->setQuantity(1)
    ->setSku("123123") // Similar to `item_number` in Classic API
    ->setPrice(7.5);
$item2 = new Item();
$item2->setName('Granola bars')
    ->setCurrency('INR')
    ->setQuantity(5)
    ->setSku("321321") // Similar to `item_number` in Classic API
    ->setPrice(2);

$itemList = new ItemList();
$itemList->setItems(array($item1, $item2));

$details = new Details();
$details->setShipping(1.2)
    ->setTax(1.3)
    ->setSubtotal(17.50);

    $amount = new Amount();
$amount->setCurrency("INR")
    ->setTotal(20)
    ->setDetails($details);

    $transaction = new Transaction();
$transaction->setAmount($amount)
    ->setItemList($itemList)
    ->setDescription("Payment description")
    ->setInvoiceNumber(uniqid());

    
$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl("http://127.0.0.1:8000/")
    ->setCancelUrl("http://127.0.0.1:8000/");


    $payment = new Payment();
$payment->setIntent("sale")
    ->setPayer($payer)
    ->setRedirectUrls($redirectUrls)
    ->setTransactions(array($transaction));

    $request = clone $payment;



    try {
        $payment->create($apiContext);
    } catch (Exception $ex) {
        ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
        exit(1);
    }


    // $approvalUrl = $payment->getApprovalLink();
    // ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

    return $payment;

});







Route::post('/execute-payment',function(Request $request){


    $apiContext = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'AbqHXXnE7vC_EB7HgGoYjj67Ch6QBh-4j67GltCAQTWSbeXK9rJk9P4mzItVp-TdPPfpBo_G1RuJ5XY9',
            'ELdGU-yMgJuubmwV0yJLMNU3HUciIbOa29tc5E3fmccpQ3UWy2ZfxkRLIQKOYCeloCgOUWJwAqfnKG0x'
        )
        );



        $paymentId = $request->paymentId;
        $payment = Payment::get($paymentId, $apiContext);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->PayerID);


// Adding shipping cost
        // $transaction = new Transaction();
        // $amount = new Amount();
        // $details = new Details();
    
        // $details->setShipping(2.2)
        //     ->setTax(1.3)
        //     ->setSubtotal(17.50);
    
        // $amount->setCurrency('INR');
        // $amount->setTotal(21);
        // $amount->setDetails($details);
        // $transaction->setAmount($amount);



        $execution->addTransaction($transaction);

        try {   
            $result = $payment->execute($execution, $apiContext);
            try {
                $payment = Payment::get($paymentId, $apiContext);
            } catch (Exception $ex) {
                exit(1);
            }
        } catch (Exception $ex) {
            exit(1);
        }
        
    return $payment;


});
