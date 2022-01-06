<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use App\Models\Sampling;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('homeuser');
    }
    public function viewsampling()
    {
        $slot=Slot_S::all();
        return view('pengajuansampling',compact('slot'));
    }
    public function savesampling(Request $request)
    {
        $this->validate($request, [
            'slot_id' => 'required',
            'model' => 'required',
            'img_model' => 'required',
            'desc' => 'required',
            'jml' => 'required'     
        ]);
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $final='model'.'_'.time().'.'.$extn;
            //$path = $request->file('img_c1')->storeAs('public/c1', $finalc1);

        $Sampling= new Sampling([
            'slot_id' => $request->slot_id,
            'model' => $request->model,
            'img' => $final,
            'desc' => $request->desc,
            'jml' => $request->jml
            
        ]);
        $Sampling->save();
        return redirect()->route('viewsampling');
    }
}
