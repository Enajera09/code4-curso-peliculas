<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');

//$routes->get('/pelicula', 'Pelicula::index');
//$routes->get('/pelicula/new', 'Pelicula::create');
//$routes->get('/pelicula/edit/(:num)', 'Pelicula::create/$1');

$routes->group('dashboard', function ($routes) {
    $routes->presenter('pelicula', ['controller' => 'Dashboard\Pelicula']);
    $routes->presenter('categoria', ['controller' => 'Dashboard\Categoria']);
    //*****TEST USUARIOS******
    //$routes->get('usuario/crear', 'Web\Usuario::crear_usuario');
    //$routes->get('usuario/probar/contrasena', 'Web\Usuario::probarContrasena');
});

$routes->get('/login', 'Web\Usuario::login');
$routes->post('/login_post', 'Web\Usuario::login_post', ['as' => 'usuario.login_post']);

$routes->get('/register', 'Web\Usuario::register');
$routes->post('/register_post', 'Web\Usuario::register_post', ['as' => 'usuario.register_post']);

$routes->get('/logout', 'Web\Usuario::logout');

//$routes->get('test/(:num)', 'Pelicula::test/$1', ['as' => 'test']);


//$routes->get('/index', 'Home::index'); //listado

//$routes->get('/show/(:num)', 'Home::show/$1');

//$routes->get('/new', 'Home::new'); // pintar el formulario
//$routes->post('/create', 'Home::create'); //Procesar el formulario

//$routes->get('/edit/(:num)', 'Home::edit/$1'); // pintar el formulario
//$routes->put('/update/(:num)', 'Home::update/$1'); //Procesar el formulario edición

//$routes->delete('/delete/(:num)', 'Home::delete/$1'); //elimina

//$routes->presenter('home'); //Se usa para crear rutas que se van a consumir directamente en nuestro proyecto
//$routes->resource('home'); //Se usa para crear ritas que se van a consumir a traves de una api rest full
