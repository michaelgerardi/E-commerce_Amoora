@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Sampling</div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($samplingS as $row)
                        <div class="col">
                            <div class="card h-100">
                            <img src="/storage/imgsampling/{{$row->img}}" width='300' height='300' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{DB::table('slot_p')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_p')->where('id', $row->slot_id)->value('selesai')}} 
                                    @if($row->status == 0)
                                    <span class="badge bg-secondary">Pending</span>
                                    @elseif($row->status == 1)
                                    <span class="badge bg-warning">Waiting list</span>
                                    @elseif($row->status == 2)
                                    <span class="badge bg-info">Proses</span>
                                    @elseif($row->status == 3)
                                    <span class="badge bg-success ">Selesai</span>
                                    @endif
                                </h5>
                                <h5 class="card-title">@if($row->model==0) rok @elseif($row->model==1) dress @else Top @endif</h5>
                                <p class="card-text">{{$row->desc}}</p>
                                <a href="{{route('viewinputproduksi',['id' => $row->id])}}" class="btn btn-primary">Produksi Dengan Sampling ini</a>
                            </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="card mt-5">
          

                <div class="card-body my-5">
                <div class="col-md-12 text-center">
                    <p class="lead text-center">Produksi dengan Sampling Custom</p>
                    <a href="{{route('viewcussampproduksi')}}" class="btn btn-primary" style="text-align: center">Klik disini</a>
                    </div>
                    
                </div>
            </div>

            <div class="card mt-5">
                <div class="card-header">Produksi on-going</div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($produksi as $row2)
                        <div class="col">
                            <div class="card h-100">
                            <img src="/storage/imgsampling/{{DB::table('sampling')->where('id', $row2->samp_id)->value('img')}}" width='300' height='300' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{DB::table('slot_p')->where('id', $row2->slot_id)->value('mulai')}} s/d {{DB::table('slot_p')->where('id', $row2->slot_id)->value('selesai')}} 
                                    @if($row2->status == 0)
                                    <span class="badge bg-secondary">Pending</span>
                                    @elseif($row2->status == 1)
                                    <span class="badge bg-warning">Waiting list</span>
                                    @elseif($row2->status == 2)
                                    <span class="badge bg-info">Proses</span>
                                    @elseif($row2->status == 3)
                                    <span class="badge bg-success ">Selesai</span>
                                    @endif
                                </h5>
                                <h5 class="card-title">Jumlah Produksi : {{$row2->jml}}</h5>
                                <p class="card-text">{{$row2->desc}}</p>
                                <a href="{{route('editproduksi',['id' => $row2->id])}}" class="btn btn-primary">Detail</a>
                            </div>
                            </div>
                        </div> 
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
