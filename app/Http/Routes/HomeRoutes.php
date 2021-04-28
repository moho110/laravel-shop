<?php

//Route::get('/vrml', '@index');
//Route::get('/vrml/test', '\App\Http\Controllers\Shop\VrmlController@test');
//$router->get('oa/cmf_accessbank', 'CmfAccessbankController@index');

namespace App\Http\Routes;
 
use Illuminate\Contracts\Routing\Registrar;
 
class HomeRoutes
{
  public function map(Registrar $router)
  {
  	$router->auth();

  	$router->group(['domain' => '127.0.0.1', 'middleware' => 'web'], function ($router) {
  		$router->get('/',['as' => 'home','uses' => '\\App\\Http\\Controllers\\Shop\\VrmlController@index']);
  		$router->get('/vrml',['test','uses' => '\\App\\Http\\Controllers\\Shop\\VrmlController@index']);
  		$router->get('/vrml/test',['test','uses' => '\\App\\Http\\Controllers\\Shop\\VrmlController@test']);
  		});
  }
}
?>