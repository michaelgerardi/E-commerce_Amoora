<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use App\Models\Slot_P;
use Illuminate\Support\Facades\Storage;
use App\Models\Sampling;
use App\Models\Produksi;
use App\Models\Konsul;
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
            ['status','!=', '5'],
            ['status','!=', '6'],
        ])->get();
        $samplingS=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->orwhere([
            ['cus_id','=', $id],
            ['status','=', '6'],
        ])->get();
        return view('sampling.pengajuansampling',compact('slot','sampling','samplingS'));
        //return $slot;
    }
    public function savesampling(Request $request)
    {
        $jml=Slot_S::where('id', $request->slot_id)->value('jml');
        $kuota=Slot_S::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
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
                'ling_b' => $request->ling_b,
                'ling_pgang' => $request->ling_pgang,
                'ling_pingl' => $request->ling_pingl,
                'ling_lh' => $request->ling_lh,
                'leb_bahu' => $request->leb_bahu,
                'pj_lengan' => $request->pj_lengan,
                'ling_kr_leng' => $request->ling_kr_leng,
                'ling_lengan' => $request->ling_lengan,
                'ling_pergel' => $request->ling_pergel,
                'leb_muka' => $request->leb_muka,
                'leb_pungg' => $request->leb_pungg,
                'panj_pungg' => $request->panj_pungg,
                'panj_baju' => $request->panj_baju,
                'tinggi_pingl' => $request->tinggi_pingl,
                'ling_pinggang' => $request->ling_pinggang,
                'ling_pesak' => $request->ling_pesak,
                'ling_paha' => $request->ling_paha,
                'ling_lutut' => $request->ling_lutut,
                'ling_kaki' => $request->ling_kaki,
                'panj_cln_rok' => $request->panj_cln_rok,
                'tingg_dudk' => $request->tingg_dudk,
                'jml' => $request->jml,
                
            ]);
            
            $Sampling->save();
            Slot_S::where('id', $request->slot_id)->increment('jml');
            return redirect()->route('viewsampling');
        }else{
            return redirect()->back()->with('Forbidden','Maaf, kuota untuk slot ini sudah penuh. Silahkan memilih slot lain');
        }
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
            'jml' => $request->jml,
            'ling_b' => $request->ling_b,
            'ling_pgang' => $request->ling_pgang,
            'ling_pingl' => $request->ling_pingl,
            'ling_lh' => $request->ling_lh,
            'leb_bahu' => $request->leb_bahu,
            'pj_lengan' => $request->pj_lengan,
            'ling_kr_leng' => $request->ling_kr_leng,
            'ling_lengan' => $request->ling_lengan,
            'ling_pergel' => $request->ling_pergel,
            'leb_muka' => $request->leb_muka,
            'leb_pungg' => $request->leb_pungg,
            'panj_pungg' => $request->panj_pungg,
            'panj_baju' => $request->panj_baju,
            'tinggi_pingl' => $request->tinggi_pingl,
            'ling_pinggang' => $request->ling_pinggang,
            'ling_pesak' => $request->ling_pesak,
            'ling_paha' => $request->ling_paha,
            'ling_lutut' => $request->ling_lutut,
            'ling_kaki' => $request->ling_kaki,
            'panj_cln_rok' => $request->panj_cln_rok,
            'tingg_dudk' => $request->tingg_dudk,
            
        ]);
        }else{
            Sampling::where('id', $request->id)->update([
                'model' => $request->model,
                'desc' => $request->desc,
                'jml' => $request->jml,
                'ling_b' => $request->ling_b,
                'ling_pgang' => $request->ling_pgang,
                'ling_pingl' => $request->ling_pingl,
                'ling_lh' => $request->ling_lh,
                'leb_bahu' => $request->leb_bahu,
                'pj_lengan' => $request->pj_lengan,
                'ling_kr_leng' => $request->ling_kr_leng,
                'ling_lengan' => $request->ling_lengan,
                'ling_pergel' => $request->ling_pergel,
                'leb_muka' => $request->leb_muka,
                'leb_pungg' => $request->leb_pungg,
                'panj_pungg' => $request->panj_pungg,
                'panj_baju' => $request->panj_baju,
                'tinggi_pingl' => $request->tinggi_pingl,
                'ling_pinggang' => $request->ling_pinggang,
                'ling_pesak' => $request->ling_pesak,
                'ling_paha' => $request->ling_paha,
                'ling_lutut' => $request->ling_lutut,
                'ling_kaki' => $request->ling_kaki,
                'panj_cln_rok' => $request->panj_cln_rok,
                'tingg_dudk' => $request->tingg_dudk,
            ]); 
        }
        //return $request;
        return redirect()->route('viewsampling');
       
        
    }
    public function delS($id)
    {
        $del=Sampling::where('id','=', $id)->value('img');
        $delpath='public/imgsampling/'.$del;
        Storage::delete($delpath);
        $id_slot=Sampling::where('id', $id)->value('slot_id');
        Sampling::where('id', $id)->delete();
        Slot_S::where('id', $id_slot)->decrement('jml');
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
            'status' => 6,
            'ling_b' => $request->ling_b,
            'ling_pgang' => $request->ling_pgang,
            'ling_pingl' => $request->ling_pingl,
            'ling_lh' => $request->ling_lh,
            'leb_bahu' => $request->leb_bahu,
            'pj_lengan' => $request->pj_lengan,
            'ling_kr_leng' => $request->ling_kr_leng,
            'ling_lengan' => $request->ling_lengan,
            'ling_pergel' => $request->ling_pergel,
            'leb_muka' => $request->leb_muka,
            'leb_pungg' => $request->leb_pungg,
            'panj_pungg' => $request->panj_pungg,
            'panj_baju' => $request->panj_baju,
            'tinggi_pingl' => $request->tinggi_pingl,
            'ling_pinggang' => $request->ling_pinggang,
            'ling_pesak' => $request->ling_pesak,
            'ling_paha' => $request->ling_paha,
            'ling_lutut' => $request->ling_lutut,
            'ling_kaki' => $request->ling_kaki,
            'panj_cln_rok' => $request->panj_cln_rok,
            'tingg_dudk' => $request->tingg_dudk,
        ]);
        $Sampling->save();
        $samplingid=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '6'],
        ])->latest()->first();
        return redirect()->route('viewinputproduksi',['id' => $samplingid]);
        // return $id;
    }
    public function vieweditproduksi($id)
    {
        $id_samp=Produksi::where([
            ['id','=', $id],
        ])->value('samp_id');
        $produksi=Produksi::where([
            ['id','=', $id],
        ])->first();
        $sampling=Sampling::where([
            ['id','=', $id_samp],
        ])->first();
        return view('produksi.editproduksi',compact('produksi','sampling'));
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
    public function viewlistbayar()
    {
        $id=Auth::user()->id;
        $sampling = Sampling::where([
            ['cus_id',$id],
            ['status','!=', '5'],
            ['status','!=', '6'],
            ])->get();
        $prod = Sampling::where('cus_id',$id)->get();
        return view('invoice.listbayar',compact('sampling','prod'));
    }
    public function inputbuktibyr(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'jenis_pembayaran' => 'required',   
        ]);
        if($request->img_bukti){
            $fullname = $request->file('img_bukti')->getClientOriginalName();
            $extn =$request->file('img_bukti')->getClientOriginalExtension();
            $finalS=$id.'buktibayar'.'_'.time().'.'.$extn;
            $path = $request->file('img_bukti')->storeAs('public/buktibayar', $finalS);
            Pembayaran::where('id',$request->id)->update([
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'img_bukti' => $finalS,
                'status' => 1,
            ]);
        }else{
            Pembayaran::where('id',$request->id)->update([
                'jenis_pembayaran' => $request->jenis_pembayaran,
                'status' => 1,
            ]);
        }
        return redirect()->back();
    }

    public function viewkonsul()
    {
        $id=Auth::user()->id;
        $produksi=Produksi::where('cus_id',$id)->get();
        $sampling=Sampling::where('cus_id',$id)->get();
        $id_prod=Produksi::where('cus_id',$id)->value('id');
        $id_samp=Sampling::where('cus_id',$id)->value('id');
        $jadwal = Konsul::where([
            ['status','1'],
            ['prod_id',$id_prod],
            ])->orwhere([
            ['status','1'],
            ['prod_id',$id_samp],
        ])->get();
        return view('konsul.pengajuankonsul',compact('sampling','produksi'));
    }

    public function viewpilihkonsul($id)
    {
        $jadwal = Konsul::where('status','0')->get();
        return view('konsul.ambiljadwal',compact('jadwal','id'));
    }

    public function pilihkonsul(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',   
        ]);
        if($request->tipe==0){
            Konsul::where('id',$request->id)->update([
                'samp_id' => $request->jasa_id,
                'status' => 1,
            ]);
        }elseif($request->tipe==0){
            Konsul::where('id',$request->id)->update([
                'prod_id' => $request->jasa_id,
                'status' => 1,
            ]);
        }
        return redirect()->back();
    }
}
