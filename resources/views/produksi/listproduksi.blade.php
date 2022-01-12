@extends('layouts.appadmin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">List Sampling</div>

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
                        @foreach($produksi as $row)
                        <tr>
                            <td class="text-center">{{DB::table('users')->where('id', $row->cus_id)->value('name')}}</td>
                            <td class="text-center">{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}}</td>
                            <td class="text-center">{{$row->model}}</td>
                            <td class="text-center">{{$row->jml}}</td>
                            <td class="text-center">
                                <a href="{{route('adminvieweditsampling',['id' => $row->id])}}" class="btn btn-primary">Detail</a>
                                <a type="button" class="btn btn-danger" href="{{route('admindelS',['id' => $row->id])}}">Delete</a>
                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$loop->iteration}}">
                                    Set Status
                                </button>
                                <div class="modal fade" id="exampleModal{{$loop->iteration}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Ubah Status produksi
                                    <form method="post" action="{{route('statusSampling')}}" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$row->id}}">
                                    <select class="form-select" name="status" aria-label="Default select example">
                                        <option value="1">Waiting list</option>
                                        <option value="2">Produksi</option>
                                        <option value="3">Finishing</option>
                                        <option value="4">Selesai</option>
                                    </select>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                    </form>
                                    </div>
                                    </div>
                                </div>
                                </div>
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
