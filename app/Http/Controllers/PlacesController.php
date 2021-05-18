<?php

namespace App\Http\Controllers;

use \App\Users;
use \App\States;
use \App\Cities;
use \App\Districts;
use \App\Places;
use \App\Sqllogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $places = Places::get();
      return view('places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $user = Users::findOrFail($id);
      $state = States::find($user->state_id);
      $city = Cities::find($user->city_id);
      $district = Districts::find($user->district_id);
      return view('places.create', compact(['user','state','city','district']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      try{
        $place = new Places;
        $place->name = $request->name;
        $place->type = $request->type;
        $request->filled('lat') ? $place->lat = $request->lat : $place->lat = 0;
        $request->filled('lng') ? $place->lng = $request->lng : $place->lng = 0;
        $place->address = $request->address;
        $place->postalcode = str_replace("-", "", $request->postalcode);
        $place->log = 'Cadastro: '.auth()->user()->name.' '.date("d/m/Y H:i");
        $place->user_id = $request->user_id;
        $place->state_id = $request->state_id;
        $place->city_id = $request->city_id;
        $place->district_id = $request->district_id;
        $place->created_at = date("Y-m-d H:i:s");

        $place->save();

        session()->flash('alert-ok', 'Propriedade cadastrada com sucesso!');
        return redirect()->route('users.show', $request->user_id );
      }
      catch(\Exception $e)
      {
        try{
          $sqllog = new Sqllogs;
          $sqllog->name = 'Imovel: Cadastro';
          $sqllog->sql = $e->getMessage();
          $sqllog->created_at = date("Y-m-d H:i:s");
          $sqllog->user_id = auth()->user()->id;
          $sqllog->save();
          session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
          return redirect()->route('users.show', $request->user_id );
        }
        catch(\Exception $e)
        {
          session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
          return redirect()->route('users.show', $request->user_id );
        } 
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $place = Places::findOrFail($id);
      $user = Users::find($place->user_id);
      $state = States::find($place->state_id);
      $city = Cities::find($place->city_id);
      $district = Districts::find($place->district_id);
      return view('places.edit', compact(['place','user','state','city','district']));
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
      $place = Places::findOrFail($id);

      try{
        $place->name = $request->name;
        $place->type = $request->type;
        $request->filled('lat') ? $place->lat = $request->lat : $place->lat = 0;
        $request->filled('lng') ? $place->lng = $request->lng : $place->lng = 0;
        $place->address = $request->address;
        $place->postalcode = str_replace("-", "", $request->postalcode);
        $place->status = 1;
        $place->log = 'Alteração: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$place->log;
        $place->state_id = $request->state_id;
        $place->city_id = $request->city_id;
        $place->district_id = $request->district_id;
        $place->updated_at = date("Y-m-d H:i:s");

        $place->save();

        session()->flash('alert-ok', 'Propriedade alterada com sucesso!');
        return redirect()->route('users.show', $request->user_id );
      }
      catch(\Exception $e)
      {
        try{
          $sqllog = new Sqllogs;
          $sqllog->name = 'Imovel: Alteração';
          $sqllog->sql = $e->getMessage();
          $sqllog->created_at = date("Y-m-d H:i:s");
          $sqllog->user_id = auth()->user()->id;
          $sqllog->save();
          session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
          return redirect()->route('users.show', $request->user_id );
        }
        catch(\Exception $e)
        {
          session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
          return redirect()->route('users.show', $request->user_id );
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
      $place = Places::findOrFail($id);

      try{
        $place->status = 0;
        $place->log = 'Desativada: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$place->log;
        $place->updated_at = date("Y-m-d H:i:s");

        $place->save();

        session()->flash('alert-alert', 'Propriedade desativada com sucesso!');
        return redirect()->route('users.show', $request->user_id );
      }
      catch(\Exception $e)
      {
        try{
          $sqllog = new Sqllogs;
          $sqllog->name = 'Propriedade: Desativação';
          $sqllog->sql = $e->getMessage();
          $sqllog->created_at = date("Y-m-d H:i:s");
          $sqllog->user_id = auth()->user()->id;
          $sqllog->save();
          session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
          return redirect()->route('users.show', $request->user_id );
        }
        catch(\Exception $e)
        {
          session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
          return redirect()->route('users.show', $request->user_id );
        } 
      }
    }
}