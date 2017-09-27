<?php

$app->get('/admin/login', 'App\Action\Admin\LoginAction:index');
$app->post('/admin/login', 'App\Action\Admin\LoginAction:logar');
$app->get('/admin/logout', 'App\Action\Admin\LoginAction:logout');
$app->post('/admin/editTilte', 'App\Action\Admin\PostActions:editTitle');
$app->post('/admin/addEvent', 'App\Action\Admin\PostActions:addEvent');
$app->post('/admin/editEventDate', 'App\Action\Admin\editEventDate');

$app->group('/admin', function(){
    $this->get('/{slug}', 'App\Action\Admin\HomeAction:index');
    /*//POSTS
    $this->get('/posts', 'App\Action\Admin\PostAction:index');
    $this->get('/posts/{id}/view', 'App\Action\Admin\PostAction:view');
    $this->get('/posts/add', 'App\Action\Admin\PostAction:add');
    $this->post('/posts/add', 'App\Action\Admin\PostAction:store');
    $this->get('/posts/{id}/edit', 'App\Action\Admin\PostAction:edit');
    $this->post('/posts/{id}/edit', 'App\Action\Admin\PostAction:update');
    $this->get('/posts/{id}/del', 'App\Action\Admin\PostAction:del');*/
})->add(App\Middleware\Admin\AuthMiddleware::class);

$app->get('/','App\Action\HomeAction:index');
$app->get('/home','App\Action\HomeAction:index');
