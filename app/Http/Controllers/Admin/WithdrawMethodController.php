<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Rules\FileTypeValidate;
use App\Models\WithdrawMethod;
use Illuminate\Http\Request;

class WithdrawMethodController extends Controller
{
    public function methods()
    {
        $pageTitle = 'Withdrawal Methods';
        $emptyMessage = 'Withdrawal Methods not found.';
        $methods = WithdrawMethod::orderBy('status','desc')->orderBy('id')->get();
        return view('admin.withdraw.index', compact('pageTitle', 'emptyMessage', 'methods'));
    }

    public function create()
    {
        $pageTitle = 'New Withdrawal Method';
        return view('admin.withdraw.create', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max: 60',
            'image' => [
                'required',
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'rate' => 'required|numeric|gt:0',
            'delay' => 'required',
            'currency' => 'required',
            'min_limit' => 'required|numeric|gt:0',
            'max_limit' => 'required|numeric|gt:min_limit',
            'fixed_charge' => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'instruction' => 'required|max:64000',
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);
        $filename = '';
        $path = imagePath()['withdraw']['method']['path'];
        $size = imagePath()['withdraw']['method']['size'];
        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image, $path, $size);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }

        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $field_name = strtolower(strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->field_name[$a])));
                $arr = [];
                $arr['field_name'] = str_replace(' ', '_', $field_name);
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }

        $method = new WithdrawMethod();
        $method->name = $request->name;
        $method->image = $filename;
        $method->rate = $request->rate;
        $method->delay = $request->delay;
        $method->min_limit = $request->min_limit;
        $method->max_limit = $request->max_limit;
        $method->fixed_charge = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->currency = $request->currency;
        $method->description = $request->instruction;
        $method->user_data = $input_form;
        $method->save();
        $notify[] = ['success', $method->name . ' has been added.'];
        return redirect()->route('admin.withdraw.method.index')->withNotify($notify);
    }


    public function edit($id)
    {
        $pageTitle = 'Update Withdrawal Method';
        $method = WithdrawMethod::findOrFail($id);
        return view('admin.withdraw.edit', compact('pageTitle', 'method'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'           => 'required|max: 60',
            'image' => [
                'image',
                new FileTypeValidate(['jpeg', 'jpg', 'png'])],
            'rate'           => 'required|numeric|gt:0',
            'delay'          => 'required',
            'min_limit'      => 'required|numeric|gt:0',
            'max_limit'      => 'required|numeric|gt:min_limit',
            'fixed_charge'   => 'required|numeric|gte:0',
            'percent_charge' => 'required|numeric|between:0,100',
            'currency'       => 'required',
            'instruction'    => 'required|max:64000',
            'field_name.*'    => 'sometimes|required'
        ],[
            'field_name.*.required'=>'All field is required'
        ]);

        $method = WithdrawMethod::findOrFail($id);
        $filename = $method->image;

        $path = imagePath()['withdraw']['method']['path'];
        $size = imagePath()['withdraw']['method']['size'];

        if ($request->hasFile('image')) {
            try {
                $filename = uploadImage($request->image,$path, $size, $method->image);
            } catch (\Exception $exp) {
                $notify[] = ['error', 'Image could not be uploaded.'];
                return back()->withNotify($notify);
            }
        }


        $input_form = [];
        if ($request->has('field_name')) {
            for ($a = 0; $a < count($request->field_name); $a++) {
                $field_name = strtolower(strtolower(preg_replace('/[^\p{L}\p{N}\s]/u', '', $request->field_name[$a])));
                $arr = [];
                $arr['field_name'] = str_replace(' ', '_', $field_name);
                $arr['field_level'] = $request->field_name[$a];
                $arr['type'] = $request->type[$a];
                $arr['validation'] = $request->validation[$a];
                $input_form[$arr['field_name']] = $arr;
            }
        }

        $method->name           = $request->name;
        $method->image          = $filename;
        $method->rate           = $request->rate;
        $method->delay          = $request->delay;
        $method->min_limit      = $request->min_limit;
        $method->max_limit      = $request->max_limit;
        $method->fixed_charge   = $request->fixed_charge;
        $method->percent_charge = $request->percent_charge;
        $method->description    = $request->instruction;
        $method->user_data      = $input_form;
        $method->currency       = $request->currency;
        $method->save();

        $notify[] = ['success', $method->name . ' has been updated.'];
        return back()->withNotify($notify);
    }

    public function status($id)
    {
        $method = WithdrawMethod::findOrFail($id);
        $method->status = !$method->status;
        $method->save();
        $message = $method->status == 1 ? 'activated':'deactivated';
        return response()->json([
            'message' => 'Method has been '.$message,
            'type' => $method->status,
        ]);
    }
}
