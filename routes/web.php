<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Quote;

$router->get('/', function () use ($router) {

    $count = Quote::query()->get()->count();
    $day = (int) date('z');
    $page = $day % $count + 1;

    $quotes = Quote::query()->get()->forPage($page, 1)->all();

    if (empty($quotes)) {
        throw new \Illuminate\Database\Eloquent\ModelNotFoundException();
    }

    return view('quote', ['quote' => $quotes[1]]);
});



$router->get('/{id}', function ($id) use ($router) {

    $quote = Quote::query()->findOrFail($id);
    return view('quote', ['quote' => $quote]);
});


// $router->get('/key', function () {
//     return str_random(32);
// });
