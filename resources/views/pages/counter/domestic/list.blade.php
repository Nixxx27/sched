@extends('layouts.template')

@section('css')
    <style>
        #main_table_demo th{
            text-align: center;
        }
        .code-class
        {
            
        }
        .code-class:hover
        {
            color:#CE352C;
            text-decoration: underline;
        }
    </style>
@endsection
@section('content')
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <h2 class="page-header">
                <img src="{{ url('/public/images/pc1.gif') }}"> Domestic Counter <small></small>
            </h2>
        </div>
        @include('partials.greetings')
    </div>
    <div class="row" >
        <div class="col-md-5 col-sm-5 pull-right" style="margin-bottom:2px;cursor:pointer"  >
            <h5 onclick="slideQuick()"><strong>Quick Links: <i class="fa fa-external-link-square" aria-hidden="true"></i></strong></h5>
            <div style="display:none;" id="quicklinks">
            <?php  $d_now=date('M-d') ?>
            <?php  $d_now_w=date('Y-m-d') ?>

             <?php $minus = date('Y-m-d', strtotime($d_now_w . ' -2 day')); ?>  
            <a href="domestic_counter?date={{ $minus }}" class="counter-quick-links">   
                <?php echo $b_date = date('M-d', strtotime($d_now . ' -2 day')); ?>
            </a> |
            <?php $minus = date('Y-m-d', strtotime($d_now_w . ' -1 day')); ?>  
            <a href="domestic_counter?date={{ $minus }}" class="counter-quick-links">   
                <?php echo $b_date = date('M-d', strtotime($d_now . ' -1 day')); ?>
            </a> |

            <a href="domestic_counter?date={{ date('Y-m-d') }}" style="color:#16b2ce;font-weight:bold;font-size:90%">{{ date('M-d') }}</a> |

            <?php $add = date('Y-m-d', strtotime($d_now_w . ' +1 day')); ?>  
            <a href="domestic_counter?date={{ $add }}" class="counter-quick-links">   
                <?php echo $c_date = date('M-d', strtotime($d_now . ' +1 day')); ?>
            </a> |

             <?php $add = date('Y-m-d', strtotime($d_now_w . ' +2 day')); ?>  
            <a href="domestic_counter?date={{ $add }}" class="counter-quick-links">   
                <?php echo $c_date = date('M-d', strtotime($d_now . ' +2 day')); ?>
            </a>
            </div>
        </div>

    </div>

    <!-- /.row -->
    <div class="row">
        <div class="col-md-4">
            <a href='domestic_counter/create'>
                <button class="button loading-pulse lighten danger" title="Assign Personnel to counter">
                    <span class="mif-plus"></span>
                </button>
            </a>
              @if($count !== 0)
             <a href='domestic_counter/unassigned/{{ $dt }}'>
                <button class="image-button primary" title="View Unassigned">
                     <small> Unassigned </small>
                    <span class="icon mif-arrow-up-right bg-darkCobalt"></span>
                </button>
               </a>

            <a href='domestic_counter/print_assignment/{{ $dt }}'>   
            <button class="button info loading-pulse"  title="view unassigned Personnel">
                 <span class="mif-printer"></span> 
            </button>
            </a>
     
         
            @endif
        </div>
       <div class=" col-md-5 col-sm-5 col-xs-4 pull-right">
            <form class="form-inline" action="domestic_counter" method="GET" name="counter_calendar" id="counter_calendar">
                <div class="input-control text" id="datepicker" data-format="yyyy-mm-dd">
                    <input type="text" name="date" value="{{ $dt }}">
                    <button class="button"><span class="mif-calendar"></span></button>
                </div>
                <button class="button loading-pulse lighten primary">GO</button>
            </form>
        </div>
    </div>
    <hr class="bg-red">
    <div class="col-md-offset-1 col-md-9 col-sm-offset-1 col-sm-9">
        @if(Session::has('flash_message'))
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{ Session::get('flash_message') }} <i class="fa fa-check"></i>
            </div>
        @endif
            @include('errors.list')
