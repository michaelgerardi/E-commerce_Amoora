@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Form Set Slot</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="post" action="{{route('savesampling')}}" enctype='multipart/form-data'>
                        @csrf
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
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Model</label>
                        <div class="col-sm-10">
                        <select class="form-control" name="model">
    
                            <option selected value="0">rok</option>
                            <option selected value="1">dress</option>
                            <option selected value="2">top</option>
                        
                        </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Deskripsi</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="desc" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Jumlah Sampling</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" name="jml" placeholder="">
                        </div>
                    </div>	
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="ftktp">Upload Image *</label>
                        <div class="col-sm-10">
                        <input type="file" class="form-control-file" name="img_model">
                    </div>
                    
                </div>
                <button type="submit" class="btn btn-danger" class="text-right" style="float: right;">Save</button>
            </form>
            </div>
            
        </div>
    </div>
</div>
@endsection
