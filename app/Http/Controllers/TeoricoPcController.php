<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TeoricoPc;

class TeoricoPcController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teoricopc = TeoricoPc::all();
        dd($teoricopc);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('pc.template');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $teoricopc = new TeoricoPc($request->all());
        if (!filter_var($request->ip, FILTER_VALIDATE_IP) === false) {
            $teoricopc->ip = ip2long($teoricopc->ip);
            $teoricopc->save();
            var_dump($teoricopc->ip);
            echo("Ok");
            dd($request->ip);
        } else {
            echo("Ip invalida");
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $teoricopc = TeoricoPc::find($id);
        dd($teoricopc);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teoricopc = TeoricoPc::find($id);
        $teoricopc->ip = long2ip($teoricopc->ip);
        return View('pc.template')->with('teoricopc', $teoricopc);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $teoricopc = TeoricoPc::find($id);
        $teoricopc->fill($request->all());
            if (!filter_var($request->ip, FILTER_VALIDATE_IP) === false) {
                $teoricopc->ip = ip2long($teoricopc->ip);
                $teoricopc->save();
                dd($teoricopc->ip);
                echo("Ok");
            } else {
                echo("Ip invalida");
            }
        $teoricopc->save();
        //return redirect()->route('');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function isActive(Request $request) {
      $ip = ip2long($request->ip());
      $teoricopc = TeoricoPc::where('ip', '=', $ip)->first();
      $error_array = array();
      if ($teoricopc->examen_id == NULL OR $teoricopc->examen_id = '') {
          array_push($error_array, 'No hay examen asignado en esta IP');
      }
      if ($teoricopc->activo != true) {
          array_push($error_array, 'Esta IP no esta habilitada');
      }
      print_r($error_array);
      if (count($error_array) > 0) {
          //echo dd($error_array);
          return 'Maquina no habilitada para rendir';
      }
      else {
          return 'Maquina habilitada para rendir';
      }
    }


}