<div id='DivIdToPrint'>
            <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                            <tr>
                                <td colspan="5" style="text-align: center"><h4><strong> Employees Assigned for {{ $dt }} </strong></h4> </td>
                            </tr>
                            <tr>
                                <td>Counter #</td>
                            <!--     <td>Employee Name</td> -->
                                <td>Code</td>
                                <td>Shift </td>
                                <td colspan="2"></td>
                            </tr>
                            </thead>
                            <tbody>
                            @if($count == 0)
                                <tr>
                                    <td colspan="4" style="text-align: center;"><h5><strong> No Assigned Personnel </strong></h5></td>

                                </tr>
                            @else
                                @foreach($dom_counter as $counter)
                                    <tr>
                                        <td style="text-align:center"><i class="fa fa-desktop fa2x" aria-hidden="true"></i> <span style="font-weight:bold;font-size:20px">{{ $counter->counter  }}</span></td>
                                      <!--   <td >{{ strtoupper( $counter->emp_id )}}</td> -->
                                        <td style="text-align:center;font-weight:bold;">
                                        <span class="code-class" style="cursor:pointer;" title="Search {{$counter->emp_code}} Details" onclick="window.location.href='employees?season=&search={{$counter->emp_code}}'">         {{ strtoupper( $counter->emp_code )}}</span>
                             

                                        @if (!empty( $counter->remarks ))
                                                <sup  data-toggle="modal" data-target="#{{$counter->id}}-modal" style="background-color:#5cb85c;color:#fff;display:inline;padding:.2em .6em .3em;font-size:75%;line-height: 1;text-align:center;border-radius: .25em;cursor:pointer">updated</sup>
                                            @endif

                                        </td>

                                            @if( $counter->shift == 1)
                                            <td style="text-align:center"> morning <img src="{{ url('public/images/morning.png') }}" width="20px"></td>
                                            @else
                                            <td style="text-align:center">   afternoon  <img src="{{ url('public/images/afternoon.png') }}" width="20px"></td>
                                            @endif

                                        <td style="text-align:right">
                                            {!! Form::open(['method'=>'GET', 'action' => ['DomesticCounter@edit',$counter->id,$dt ]]) !!}
                                            <input type="hidden" name="date" value={{$dt}}>
                                            <button class="btn btn-primary btn-sm" title="Change Employee on Counter # {{  $counter->counter}}?"><span style="font-weight: bold"><i class="fa fa-pencil"></i> </span></button>
                                            {!! Form::close() !!}
                                        </td>

                                        <td>
                                            {!! Form::open(['method'=>'GET', 'url' => ['domestic_counter/change_counter',$counter->emp_code,$dt,$counter->shift,$counter->counter ]]) !!}
                                             <button class="btn btn-info btn-sm" title="Reassigned Counter of {{ $counter->emp_code  }}?"><span style="font-weight: bold"><i class="fa fa-repeat" aria-hidden="true"></i> </span></button>
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
</div>

            
<!-- Modal -->
@foreach($dom_counter as $counter)
    @if (!empty( $counter->remarks ))
    <div class="modal fade" id="{{$counter->id}}-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Updates History</h4>
          </div>
          <div class="modal-body">
                <textarea rows="15" cols="67" disabled="" style="font-size:80%;background-color:transparent">
                    {{ $counter->remarks }}
                </textarea>
                
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
      </div>
    </div>
    @endif
@endforeach
             </div>

    </div>
    </div>
    </div>

@endsection

@section('js')
    <script>
        $(function(){
            $("#datepicker").datepicker();
        });

        function printDiv() 
            {

              var divToPrint=document.getElementById('DivIdToPrint');

              var newWin=window.open('','Print-Window');

              newWin.document.open();

              newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

              newWin.document.close();

              setTimeout(function(){newWin.close();},10);

            }

        function slideQuick(){
            $('#quicklinks').slideToggle();
        }
        
    </script>
@endsection



