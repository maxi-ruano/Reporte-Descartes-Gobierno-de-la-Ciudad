@extends('layouts.templeate')
@section('titlePage', 'Dashboard')
@section('content')

<!-- page content -->

  <div role="main">

    <!-- top Totales -->
    <div class="row tile_count">
      @foreach ($datos_precheck as $datos)
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="{{ $datos['ico'] }}"></i> Total {{ $datos['titulo'] }} </span>
          <div class="count"> {{ $datos['total'] }} </div>
          <span class="count_bottom"> <i class="green">{{ $datos['porc'] }} % </i> {{ $datos['subtitulo'] }} </span>
        </div>
      @endforeach
    </div>

    <div class="row tile_count">
      @foreach ($datos_tramites as $datos)
        <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
          <span class="count_top"><i class="{{ $datos['ico'] }}"></i> Total {{ $datos['titulo'] }} </span>
          <div class="count"> {{ $datos['total'] }} </div>
          <span class="count_bottom"> <i class="green">{{ $datos['porc'] }} % </i> {{ $datos['subtitulo'] }} </span>
        </div>
      @endforeach
    </div>
    <!-- /top totales -->

    <!-- /Widget Summary - ESTADISTICAS -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel tile fixed_height_350">
          <div class="x_title">
            <h2>ESTADÍSTICAS PreCheck </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            @foreach ($datos_precheck as $datos)
              <div class="widget_summary">
                <div class="w_left w_25">
                <span>{{ $datos['titulo'] }}</span>
                </div>
                <div class="w_center w_55">
                  <div class="progress">
                      <div class="progress-bar bg-green" role="progressbar" style="width: {{ $datos['porc'] }}%;">
                    </div>
                  </div>
                </div>
                <div class="w_right w_20">
                  <span> {{ $datos['porc'] }} %</span>
                </div>
                <div class="clearfix"></div>
              </div>
              @endforeach
          </div>
        </div>
      </div>
    <!-- /end Widget Summary -->

    <!-- /Form Group -->
    <div class="col-md-12 col-sm-12 col-xs-12">
        {!! Form::open(['route' => 'consultaDashboard', 'id'=>'consultaDashboard', 'method' => 'get', 'class' => 'form-horizontal form-label-left', 'role' => 'form', 'files' => true ]) !!}
          @include('safit.botoneraDashboard')
        {{ Form::close() }}
    </div>
    <!-- /end form-group -->

  </div>
<!-- /page content -->

@endsection

@push('scripts')
  <script src="{{ asset('vendors/jquery/dist/jquery.min.js')}}"></script>
  <!-- Bootstrap -->
  <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="{{ asset('vendors/moment/min/moment.min.js')}}"></script>
  <script src="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
  <!-- Bootstrap-toggle -->
  <script src="{{ asset('vendors/bootstrap-toggle/js/bootstrap-toggle.min.js')}}"></script>

  <script src="{{ asset('js/dashboard.js')}}"></script>

  <script>
    function reload(){
      window.location.href = "{{ route('consultaDashboardGraf') }}"; //using a named route
    }
  </script>
@endpush

@section('css')
    <!-- bootstrap-daterangepicker -->
    <link href="{{ asset('vendors/bootstrap-daterangepicker/daterangepicker.css')}}" rel="stylesheet">
    <!-- bootstrap-toggle -->
    <link href="{{ asset('vendors/bootstrap-toggle/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
@endsection 