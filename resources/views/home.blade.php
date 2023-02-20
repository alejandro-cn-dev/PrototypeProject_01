@extends('adminlte::page')

@section('title', 'Dashboard Admin')

@section('content_header')
    <h1>Dashboard de Administración</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    <!-- PRIMERA SECCION -->
    <div class="row" bis_skin_checked="1">
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-info" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>10</h3>
              <p>Total de Ventas</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-success" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>10<sup style="font-size: 20px">%</sup></h3>
              <p>Ganancias</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-check" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-warning" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>2</h3>
              <p>Empleados registrados</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fa fa-user-plus" aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6" bis_skin_checked="1">
          <!-- small box -->
          <div class="small-box bg-danger" bis_skin_checked="1">
            <div class="inner" bis_skin_checked="1">
              <h3>10</h3>
              <p>Productos registrados</p>
            </div>
            <div class="icon" bis_skin_checked="1">
              <i class="fas fa-fw fa-store " aria-hidden="true"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

      <!-- SEGUNDA SECCION -->
      <div class="row" bis_skin_checked="1">

        <section class="col-lg-7 connectedSortable ui-sortable">
        
        {{-- <div class="card" bis_skin_checked="1">
        <div class="card-header ui-sortable-handle" style="cursor: move;" bis_skin_checked="1">
        <h3 class="card-title">
        <i class="fas fa-chart-pie mr-1"></i>
        Sales
        </h3>
        <div class="card-tools" bis_skin_checked="1">
        <ul class="nav nav-pills ml-auto">
        <li class="nav-item">
        <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
        </li>
        </ul>
        </div>
        </div>
        <div class="card-body" bis_skin_checked="1">
        <div class="tab-content p-0" bis_skin_checked="1">
        
        <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;" bis_skin_checked="1"><div class="chartjs-size-monitor" bis_skin_checked="1"><div class="chartjs-size-monitor-expand" bis_skin_checked="1"><div class="" bis_skin_checked="1"></div></div><div class="chartjs-size-monitor-shrink" bis_skin_checked="1"><div class="" bis_skin_checked="1"></div></div></div>
        <canvas id="revenue-chart-canvas" height="300" style="height: 300px; display: block; width: 696px;" width="696" class="chartjs-render-monitor"></canvas>
        </div>
        <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;" bis_skin_checked="1">
        <canvas id="sales-chart-canvas" height="0" style="height: 0px; display: block; width: 0px;" class="chartjs-render-monitor" width="0"></canvas>
        </div>
        </div>
        </div>
        </div> --}}
        
        <div class="card" bis_skin_checked="1">
        <div class="card-header ui-sortable-handle" style="cursor: move;" bis_skin_checked="1">
        <h3 class="card-title">
        <i class="ion ion-clipboard mr-1"></i>
        To Do List
        </h3>
        <div class="card-tools" bis_skin_checked="1">
        <ul class="pagination pagination-sm">
        <li class="page-item"><a href="#" class="page-link">«</a></li>
        <li class="page-item"><a href="#" class="page-link">1</a></li>
        <li class="page-item"><a href="#" class="page-link">2</a></li>
        <li class="page-item"><a href="#" class="page-link">3</a></li>
        <li class="page-item"><a href="#" class="page-link">»</a></li>
        </ul>
        </div>
        </div>
        
        <div class="card-body" bis_skin_checked="1">
         <ul class="todo-list ui-sortable" data-widget="todo-list">
        <li>
        
        <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
        </span>
        
        <div class="icheck-primary d-inline ml-2" bis_skin_checked="1">
        <input type="checkbox" value="" name="todo1" id="todoCheck1">
        <label for="todoCheck1"></label>
        </div>
        
        <span class="text">Design a nice theme</span>
        
        <small class="badge badge-danger"><i class="far fa-clock"></i> 2 mins</small>
        
        <div class="tools" bis_skin_checked="1">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
        </div>
        </li>
        <li class="done">
        <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
        </span>
        <div class="icheck-primary d-inline ml-2" bis_skin_checked="1">
        <input type="checkbox" value="" name="todo2" id="todoCheck2" checked="">
        <label for="todoCheck2"></label>
        </div>
        <span class="text">Make the theme responsive</span>
        <small class="badge badge-info"><i class="far fa-clock"></i> 4 hours</small>
        <div class="tools" bis_skin_checked="1">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
        </div>
        </li>
        <li class="done">
        <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
        </span>
        <div class="icheck-primary d-inline ml-2" bis_skin_checked="1">
        <input type="checkbox" value="" name="todo3" id="todoCheck3">
        <label for="todoCheck3"></label>
        </div>
        <span class="text">Let theme shine like a star</span>
        <small class="badge badge-warning"><i class="far fa-clock"></i> 1 day</small>
        <div class="tools" bis_skin_checked="1">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
        </div>
        </li>
        <li class="done">
        <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
        </span>
        <div class="icheck-primary d-inline ml-2" bis_skin_checked="1">
        <input type="checkbox" value="" name="todo4" id="todoCheck4">
        <label for="todoCheck4"></label>
        </div>
        <span class="text">Let theme shine like a star</span>
        <small class="badge badge-success"><i class="far fa-clock"></i> 3 days</small>
        <div class="tools" bis_skin_checked="1">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
        </div>
        </li>
        <li>
        <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
        </span>
        <div class="icheck-primary d-inline ml-2" bis_skin_checked="1">
        <input type="checkbox" value="" name="todo5" id="todoCheck5">
        <label for="todoCheck5"></label>
        </div>
        <span class="text">Check your messages and notifications</span>
        <small class="badge badge-primary"><i class="far fa-clock"></i> 1 week</small>
          <div class="tools" bis_skin_checked="1">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
        </div>
        </li>
        <li>
        <span class="handle ui-sortable-handle">
        <i class="fas fa-ellipsis-v"></i>
        <i class="fas fa-ellipsis-v"></i>
        </span>
        <div class="icheck-primary d-inline ml-2" bis_skin_checked="1">
        <input type="checkbox" value="" name="todo6" id="todoCheck6">
        <label for="todoCheck6"></label>
        </div>
        <span class="text">Let theme shine like a star</span>
        <small class="badge badge-secondary"><i class="far fa-clock"></i> 1 month</small>
        <div class="tools" bis_skin_checked="1">
        <i class="fas fa-edit"></i>
        <i class="fas fa-trash-o"></i>
        </div>
        </li>
        </ul>
        </div>
        
        <div class="card-footer clearfix" bis_skin_checked="1">
        <button type="button" class="btn btn-primary float-right"><i class="fas fa-plus"></i> Add item</button>
        </div>
        </div>
        
        
{{--     
        </section>    
        <div class="card bg-gradient-info" bis_skin_checked="1">
        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;" bis_skin_checked="1">
        <h3 class="card-title">
        <i class="fas fa-th mr-1"></i>
        Sales Graph
        </h3>
        <div class="card-tools" bis_skin_checked="1">
        <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
        </div>
        </div>
        <div class="card-body" bis_skin_checked="1"><div class="chartjs-size-monitor" bis_skin_checked="1"><div class="chartjs-size-monitor-expand" bis_skin_checked="1"><div class="" bis_skin_checked="1"></div></div><div class="chartjs-size-monitor-shrink" bis_skin_checked="1"><div class="" bis_skin_checked="1"></div></div></div>
         <canvas class="chart chartjs-render-monitor" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 696px;" width="696" height="250"></canvas>
        </div>
        
        <div class="card-footer bg-transparent" bis_skin_checked="1">
        <div class="row" bis_skin_checked="1">
        <div class="col-4 text-center" bis_skin_checked="1">
        <div style="display:inline;width:60px;height:60px;" bis_skin_checked="1"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;"></div>
        <div class="text-white" bis_skin_checked="1">Mail-Orders</div>
        </div>
        
        <div class="col-4 text-center" bis_skin_checked="1">
        <div style="display:inline;width:60px;height:60px;" bis_skin_checked="1"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;"></div>
        <div class="text-white" bis_skin_checked="1">Online</div>
        </div>
        
        <div class="col-4 text-center" bis_skin_checked="1">
        <div style="display:inline;width:60px;height:60px;" bis_skin_checked="1"><canvas width="60" height="60"></canvas><input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60" data-fgcolor="#39CCCC" readonly="readonly" style="width: 34px; height: 20px; position: absolute; vertical-align: middle; margin-top: 20px; margin-left: -47px; border: 0px; background: none; font: bold 12px Arial; text-align: center; color: rgb(57, 204, 204); padding: 0px; appearance: none;"></div>
        <div class="text-white" bis_skin_checked="1">In-Store</div>
        </div>
        
        </div>
        
        </div>
        
        </div> --}}
        
        
        <div class="card bg-gradient-success" bis_skin_checked="1">
        <div class="card-header border-0 ui-sortable-handle" style="cursor: move;" bis_skin_checked="1">
        <h3 class="card-title">
        <i class="far fa-calendar-alt"></i>
        Calendar
        </h3>
        
        <div class="card-tools" bis_skin_checked="1">
        
        <div class="btn-group" bis_skin_checked="1">
        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
        <i class="fas fa-bars"></i>
        </button>
        <div class="dropdown-menu" role="menu" bis_skin_checked="1">
        <a href="#" class="dropdown-item">Add new event</a>
        <a href="#" class="dropdown-item">Clear events</a>
        <div class="dropdown-divider" bis_skin_checked="1"></div>
        <a href="#" class="dropdown-item">View calendar</a>
        </div>
        </div>
        <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
        <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
        <i class="fas fa-times"></i>
        </button>
        </div>
        
        </div>
        
        <div class="card-body pt-0" bis_skin_checked="1">
        
        <div id="calendar" style="width: 100%" bis_skin_checked="1"><div class="bootstrap-datetimepicker-widget usetwentyfour" bis_skin_checked="1"><ul class="list-unstyled"><li class="show"><div class="datepicker" bis_skin_checked="1"><div class="datepicker-days" style="" bis_skin_checked="1"><table class="table table-sm"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Month"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Month">February 2023</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Month"></span></th></tr><tr><th class="dow">Su</th><th class="dow">Mo</th><th class="dow">Tu</th><th class="dow">We</th><th class="dow">Th</th><th class="dow">Fr</th><th class="dow">Sa</th></tr></thead><tbody><tr><td data-action="selectDay" data-day="01/29/2023" class="day old weekend">29</td><td data-action="selectDay" data-day="01/30/2023" class="day old">30</td><td data-action="selectDay" data-day="01/31/2023" class="day old">31</td><td data-action="selectDay" data-day="02/01/2023" class="day">1</td><td data-action="selectDay" data-day="02/02/2023" class="day">2</td><td data-action="selectDay" data-day="02/03/2023" class="day">3</td><td data-action="selectDay" data-day="02/04/2023" class="day weekend">4</td></tr><tr><td data-action="selectDay" data-day="02/05/2023" class="day weekend">5</td><td data-action="selectDay" data-day="02/06/2023" class="day">6</td><td data-action="selectDay" data-day="02/07/2023" class="day">7</td><td data-action="selectDay" data-day="02/08/2023" class="day">8</td><td data-action="selectDay" data-day="02/09/2023" class="day">9</td><td data-action="selectDay" data-day="02/10/2023" class="day">10</td><td data-action="selectDay" data-day="02/11/2023" class="day weekend">11</td></tr><tr><td data-action="selectDay" data-day="02/12/2023" class="day weekend">12</td><td data-action="selectDay" data-day="02/13/2023" class="day">13</td><td data-action="selectDay" data-day="02/14/2023" class="day">14</td><td data-action="selectDay" data-day="02/15/2023" class="day">15</td><td data-action="selectDay" data-day="02/16/2023" class="day">16</td><td data-action="selectDay" data-day="02/17/2023" class="day">17</td><td data-action="selectDay" data-day="02/18/2023" class="day weekend">18</td></tr><tr><td data-action="selectDay" data-day="02/19/2023" class="day active today weekend">19</td><td data-action="selectDay" data-day="02/20/2023" class="day">20</td><td data-action="selectDay" data-day="02/21/2023" class="day">21</td><td data-action="selectDay" data-day="02/22/2023" class="day">22</td><td data-action="selectDay" data-day="02/23/2023" class="day">23</td><td data-action="selectDay" data-day="02/24/2023" class="day">24</td><td data-action="selectDay" data-day="02/25/2023" class="day weekend">25</td></tr><tr><td data-action="selectDay" data-day="02/26/2023" class="day weekend">26</td><td data-action="selectDay" data-day="02/27/2023" class="day">27</td><td data-action="selectDay" data-day="02/28/2023" class="day">28</td><td data-action="selectDay" data-day="03/01/2023" class="day new">1</td><td data-action="selectDay" data-day="03/02/2023" class="day new">2</td><td data-action="selectDay" data-day="03/03/2023" class="day new">3</td><td data-action="selectDay" data-day="03/04/2023" class="day new weekend">4</td></tr><tr><td data-action="selectDay" data-day="03/05/2023" class="day new weekend">5</td><td data-action="selectDay" data-day="03/06/2023" class="day new">6</td><td data-action="selectDay" data-day="03/07/2023" class="day new">7</td><td data-action="selectDay" data-day="03/08/2023" class="day new">8</td><td data-action="selectDay" data-day="03/09/2023" class="day new">9</td><td data-action="selectDay" data-day="03/10/2023" class="day new">10</td><td data-action="selectDay" data-day="03/11/2023" class="day new weekend">11</td></tr></tbody></table></div><div class="datepicker-months" style="display: none;" bis_skin_checked="1"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Year"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Year">2023</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Year"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectMonth" class="month">Jan</span><span data-action="selectMonth" class="month active">Feb</span><span data-action="selectMonth" class="month">Mar</span><span data-action="selectMonth" class="month">Apr</span><span data-action="selectMonth" class="month">May</span><span data-action="selectMonth" class="month">Jun</span><span data-action="selectMonth" class="month">Jul</span><span data-action="selectMonth" class="month">Aug</span><span data-action="selectMonth" class="month">Sep</span><span data-action="selectMonth" class="month">Oct</span><span data-action="selectMonth" class="month">Nov</span><span data-action="selectMonth" class="month">Dec</span></td></tr></tbody></table></div><div class="datepicker-years" style="display: none;" bis_skin_checked="1"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Decade"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5" title="Select Decade">2020-2029</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Decade"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectYear" class="year old">2019</span><span data-action="selectYear" class="year">2020</span><span data-action="selectYear" class="year">2021</span><span data-action="selectYear" class="year">2022</span><span data-action="selectYear" class="year active">2023</span><span data-action="selectYear" class="year">2024</span><span data-action="selectYear" class="year">2025</span><span data-action="selectYear" class="year">2026</span><span data-action="selectYear" class="year">2027</span><span data-action="selectYear" class="year">2028</span><span data-action="selectYear" class="year">2029</span><span data-action="selectYear" class="year old">2030</span></td></tr></tbody></table></div><div class="datepicker-decades" style="display: none;" bis_skin_checked="1"><table class="table-condensed"><thead><tr><th class="prev" data-action="previous"><span class="fa fa-chevron-left" title="Previous Century"></span></th><th class="picker-switch" data-action="pickerSwitch" colspan="5">2000-2090</th><th class="next" data-action="next"><span class="fa fa-chevron-right" title="Next Century"></span></th></tr></thead><tbody><tr><td colspan="7"><span data-action="selectDecade" class="decade old" data-selection="2006">1990</span><span data-action="selectDecade" class="decade" data-selection="2006">2000</span><span data-action="selectDecade" class="decade" data-selection="2016">2010</span><span data-action="selectDecade" class="decade active" data-selection="2026">2020</span><span data-action="selectDecade" class="decade" data-selection="2036">2030</span><span data-action="selectDecade" class="decade" data-selection="2046">2040</span><span data-action="selectDecade" class="decade" data-selection="2056">2050</span><span data-action="selectDecade" class="decade" data-selection="2066">2060</span><span data-action="selectDecade" class="decade" data-selection="2076">2070</span><span data-action="selectDecade" class="decade" data-selection="2086">2080</span><span data-action="selectDecade" class="decade" data-selection="2096">2090</span><span data-action="selectDecade" class="decade old" data-selection="2106">2100</span></td></tr></tbody></table></div></div></li><li class="picker-switch accordion-toggle"></li></ul></div></div>
        </div>
        
        </div>
        
        </section>
        
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop