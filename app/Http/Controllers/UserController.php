<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use App\Models\Slot_P;
use Illuminate\Support\Facades\Storage;
use App\Models\Sampling;
use App\Models\Produksi;
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
        $sampling=Sampling::where([
            ['cus_id','=', $id],
            ['status','!=', '4'],
            ['status','!=', '5'],
        ])->get();
        $samplingS=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '4'],
        ])->get();
        return view('sampling.pengajuansampling',compact('slot','sampling','samplingS'));
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
    public function revisisampling($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        $slot=Slot_S::where('status','=', '1')->get();
        //return $sampling;
        return view('sampling.revisisampling',compact('sampling','slot'));
    }
    public function saverevisiS(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'slot_id' => 'required',
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
            'slot_id' => $request->slot_id,
            'model' => $request->model,
            'img' => $finalS,
            'desc' => $request->desc,
            'jml' => $request->jml
            
        ]);
        }else{
            Sampling::where('id', $request->id)->update([
                'slot_id' => $request->slot_id,
                'model' => $request->model,
                'desc' => $request->desc,
                'status' => 0,
                'jml' => $request->jml
                
            ]); 
        }
        Slot_S::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewsampling');
    }
    public function viewproduksi()
    {
        $id=Auth::user()->id;
        $slot=Slot_P::where('status','=', '1')->get();
        $samplingS=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '4'],
        ])->orwhere([
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->get();
        $produksi=Produksi::where([
            ['cus_id','=', $id],
            ['status','!=', '4'],
        ])->get();
        return view('produksi.pengajuanproduksi',compact('slot','samplingS','produksi'));
       
    }
    public function viewinputproduksi($id)
    {
        $slot=Slot_P::where('status','=', '1')->get();
        $sampling=Sampling::where([
            ['id','=', $id],
        ])->first();
        return view('produksi.inputproduksi',compact('sampling','slot'));
    }
    public function saveinputprod(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request,[
            'slot_id' => 'required',
            'samp_id' => 'required',
            'desc' => 'required',
            'jml' => 'required' 
        ]);

        $produksi= new Produksi([
            'cus_id' => $id,
            'slot_id' => $request->slot_id,
            'samp_id' => $request->samp_id,
            'desc' => $request->desc,
            'status' => 0,
            'jml' => $request->jml 
        ]);
        $produksi->save();
        Slot_P::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewproduksi');
    }
    public function viewcussampproduksi()
    {
        return view('produksi.inputsampprodcustom');
    }
    public function savesamplingcustom(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'model' => 'required',
            'img_model' => 'required',
            'desc' => 'required',  
        ]);
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
        $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);

        $Sampling= new Sampling([
            'cus_id' => $id,
            'model' => $request->model,
            'img' => $finalS,
            'desc' => $request->desc,
            'status' => 5,
            
        ]);
        $Sampling->save();
        $samplingid=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->latest()->first();
        return redirect()->route('viewinputproduksi',['id' => $samplingid]);
        // return $id;
    }
    public function vieweditproduksi($id)
    {
        $produksi=Produksi::where([
            ['id','=', $id],
        ])->first();
        return view('produksi.editproduksi',compact('produksi'));
    }

    public function saveeditprod(Request $request)
    {
        $this->validate($request,[
            'desc' => 'required',
            'jml' => 'required' 
        ]);
        Produksi::where('id',$request->id)->update([
            'desc' => $request->desc,
            'jml' => $request->jml
        ]);
        return redirect()->route('viewproduksi');
    }
}
