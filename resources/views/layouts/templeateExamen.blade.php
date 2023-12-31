<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Examen Teorico </title>

    <!-- Bootstrap -->
    <link href="{{ asset('vendors/bootstrap/dist/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Font Awesome -->
    <!-- NProgress -->

    <!-- Custom Theme Style -->
    <!-- Custom Theme Style -->
    <link href="{{ asset('build/css/examen.css')}}" rel="stylesheet">
  </head>

  <body>


    <div class="container-fluid contenedor-full happyblue">
      <div class="row content">
        <div class="col-sm-9 sidenav">

            <div class="">
              <div class="panel panel-default ">
                <div class="panel-body">
                  <legend>Pregunta</legend>
                      @yield('pregunta')
                </div>
              </div>
            </div>

          <div class="">
            <div class=" panel panel-default">
              <div class="panel-body">
                @yield('respuestas')

              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-3 sidenav">
          <div class="datos-personales">
            <row>
            <div class="panel panel-default  contenedor-examen-panel">

              <div class="text-center">
                @yield('persona')


              </div>

            </div></row>
          </div>
          <div class="progreso">
            <div class="panel panel-default  contenedor-examen-panel">
              <div class="panel-body"><legend>Progreso</legend>
                <h4 class="text-center numerador-preguntas" >Pregunta 1 de 30</h4>
                <div class="col progress">
                  <div class="progress-bar progress-preguntas" role="progressbar" aria-valuenow="0"
                       aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    <span class="sr-only">0% completado</span>
                  </div>
                </div>
                <h4 class="text-center">Tiempo Restante</h4>
                <div class="col progress">
                  <div class="progress-bar progress-tiempo" role="progressbar" aria-valuenow="0"
                       aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    <span class="sr-only">0% completado</span>
                  </div>
                </div>
                <div id="regresion" class="text-center">
                    <h2 id="countdown">45:00:00</h2>
                </div>
              </div>
            </div>
          </div>
          <div class="acciones">
            <div class="panel panel-default  contenedor-examen-panel">
              <div class="panel-body text-center">
                <legend>Acciones</legend>
                  <div class="div-boton-siguiente">
                    <button type="button" class="btn btn-primary btn-lg" id="botonPregunta">Siguiente</button>
                  </div>
                  {{ Form::open(['route' => 'finalizar_examen', 'method' => 'POST', 'id' => 'finalizar_examen', 'role' => 'form', 'files' => false]) }}
                    <input type="hidden" name="examen_id" class = "examen_input" value="">


                  {{ Form::close() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="{{ asset('vendors/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{ asset('vendors/fastclick/lib/fastclick.js')}}"></script>
    <!-- NProgress -->
    <script src="{{ asset('vendors/nprogress/nprogress.js')}}"></script>
    <script src="{{ asset('build/js/base64.js')}}"></script>
    <script src="{{ asset('build/js/notify.min.js') }}"></script>
    <script src="{{ asset('build/js/jquery.timer.js') }}"></script>
    <script src="{{ asset('build/js/examen.js') }}"></script>
    <script>
        $.notify.addStyle('reconectando', {
          html: "<div><h3><span class='glyphicon glyphicon-info-sign' aria-hidden='true'></span>  <span data-notify-text/></h3></div>",
          classes: {
            base: {
              "white-space": "nowrap",
              "background-color": "lightblue",
              "padding": "5px",
              "border-radius": "5px",
              "border-style": "solid",
              "border-color": "#337ab7"
            },
            superblue: {
              "color": "white",
              "background-color": "blue"
            }
          }
        });
    </script>

    @yield('scripts')

    <!-- Custom Theme Scripts
    <script src="{{ asset('build/js/custom.min.js')}}"></script>
-->
  </body>
</html>
