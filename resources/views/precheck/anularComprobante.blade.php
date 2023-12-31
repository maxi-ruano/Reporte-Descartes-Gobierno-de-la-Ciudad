<div id="divBuscarPrecheck" class="row">
    <div class="col-sm-12 col-xs-12">
        {!! Form::open(['method'=>'GET','url'=>'precheck','class'=>'navbar-form navbar-left','role'=>'search'])  !!}
        Número de Documento: <br>
        <div class="input-group">
            <input type="text" class="form-control" id="nro_doc" name="nro_doc" placeholder="Buscar..." value="{{ Request::get('nro_doc') }}">
            <span class="input-group-btn">
                <button id="buscar" class="btn btn-default-sm" type="submit"><i class="fa fa-search"></i></button>
            </span>
        </div>
        <input type="hidden" class="form-control" id="id" name="id" value="{{ Request::get('id') }}">
        {!! Form::close() !!}
    </div>
</div>

<div class="table-responsive">
    @if($tramites)
        <table class="table table-striped jambo_table" data-form="deleteForm">
            <thead>
                <tr>
                    <th class="column-title">ID</th>
                    <th class="column-title">Nombre</th>
                    <th class="column-title">Apellido</th>
                    <th class="column-title">Tipo Doc.</th>
                    <th class="column-title">Sexo</th>
                    <th class="column-title">Nacionalidad</th>
                    <th class="column-title">Turno Sigeci</th>
                    <th class="column-title">Turno SATH</th>
                    <th class="column-title">Tramite LICTA</th>
                    <th class="column-title">Fecha Emisión</th>
                    <th class="column-title">Fecha Vencimiento</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($tramites as $row)
                <tr>
                    <td>
                        @if($row->id == Request::get('id') || count($tramites) == 1)
                            <input type="radio" name="checkTramite" onclick="mostrarPrecheck({{ $row->id }})" checked>
                        @else
                            <input type="radio" name="checkTramite" onclick="mostrarPrecheck({{ $row->id }})">
                        @endif
                        {{ $row->id }}
                    </td>
                    <td>{{ $row->nombre }}</td>
                    <td>{{ $row->apellido }}</td>
                    <td>{{ $row->tipo_doc }}</td>
                    <td>{{ $row->sexo }}</td>
                    <td>{{ strtoupper($row->nacionalidad) }}</td>
                    <td>{{ $row->sigeci_fecha }}</td>
                    <td>{{ $row->sath_fecha }}</td>
                    <td class="red">{{ $row->tramite_dgevyl_id }}</td>
                    <td>{{ $row->fec_emision }}</td>
                    <td>{{ $row->fec_vencimiento }}</td>
                    <td>
                        <button type="button" onclick="getPreCheck({{ $row->id }})" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-precheck">
                            <i class="glyphicon glyphicon-check"></i> Precheck
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
</div>


<div class="table-responsive">
@if($precheck)
    <table class="table table-striped table-hover jambo_table">
        <thead>
            <tr>
                <th class="column-title">Tramite a Iniciar ID</th>
                <th class="column-title">PreCheck</th>
                <th class="column-title">Comprobante</th>
                <th class="column-title">Validado</th>
            </tr>
        </thead>
        <tbody>
        @foreach($precheck as $row)
            <tr>
                <td>{{ $row->tramite_a_iniciar_id }}</td>
                <td>{{ $row->description }}</td>
                <td>{{ $row->comprobante }}</td>
                <td>
                    @if($row->validado)
                        <input id="precheck{{ $row->id }}" type="checkbox" disabled checked data-toggle="toggle" data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="60">
                        
                        @can('anular_comprobantes_precheck')
                            @if($row->validation_id == '3' && $row->tramite_dgevyl_id == null)
                                <button id="btn-modal-cenat" type="button" class="btn btn-danger btn-xs" data-id="{{ $row->id }}" data-toggle="modal" data-target="#modal-delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            @endif

                            @if($row->validation_id == '5' && $row->tramite_dgevyl_id == null)
                                <button id="btn-modal-bui" type="button" class="btn btn-danger btn-xs" data-id="{{ $row->id }}" data-toggle="modal" data-target="#modal-delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            @endif

                            @if($row->validation_id == '7' && $row->tramite_dgevyl_id == null)
                                <button id="btn-modal-sinalic" type="button" class="btn btn-danger btn-xs" data-id="{{ $row->tramite_a_iniciar_id }}" data-toggle="modal" data-target="#modal-delete">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            @endif
                        @endcan

                    @else
                        <input id="precheck{{ $row->id }}" type="checkbox" disabled data-toggle="toggle"  data-on="Si" data-off="No" data-onstyle="success" data-offstyle="danger" data-size="mini" data-width="60" >
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif
</div>

@include('includes.modalPrecheck')

@push('scripts')
    <script>
        $(document).ready(function() {
            $("#divBuscarPrecheck #nro_doc").change(function(){
                $("#divBuscarPrecheck #id").val('');
            });
            
           //Modal delete confirmar antes de borrar
            $('#modal-delete').on('click', '#delete-btn', function(){
                const servicio = $("#servicio").val();
                const id = $("#delete-id").val();
                
                switch(servicio){
                    case "sinalic":
                        anularSinalic(id);
                        break;
                    case "bui":
                        anularComprobante(id);
                        break;
                    case "cenat":
                        anularComprobante(id);
                        break;
                }
            }); 

            $("#btn-modal-sinalic").on("click", function () {
                $("#delete-id").val($(this).data('id'));
                $("#servicio").val('sinalic');
            });

            $("#btn-modal-bui").on("click", function () {
                $("#delete-id").val($(this).data('id'));
                $("#servicio").val('bui');
            });

            $("#btn-modal-cenat").on("click", function () {
                $("#delete-id").val($(this).data('id'));
                $("#servicio").val('cenat');
            });
        });

        //Colocamos el ID de tramites_a_iniciar en un input type hidden para realizar el submit con el buscar
        function mostrarPrecheck(id){
            $("#divBuscarPrecheck #id").val(id);
            $("#divBuscarPrecheck #buscar").click();
        }

        //Solo si confirma la anulacion mediante el modal
        function anularComprobante(id){
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: 'anularPreCheckComprobante',
                data: {id: id },
                type: "GET", 
                success: function(ret){
                    $("#divBuscarPrecheck #buscar").click();
                }
            });
        }

        //Anular el sinalic creado desde el Precheck en caso que lo amerite
        function anularSinalic(id){  
            $.ajax({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: 'anularPreCheckSinalic',
                data: {id: id },
                type: "GET", 
                success: function(ret){
                    $("#divBuscarPrecheck #buscar").click();
                }
            });
        }
    </script>
@endpush