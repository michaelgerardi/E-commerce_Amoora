@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
            <div class="card">
                <div class="card-header">Sampling Selesai</div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($samplingS as $row)
                        <div class="col">
                            <div class="card h-100">
                            <img src="/storage/imgsampling/{{$row->img}}" width='300' height='300' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}} 
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
                <div class="card-header">Produksi on-going</div>

                <div class="card-body">
                    <div class="row row-cols-1 row-cols-md-3 g-4">
                        @foreach($samplingS as $row)
                        <div class="col">
                            <div class="card h-100">
                            <img src="/storage/imgsampling/{{$row->img}}" width='300' height='300' class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{DB::table('slot_s')->where('id', $row->slot_id)->value('mulai')}} s/d {{DB::table('slot_s')->where('id', $row->slot_id)->value('selesai')}} 
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
                                <a href="{{route('revisisampling',['id' => $row->id])}}" class="btn btn-primary">Produksi Dengan Sampling ini</a>
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
