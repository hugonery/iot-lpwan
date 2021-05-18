<?php

namespace App\Http\Controllers;

use \App\Stations;
use \App\Places;
use \App\Sqllogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StationsController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      $stations = Stations::get();
      return view('stations.index', compact('stations'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create($id)
  {
    $place = Places::findOrFail($id);
    return view('stations.create', compact(['place']));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $user = Places::find($request->place_id);
    
    try{
      $station = new Stations;
      $station->name = $request->name;
      $request->filled('lat') ? $station->lat = $request->lat : $station->lat = 0;
      $request->filled('lng') ? $station->lng = $request->lng : $station->lng = 0;
      $request->filled('alt') ? $station->alt = $request->alt : $station->alt = 0;
      $station->log = 'Cadastro: '.auth()->user()->name.' '.date("d/m/Y H:i");
      $station->place_id = $request->place_id;
      $station->created_at = date("Y-m-d H:i:s");

      $station->save();

      session()->flash('alert-ok', 'Estação cadastrada com sucesso!');
      return redirect()->route('users.show', $user->user_id );
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Estação: Cadastro';
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
    $station = Stations::findOrFail($id);
    $place = Places::find($station->place_id);
    return view('stations.edit', compact(['station','place']));
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
    $station = Stations::findOrFail($id);
    $user = Places::find($request->place_id);

    try{
      $station->name = $request->name;
      $request->filled('lat') ? $station->lat = $request->lat : $station->lat = 0;
      $request->filled('lng') ? $station->lng = $request->lng : $station->lng = 0;
      $request->filled('alt') ? $station->alt = $request->alt : $station->alt = 0;
      $station->status = 1;
      $station->log = 'Alteração: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$station->log;
      $station->updated_at = date("Y-m-d H:i:s");

      $station->save();

      session()->flash('alert-ok', 'Estação alterada com sucesso!');
      return redirect()->route('users.show', $user->user_id );
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Estação: Alteração';
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
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy(Request $request, $id)
  {
    $station = Stations::findOrFail($id);

    try{
      $station->status = 0;
      $station->log = 'Desativada: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$station->log;
      $station->updated_at = date("Y-m-d H:i:s");

      $station->save();

      session()->flash('alert-alert', 'Estação desativada com sucesso!');
      return redirect()->route('stations.index');
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Estação: Desativação';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();
        session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
        return redirect()->route('stations.index');
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('stations.index');
      } 
    }
  }

}
