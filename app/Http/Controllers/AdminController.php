<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use App\Models\Slot_P;
use App\Models\Sampling;
use App\Models\Produksi;
use App\Models\Pembayaran;
use App\Models\Konsul;
use App\Models\User;
use App\Models\DetailInvoice;
use PDF;
use Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        return view('homeAdmin');
    }
    public function viewslotsampling()
    {
        $slot=Slot_S::all();
        return view('sampling.setslotsampling',compact('slot'));
    }

    public function saveslot(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);

        $Slot_S= new Slot_S([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => 1
            
        ]);
        $Slot_S->save();
        return redirect()->route('viewslotsampling');
    }
    public function vieweditslotsampling($id)
    {
        $slot=Slot_S::where('id','=', $id)->first();
        return view('sampling.editslotsampling',compact('slot'));
    }

    public function saveeditslotS(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);
        if($request->status==null){
            $status=0;
        }else{
            $status=1;
        }
        Slot_S::where('id', $request->id)->update([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'selesai' => $request->kuota,
            'status' => $status
            
        ]);
        return redirect()->route('viewslotsampling');
       
        
    }

    public function delslotS($id)
    {
        Slot_S::where('id', $id)->delete();
        return redirect()->route('viewslotsampling');
    }

    public function viewslistsampling()
    {
        $sampling=Sampling::where('status','!=','6')->get();
        return view('sampling.listsampling',compact('sampling'));
    }

    public function delS($id)
    {
        $del=Sampling::where('id','=', $id)->value('img');
        $delpath='public/imgsampling/'.$del;
        Storage::delete($delpath);
        Sampling::where('id', $id)->delete();
        return redirect()->route('viewslistsampling');
    }

    public function vieweditsampling($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        //return $sampling;
        return view('sampling.admineditsampling',compact('sampling'));
    }

    public function saveeditS(Request $request)
    {
        $this->validate($request, [
            'model' => 'required',
            'desc' => 'required',
            'jml' => 'required'      
        ]);
        if($request->img_model != null){
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $finalS=$request->cus_id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
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
        return redirect()->route('viewslistsampling');
    }

    public function statusSampling(Request $request)
    {
        Sampling::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return redirect()->route('viewslistsampling'); 
    }    

    public function viewslotproduksi()
    {
        $slot=Slot_P::all();
        return view('produksi.setslotproduksi',compact('slot'));
    }

    public function saveslotP(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);

        $Slot_P= new Slot_P([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => 1
            
        ]);
        $Slot_P->save();
        return redirect()->route('viewslotproduksi');
    }

    public function vieweditslotproduksi($id)
    {
        $slot=Slot_P::where('id','=', $id)->first();
        return view('produksi.editslotproduksi',compact('slot'));
    }

    public function saveeditslotP(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);
        if($request->status==null){
            $status=0;
        }else{
            $status=1;
        }
        Slot_P::where('id', $request->id)->update([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => $status
            
        ]);
        return redirect()->route('viewslotproduksi');
       
        
    }

    public function viewslistproduksi()
    {
        $produksi=Produksi::all();
        return view('produksi.listproduksi',compact('produksi'));
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
        return view('produksi.admineditproduksi',compact('produksi','sampling'));
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
        return redirect()->route('viewslistproduksi');
    }
    public function statusProd(Request $request)
    {
        Produksi::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return redirect()->route('viewslistproduksi'); 
    }

    public function lihatinvoicesampling($id,$jns)
    {
        if($jns==0){
            $jasa=Sampling::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('samp_id',$jasa->id)->get();
            $sum=DetailInvoice::where('samp_id',$jasa->id)->sum('total');
        }else{
            $jasa=Produksi::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('prod_id',$jasa->id)->get();
            $sum=DetailInvoice::where('prod_id',$jasa->id)->sum('total');
        }
        //return
        return view('invoice.lihatinvoiceadm',compact('dataD','jasa','invoice','id','jns','sum'));
    }
    
    public function addinvoice(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required',
            'ket' => 'required',
            'harga' => 'required',
            'total' => 'required'      
        ]);
        if( $request->jns==0){
            $invoice= new DetailInvoice([
                'samp_id' => $request->id,
                'qty' => $request->qty,
                'ket' => $request->ket,
                'harga' => $request->harga,
                'total' => $request->total
                
            ]);
            $invoice->save();
        }else{
            $invoice= new DetailInvoice([
                'prod_id' => $request->id,
                'qty' => $request->qty,
                'ket' => $request->ket,
                'harga' => $request->harga,
                'total' => $request->total
            ]);
            $invoice->save(); 
        }
        return redirect()->back();
    }

    public function generateinvoicesampling($id,$jns)
    {
        if($jns==0){
            $jasa=Sampling::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('samp_id',$jasa->id)->get();
            $sum=DetailInvoice::where('samp_id',$jasa->id)->sum('total');
        }else{
            $jasa=Produksi::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('prod_id',$jasa->id)->get();
            $sum=DetailInvoice::where('prod_id',$jasa->id)->sum('total');
        }
        $pdf = PDF::loadview('/pdf/invoice',compact('dataD','jasa','invoice','id','jns','sum'))->setpaper('Legal','potrait');
        return $pdf->stream('invoice');
        
    }
    public function sendinvoice($id,$jns)
    {
        if($jns==0){
            $jasa=Sampling::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('samp_id',$jasa->id)->get();
            $sum=DetailInvoice::where('samp_id',$jasa->id)->sum('total');
        }else{
            $jasa=Produksi::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('prod_id',$jasa->id)->get();
            $sum=DetailInvoice::where('prod_id',$jasa->id)->sum('total');
        }
        $pdf = PDF::loadview('/pdf/invoice',compact('dataD','jasa','invoice','id','jns','sum'))->setpaper('Legal','potrait');
        $content = $pdf->download()->getOriginalContent();
        $nama=$jns.'_'.$jasa->id.'_'.$dataD->id.'.pdf';
        Storage::put('public/invoice/'.$nama,$content);
        if($jns==0){
            $bayar= new Pembayaran([
                'samp_id' => $jasa->id,
                'jenis_jasa' => $jns,
                'file_invoice' => $nama,
            ]);
        }else{
            $bayar= new Pembayaran([
                'prod_id' => $jasa->id,
                'jenis_jasa' => $jns,
                'file_invoice' => $nama,
            ]);
            
        }
        $bayar->save();
        return redirect()->back();
    }
    public function verifbuktibyr(Request $request)
    {
        Pembayaran::where('id',$request->id)->update([
            'status' => 2
        ]);
        return redirect()->back();
    }
    public function viewjadwalkonsul()
    {
        $jadwal = Konsul::where('status','1')->get();
        //return view('');
    }
    public function viewformtambahkonsul()
    {
        $id_admin=Auth::user()->id;
        return view('konsul.setjadwal',compact('id_admin'));
    }
    public function tambahkonsul(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required',
            'tgl' => 'required',
            'mulai' => 'required', 
        ]);
        $konsul= new Konsul([
            'title' => $request->title,
            'tgl' => $request->tgl,
            'mulai' => $request->mulai,
            'status' =>'0'
        ]);
        $konsul->save();
        return redirect()->back();
    }

}
