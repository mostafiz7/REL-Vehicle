<?php 

use Illuminate\Support\Facades\Route;

// Routes List
if( ! function_exists('Routes') ){
  function Routes(){

    // Get all named-route to uses for user permissions
    $routes_arr = [];
    foreach( Route::getRoutes()->getRoutes() as $route ){
      $action = $route->getAction();
      if( array_key_exists('as', $action) ){
        $routes_arr[] = $action['as'];
      }
    }

    // unnecessary routes
    $route_exclude = [
      'ignition.healthCheck', 'ignition.executeSolution',
      'ignition.shareReport', 'ignition.scripts', 'ignition.styles',
      'login', 'logout', 'register', 'homepage', 'contact-us',
    ];

    // exclude unnecessary routes from array value with key & re-index the key
    $routes_all = array_values( array_diff( $routes_arr, $route_exclude ) );

    // Remove duplicate array value & sorting by ascending order
    $routes = array_unique( $routes_all );
    sort($routes);

    return $routes;

  }

}



