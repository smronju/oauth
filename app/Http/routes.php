<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::auth();

  Route::get('/home', 'HomeController@index');
  
  Route::get('oauth/authorize', ['as' => 'oauth.authorize.get', 'middleware' => ['check-authorization-params', 'auth', 'web'], function() {
    $authParams = Authorizer::getAuthCodeRequestParams();

    $formParams = array_except($authParams,'client');

    $formParams['client_id'] = $authParams['client']->getId();

    $formParams['scope'] = implode(config('oauth2.scope_delimiter'), array_map(function ($scope) {
      return $scope->getId();
    }, $authParams['scopes']));

    return View::make('oauth.authorization-form', ['params' => $formParams, 'client' => $authParams['client']]);
  }]);

  Route::post('oauth/authorize', ['as' => 'oauth.authorize.post', 'middleware' => ['csrf', 'check-authorization-params', 'auth'], function() {
    $params = Authorizer::getAuthCodeRequestParams();
    $params['user_id'] = Auth::user()->id;
    $redirectUri = '/';

    // If the user has allowed the client to access its data, redirect back to the client with an auth code.
    if (Request::has('approve')) {
      $redirectUri = Authorizer::issueAuthCode('user', $params['user_id'], $params);
    }

    // If the user has denied the client to access its data, redirect back to the client with an error message.
    if (Request::has('deny')) {
      $redirectUri = Authorizer::authCodeRequestDeniedRedirectUri();
    }

    return Redirect::to($redirectUri);
  }]);

  Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
  });

});

Route::get('redirect', function(Request $request){
  if(Request::has('code')){
    dd('Access granted do your staff.');
  }else{
    dd(Request::get('error'). ' => '.Request::get('error_description'));
  }
});

Route::get('posts', ['as' => 'post::all', 'uses' => 'PostController@all', 'middleware' => 'oauth']);
