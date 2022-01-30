@extends('layouts.app')

@section('content')
<div class="main-content">
            
            
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-lg-4 col-ml-12">
                        <div class="row">
                            <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" action="{{route('pilihkonsul')}}" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="jasa_id" value="{{$id}}">
                                        <h4 class="header-title">isi dengan jadwal konsul </h4>
                                        <p class="text-muted font-14 mb-4">Here are examples of <code>.form-control</code> applied to each textual HTML5 <code>&lt;input&gt;</code> <code>type</code>.</p>
                                        <div class="form-group">
                                            <label class="col-form-label">Slot</label>
                                            <select class="custom-select" name="id">
                                                @foreach($jadwal as $row)
                                                    <option value="{{$row->id}}">{{$row->tgl}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-2" class="text-right" style="float: right;">Save</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Textual inputs end -->
                            
                            
                        </div>
                    </div>
                    <div class="col-lg-8 col-ml-12">
                        <div class="row">
                            <!-- basic form start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Calendar</h4>
                                        <form>
                                            
                                            
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- basic form end -->
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection