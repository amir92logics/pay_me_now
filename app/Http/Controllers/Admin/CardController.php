<?php

namespace App\Http\Controllers\Admin;

use App\Models\Gateway;
use App\Models\GeneralSetting;
use App\Http\Controllers\Controller;
use App\Models\VirtualCard;
use App\Models\GatewayCurrency;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CardController extends Controller
{

    public function active()
    {
        $pageTitle = 'Active Card';
        $emptyMessage = 'No Active Card.';
        $card = VirtualCard::where('status','!=', 2)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.card.index', compact('pageTitle', 'emptyMessage', 'card'));
    }

  public function inactive()
    {
        $pageTitle = 'Terminated Card';
        $emptyMessage = 'No Terminated Card.';
        $card = VirtualCard::where('status', 2)->orderBy('id','desc')->paginate(getPaginate());
        return view('admin.card.index', compact('pageTitle', 'emptyMessage', 'card'));
    }


    public function view($id)
    {

        $card = VirtualCard::whereReference($id)->first();
         if (!$card) {
            $notify[] = ['error', 'Invalid Virtual Card.'];
            return back()->withNotify($notify);
        }

        $curl = curl_init();
        $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
        $parameter = json_decode($key, true);
        $secret = $parameter['secret_key'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/".$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$reply = json_decode($response, true);
//return $reply;
if(!isset($reply['status']))
{
 $notify[] = ['error', 'Gateway Error.'];
 return back()->withNotify($notify);
}

if($reply['status'] != "success")
{
 $notify[] = ['error', 'Error Opening Card.'];
 return back()->withNotify($notify);
}


if($reply['status'] == "success")
{
$data['amount'] = $reply['data']['amount'];
$data['currency'] = $reply['data']['currency'];
$data['cardno'] = $reply['data']['card_pan'];
$data['cvv'] = $reply['data']['cvv'];
$data['expire'] = $reply['data']['expiration'];
$data['type'] = $reply['data']['card_type'];
$data['user'] = $reply['data']['name_on_card'];
$data['status'] = $reply['data']['is_active'];
$pageTitle = 'View Virtual Card';
return view('admin.card.view',$data, compact('pageTitle','card'));
    }

$notify[] = ['error', 'Error Viewing Card.'];
 return back()->withNotify($notify);

}

     public function fundcard(Request $request,$id)
    {

     $request->validate([
            'amount' => 'required',

        ],[
            'amount.required'=>'Please Enter An Amount',
        ]);

        $card = VirtualCard::whereReference($id)->first();
         if (!$card) {
            $notify[] = ['error', 'Invalid Virtual Card.'];
            return back()->withNotify($notify);
        }

        $curl = curl_init();
        $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
        $parameter = json_decode($key, true);
        $secret = $parameter['secret_key'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/".$id."/fund",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
   CURLOPT_POSTFIELDS =>"{\n    \"debit_currency\": \"USD\",\n    \"amount\": ".$request->amount."\n}",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$reply = json_decode($response, true);
//return $reply;
if(!isset($reply['status']))
{
 $notify[] = ['error', 'Gateway Error.'];
 return back()->withNotify($notify);
}

if($reply['status'] != "success")
{
 $notify[] = ['error', 'Error Opening Card.'];
 return back()->withNotify($notify);
}


if($reply['status'] == "success")
{

 $notify[] = ['success', 'Card Funded Successfuly.'];
 return back()->withNotify($notify);

}

$notify[] = ['error', 'Error Viewing Card.'];
 return back()->withNotify($notify);

}


 public function trxcard(Request $request,$id)
    {

     $request->validate([
            'start' => 'required',
            'end' => 'required',

        ],[
            'start.required'=>'Please Enter Start Date',
            'end.required'=>'Please Enter End Date',
        ]);

        $card = VirtualCard::whereReference($id)->first();
         if (!$card) {
            $notify[] = ['error', 'Invalid Virtual Card.'];
            return back()->withNotify($notify);
        }

        $curl = curl_init();
        $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
        $parameter = json_decode($key, true);
        $secret = $parameter['secret_key'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/".$id."/transactions?from=".$request->start."&to=".$request->end."&index=1&size=5",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$reply = json_decode($response, true);

if(!isset($reply['status']))
{
 $notify[] = ['error', 'Gateway Error.'];
 return back()->withNotify($notify);
}

if($reply['status'] != "success")
{
 $notify[] = ['error', 'Error Opening Card.'];
 return back()->withNotify($notify);
}


if($reply['status'] == "success")
{
$pageTitle = 'Virtual Card Statement';
$log = $reply['data'];
if(!$log)
{
 $notify[] = ['error', 'There is no transaction record for this daterange'];
 return back()->withNotify($notify);
}

return view('admin.card.statement', compact('pageTitle','card','log'));


}

$notify[] = ['error', 'Error Viewing Card.'];
 return back()->withNotify($notify);

}



       public function block($id)
    {

        $card = VirtualCard::whereReference($id)->first();
         if (!$card) {
            $notify[] = ['error', 'Invalid Virtual Card.'];
            return back()->withNotify($notify);
        }

        $curl = curl_init();
        $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
        $parameter = json_decode($key, true);
        $secret = $parameter['secret_key'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/".$id."/status/block",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$reply = json_decode($response, true);
//return $reply;
if(!isset($reply['status']))
{
 $notify[] = ['error', 'Gateway Error.'];
 return back()->withNotify($notify);
}

if($reply['status'] != "success")
{
 $notify[] = ['error', $reply['message']];
 return back()->withNotify($notify);
}


if($reply['status'] == "success")
{
$card->status = 0;
$card->save();
 $notify[] = ['success', ''.$reply['message'].''];
 return back()->withNotify($notify);

}

$notify[] = ['error', 'Error Viewing Card.'];
 return back()->withNotify($notify);

}

       public function unblock($id)
    {


        $card = VirtualCard::whereReference($id)->first();
         if (!$card) {
            $notify[] = ['error', 'Invalid Virtual Card.'];
            return back()->withNotify($notify);
        }

        $curl = curl_init();
        $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
        $parameter = json_decode($key, true);
        $secret = $parameter['secret_key'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/".$id."/status/unblock",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$reply = json_decode($response, true);
//return $reply;
if(!isset($reply['status']))
{
 $notify[] = ['error', 'Gateway Error.'];
 return back()->withNotify($notify);
}

if($reply['status'] != "success")
{
 $notify[] = ['error', 'Error Unfreezing Card.'];
 return back()->withNotify($notify);
}


if($reply['status'] == "success")
{
$card->status = 0;
$card->save();
 $notify[] = ['success', ''.$reply['message'].''];
 return back()->withNotify($notify);

}

$notify[] = ['error', 'Error Viewing Card.'];
 return back()->withNotify($notify);

}



       public function terminate($id)
    {

        $card = VirtualCard::whereReference($id)->first();
         if (!$card) {
            $notify[] = ['error', 'Invalid Virtual Card.'];
            return back()->withNotify($notify);
        }

        $curl = curl_init();
        $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
        $parameter = json_decode($key, true);
        $secret = $parameter['secret_key'];

  curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.flutterwave.com/v3/virtual-cards/".$id."/terminate",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "PUT",
  CURLOPT_HTTPHEADER => array(
    "Content-Type: application/json",
    "Authorization: Bearer ".$secret
  ),
));

$response = curl_exec($curl);

curl_close($curl);
$reply = json_decode($response, true);
//return $reply;
if(!isset($reply['status']))
{
 $notify[] = ['error', 'Gateway Error.'];
 return back()->withNotify($notify);
}

if($reply['status'] != "success")
{
 $notify[] = ['error', 'Error Opening Card.'];
 return back()->withNotify($notify);
}


if($reply['status'] == "success")
{
$card->status = 2;
$card->save();
$notify[] = ['success', ''.$reply['message'].''];
return redirect()->route('admin.card.active')->withNotify($notify);

}

$notify[] = ['error', 'Error Viewing Card.'];
 return back()->withNotify($notify);

}



}
