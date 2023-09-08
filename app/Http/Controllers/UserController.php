<?php

namespace App\Http\Controllers;

use PDF;
use Swift_Mailer;
use Carbon\Carbon;
use App\Models\Kyc;
use App\Models\Desk;
use App\Models\Loan;
use App\Models\Plan;
use App\Models\User;
use App\Models\Deposit;
use App\Models\Savings;
use App\Models\Transfer;
use Swift_SmtpTransport;
use App\Models\SavingPay;
use App\Models\Investment;
use App\Models\Kycsetting;
use App\Models\Withdrawal;
use App\Mail\TrxReportMail;
use App\Models\Transaction;
use Illuminate\Mail\Mailer;
use Illuminate\Http\Request;
use App\Models\SupportTicket;
use App\Models\DashboardSlide;
use App\Models\GeneralSetting;
use App\Models\SupportMessage;
use App\Models\WithdrawMethod;
use App\Models\GatewayCurrency;
use App\Rules\FileTypeValidate;
use App\Lib\GoogleAuthenticator;
use App\Models\DashboardContent;
use App\Models\SubSavingAccount;
use App\Models\AdminNotification;
use App\Models\SupportAttachment;
use App\Models\TransferBeneficiary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function __construct()
    {
        $this->activeTemplate = activeTemplate();
    }

    public function home()
    {
        $pageTitle = 'Dashboard';
        $year = date('Y');
        $month = date('m');
        $day = date('d');

        $jan = '01';
        $feb = '02';
        $mar = '03';
        $apr = '04';
        $may = '05';
        $jun = '06';
        $jul = '07';
        $aug = '08';
        $sep = '09';
        $oct = '10';
        $nov = '11';
        $dec = '12';

        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();

        $data['tjan'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $jan)->sum('amount');
        $data['tfeb'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $feb)->sum('amount');
        $data['tmar'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $mar)->sum('amount');
        $data['tapr'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $apr)->sum('amount');
        $data['tmay'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $may)->sum('amount');
        $data['tjun'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $jun)->sum('amount');
        $data['tjul'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $jul)->sum('amount');
        $data['taug'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $aug)->sum('amount');
        $data['tsep'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $sep)->sum('amount');
        $data['toct'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $oct)->sum('amount');
        $data['tnov'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $nov)->sum('amount');
        $data['tdec'] = SavingPay::wherePlanId(2)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $dec)->sum('amount');


        $data['rjan'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $jan)->sum('amount');
        $data['rfeb'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $feb)->sum('amount');
        $data['rmar'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $mar)->sum('amount');
        $data['rapr'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $apr)->sum('amount');
        $data['rmay'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $may)->sum('amount');
        $data['rjun'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $jun)->sum('amount');
        $data['rjul'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $jul)->sum('amount');
        $data['raug'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $aug)->sum('amount');
        $data['rsep'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $sep)->sum('amount');
        $data['roct'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $oct)->sum('amount');
        $data['rnov'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $nov)->sum('amount');
        $data['rdec'] = SavingPay::wherePlanId(1)->where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->whereMonth('created_at', $dec)->sum('amount');

        $emptyMessage = 'No Transaction Record Found At The Moment. Please Check Back Later';
        $yloan = Loan::where('user_id', $user->id)->whereStatus(1)->whereYear('created_at', $year)->where('status', '!=', 0)->where('status', '!=', 3)->sum('amount');
        $loan = Loan::where('user_id', $user->id)->whereStatus(1)->whereStatus(1)->sum('amount');
        $pendingDeposit = Deposit::where('user_id', $user->id)->whereStatus(2)->whereStatus(2)->sum('amount');
        $paid = Loan::where('user_id', $user->id)->whereStatus(1)->whereStatus(1)->sum('paid');
        $bal = $loan - $paid;
        $saved = Savings::where('user_id', $user->id)->whereYear('created_at', $year)->sum('balance');

        $dashboardSlides = DashboardSlide::all();
        $dashboardFooter = DashboardContent::where('data_key', '=', 'dashboard.footer')->get();
        $subSavingAccounts = SubSavingAccount::where('user_id', auth()->id())->get();
        return view($this->activeTemplate . 'user.dashboard', $data, compact(
            'pageTitle',
            'user',
            'emptyMessage',
            'loan',
            'yloan',
            'saved',
            'bal',
            'dashboardSlides',
            'dashboardFooter',
            'subSavingAccounts',
            'pendingDeposit'
        ));
    }

    public function depositlatestTrx()
    {
        $pageTitle = "Deposite Histroy";
        $emptyMessage = 'No Transaction Record Found At The Moment. Please Check Back Later';
        $latestTrx = Transaction::where('user_id', auth()->id())->latest()->limit(10)->get();
        return view($this->activeTemplate . 'user.deposit.latest_trx', compact('pageTitle', 'emptyMessage', 'latestTrx'));
    }

    public function depositStatistics()
    {
        $pageTitle = "Deposite Statistics";
        $totalDeposit = Deposit::where('user_id', auth()->id())->where('status', 1)->sum('amount');
        $totalWithdraw = Withdrawal::where('user_id', auth()->id())->where('status', 1)->sum('amount');
        $totalInvest = Investment::where('user_id', auth()->id())->sum('amount');
        return view($this->activeTemplate . 'user.deposit.statistics', compact('pageTitle', 'totalDeposit', 'totalWithdraw', 'totalInvest'));
    }

    public function profile()
    {
        $pageTitle = "Profile Setting";
        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();
        return view($this->activeTemplate . 'user.settings.profile_setting', compact('pageTitle', 'user'));
    }

    public function submitProfile(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:50',
            'lastname' => 'required|string|max:50',
            'address' => 'sometimes|required|max:80',
            'state' => 'sometimes|required|max:80',
            'zip' => 'sometimes|required|max:40',
            'city' => 'sometimes|required|max:50',
            'image' => ['image', new FileTypeValidate(['jpg', 'jpeg', 'png'])]
        ], [
            'firstname.required' => 'First name field is required',
            'lastname.required' => 'Last name field is required'
        ]);

        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();

        $in['firstname'] = $request->firstname;
        $in['lastname'] = $request->lastname;

        $in['address'] = [
            'address' => $request->address,
            'state' => $request->state,
            'zip' => $request->zip,
            'country' => @$user->address->country,
            'city' => $request->city,
        ];


        if ($request->hasFile('image')) {
            $location = imagePath()['profile']['user']['path'];
            $size = imagePath()['profile']['user']['size'];
            $filename = uploadImage($request->image, $location, $size, $user->image);
            $in['image'] = $filename;
        }
        $user->fill($in)->save();
        $notify[] = ['success', 'Profile updated successfully.'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change password';
        return view($this->activeTemplate . 'user.settings.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {

        $password_validation = Password::min(6);
        $general = GeneralSetting::first();

        $this->validate($request, [
            'current_password' => 'required',
            'password' => ['required', 'confirmed', $password_validation]
        ]);


        try {
            /**
             * @var App/Models/User $user
             */
            $user = auth()->user();
            if (Hash::check($request->current_password, $user->password)) {
                $password = Hash::make($request->password);
                $user->password = $password;
                $user->save();
                $notify[] = ['success', 'Password changes successfully.'];
                return back()->withNotify($notify);
            } else {
                $notify[] = ['error', 'The password doesn\'t match!'];
                return back()->withNotify($notify);
            }
        } catch (\PDOException $e) {
            $notify[] = ['error', $e->getMessage()];
            return back()->withNotify($notify);
        }
    }

    /*
     * Deposit History
     */
    public function depositHistory()
    {
        /**
         * @var App/Models/User $user
         */
        $user = auth()->user();
        $pageTitle = 'Deposit History';
        $emptyMessage = 'No history found.';
        $logs = $user->deposits()->with(['gateway'])->orderBy('id', 'desc')->paginate(getPaginate());
        return view($this->activeTemplate . 'user.deposit.deposit_history', compact('pageTitle', 'emptyMessage', 'logs'));
    }

    /*
     * Withdraw Operation
     */


    public function othertransfer()
    {
        $pageTitle = 'Other Bank Transfer';
        $benefit = TransferBeneficiary::whereMethod_id(2)->whereUserId(auth()->id())->get();
        $log = Transfer::whereMethod_id(2)->whereUserId(auth()->id())->latest()->paginate(10);

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.paystack.co/bank',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer SECRET_KEY'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $reply = json_decode($response, true);

        if (!isset($reply)) {
            $notify[] = ['error', 'Invalid Bank API Response. Check Internet Settings'];
            return back()->withNotify($notify);
        }
        if (!$reply['data']) {
            $notify[] = ['error', 'Banks Not Available At The Moment. '];
            return back()->withNotify($notify);
        }

        $banks = $reply['data'];


        return view($this->activeTemplate . 'user.transfer.othertransfer', compact('pageTitle', 'banks', 'log'));
    }

    public function othertransfersubmit(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'amount' => 'required|numeric'
        ]);
        /**
         * @var App/Models/User $user
         */
        $user = auth()->user();


        if ($request->amount > $user->balance) {
            $notify[] = ['error', 'You do not have sufficient balance for transfer.'];
            return back()->withNotify($notify);
        }

        if ($request->type == 1) {
            $this->validate($request, [
                'bank' => 'required',
                'account' => 'required',
            ]);

            $key = GatewayCurrency::whereMethodCode(107)->first()->gateway_parameter;
            $parameter = json_decode($key, true);
            $secret = $parameter['secret_key'];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.paystack.co/bank/resolve?account_number=' . $request->account . '&bank_code=' . $request->bank . '',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer ' . $secret
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            $reply = json_decode($response, true);
            if (!isset($reply)) {
                $notify[] = ['error', 'Invalid Gateway Response.'];
                return back()->withNotify($notify);
            }
            if ($reply['status'] != 'true') {
                $notify[] = ['error', 'Invalid Gateway Response.'];
                return back()->withNotify($notify);
            }

            if ($reply['status'] == 'true') {

                session()->put('name', $reply['data']['account_name']);
                session()->put('amount', $request->amount);
                session()->put('accountnumber', $request->account);
                session()->put('bankcode', $request->bank);
                session()->put('bankname', $request->bankn);
                session()->put('type', $request->type);
                return redirect()->route('user.transfer.previewother');
            }
        }
        if ($request->type == 2) {
            $this->validate($request, [
                'bankname' => 'required',
                'accountnumber' => 'required',
                'accountname' => 'required',
                'country' => 'required',
                'swiftcode' => 'required',
            ]);

            session()->put('name', $request->accountname);
            session()->put('amount', $request->amount);
            session()->put('accountnumber', $request->accountnumber);
            session()->put('bankcode', $request->swiftcode);
            session()->put('bankname', $request->bankname);

            session()->put('country', $request->country);
            session()->put('type', $request->type);
            return redirect()->route('user.transfer.previewother');
        }

        $notify[] = ['error', 'Sorry we cant process this transfer at the moment.'];
        return back()->withNotify($notify);
    }


    public function transferpreviewother()
    {
        $amount = session()->get('amount');
        $accountnumber = session()->get('accountnumber');
        $name = session()->get('name');
        $bankcode = session()->get('bankcode');
        $country = session()->get('country');
        $bankname = session()->get('bankname');
        $type = session()->get('type');
        $pageTitle = 'Transfer Preview';
        return view($this->activeTemplate . 'user.transfer.previewother', compact('type', 'pageTitle', 'amount', 'accountnumber', 'name', 'bankcode', 'country', 'bankname'));
    }


    public function transferpreviewothersubmit(Request $request)
    {

        $general = GeneralSetting::first();
        $amount = session()->get('amount');
        $accountnumber = session()->get('accountnumber');
        $name = session()->get('name');
        $bankcode = session()->get('bankcode');
        $country = session()->get('country');
        $bankname = session()->get('bankname');
        $type = session()->get('type');
        $chargepay = $request->chargepay;

        $charge = $amount * $general->transferfee / 100;

        /**
        @var App/Models/User $user */
        $user = auth()->user();

        $total = $amount + $charge;

        if ($amount > $user->balance) {
            $notify[] = ['error', 'You do not have sufficient balance for transfer.'];
            return back()->withNotify($notify);
        }

        if ($chargepay == 2) {
            if ($total > $user->balance) {
                $notify[] = ['error', 'You do not have sufficient balance for transfer.'];
                return back()->withNotify($notify);
            }
            $pay = $total;
        }
        $pay = $amount;

        if ($type == 1) {
            $key = GatewayCurrency::whereMethodCode(109)->first()->gateway_parameter;
            $parameter = json_decode($key, true);
            $secret = $parameter['secret_key'];
            $url = "https://api.flutterwave.com/v3/transfers";
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => '{
	"account_bank": "' . $bankcode . '",
    "account_number": "' . $accountnumber . '",
    "amount": "' . $pay . '",
    "narration": "Fund Transfer",
    "currency": "NGN",
    "reference": "' . getTrx() . '",
    "callback_url": "https://webhook.site/b3e505b0-fe02-430e-a538-22bbbce8ce0d",
    "debit_currency": "NGN"
}',
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Authorization: Bearer ' . $secret
                ),
            ));

            $response = curl_exec($curl);


            if (!isset($response)) {
                $notify[] = ['error', 'Invalid API Response.'];
                return back()->withNotify($notify);
            }

            curl_close($curl);
            $rep = json_decode($response, true);

            if (!isset($rep)) {
                $notify[] = ['error', 'Invalid API Response.'];
                return back()->withNotify($notify);
            }
            if ($rep['status'] != 'success') {
                $notify[] = ['error', 'Invalid API Response.'];
                return back()->withNotify($notify);
            }

            if ($rep['status'] == 'success') {

                $transfer = new Transfer();
                $transfer->method_id = 2; // wallet method ID
                $transfer->user_id = $user->id;
                $transfer->charge = $charge;
                $transfer->amount = $amount;
                $transfer->details =
                    "Bank Name: " . $rep['data']['bank_name'] . "<br>
        Account Name: " . $rep['data']['full_name'] . "<br>
        Account Number:  " . $rep['data']['account_number'] . "<br>
        Narration: " . $rep['data']['narration'] . "";
                $transfer->status = 1;
                $transfer->trx = $rep['data']['reference'];
                $transfer->save();

                if ($chargepay == 2) {
                    $user->balance -= $total;
                } {
                    $user->balance -= $amount;
                }
                $user->save();


                $transaction = new Transaction();
                $transaction->user_id = $user->id;
                $transaction->amount = $amount;
                $transaction->post_balance = $user->balance;
                $transaction->charge = $charge;
                $transaction->trx_type = '-';
                $transaction->details = 'Transfer Fund To' . $rep['data']['bank_name'] . ' ' . $rep['data']['account_number'];
                $transaction->trx = $rep['data']['reference'];
                $transaction->save();

                $request->session()->forget('amount');
                $request->session()->forget('accountnumber');
                $request->session()->forget('name');
                $request->session()->forget('bankcode');
                $request->session()->forget('country');
                $request->session()->forget('bankname');
                $request->session()->forget('type');


                $notify[] = ['success', 'Fund Transfered Successfully'];
                return redirect()->route('user.othertransfer')->withNotify($notify);
            }
        } else {
            $trx = getTrx();
            $transfer = new Transfer();
            $transfer->method_id = 2; // wallet method ID
            $transfer->user_id = $user->id;
            $transfer->charge = $charge;
            $transfer->amount = $amount;
            $transfer->details =
                "Bank Name: " . $bankname . "<br>
        Account Name: " . $name . "<br>
        Account Number:  " . $accountnumber . "<br>
        Swift Code:  " . $bankcode . "<br>
        Narration: Other Bank Transfer";
            $transfer->status = 0;
            $transfer->trx = $trx;
            $transfer->save();

            if ($chargepay == 2) {
                $user->balance -= $total;
            } {
                $user->balance -= $amount;
            }
            $user->save();


            $transaction = new Transaction();
            $transaction->user_id = $user->id;
            $transaction->amount = $amount;
            $transaction->post_balance = $user->balance;
            $transaction->charge = $charge;
            $transaction->trx_type = '-';
            $transaction->details = 'Transfer Fund To' . $bankname . ' ' . $accountnumber;
            $transaction->trx = $trx;
            $transaction->save();

            $request->session()->forget('amount');
            $request->session()->forget('accountnumber');
            $request->session()->forget('name');
            $request->session()->forget('bankcode');
            $request->session()->forget('country');
            $request->session()->forget('bankname');
            $request->session()->forget('type');


            $notify[] = ['success', 'Fund Transfered Successfully'];
            return redirect()->route('user.othertransfer')->withNotify($notify);
        }
    }

    public function usertransfer()
    {

        return view($this->activeTemplate . 'user.transfer.usertransfer', compact('benefit', 'log'));
    }

    public function requestsubmit(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'amount' => 'required|numeric'
        ]);

        $user = auth()->user();

        if ($request->type == 1) {
            $this->validate($request, [
                'beneficiary' => 'required',
            ]);
            $username = $request->beneficiary;
        } else {
            $this->validate($request, [
                'username' => 'required',
            ]);
            $username = $request->username;
        }
        $beneficiary = User::whereAccountNumber($username)->first();

        if ($username == $user->account_number) {
            $notify[] = ['error', 'You cant transfer fund to the same beneficiary account.'];
            return back()->withNotify($notify);
        }

        if (!$beneficiary) {
            $notify[] = ['error', 'Invalid Beneficiary Account Number.'];
            return back()->withNotify($notify);
        }
        if ($request->amount > $user->balance) {
            $notify[] = ['error', 'You do not have sufficient balance for this transfer.'];
            return back()->withNotify($notify);
        }


        $withdraw = new Transfer();
        $withdraw->method_id = 1; // wallet method ID
        $withdraw->user_id = $user->id;
        $withdraw->amount = $request->amount;
        $withdraw->details = $username;
        $withdraw->status = 1;
        $withdraw->trx = getTrx();
        //$withdraw->save();
        session()->put('username', $withdraw->details);
        session()->put('amount', $withdraw->amount);
        session()->put('fname', $beneficiary->firstname);
        session()->put('lname', $beneficiary->lastname);
        return redirect()->route('user.usertransfer.preview');
    }

    public function usertransferpreview()
    {
        $amount = session()->get('amount');
        $username = session()->get('username');
        $fname = session()->get('fname');
        $lname = session()->get('lname');
        $name = $fname . ' ' . $lname;
        $pageTitle = 'Transfer Preview';
        return view($this->activeTemplate . 'user.transfer.preview', compact('pageTitle', 'amount', 'username', 'name'));
    }

    public function usertransfersend(Request $request)
    {

        $amount = session()->get('amount');
        $username = session()->get('username');
        $fname = session()->get('fname');
        $lname = session()->get('lname');
        $name = $fname . ' ' . $lname;

        /**
        @var App/Models/User $user */
        $user = auth()->user();
        $beneficiary = User::whereAccountNumber($username)->first();

        if ($amount > $user->balance) {
            $notify[] = ['error', 'You do not have sufficient balance for this transfer.'];
            return back()->withNotify($notify);
        }

        if (!$beneficiary) {
            $notify[] = ['error', 'Invalid Beneficiary Detected.'];
            return back()->withNotify($notify);
        }


        $transfer = new Transfer();
        $transfer->method_id = 1; // wallet method ID
        $transfer->user_id = $user->id;
        $transfer->amount = $amount;
        $transfer->details = $username;
        $transfer->status = 1;
        $transfer->trx = getTrx();
        $transfer->save();


        $user->balance -= $amount;
        $user->save();

        $beneficiary->balance += $amount;
        $beneficiary->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->details = 'Transfer Fund to ' . $username;
        $transaction->trx = $transfer->trx;
        $transaction->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $amount;
        $transaction->post_balance = $beneficiary->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '+';
        $transaction->details = 'Fund Receieved From ' . $user->account_number;
        $transaction->trx = $transfer->trx;
        $transaction->save();

        if (isset($request->beneficiary)) {
            $benefisaved = TransferBeneficiary::whereMethod_id(1)->whereUserId($user->id)->whereDetails($beneficiary->username)->first();
            if (!$benefisaved) {
                $benefit = new TransferBeneficiary();
                $benefit->user_id = $user->id;
                $benefit->method_id = 1;
                $benefit->status = 1;
                $benefit->details =  $beneficiary->firstname . ' ' . $beneficiary->lastname . ' (' . $beneficiary->username . ')';
                $benefit->save();
            }
        }


        $request->session()->forget('amount');
        $request->session()->forget('username');
        $request->session()->forget('fname');
        $request->session()->forget('lname');

        $notify[] = ['success', 'Fund Transfered Successfully'];
        return redirect()->route('user.usertransfer')->withNotify($notify);
    }

    public function deletebeneficiary($id)
    {
        /**
        @var App/Models/User $user */
        $user = auth()->user();
        $benefit = TransferBeneficiary::whereId($id)->whereUserId($user->id)->first();

        if (!$benefit) {
            $notify[] = ['error', 'Beneficiary Not Found'];
            return back()->withNotify($notify);
        } else {
            $benefit->delete();
            $notify[] = ['success', 'Beneficiary Deleted Successfuly'];
            return back()->withNotify($notify);
        }
    }

    public function show2faForm()
    {
        $general = GeneralSetting::first();
        $ga = new GoogleAuthenticator();
        /**
        @var App/Models/User $user */
        $user = auth()->user();
        $secret = $ga->createSecret();
        $qrCodeUrl = $ga->getQRCodeGoogleUrl($user->username . '@' . $general->sitename, $secret);
        $pageTitle = 'Two Factor';
        return view($this->activeTemplate . 'user.settings.twofactor', compact('pageTitle', 'secret', 'qrCodeUrl'));
    }

    public function create2fa(Request $request)
    {
        /**
        @var App/Models/User $user */
        $user = auth()->user();
        $this->validate($request, [
            'key' => 'required',
            'code' => 'required',
        ]);
        $response = verifyG2fa($user, $request->code, $request->key);
        if ($response) {
            $user->tsc = $request->key;
            $user->ts = 1;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_ENABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Google authenticator enabled successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'Wrong verification code'];
            return back()->withNotify($notify);
        }
    }


    public function disable2fa(Request $request)
    {
        $this->validate($request, [
            'code' => 'required',
        ]);

        /**
        @var App/Models/User $user */
        $user = auth()->user();
        $response = verifyG2fa($user, $request->code);
        if ($response) {
            $user->tsc = null;
            $user->ts = 0;
            $user->save();
            $userAgent = getIpInfo();
            $osBrowser = osBrowser();
            notify($user, '2FA_DISABLE', [
                'operating_system' => @$osBrowser['os_platform'],
                'browser' => @$osBrowser['browser'],
                'ip' => @$userAgent['ip'],
                'time' => @$userAgent['time']
            ]);
            $notify[] = ['success', 'Two factor authenticator disable successfully'];
        } else {
            $notify[] = ['error', 'Wrong verification code'];
        }
        return back()->withNotify($notify);
    }

    public function trxLog()
    {
        $pageTitle = 'Transaction Log';
        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();
        $logs = Transaction::where('user_id', $user->id)->latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.trx_log', compact('pageTitle', 'user', 'logs', 'emptyMessage'));
    }

    public function trxReport()
    {
        $general = GeneralSetting::first();

        $config = $general->mail_config;
        if ($config->name != 'smtp') {
            $notify[] = ['error', 'Mail not sent due to technical Issue Contact Admin'];
            return back()->withNotify($notify);
        }
        try {
            $data["pageTitle"] = "From " . $general->sitename;
            $data["emptyMessage"]  = "You Don't Have any Report History";


            $transport = new Swift_SmtpTransport($config->host, $config->port, $config->enc);
            $transport->setUsername($config->username);
            $transport->setPassword($config->password);

            $swift_mailer = new Swift_Mailer($transport);

            $view = app()->get('view');
            $mailer = new Mailer($general->sitename, $view, $swift_mailer);
            $mailer->to(auth_user()->email)->send(new TrxReportMail($general, $data));
        } catch (\Exception $th) {
            $notify[] = ['error', 'Mail not sent'];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Mail Send successfully'];
        return back()->withNotify($notify);



        // $pdf = PDF::loadView('mails.statement', $data);
        // die();
        // Mail::send('mails.trx_report', $data, function ($message) use ($data, $pdf) {
        //     $message->to($data["email"], $data["email"])
        //         ->subject($data["pageTitle"])
        //         ->attachData($pdf->output(), "report.pdf");
        // });
    }


    public function investmentnew()
    {
        $pageTitle = 'New Investment';
        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();
        $plan = Plan::where('status', 1)->get();
        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.investment.new', compact('pageTitle', 'user', 'plan', 'emptyMessage'));
    }



    public function investment(Request $request)
    {

        $request->validate([
            'amount' => 'required|numeric|gt:0',
            'plan' => 'required|numeric|gt:0'
        ]);

        $findPlan = Plan::where('id', $request->plan)->where('status', 1)->firstOrFail();

        if ($findPlan->min_amount > $request->amount || $findPlan->max_amount < $request->amount) {
            $notify[] = ['error', 'Amount must be between' . showAmount($findPlan->min_amount) . ' and ' . showAmount($findPlan->max_amount)];
            return redirect()->back()->withNotify($notify);
        }

        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();

        if ($user->balance < $request->amount) {
            $notify[] = ['error', 'Sorry you have not sufficient balance'];
            return redirect()->route('user.deposit')->withNotify($notify);
        }

        $perAnnuityInterest = 0;
        $nextReturn = Carbon::now()->addDay(1);

        if ($findPlan->interest_type == 0) {
            $perAnnuityInterest = $findPlan->interest_amount;
        } else {
            $perAnnuityInterest = ($request->amount * $findPlan->interest_amount) / 100;
        }

        $newInvest = new Investment();
        $newInvest->trx = getTrx();
        $newInvest->plan_id = $findPlan->id;
        $newInvest->user_id = $user->id;
        $newInvest->amount = $request->amount;
        $newInvest->interest_type = $findPlan->interest_type;
        $newInvest->interest_amount = $perAnnuityInterest;
        $newInvest->total_return = $findPlan->total_return;
        $newInvest->next_return_date = $nextReturn;
        $newInvest->status = 0;
        $newInvest->save();

        $user->balance -= $request->amount;
        $user->save();

        $transaction = new Transaction();
        $transaction->user_id = $user->id;
        $transaction->amount = $request->amount;
        $transaction->post_balance = $user->balance;
        $transaction->charge = 0;
        $transaction->trx_type = '-';
        $transaction->details = 'Investment in ' . $findPlan->name;
        $transaction->trx =  $newInvest->trx;
        $transaction->save();

        $adminNotification = new AdminNotification();
        $adminNotification->user_id = $user->id;
        $adminNotification->title = 'New Investment In ' . $findPlan->name . ' from ' . $user->username;
        $adminNotification->click_url = urlPath('admin.users.investment', $user->id);
        $adminNotification->save();

        $general = GeneralSetting::first();

        notify($user, 'INVESTMENT', [
            'currency' => $general->cur_text,
            'trx' => $transaction->trx,
            'plan' => $findPlan->name,
            'amount' => $request->amount,
            'details' => $transaction->details,
            'post_balance' => $user->balance,
            'interest' => $perAnnuityInterest,
            'total_return' => $newInvest->total_return
        ]);

        $notify[] = ['success', 'Successfully investment in ' . $findPlan->name];
        return redirect()->route('user.investment.investment_log')->withNotify($notify);
    }

    public function investmentLog()
    {
        $pageTitle = 'Investment Log';
        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();
        $logs = Investment::where('user_id', $user->id)->latest()->paginate(getPaginate());
        $emptyMessage = 'Data Not Found';
        return view($this->activeTemplate . 'user.investment.investment_log', compact('pageTitle', 'user', 'logs', 'emptyMessage'));
    }


    public function kyc()
    {
        $pageTitle = 'Account Verification';
        $empty_message = 'No Verification Documents found.';
        $kyc = Kyc::where('user_id', Auth::id())->latest()->first();
        $document = Kycsetting::where('status', 1)->orderBy('type', 'asc')->get();
        return view($this->activeTemplate . 'user.verification.kyc', compact('pageTitle', 'empty_message', 'kyc', 'document'));
    }

    public function postkyc(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        $exist = Kyc::whereUser_id(Auth::id())->whereStatus(0)->count();
        if ($exist > 0) {
            $notify[] = ['warning', 'You have already uploaded a document and its under review, Please hold on for verification.'];
            return back()->withNotify($notify);
        }

        $exist = Kyc::whereUser_id(Auth::id())->whereStatus(1)->first();
        if ($exist) {
            $notify[] = ['warning', 'You have already completed the verification process.'];
            return back()->withNotify($notify);
        }


        $request->validate([
            'type' => 'required|string|max:50',
            'expiry' => 'required|string|max:50',
            'image' => 'mimes:png,jpg,jpeg'
        ], [
            'type.required' => 'ID type Field is required',
            'expiry.required' => 'ID expiry Field is required'
        ]);


        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . 'kyc' . $user->username . '.jpg';
            $location = imagePath()['profile']['user']['path'];
            $size = imagePath()['profile']['user']['size'];
            if (file_exists($filename)) {
                @unlink($filename);
            }
            $filename = uploadImage($request->image, $location, $size, $user->image);
        }

        $w['type'] = $request->type; // ID Type
        $w['user_id'] = Auth::id();
        $w['expiry'] = $request->expiry; // ID Expiry Date
        $w['number'] = $request->number;
        $w['front'] = $filename;
        $w['address'] = $request->address;
        $w['city'] = $request->city;
        $w['state'] = $request->state;
        $w['country'] = $request->country;
        $w['zip'] = $request->zip;
        $w['status'] = 0;
        $result = Kyc::create($w);

        $notify[] = ['success', 'KYC Submited successfully.'];
        return back()->withNotify($notify);
    }




    //Support Ticket
    public function support()
    {
        $pageTitle = "Support Tickect";
        $supports = SupportTicket::where('user_id', Auth::id())->latest()->paginate(10);
        return view($this->activeTemplate . 'user.support.index', compact('supports', 'pageTitle'));
    }

    public function supportnew()
    {
        $pageTitle = "Create New Dispute";
        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();
        $topics = Desk::all();
        return view($this->activeTemplate . 'user.support.create', compact('pageTitle', 'user', 'topics'));
    }

    public function supportpost(Request $request)
    {
        $ticket = new SupportTicket();
        $message = new SupportMessage();

        $imgs = $request->file('attachments');
        $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

        $validator = $this->validate($request, [
            'attachments' => [
                'max:4096',
                function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                    foreach ($imgs as $img) {
                        $ext = strtolower($img->getClientOriginalExtension());

                        if (!in_array($ext, $allowedExts)) {
                            return $fail("Only png, jpg, jpeg, pdf images are allowed");
                        }
                    }
                    if (count($imgs) > 5) {
                        return $fail("Maximum 5 images can be uploaded");
                    }
                },
            ],
            'subject' => 'required|max:100',
            'department' => 'required',
            'priority' => 'required',
            'message' => 'required',
        ]);


        $ticket->user_id = Auth::id();
        $random = rand(100000, 999999);

        $ticket->ticket = 'S-' . $random;
        $ticket->name = Auth::user()->fullname;
        $ticket->email = Auth::user()->email;
        $ticket->subject = $request->subject;
        $ticket->department = $request->department;
        $ticket->priority = $request->priority;
        $ticket->status = 0;
        $ticket->save();

        $message->supportticket_id = $ticket->id;
        $message->type = 1;
        $message->message = $request->message;
        $message->save();


        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $image) {
                $filename = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                $image->move('assets/images/support', $filename);
                SupportAttachment::create([
                    'support_message_id' => $message->id,
                    'image' => $filename,
                ]);
            }
        }
        $adminNotification = new AdminNotification();
        $adminNotification->user_id = Auth::user()->id;
        $adminNotification->title = 'New support ticket from '.Auth::user()->fullname;
        $adminNotification->click_url = urlPath('admin.user.ticket.view',$ticket->ticket);
        $adminNotification->save();
        $notify[] = ['success', 'ticket created successfully!'];
        return back()->withNotify($notify);
    }
    // public function notificationRead($id){
    //     $notification = AdminNotification::findOrFail($id);
    //     $notification->read_status = 1;
    //     $notification->save();
    //     return redirect('user/notifications');
    // }
    public function notifications(){
        $notifications = AdminNotification::orderBy('id','desc')->with('user')->paginate(getPaginate());
        $pageTitle = 'Notifications';
        return view('admin.notifications',compact('pageTitle','notifications'));
    }


    public function notificationRead($id){
        // dd('dsfad', $id);
        $notification = AdminNotification::findOrFail($id);
        $notification->read_status = 1;
        $notification->save();
       
        return redirect($notification->click_url);
    }

    public function readAll(){
        AdminNotification::where('read_status',0)->update([
            'read_status'=>1
        ]);
        $notify[] = ['success','Notifications read successfully'];
        return back()->withNotify($notify);
    }

    public function supportview($ticket)
    {
        // dd($ticket);
        $pageTitle = "View Ticket";
        $my_ticket = SupportTicket::where('ticket', $ticket)->latest()->first();
        $messages = SupportMessage::where('supportticket_id', $my_ticket->id)->with('attachments')->latest()->get();
        /**
         * @var App/Models/User $user
         */
        $user = Auth::user();
        $topics = Desk::all();
        if ($my_ticket->user_id == Auth::id()) {
            return view($this->activeTemplate . 'user.support.view', compact('my_ticket', 'messages', 'pageTitle', 'user', 'topics'));
        } else {
            return abort(404);
        }
    }

    public function supportMessageStore(Request $request, $id)
    {
        $ticket = SupportTicket::findOrFail($id);
        $message = new SupportMessage();

        if ($ticket->status != 3) {

            if ($request->replayTicket == 1) {
                $imgs = $request->file('attachments');
                $allowedExts = array('jpg', 'png', 'jpeg', 'pdf');

                $this->validate($request, [
                    'attachments' => [
                        'max:4096',
                        function ($attribute, $value, $fail) use ($imgs, $allowedExts) {
                            foreach ($imgs as $img) {
                                $ext = strtolower($img->getClientOriginalExtension());
                                if (($img->getClientSize() / 1000000) > 2) {
                                    return $fail("Images MAX  2MB ALLOW!");
                                }
                                if (!in_array($ext, $allowedExts)) {
                                    return $fail("Only png, jpg, jpeg, pdf images are allowed");
                                }
                            }
                            if (count($imgs) > 5) {
                                return $fail("Maximum 5 images can be uploaded");
                            }
                        },
                    ],
                    'message' => 'required',
                ]);

                $ticket->status = 2;
                $ticket->save();
                $admin = Auth::guard('admin')->user();
                $message->supportticket_id = $ticket->id;
                $message->type = 1;
                $message->message = $request->message;
                $message->save();
                $adminNotification = new AdminNotification();
                $adminNotification->user_id = $admin->id;
                $adminNotification->title = 'Reply on support ticket from '.Auth::user()->fullname;
                $adminNotification->click_url = urlPath('admin.user.ticket.view',$ticket->ticket);
                $adminNotification->save();
                
                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $image) {
                        $filename = rand(1000, 9999) . time() . '.' . $image->getClientOriginalExtension();
                        $image->move('assets/images/support', $filename);
                        SupportAttachment::create([
                            'support_message_id' => $message->id,
                            'image' => $filename,
                        ]);
                    }
                }

                $notify[] = ['success', 'Support ticket replied successfully!'];
                return back()->withNotify($notify);
            } elseif ($request->replayTicket == 2) {
                $ticket->status = 3;
                $ticket->save();
                $notify = ['success', 'Support ticket closed successfully!'];
                return back()->withNotify($notify);
            }
        } else {
            $notify = ['error', 'Support ticket already closed!'];
            return back()->withNotify($notify);
        }
        $notify[] = ['success', 'Support ticket replied successfully!'];
        return back()->withNotify($notify);
    }

    public function ticketDownload($ticket_id)
    {
        $attachment = SupportAttachment::findOrFail(decrypt($ticket_id));
        $file = $attachment->image;
        $full_path = 'assets/images/support/' . $file;

        $title = str_slug($attachment->supportMessage->ticket->subject);
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        $mimetype = mime_content_type($full_path);


        header('Content-Disposition: attachment; filename="' . $title . '.' . $ext . '";');
        header("Content-Type: " . $mimetype);
        return readfile($full_path);
    }

    public function ticketDelete(Request $request)
    {
        $message = SupportMessage::where('id', $request->message_id)->latest()->firstOrFail();

        if ($message->ticket->user_id != Auth::id()) {
            $notify[] = ['error', 'Unauthorized!'];
            return back()->withNotify($notify);
        }

        if ($message->attachments()->count() > 0) {
            foreach ($message->attachments as $img) {
                @unlink('assets/images/support/' . $img->image);
                $img->delete();
            }
        }
        $message->delete();

        $notify[] = ['success', 'Deleted successfully.'];
        return back()->withNotify($notify);
    }


    public function atm()
    {
        return redirect(route('user.atms.index'));
    }
}
