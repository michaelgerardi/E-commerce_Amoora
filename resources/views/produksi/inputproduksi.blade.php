@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="/storage/imgsampling/{{$sampling->img}}" class="img-fluid rounded-start ml-5 mt-3" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h3 class="card-title">Sampling Yang Dipakai</h3>
                    <h6>
                        @if($sampling->model==0) 
                        Rok  
                        @elseif($sampling->model==1) 
                        Dress
                        @elseif($sampling->model==2) 
                        Top
                        @endif
                    </h6>
                    <div id="accordion2" class="according accordion-s2 mt-4">
                        <div class="card">
                            <div class="card-header">
                                <a class="card-link" data-toggle="collapse" href="#accordion21">Detail Ukuran</a>
                            </div>
                            <div id="accordion21" class="collapse" data-parent="#accordion2">
                                <div class="card-body">
                                    
                                <table class="table table-bordered text-center">
                                    <tbody>
                                            <tr>
                                                <th scope="row">Lingkar Badan</th>
                                                <td>{{$sampling->ling_b}}</td>
                                                <th scope="row">Lingkar Pinggang</th>
                                                <td>{{$sampling->ling_pgang}}</td>
                                                <th scope="row">Lingkar Pinggul</th>
                                                <td>{{$sampling->ling_pingl}}</td>
                                                <th scope="row">Lingkar Leher</th>
                                                <td>{{$sampling->ling_lh}}</td>
                                            </tr>
                                        
                                            <tr>
                                                <th scope="row">Lebar Bahu</th>
                                                <td>{{$sampling->leb_bahu}}</td>
                                                <th scope="row">Panjang Lengan</th>
                                                <td>{{$sampling->pj_lengan}}</td>
                                                <th scope="row">Lingkar Kerung Lengan</th>
                                                <td>{{$sampling->ling_kr_leng}}</td>
                                                <th scope="row">Lingkar Lengan</th>
                                                <td>{{$sampling->ling_lengan}}</td>
                                            </tr>
                                            
                                            <tr>
                                                <th scope="row">Lingkar Pergel</th>
                                                <td>{{$sampling->ling_pergel}}</td>
                                                <th scope="row">Lebar Muka</th>
                                                <td>{{$sampling->leb_muka}}</td>
                                                <th scope="row">Lebar Punggung</th>
                                                <td>{{$sampling->leb_pungg}}</td>
                                                <th scope="row">Panjang Punggung</th>
                                                <td>{{$sampling->panj_pungg}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Panjang Baju</th>
                                                <td>{{$sampling->panj_baju}}</td>
                                                <th scope="row">Tinggi Pinggul</th>
                                                <td>{{$sampling->tinggi_pingl}}</td>
                                                <th scope="row">Lingkar Paha</th>
                                                <td>{{$sampling->ling_paha}}</td>
                                                <th scope="row">Lingkar Lutut</th>
                                                <td>{{$sampling->ling_lutut}}</td>
                                            </tr>
                                            <tr>
                                                <th scope="row">Lingkar Kaki</th>
                                                <td>{{$sampling->ling_kaki}}</td>
                                                <th scope="row">Panjang Celana/Rok</th>
                                                <td>{{$sampling->panj_cln_rok}}</td>
                                            </tr>
                                    </tbody>
                                </table>



                                </div>
                            </div>
                        </div>
                    </div>
                    <h6 class="card-text mt-5">Deskripsi</h6>
                    <p class="card-text">{{$sampling->desc}}</p>
                </div>
                </div>
            </div>
        </div>

        <div class="card">
                <div class="card-header">Form Pengajuan Produksi</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if(count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                            </ul>
                            </div>
                        @endif

                        @if(\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{\Session::get('success')}}</p>
                            </div>
                        @endif

                        @if(\Session::has('Forbidden'))
                            <div class="alert alert-danger">
                                <p>{{\Session::get('Forbidden')}}</p>
                            </div>
                        @endif
                    <form method="post" action="{{route('saveinputprod')}}" enctype='multipart/form-data'>
                        @csrf
                        <input type="hidden" class="form-control" name="samp_id" value="{{$sampling->id}}">
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Slot</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="slot_id">
                        @foreach($slot as $row)
                            <option value="{{$row->id}}">{{$row->mulai}} sampai {{$row->selesai}}</option>
                        @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" name="desc"></textarea>
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Jumlah Produksi</label>
                        <div class="col-sm-10">
                            <input type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" class="form-control" name="jml" placeholder="">
                        </div>
                    </div>	
                    <button type="submit" class="btn btn-danger mt-2" class="text-right" style="float: right;">Save</button>
            </form>
                </div>
                
            </div>
            
        </div>
        </div>
    </div>
</div>
@endsection
