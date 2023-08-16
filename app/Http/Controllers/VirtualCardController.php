<?php

namespace App\Http\Controllers;

use App\Lib\GoogleAuthenticator;
use App\Models\AdminNotification;
use App\Models\GeneralSetting;
use App\Models\Transaction;
use App\Models\VirtualCard;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Carbon\Carbon;

class VirtualCardController extends Controller
{
  public function __construct()
  {
    $this->activeTemplate = activeTemplate();
  }

  public function requestcard()
  {
    $pageTitle = 'Manage Virtual Cards';
    $user = Auth::user();

    $card = VirtualCard::where('user_id', $user->id)->where('status', '!=', 2)->get();
    return view($this->activeTemplate . 'user.cards.manage', compact(
      'pageTitle',
      'user',
      'card'
    ));
  }



  public function requestsubmit(Request $request)
  {


    $request->validate([
      'billing_name' => 'required|string',
      'currency' => 'required|string|max:30',
      'amount' => 'required',

    ], [
      'billing_name.required' => 'Please Enter A Billing Name',
      'currency.required' => 'Please Please Select Currency',
      'amount.required' => 'Please Enter An Amount',
    ]);

    $general = GeneralSetting::first();

    $user = Auth::user();
    $total = $general->cardfee + $request->amount;
    if ($total > $user->balance) {

      $notify[] = ['error', 'Insufficient Balance When Creating Card.'];
      return back()->withNotify($notify);
    }

    $curl = curl_init();
    $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
    $parameter = json_decode($key, true);
    $secret = $parameter['secret_key'];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n    \"currency\": \"" . $request->currency . "\",\n    \"amount\": " . $request->amount . ",\n    \"billing_name\": \"" . $request->billing_name . "\",\n    \"billing_address\": \"null\",\n    \"billing_city\": \"null \",\n    \"billing_state\": \"CA\",\n    \"billing_postal_code\": \"null\",\n    \"billing_country\": \"US\",\n    \"callback_url\": \"https://your-callback-url.com/\"\n}",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $secret
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $reply = json_decode($response, true);
    // dd($response);
    //return $reply;
    if (!isset($reply['status'])) {
      $notify[] = ['error', 'Gateway Error.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] != "success") {
      $notify[] = ['error', 'Error Creating Card.'];
      return back()->withNotify($notify);
    }


    if ($reply['status'] == "success") {
      $user->balance -= $total;
      $user->save();
      $save = new VirtualCard();
      $save->user_id = $user->id;
      $save->status = $reply['data']['is_active'];
      $save->reference = $reply['data']['id'];
      $save->masked_pan = $reply['data']['masked_pan'];
      $save->card_type = $reply['data']['card_type'];
      $save->name_on_card = $reply['data']['name_on_card'];

      $save->save();



      $transaction = new Transaction();
      $transaction->user_id = $user->id;
      $transaction->amount = $total;
      $transaction->post_balance = $user->balance;
      $transaction->charge = 0;
      $transaction->trx_type = '-';
      $transaction->details = 'Fund Debited From Wallet To Service Virtual Master Card Creation';
      $transaction->trx = getTrx();
      $transaction->save();

      $notify[] = ['success', 'Virtual Card Created Successfully.'];
      return back()->withNotify($notify);
    } else {
      $notify[] = ['error', 'Error Creating Card.'];
      return back()->withNotify($notify);
    }
  }




  public function viewcard($id)
  {

    $user = Auth::user();
    $card = VirtualCard::where('user_id', $user->id)->whereReference($id)->first();
    if (!$card) {
      $notify[] = ['error', 'Invalid Virtual Card.'];
      return back()->withNotify($notify);
    }

    $curl = curl_init();
    $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
    $parameter = json_decode($key, true);
    $secret = $parameter['secret_key'];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/" . $id,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $secret
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $reply = json_decode($response, true);
    //return $reply;
    if (!isset($reply['status'])) {
      $notify[] = ['error', 'Gateway Error.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] != "success") {
      $notify[] = ['error', 'Error Opening Card.'];
      return back()->withNotify($notify);
    }


    if ($reply['status'] == "success") {
      $data['amount'] = $reply['data']['amount'];
      $data['currency'] = $reply['data']['currency'];
      $data['cardno'] = $reply['data']['card_pan'];
      $data['cvv'] = $reply['data']['cvv'];
      $data['expire'] = $reply['data']['expiration'];
      $data['type'] = $reply['data']['card_type'];
      $data['user'] = $reply['data']['name_on_card'];
      $data['status'] = $reply['data']['is_active'];
      $pageTitle = 'My Virtual Card';
      return view($this->activeTemplate . 'user.cards.view', $data, compact('pageTitle', 'card'));
    }

    $notify[] = ['error', 'Error Viewing Card.'];
    return back()->withNotify($notify);
  }


  public function blockcard($id)
  {

    $user = Auth::user();
    $card = VirtualCard::where('user_id', $user->id)->whereReference($id)->first();
    if (!$card) {
      $notify[] = ['error', 'Invalid Virtual Card.'];
      return back()->withNotify($notify);
    }

    $curl = curl_init();
    $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
    $parameter = json_decode($key, true);
    $secret = $parameter['secret_key'];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/" . $id . "/status/block",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $secret
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $reply = json_decode($response, true);
    //return $reply;
    if (!isset($reply['status'])) {
      $notify[] = ['error', 'Gateway Error.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] != "success") {
      $notify[] = ['error', 'Error Opening Card.'];
      return back()->withNotify($notify);
    }


    if ($reply['status'] == "success") {
      $card->status = 0;
      $card->save();
      $notify[] = ['success', '' . $reply['message'] . ''];
      return back()->withNotify($notify);
    }

    $notify[] = ['error', 'Error Viewing Card.'];
    return back()->withNotify($notify);
  }

  public function unblockcard($id)
  {


    $user = Auth::user();
    $card = VirtualCard::where('user_id', $user->id)->whereReference($id)->first();
    if (!$card) {
      $notify[] = ['error', 'Invalid Virtual Card.'];
      return back()->withNotify($notify);
    }

    $curl = curl_init();
    $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
    $parameter = json_decode($key, true);
    $secret = $parameter['secret_key'];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/" . $id . "/status/unblock",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $secret
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $reply = json_decode($response, true);
    //return $reply;
    if (!isset($reply['status'])) {
      $notify[] = ['error', 'Gateway Error.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] != "success") {
      $notify[] = ['error', 'Error Opening Card.'];
      return back()->withNotify($notify);
    }


    if ($reply['status'] == "success") {
      $card->status = 0;
      $card->save();
      $notify[] = ['success', '' . $reply['message'] . ''];
      return back()->withNotify($notify);
    }

    $notify[] = ['error', 'Error Viewing Card.'];
    return back()->withNotify($notify);
  }


  public function fundcard(Request $request, $id)
  {

    $request->validate([
      'amount' => 'required',
      'payment-method' => 'required',

    ], [
      'amount.required' => 'Please Enter An Amount',
      'payment-method.required' => 'Please Select A Payment Method',
    ]);

    $user = Auth::user();
    $card = VirtualCard::where('user_id', $user->id)->whereReference($id)->first();
    if (!$card) {
      $notify[] = ['error', 'Invalid Virtual Card.'];
      return back()->withNotify($notify);
    }

    $user = Auth::user();
    $total = $request->amount;
    if ($total > $user->balance) {

      $notify[] = ['error', 'Insufficient Balance When Funding Card.'];
      return back()->withNotify($notify);
    }

    $curl = curl_init();
    $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
    $parameter = json_decode($key, true);
    $secret = $parameter['secret_key'];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/" . $id . "/fund",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n    \"debit_currency\": \"USD\",\n    \"amount\": " . $request->amount . "\n}",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $secret
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $reply = json_decode($response, true);
    //return $reply;
    if (!isset($reply['status'])) {
      $notify[] = ['error', 'Gateway Error.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] != "success") {
      $notify[] = ['error', 'Error Opening Card.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] == "success") {
      $user->balance -= $total;
      $user->save();
      $notify[] = ['success', 'Card Funded Successfuly.'];
      return back()->withNotify($notify);
    }

    $notify[] = ['error', 'Error Viewing Card.'];
    return back()->withNotify($notify);
  }

  public function trxcard(Request $request, $id)
  {

    $request->validate([
      'start' => 'required',
      'end' => 'required',

    ], [
      'start.required' => 'Please Enter Start Date',
      'end.required' => 'Please Enter End Date',
    ]);

    $user = Auth::user();
    $card = VirtualCard::where('user_id', $user->id)->whereReference($id)->first();
    if (!$card) {
      $notify[] = ['error', 'Invalid Virtual Card.'];
      return back()->withNotify($notify);
    }

    $curl = curl_init();
    $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
    $parameter = json_decode($key, true);
    $secret = $parameter['secret_key'];

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/" . $id . "/transactions?from=" . $request->start . "&to=" . $request->end . "&index=1&size=5",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $secret
      ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $reply = json_decode($response, true);

    if (!isset($reply['status'])) {
      $notify[] = ['error', 'Gateway Error.'];
      return back()->withNotify($notify);
    }

    if ($reply['status'] != "success") {
      $notify[] = ['error', 'Error Opening Card.'];
      return back()->withNotify($notify);
    }


    if ($reply['status'] == "success") {
      $pageTitle = 'Virtual Card Statement';
      $log = $reply['data'];
      return view($this->activeTemplate . 'user.cards.statement', compact('pageTitle', 'card', 'log'));
    }

    $notify[] = ['error', 'Error Viewing Card.'];
    return back()->withNotify($notify);
  }
}
