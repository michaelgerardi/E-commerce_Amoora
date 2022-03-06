@extends('layouts.app')

@section('content')
<div class="main-content">
            
            
            <div class="main-content-inner">
                
                    
                            <!-- Textual inputs start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                    <form method="post" action="{{route('pilihkonsul')}}" enctype='multipart/form-data'>
                                        @csrf
                                        <input type="hidden" name="jasa_id" value="{{$id}}">
                                        <h4 class="header-title">isi dengan jadwal konsul </h4>
                                        <div class="form-group">
                                            <label class="col-form-label">Slot</label>
                                            <select class="custom-select" name="id">
                                                @foreach($jadwal as $row)
                                                    <option value="{{$row->id}}">@if($row->jenis == 0)Tatap Muka @else Online @endif {{$row->tgl}} Pada Jam {{$row->mulai}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-danger mt-2" class="text-right" style="float: right;">Save</button>
                                        </form>
                                        
                                    </div>
                                </div>
                            </div>
                            <!-- Textual inputs end -->
                            
                            
                        
                    
                            <!-- basic form start -->
                            <div class="col-12 mt-5">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Calendar</h4>
                                        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
                                            <link href="{{ asset('css/style.css') }}" rel="stylesheet">
                                            <link href="{{ asset('fullcalendar/packages/core/main.css') }}" rel="stylesheet">
                                            <link href="{{ asset('fullcalendar/packages/daygrid/main.css') }}" rel="stylesheet">
                                            <div class="content p-0 col-sm-12">
                                            <div id='calendar'></div>
                                    </div>
                                </div>
                            </div>
                            <!-- basic form end -->
                            
                        
                    
                
            </div>
        </div>
        <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('fullcalendar/packages/core/main.js') }}"></script>
        <script src="{{ asset('fullcalendar/packages/interaction/main.js') }}"></script>
        <script src="{{ asset('fullcalendar/packages/daygrid/main.js')}}"></script>

                <script>
                document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');

                var calendar = new FullCalendar.Calendar(calendarEl, {
                plugins: [ 'interaction', 'dayGrid' ],
                defaultDate: <?php echo "'".date('Y-m-d')."'" ?>,
                editable: false,
                eventLimit: true, // allow "more" link when too many events
                events: [
                    // {title:'eek',start:'2022-02-08'},
                    <?php
                 foreach($cal as $row){
                     $echo="{"."title: "."'".$row['mulai'].' WIB'."'".",
                        start: "."'".$row['tgl']."'".",";
                        
                        if ($row['status']==0) {
                            $echo.="backgroundColor: "."'"."green"."'".",
                            borderColor: "."'"."green"."'"."},";
                        }elseif ($row['status']==1) {
                            $echo.="backgroundColor: "."'"."red"."'".",
                            borderColor: "."'"."red"."'"."},";
                        }else{
                            $echo.="backgroundColor: "."'"."grey"."'".",
                            borderColor: "."'"."grey"."'"."},";
                        }
                    echo $echo;   
                }
                ?>
                ]
                });

                calendar.render();
            });

                </script>
        @endsection