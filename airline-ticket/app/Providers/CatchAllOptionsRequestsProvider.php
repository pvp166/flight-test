<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * If the incoming request is an OPTIONS request
 * we will register a handler for the requested route
 */
class CatchAllOptionsRequestsProvider extends ServiceProvider {

  public function register()
  {
    $request = app('request');

    if ($request->isMethod('OPTIONS'))
    {

      app()->options($request->path(), function() { 
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
        header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, Authorization');
        header('Access-Control-Allow-Credentials: true');

        return response('', 200); });
    }
  }

}