@extends('layouts.appadmin')

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
                    <form method="post" action="{{route('saveslotP')}}" enctype='multipart/form-data'>
                        @csrf
                    <div class="form-group row">
                        <label class="control-label col-sm-2" for="nik">Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" placeholder="">
                        </div>
                    </div>
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Mulai</label>
                        <div class="col-sm-2 ">
                            <input type="date" class="form-control" name="mulai" placeholder="">
                        </div>
                    </div>		
                    <div class="form-group row mt-2">
                        <label class="control-label col-sm-2" for="nik">Selesai</label>
                        <div class="col-sm-2 ">
                            <input type="date" class="form-control" name="selesai" placeholder="">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-danger" class="text-right" style="float: right;">Save</button>
            </form>
                </div>
            </div>
            
        </div>
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Slot</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th class="text-center">Title</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah Customer</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach($slot as $row)
                        <tr>
                            <td class="text-center">{{$row->title}}</td>
                            <td class="text-center">{{$row->mulai}} s/d {{$row->selesai}}</td>
                            <td class="text-center">{{$row->jml}}</td>
                            <td class="text-center"> @if($row->status==1) Aktif @else Non-Aktif @endif</td>
                            <td class="text-center">
                                <a type="button" class="btn btn-success" href="{{route('vieweditslotproduksi',['id' => $row->id])}}">Edit</a>
                                <a type="button" class="btn btn-danger" href="{{route('delslotS',['id' => $row->id])}}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
