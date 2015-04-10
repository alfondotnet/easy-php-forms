<?php


$app->get('/user/login', function () use ($app) {

    $c = array();
    $app->render('pages/login.html', $c);

})->name('login');

$app->get('/user/logout', function () use ($app) {

    $c = array();
    unset($_SESSION['loggedIn']);

    $app->redirect($app->urlFor('index'));

})->name('logout');


/* 
*  POST
*  TODO: Login route (This is insecure!, salt, use a proper password mechanism i.e. BCrypt)
*/

$app->post('/user/login', function () use ($app) {

    $c = array();

    $username = $app->request()->post('username');
    $password = $app->request()->post('password');

    $valid_user = models\User::where('username','=',$username)
        ->where('password','=',sha1($password))->count();

    if($valid_user > 0)
        $_SESSION['loggedIn'] = true;

    $app->redirect($app->urlFor('index'));

});