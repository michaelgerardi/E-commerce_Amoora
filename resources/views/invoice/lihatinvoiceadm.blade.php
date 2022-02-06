@extends('layouts.appadmin')

@section('content')
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-body">
                    <div class="invoice-area">
                        <div class="invoice-head">
                            <div class="row">
                                <div class="iv-left col-6">
                                    <span>INVOICE</span>
                                </div>
                                <div class="iv-right col-6 text-md-right">
                                    <span>{{$dataD->id}}{{$jasa->id}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-md-10">
                                <div class="invoice-address">
                                <img class="col-lg-3 col-md-3 mb-2" src="{{ asset('images/logo_1.png') }}" alt="logo">
                                    <h5 class="col-lg-4 col-md-4 ml-4"><i class="fa fa-whatsapp"></i>082123488998<i class="fa fa-instagram ml-2"></i>@amoora.couture</h5>
                                </div>
                            </div>
                            <div class="col-md-2 text-md-left">
                                <ul class="invoice-date">
                                    <li>NO : </li>
                                    <li>Nama : {{$dataD->name}}</li>
                                    <li>No Telp : {{$dataD->no_telp}}</li>
                                    <li>Tgl Masuk : {{$jasa->created_at}}</li>
                                    <li>Tgl Keluar : </li>
                                </ul>
                            </div>
                        </div>
                        <div class="invoice-table table-responsive mt-5">
                            <table class="table table-bordered table-hover text-right">
                                <thead>
                                    <tr class="text-capitalize">
                                        <th class="text-center" style="width: 1%;">NO</th>
                                        <th style="width: 1%;">qty</th>
                                        <th class="text-left" style="width: 50%; min-width: 130px;">Keterangan</th>
                                        <th style="min-width: 100px">Harga</th>
                                        <th>total</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($invoice as $row)
                                    <tr>
                                        <td class="text-center">{{$loop->iteration}}</td>
                                        <td>{{$row->qty}}</td>
                                        <td class="text-left">{{$row->ket}}</td>
                                        <td>{{$row->harga}}</td>
                                        <td>{{$row->total}}</td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li class="mr-3"><a href="#" class="text-secondary"><i class="fa fa-edit"></i></a></li>
                                                <li><a href="#" class="text-danger"><i class="ti-trash"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class="text-center"></td>
                                        <td></td>
                                        <td class="text-left"></td>
                                        <td></td>
                                        <td></td>
                                        <td>
                                            <ul class="d-flex justify-content-center">
                                                <li><a type="button" data-toggle="modal" data-target="#exampleModalLong"class="text-danger"><i class="ti-plus"></i></a></li>
                                            </ul>
                                        </td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">total balance :</td>
                                        
                                        <td>{{$sum}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                            <!-- modal +-->
                            <div class="modal fade" id="exampleModalLong">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Tambah Item Invoice</h5>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="{{route('addinvoice')}}" enctype='multipart/form-data'>
                                            <input class="form-control" type="hidden" value="{{$jns}}" name="jns">
                                            <input class="form-control" type="hidden" value="{{$id}}" name="id">
                                            @csrf
                                            <div class="form-group">
                                                <label for="example-text-input" class="col-form-label">Keterangan</label>
                                                <input class="form-control" type="text" value="" name="ket">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-date-input" class="col-form-label">QTY</label>
                                                <input class="form-control" id="qty" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="" name="qty">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-time-input" class="col-form-label">Harga Satuan</label>
                                                <input class="form-control" id="harga" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="" name="harga">
                                            </div>
                                            <div class="form-group">
                                                <label for="example-time-input" class="col-form-label">Total</label>
                                                <input class="form-control" id="total" type="number" onkeypress="return event.charCode >= 48 && event.charCode <=57" value="" name="total" readonly>
                                            </div>
                                            
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="invoice-buttons text-right">
                        <a href="{{route('generateinvoicesampling',['id' => $id,'jns' => $jns])}}" class="invoice-btn">print invoice</a>
                        <a href="{{route('sendinvoice',['id' => $id,'jns' => $jns])}}" class="invoice-btn">send invoice</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection