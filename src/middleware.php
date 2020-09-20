<?php
  $app->add(new Tuupola\Middleware\JwtAuthentication([
    "header" => "X-Token",
    "regexp" => "/(.*)/",
    "path" => "/api",
    "ignore" => ["/api/token"],
    "secret" => $container->get('settings')['secretKey']
  ]));

// Application middleware
  $app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response->withHeader('Access-Control-Allow-Origin', '*')
                    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
                    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
  });
?>
