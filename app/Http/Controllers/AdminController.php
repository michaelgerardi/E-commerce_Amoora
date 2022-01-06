<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;

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
        return view('setslotsampling',compact('slot'));
    }
    public function saveslot(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'selesai' => 'required'      
        ]);

        $Slot_S= new Slot_S([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status' => 0
            
        ]);
        $Slot_S->save();
        return redirect()->route('viewslotsampling');
    }
}
