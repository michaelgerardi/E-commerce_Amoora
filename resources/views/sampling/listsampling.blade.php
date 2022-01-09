@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
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
                            <th class="text-center">Customer</th>
                            <th class="text-center">Tanggal Slot</th>
                            <th class="text-center">Model</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sampling as $row)
                        <tr>
                            <td class="text-center">{{DB::table('users')->where('id', $row->cus_id)->value('name')}}</td>
                            <td class="text-center">{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}}</td>
                            <td class="text-center">{{$row->model}}</td>
                            <td class="text-center">{{$row->jml}}</td>
                            <td class="text-center">
                            <a href="{{route('adminvieweditsampling',['id' => $row->id])}}" class="btn btn-primary">Detail</a>
                                <a type="button" class="btn btn-danger" href="{{route('admindelS',['id' => $row->id])}}">Delete</a>
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
