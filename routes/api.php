<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//平台端接口
Route::group(['middleware' => 'customer', 'namespace' => 'api'], function () {
    Route::get('/getJurisdiction', 'CommonController@getJurisdiction');
    /*
     * 用户管理
     */
    Route::get('/getUserList', 'CustomerController@getUserList');
    Route::post('/saveUser', 'CustomerController@saveUser');
    Route::post('/getUserInfo', 'CustomerController@getUserInfo');
    Route::post('/deleteUser', 'CustomerController@deleteUser');

    /*
     * 节点管理
     */
    Route::get('/getNodes', 'PermissionsController@getNodes');
    Route::get('/getNodesAll', 'PermissionsController@getNodesAll');
    Route::get('/getNodesGetTree', 'PermissionsController@getNodesGetTree');
    Route::post('/addNode', 'PermissionsController@addNode');
    Route::post('/deleteNode', 'PermissionsController@deleteNode');

    /*
     * 角色管理
     */
    Route::get('/getRoles', 'RoleController@getRoles');
    Route::get('/getRolesAll', 'RoleController@getRolesAll');
    Route::post('/addRole', 'RoleController@addRole');
    Route::post('/updateRolePower', 'RoleController@updateRolePower');
    Route::post('/deleteRole', 'RoleController@deleteRole');
});

Route::post('/upImage', 'Controller@upImage');
