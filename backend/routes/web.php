<?php

/** 
 * @var Router $router 
 * */


//Login e Registro
$router->post('/login', 'AuthController@auth');
$router->post('/registro', 'AuthController@create');

//Rotas para verificar as tarefas
$router->get('/view/{id}/{token}', 'TasksController@view');

//Rotas da tarefas
$router->get('/task/{user}', 'TasksController@index');
$router->get('/task/filter/{type}', 'TasksController@filter');
$router->post('/task/create', 'TasksController@create');
$router->put('/task/update/{id}', 'TasksController@update');
$router->delete('/task/delete/{id}', 'TasksController@destroy');

//Rotas de SubTarefa
$router->get('/subtask', 'SubTasksController@index');
$router->get('/subtask/{user}', 'SubTasksController@index');
$router->post('/subtask/create', 'SubTasksController@create');
$router->put('/subtask/update/{id}', 'SubTasksController@update');
$router->delete('/subtask/delete/{id}', 'SubTasksController@destroy');


