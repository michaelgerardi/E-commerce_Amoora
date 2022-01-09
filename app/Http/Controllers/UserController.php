<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use Illuminate\Support\Facades\Storage;
use App\Models\Sampling;
use Auth;
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
        $id=Auth::user()->id;
        $slot=Slot_S::where('status','=', '1')->get();
        $sampling=Sampling::where('cus_id','=', $id)->get();
        return view('sampling.pengajuansampling',compact('slot','sampling'));
        //return $slot;
    }
    public function savesampling(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'slot_id' => 'required',
            'model' => 'required',
            'img_model' => 'required',
            'desc' => 'required',
            'jml' => 'required'     
        ]);
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
        $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);

        $Sampling= new Sampling([
            'slot_id' => $request->slot_id,
            'cus_id' => $id,
            'model' => $request->model,
            'img' => $finalS,
            'desc' => $request->desc,
            'status' => 0,
            'jml' => $request->jml
            
        ]);
        $Sampling->save();
        Slot_S::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewsampling');
        // return $id;
    }
    public function vieweditsampling($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        //return $sampling;
        return view('sampling.editsampling',compact('sampling'));
    }
    public function saveeditS(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'model' => 'required',
            'desc' => 'required',
            'jml' => 'required'      
        ]);
        if($request->img_model != null){
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
        $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);
        $del=Sampling::where('id','=', $request->id)->value('img');
        $delpath='public/imgsampling/'.$del;
        Storage::delete($delpath);
        Sampling::where('id', $request->id)->update([
            'model' => $request->model,
            'img' => $finalS,
            'desc' => $request->desc,
            'jml' => $request->jml
            
        ]);
        }else{
            Sampling::where('id', $request->id)->update([
                'model' => $request->model,
                'desc' => $request->desc,
                'jml' => $request->jml
                
            ]); 
        }
        return redirect()->route('viewsampling');
       
        
    }
    public function delS($id)
    {
        $del=Sampling::where('id','=', $id)->value('img');
        $delpath='public/imgsampling/'.$del;
        Storage::delete($delpath);
        Sampling::where('id', $id)->delete();
        return redirect()->route('viewsampling');
    }
}
