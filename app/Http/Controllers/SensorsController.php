<?php

namespace App\Http\Controllers;

use \App\Sensors;
use \App\Stations;
use \App\Places;
use \App\Sqllogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $sensors = Sensors::get();
      return view('sensors.index', compact('sensors'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    $station = Stations::findOrFail($id);
    return view('sensors.create', compact(['station']));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $place = Stations::find($request->station_id);
    $user = Places::find($place->place_id);
    
    try{
      $sensor = new Sensors;
      $sensor->name = $request->name;
      $sensor->description = $request->description;
      $sensor->log = 'Cadastro: '.auth()->user()->name.' '.date("d/m/Y H:i");
      $sensor->station_id = $request->station_id;
      $sensor->created_at = date("Y-m-d H:i:s");

      $sensor->save();

      session()->flash('alert-ok', 'Sensor cadastrado com sucesso!');
      return redirect()->route('users.show', $user->user_id );
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Sensor: Cadastro';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();
        session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
        return redirect()->route('users.show', $user->user_id );
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('users.show', $user->user_id );
      } 
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
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
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
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    $sensor = Sensors::findOrFail($id);

    try{
      $sensor->status = 0;
      $sensor->log = 'Desativado: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$sensor->log;
      $sensor->updated_at = date("Y-m-d H:i:s");

      $sensor->save();

      session()->flash('alert-alert', 'Sensor desativado com sucesso!');
      return redirect()->route('sensors.index');
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Sensor: Desativação';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();
        session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
        return redirect()->route('sensors.index');
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('sensors.index');
      } 
    }
  }
  
}
