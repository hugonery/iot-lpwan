<?php

namespace App\Http\Controllers;

use \App\Users;
use \App\Places;
use \App\Stations;
use \App\Sensors;
use Illuminate\Http\Request;

class HomeController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $users = Users::where('status', '=', 1)->orderBy('id', 'desc')->limit(10)->get();
    $users_all = Users::where('status', '=', 1)->count();
    $places_all = Places::where('status', '=', 1)->count();
    $stations_all = Stations::where('status', '=', 1)->count();
    $sensors_all = Sensors::where('status', '=', 1)->count();
    return view('home', compact('users', 'users_all', 'places_all', 'stations_all', 'sensors_all'));
  }
}