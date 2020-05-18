<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Approach;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('language/{locale}', function ($locale) {
    Session::put('locale',$locale);

    return redirect()->back();
});
Route::get('/', function () {return redirect('login');});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');


// Authentication Route
//Route::group(['prefix' =>'back','middleware'=>'auth'], function() {
Route::group(['middleware'=>'MyMiddleWire'],function(){
	    // Role permission Route
	    // Route::group(['middleware' => ['role:Super Admin']], function () {
		// Route::get('/user_create', 'PermissionController@permission')->name('permission');
        Route::get('/permission/{id?}', 'PermissionController@permission')->name('permission');
		Route::post('/permission_insert', 'PermissionController@permissionInsert');
		Route::get('/permission_delete/{permission_id}', 'PermissionController@permissionDelete');

		Route::get('/role/{id?}', 'RoleController@role')->name('role');

		// Route::get('/create_role', 'RoleController@create_role')->name('create_role');
		Route::post('/role_insert', 'RoleController@roleInsert');
		Route::get('role_delete/{role_id}', 'RoleController@roleDelete');

		Route::get('/assign_permission_model', 'RoleController@assignPermissionToModel');
		Route::post('/assign_permission_model', 'RoleController@assignPermissionToModelStore');

        Route::post('get_permission_model', 'RoleController@getPermissionModel');


		Route::get('assign_role_model', 'RoleController@assignRoleModel');
		Route::get('get_role/{user_id}', 'RoleController@getRole');
		Route::post('assign_model_role', 'RoleController@assignModelRole');

		Route::post('user_create', 'UserManagement@userCreate');
        Route::get('user_delete/{user_id}', 'UserManagement@userDelete');
		Route::get('user_list', 'UserManagement@userList');
		Route::get('user_update/{user_id}', 'UserManagement@userDetails');

		Route::post('get_roles', 'RoleController@get_role');
		Route::post('get_permission_for_user', 'PermissionController@getPermissionForUser');

		Route::post('update_user', 'UserManagement@userUpdate');
		Route::post('change_password', 'UserManagement@changePassword');
		Route::post('permission_search', 'PermissionController@permissionSearch');
		// Route::post('user_change_password', 'UserManagement@userChangePassword');

		// Code Added by Ahasan from 
		Route::post('user_update', 'UserManagement@userUpdate');
		Route::get('get_permission_by_role_id/{user_id}', 'RoleController@get_role_permission_by_role_id');


		//Approaches data Controller
        Route::get('home', 'ApproachController@index');
        Route::get('home/create', 'ApproachController@create');
        Route::post('home/store','ApproachController@store');

        Route::get('home/edit/{id}',['uses'=>'ApproachController@edit', 'as'=>'approach-edit']);
        Route::get('home/update/{id}',['uses'=>'ApproachController@update', 'as'=>'approach-update']);
        Route::post('home/delete/{id}',['uses'=>'ApproachController@destroy', 'as'=>'approach-delete']);


        //csv
        Route::get('home/export', 'CSVController@export')->name('export');
        //Route::get('export_selected', 'CSVController@export_selected')->name('export_selected');
        Route::get('export_selected/{ids}', 'CSVController@export_selected');
        Route::post('home/importcsv','CSVController@importcsv');

        //Searching data
        Route::post('jqueryLoadMore_normal','ApproachController@jqueryLoadMore_normal');


});

