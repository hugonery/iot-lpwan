<?php

namespace App\Http\Controllers;

use \App\Users;
use \App\States;
use \App\Cities;
use \App\Districts;
use \App\Sqllogs;
use \App\Places;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = Users::get();
    return view('users.index', compact('users'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('users.create');
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
      $user = new Users;
      $user->name = $request->name;
      $request->filled('birth') ? $user->birth = $request->birth : $user->birth = "";
      $user->gender = $request->gender;
      $user->type = $request->type;
      $user->cpf = str_replace("/", "", str_replace("-", "", str_replace(".", "", $request->cpfcnpj)));
      $user->email = $request->email;
      $request->filled('phone1') ? $user->phone1 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->phone1)))) : $user->phone1 = "";
      $request->filled('phone2') ? $user->phone2 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->phone2)))) : $user->phone2 = "";
      $user->person1 = $request->person1;
      $request->filled('personphone1') ? $user->personphone1 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->personphone1)))) : $user->personphone1 = "";
      $user->person2 = $request->person2;
      $request->filled('personphone2') ? $user->personphone2 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->personphone2)))) : $user->personphone2 = "";
      $user->postalcode = str_replace("-", "", $request->postalcode);
      $user->address = $request->address;
      $user->webaccess = $request->webaccess;
      $user->adminappaccess = $request->adminappaccess;
      $user->note = $request->note;
      $user->log = 'Cadastro: '.auth()->user()->name.' '.date("d/m/Y H:i");
      $user->state_id = $request->state_id;
      $user->city_id = $request->city_id;
      $user->district_id = $request->district_id;
      $user->created_at = date("Y-m-d H:i:s");
      //$user->password = '$2y$10$SCSayUCc7dEcWEgCFSXwDOWIUsESCNr.24eIhbhTaszSGGB.LMI9i';
      $user->password = '';
      $user->remember_token = Str::random(60);
      
      $user->save();

      session()->flash('alert-ok', 'Cliente cadastrado com sucesso!');
      return redirect()->route('users.show', $user->id );
    }
    catch(\Exception $e)
    {
      try{
        //dd($e->errorInfo[2]);
        $sqllog = new Sqllogs;
        $sqllog->name = 'Cliente: Cadastro';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();

        if (in_array("23000", $e->errorInfo))
          session()->flash('alert-fail', '<b>Erro!</b> -> Email já cadastrado para outro cliente.');
        else
          session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');

        return redirect()->route('users.index');
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('users.index');
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
    $user = Users::findOrFail($id);
    $state = States::find($user->state_id);
    $city = Cities::find($user->city_id);
    $district = Districts::find($user->district_id);
    $places = Places::where('user_id', '=', $user->id)->orderBy('name', 'asc')->get();
    $places_all = Places::where('status', '=', 1)->where('user_id', '=', $user->id)->count();

    $stations_all = DB::table('stations')
                        ->join('places', 'stations.place_id', '=', 'places.id')
                        ->join('users', 'places.user_id', '=', 'users.id')
                        ->where('users.id', '=', $user->id)
                        ->where('stations.status', '=', 1)
                        ->select('stations.id')
                        ->count();

    $sensors_all = DB::table('sensors')
                        ->join('stations', 'sensors.station_id', '=', 'stations.id')
                        ->join('places', 'stations.place_id', '=', 'places.id')
                        ->join('users', 'places.user_id', '=', 'users.id')
                        ->where('users.id', '=', $user->id)
                        ->where('sensors.status', '=', 1)
                        ->select('sensors.id')
                        ->count();
    
    return view('users.show', compact(['user','state','city','district','places', 'places_all', 'stations_all', 'sensors_all']));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
    $user = Users::findOrFail($id);
    $state = States::find($user->state_id);
    $city = Cities::find($user->city_id);
    $district = Districts::find($user->district_id);
    return view('users.edit', compact(['user','state','city','district']));
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
    $user = Users::findOrFail($id);

    try{
      $user->name = $request->name;
      $request->filled('birth') ? $user->birth = $request->birth : $user->birth = "";
      $user->gender = $request->gender;
      $user->type = $request->type;
      $user->cpf = str_replace("/", "", str_replace("-", "", str_replace(".", "", $request->cpfcnpj)));
      $user->email = $request->email;
      $request->filled('phone1') ? $user->phone1 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->phone1)))) : $user->phone1 = "";
      $request->filled('phone2') ? $user->phone2 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->phone2)))) : $user->phone2 = "";
      $user->person1 = $request->person1;
      $request->filled('personphone1') ? $user->personphone1 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->personphone1)))) : $user->personphone1 = 0;
      $user->person2 = $request->person2;
      $request->filled('personphone2') ? $user->personphone2 = str_replace(" ", "", str_replace("-", "", str_replace("(", "", str_replace(")", "", $request->personphone2)))) : $user->personphone2 = 0;
      $user->postalcode = str_replace("-", "", $request->postalcode);
      $user->address = $request->address;
      $user->webaccess = $request->webaccess;
      $user->adminappaccess = $request->adminappaccess;
      $user->note = $request->note;
      $user->status = 1;
      $user->log = 'Alteração: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$user->log;
      $user->state_id = $request->state_id;
      $user->city_id = $request->city_id;
      $user->district_id = $request->district_id;
      $user->updated_at = date("Y-m-d H:i:s");

      $user->save();

      session()->flash('alert-ok', 'Cliente alterado com sucesso!');
      return redirect()->route('users.show', $user->id );
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Cliente: Alteração';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();
        session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
        return redirect()->route('users.show', $user->id );
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('users.show', $user->id );
      } 
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $user = Users::findOrFail($id);

    try{
      $user->status = 0;
      $user->log = 'Desativado: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$user->log;
      $user->updated_at = date("Y-m-d H:i:s");

      $user->save();

      session()->flash('alert-ok', 'Cliente desativado com sucesso!');
      return redirect()->route('users.index');
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Cliente: Desativação';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();
        session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
        return redirect()->route('users.index');
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('users.index');
      } 
    }
  }
  
  /**
   * Display form to Change Password.
   *
   * @return \Illuminate\Http\Response
   */
  public function showChangePasswordForm()
  {
    return view('auth.changepassword');
  }
  
  /**
   * 
   * 
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function changePassword(Request $request)
  {
    if ($request->newPassword!=$request->newPasswordConfirm)
    {
      session()->flash('alert-fail', '<b>Erro!</b> Os campos digitados de <font color=red>Nova Senha</font></strong> e <font color=red>Confirmação de Nova Senha</font></strong> não são iguais.');
      return redirect()->route('changePassword');
    }
    else
    {
      if (!(Hash::check($request->currentPassword, Auth::user()->password))) {
        session()->flash('alert-fail', '<b>Erro!</b> A senha atual digitada não está correta.');
        return redirect()->route('changePassword');
      }
    }

    $validatedData = $request->validate([
      'newPassword' => 'required|string|min:8',
    ]);
    
    try{
      $user = Auth::user();
      $user->password = Hash::make($request->newPassword);
      $user->log = 'Senha Alterada: '.auth()->user()->name.' '.date("d/m/Y H:i").'| '.$user->log;
      $user->updated_at = date("Y-m-d H:i:s");

      $user->save();

      session()->flash('alert-ok', 'Senha alterada com sucesso!');
      return redirect()->route('changePassword');
    }
    catch(\Exception $e)
    {
      try{
        $sqllog = new Sqllogs;
        $sqllog->name = 'Usuário: Altera Senha';
        $sqllog->sql = $e->getMessage();
        $sqllog->created_at = date("Y-m-d H:i:s");
        $sqllog->user_id = auth()->user()->id;
        $sqllog->save();
        session()->flash('alert-fail', '<b>Erro!</b> Tente novamente e caso o erro persista, avise o administrador do sistema.');
        return redirect()->route('changePassword');
      }
      catch(\Exception $e)
      {
        session()->flash('alert-fail', '<b>Erro!</b> Avise o administrador do sistema.');
        return redirect()->route('changePassword');
      } 
    }
  }
}