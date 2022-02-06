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
                                        <td>@if(DB::table('pembayaran')->where('samp_id', $row->id)->value('status')==0) Belum Lunas @else Lunas @endif</td>
                                        <td>
                                            <a href="/storage/invoice/{{DB::table('pembayaran')->where('samp_id', $row->id)->value('file_invoice')}}" class="btn btn-primary">lihat invoice</a>
                                        
                                            
                                        </td>
                                        <td>
                                        
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
