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
                    <div class="row">
                    <div class="col-md-8">
                        <form method="post" action="{{route('saverevisiS')}}" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" name="id" value="{{$sampling->id}}">
                        <div class="form-group row">
                            <label class="control-label col-sm-2" for="nik">Slot</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="slot_id">
                            @foreach($slot as $roww)
                                <option value="{{$roww->id}}">{{$roww->mulai}} sampai {{$roww->selesai}}</option>
                            @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2" for="nik">Model</label>
                            <div class="col-sm-10">
                            <select class="form-control" name="model">
        
                                <option selected value="0">rok</option @if($sampling->model==0) selected @endif>
                                <option selected value="1">dress</option @if($sampling->model==1) selected @endif>
                                <option selected value="2">top</option @if($sampling->model==2) selected @endif>
                            
                            </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2" for="nik">Deskripsi</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" name="desc">{{$sampling->desc}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="control-label col-sm-2" for="nik">Jumlah Sampling</label>
                            <div class="col-sm-10">
                                <input type="number" class="form-control" name="jml" value="{{$sampling->jml}}">
                            </div>
                        </div>	
                        <div class="form-group row">
                            <label class="control-label col-sm-2" for="ftktp">Upload Image *</label>
                            <div class="col-sm-10">
                            <input type="file" class="form-control-file" name="img_model">
                        </div>
                        
                    </div>
                    
                    <button type="submit" class="btn btn-danger" class="text-right" style="float: right;">Ajukan Revisi</button>
                </form>
            </div>
            <div class="col-md-4">
                    <img src="/storage/imgsampling/{{$sampling->img}}" height='350' class="card-img-top" alt="...">
            </div>
                    </div>
            </div>
            
        </div>
    </div>
</div>
@endsection
