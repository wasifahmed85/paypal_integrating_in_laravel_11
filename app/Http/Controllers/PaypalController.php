<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Session;

class PaypalController extends Controller
{
    private $_api_Context;
    public function __construct()
    {
        $peypal = config('paypal');
        $this->_api_Context = new ApiContext(new OAuthTokenCredential($peypal['client_id'], $peypal['secret']));
        $this->_api_Context->setConfig($peypal['settings']);
    }
    public function PayWithPaypal()
    {
        return view('Paypal.index');
    }
    public function postPaymentWithPaypal(Request $request)
    {
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal($request->input('amount'));
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl(URL::route('status'));
        $redirectUrls->setCancelUrl(URL::route('status'));

        $payment = new Payment();
        $payment->setIntent('sale');
        $payment->setPayer($payer);
        $payment->setTransactions(array($transaction));
        $payment->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->_api_Context);
            return Redirect::away($payment->getApprovalLink());
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            if (Config::get('app.debug')) {
                Session::put('error', 'Connection timeout');
                return Redirect::route('payWithPaypal');
            } else {
                Session::put('error', 'Some error occur, sorry for inconvenient');
                return Redirect::route('payWithPaypal');
            }
        }
    }
    public function getPaymentWithPaypal(Request $request)
    {
            $input = $request->all();
            $paymentId = $input['paymentId'];
            $payerId = $input['PayerID'];
            $token = $input['token'];

            if (empty($paymentId) || empty($token) || empty($payerId)) {
                Session::put('error', 'Payment Failed');
                return Redirect::route('payWithPaypal');
            }

            $payment = Payment::get($paymentId, $this->_api_Context);
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            $result = $payment->execute($execution, $this->_api_Context);
            dd($result);
            if ($result->getState() == 'approved') {
                Session::put('success', 'Payment Success');
                return Redirect::route('payWithPaypal');
            }
    }

}
