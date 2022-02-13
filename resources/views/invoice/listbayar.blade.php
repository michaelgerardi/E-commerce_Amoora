@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">List Tagihan</div>

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
                <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">Tanggal Slot</th>
                                        <th scope="col">Model</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">status</th>
                                        <th scope="col">Invoice</th>
                                        <th scope="col">action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($sampling as $row)
                                    <tr>
                                        <td>{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} <br> s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}}</td>
                                        <td>@if($row->model == 0)
                                            rok
                                            @elseif($row->model == 1)
                                            dress
                                            @elseif($row->model == 2)
                                            Top
                                            @endif
                                        </td>
                                        <td>{{$row->jml}}</td>
                                        <td>@if(DB::table('pembayaran')->where('samp_id', $row->id)->value('status')==0) Belum Lunas @elseif(DB::table('pembayaran')->where('samp_id', $row->id)->value('status')==1) Menunggu @elseif(DB::table('pembayaran')->where('samp_id', $row->id)->value('status')==2) Lunas @endif</td>
                                        <td>
                                            <a href="/storage/invoice/{{DB::table('pembayaran')->where('samp_id', $row->id)->value('file_invoice')}}" class="btn btn-primary">lihat invoice</a>
                                        
                                            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong{{$loop->iteration}}">
                                            Upload Bukti Bayar
                                            </button>
                                            <div class="modal fade" id="exampleModalLong{{$loop->iteration}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Ubah Status Sampling
                                                <form method="post" action="{{route('inputbuktibyr')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$row->id}}">
                                                <input type="hidden" name="jns" value="0">
                                                <select class="custom-select" name="jenis_pembayaran">
                                                    <option value="1">Transfer Bank</option>
                                                    <option value="2">Lainnya</option>
                                                    <option value="3">Cash</option>
                                                </select>
                                                <div class="col-sm-10 mt-2">
                                                <input type="file" class="form-control-file" name="img_bukti">
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
                                                </form>
                                                </div>
                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach 
                                @foreach($prod as $row2)
                                    <tr>
                                        <td>{{DB::table('slot_s')->where('id', $row2->slot_id)->value('mulai')}} <br> s/d {{DB::table('slot_s')->where('id', $row2->slot_id)->value('selesai')}}</td>
                                        <td>@if($row2->model == 0)
                                            rok
                                            @elseif($row2->model == 1)
                                            dress
                                            @elseif($row2->model == 2)
                                            Top
                                            @endif
                                        </td>
                                        <td>{{$row2->jml}}</td>
                                        <td>@if(DB::table('pembayaran')->where('prod_id', $row2->id)->value('status')==0) Belum Lunas @elseif(DB::table('pembayaran')->where('prod_id', $row2->id)->value('status')==1) Menunggu Verifikasi @elseif(DB::table('pembayaran')->where('prod_id', $row2->id)->value('status')==2) Lunas @endif</td>
                                        <td>
                                            <a href="/storage/invoice/{{DB::table('pembayaran')->where('prod_id', $row2->id)->value('file_invoice')}}" class="btn btn-primary">lihat invoice</a>
                                        
                                            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong_{{$loop->iteration}}">
                                                Upload Bukti Bayar
                                            </button>
                                            <div class="modal fade" id="exampleModalLong_{{$loop->iteration}}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Ubah Status Sampling
                                                <form method="post" action="{{route('inputbuktibyr')}}" enctype='multipart/form-data'>
                                                @csrf
                                                <input type="hidden" name="id" value="{{$row2->id}}">
                                                <input type="hidden" name="jns" value="1">
                                                <select class="custom-select" name="jenis_pembayaran">
                                                    <option value="1">Transfer Bank</option>
                                                    <option value="2">Lainnya</option>
                                                    <option value="3">Cash</option>
                                                </select>
                                                <div class="col-sm-10 mt-2">
                                                <input type="file" class="form-control-file" name="img_bukti">
                                                </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Kirim</button>
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
    </div>
</div>
@endsection
