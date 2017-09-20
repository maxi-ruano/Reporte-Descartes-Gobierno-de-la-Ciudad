<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SoapController;

class IniciarTramiteWSController extends Controller
{
  var $client = null;

  public function __construct()
  {
    $this->client = new SoapController();
  }

  public function IniciarTramiteNuevaLicencia($Apellido,
                                              $Nombre,
                                              $IdCelExpedidor,
                                              $NombreUsuario,
                                              $TipoDocumento,
                                              $NumeroDocumento,
                                              $Sexo,
                                              $FechaNacimiento,
                                              $Nacionalidad,
                                              $NumeroFormulario,
                                              $CodigoBarraSafit,
                                              $ImporteAbonadoSafit,
                                              $FechaPagoSafit,
                                              $NumeroComprobanteSafit,
                                              $Cuil,
                                              $ws){

    $parametros = $this->iniciarTramiteParametros($Apellido,
                                                  $Nombre,
                                                  $IdCelExpedidor,
                                                  $NombreUsuario,
                                                  $TipoDocumento,
                                                  $NumeroDocumento,
                                                  $Sexo,
                                                  $FechaNacimiento,
                                                  $Nacionalidad,
                                                  $NumeroFormulario,
                                                  $CodigoBarraSafit,
                                                  $ImporteAbonadoSafit,
                                                  $FechaPagoSafit,
                                                  $NumeroComprobanteSafit,
                                                  $Cuil);

    $ws = $this->client->getClienteSoap();
    $response = $ws->IniciarTramiteNuevaLicencia($parametros);
    dd($response);
  }

  public function iniciarTramiteParametros($Apellido, $Nombre, $IdCelExpedidor, $NombreUsuario, $TipoDocumento, $NumeroDocumento,
                                 $Sexo, $FechaNacimiento, $Nacionalidad, $NumeroFormulario, $CodigoBarraSafit, $ImporteAbonadoSafit,
                                 $FechaPagoSafit, $NumeroComprobanteSafit, $Cuil){
     $parametros = array();
     $parametros['Apellido'] = $Apellido;
     $parametros['Nombre'] = $Nombre;
     $parametros['IdCelExpedidor'] = $IdCelExpedidor;
     $parametros['NombreUsuario'] = $NombreUsuario;
     $parametros['TipoDocumento'] = $TipoDocumento;
     $parametros['NumeroDocumento'] = $NumeroDocumento;
     $parametros['Sexo'] = $Sexo;
     $parametros['FechaNacimiento'] = $FechaNacimiento;
     $parametros['Nacionalidad'] = $Nacionalidad;
     $parametros['NumeroFormulario'] = $NumeroFormulario;
     $parametros['CodigoBarraSafit'] = $CodigoBarraSafit;
     $parametros['ImporteAbonadoSafit'] = $ImporteAbonadoSafit;
     $parametros['FechaPagoSafit'] = $FechaPagoSafit;
     $parametros['NumeroComprobanteSafit'] = $NumeroComprobanteSafit;
     $parametros['Cuil'] = $Cuil;

     $parametros = array( 'tramite' => $parametros );
    return $parametros;
  }

  /*
  TEST INICIO TRAMITE SINALIC

  public function nuevo(){
    return $this->IniciarTramiteNuevaLicencia('MORALES RODRIGUEZ',//Apellido
                                              'DAYANARA',//Nombre
                                              '25',//IdCelExpedidor
                                              'mtorre',//NombreUsuario
                                              '1',//TipoDocumento
                                              '95695314',//NumeroDocumento
                                              'F',//Sexo
                                              '09/01/1975',//FechaNacimiento
                                              '232',//Nacionalidad
                                              '999',//NumeroFormulario
                                              '23184160',//CodigoBarraSafit
                                              '0',//ImporteAbonadoSafit
                                              '19/08/2017',//FechaPagoSafit
                                              '60',//NumeroComprobanteSafit
                                              '',//Cuil
                                              '');
  }
  */
}
