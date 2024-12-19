<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

Route::get('/login', function () {
    $csrf = csrf_token();
    return '
        <form method="POST" action="/login">
            <input type="hidden" name="_token" value="'.$csrf.'">
            <input type="text" name="username" placeholder="Username" />
            <input type="password" name="password" placeholder="Password" />
            <button type="submit">Login</button>
        </form>
    ';
});

Route::post('/login', function (Request $request) {
    $username = $request->input('username');
    $password = $request->input('password');

    // Überprüfe die DB auf entsprechenden User
    $user = DB::table('user_table')
        ->where('name', $username)
        ->where('password', $password)
        ->first();

    if ($user) {
        return 'Login successful!';
    } else {
        return 'Invalid credentials';
    }
});


Route::get('/test', function () {
    return 'Test route is working!';
});

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Hier kannst du Web-Routen für deine Anwendung registrieren. Diese
| Routen werden vom RouteServiceProvider geladen und alle werden
| der "web"-Middleware-Gruppe zugewiesen. Viel Spaß!
|
*/
