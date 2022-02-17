@extends('layouts.appadmin')

@section('content')
    <div class="row">
    <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                <h4 class="header-title">Daftar Invoice</h4>
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover progress-table text-center">
                                <thead class="text-uppercase">
                                    <tr>
                                        <th scope="col">Bukti Bayar</th>
                                        <th scope="col">Jenis Pembayaran</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if($pemb !=null)
                                    <tr>
                                        <td>
                                        @if($jns==0)
                                        <a href="/storage/buktibayar/{{$pemb->img_bukti}}" class="btn btn-primary">lihat bukti bayar</a>
                                        @else
                                        <a href="/storage/buktibayar/{{$pemb->img_bukti}}" class="btn btn-primary">lihat bukti bayar</a>
                                        @endif
                                        </td>
                                        <td>{{$pemb->jenis_pembayaran}}</td>
                                        
                                        <td>@if($pemb->status==0) Belum Lunas @elseif($pemb->status==1) Menunggu @elseif($pemb->status==2) Lunas @endif</td>
                                        <td>
                                            <form action="{{route('verifbuktibyr')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$pemb->id}}">
                                                <input type="hidden" name="jns" value="{{$jns}}">
                                                <button type="submit" class="btn btn-primary">Verif Bukti Bayar</button>
                                                <button type="submit" class="btn btn-primary">Detail Nota</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <form action="{{route('tambahinvoice')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="">
                                                <li><button type="submit" data-toggle="modal" data-target="#exampleModalLong"class="text-danger"><i class="ti-plus"></i></button></li>
                                                </form>
                                            </ul>
                                        </td>
                                    </tr>
                                
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
@endsection