<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $collection = Setting::all();
        $setting['setting'] = $collection->flatMap(function ($collection) {  // مشان ما يجيب الاعدادات بشكل جيسون
            return [$collection->key => $collection->value];  //  $setting['setting'] is array
        });
        return view('pages.setting.index', $setting);
    }

    public function update(Request $request){

        try{
            $info = $request->except('_token', '_method', 'logo');  // except ماعدا

            foreach ($info as $key=> $value){
                Setting::where('key', $key)->update(['value' => $value]);
            }

//            $key = array_keys($info);   طريقة ثانية
//            $value = array_values($info);
//            for($i =0; $i<count($info);$i++){
//                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
//            }

            if($request->hasFile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();
                Setting::where('key', 'logo')->update(['value' => $logo_name]); // in db
                $this->uploadFile($request,'logo','logo'); // in file logo
            }

            toastr()->success(trans('messages.Update'));
            return back();
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }

}
