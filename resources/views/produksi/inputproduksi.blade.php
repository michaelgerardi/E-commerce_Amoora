@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                <img src="/storage/imgsampling/{{$sampling->img}}" class="img-fluid rounded-start" alt="...">
                </div>
                <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title">
                        @if($sampling->model==0) 
                        Rok  
                        @elseif($sampling->model==1) 
                        Dress
                        @elseif($sampling->model==2) 
                        Top
                        @endif

                    </h4>
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
