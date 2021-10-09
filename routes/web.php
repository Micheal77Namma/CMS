<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Mail\TestEmail;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

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

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => 'auth'] , function(){
    // route for Posts
    Route::resource('post', "postController");
    Route::get('post/{id}/delete',"postController@deleted");
    Route::get('posts/trashed',"postController@trashed");
    Route::get('post/{id}/hdelete',"postController@hdelete");
    Route::get('post/{id}/restore',"postController@restore");


        // route for Category
    Route::resource('category', "categoryController");
    Route::get('category/{id}/delete',"categoryController@deleted");

    // route for Tags
    Route::resource('tag', "tagController");
    Route::get('tag/{id}/delete',"tagController@deleted");

    // route for Users
    Route::resource('user', "userController");
    Route::get('tag/{id}/delete',"tagController@deleted");
    Route::get('user/admin/{id}',"userController@admin");
    Route::get('user/notadmin/{id}',"userController@notadmin");

    // route for Settings
    Route::resource('settings', "settingsController");
    Route::get('settings/update2',"settingsController@update")->name('settings.update2');


    Route::get('/',"siteUIcontroller@index")->name('index');

    //route for showing single post
    Route::get('/post/{slug}', 'siteUIcontroller@showPost')->name('post.show');

	//route for User front end
	Route::get('/', 'siteUIcontroller@index')->name('index');
	Route::get('/category/{id}', 'siteUIcontroller@category')->name('category.show');
	Route::get('/tag/{id}', 'siteUIcontroller@tag')->name('tag.show');

	//route for showing single post
	Route::get('/post/{slug}', 'siteUIcontroller@showPost')->name('post.show');

    //route for user profile
    Route::get('/users/profile', 'ProfilesController@index')->name('users.profile');
    Route::post('/users/profile/update', 'ProfilesController@update')->name('users.profile.update');
    Route::get('/users/profile/create', 'ProfilesController@create')->name('users.profile.create');

	//route for admin dashboard
    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');


    //route for query results
	Route::get('/results', function () {
		$post = App\Models\post::where('title', 'like' ,  '%' . request('search') . '%' )->get();
		return view('results.results')
		->with('posts' , $post )
		->with('title' ,  'Result : '. request('search') )
		->with('settings',  App\Models\settings::first() )
		->with('blog_name' , App\Models\settings::first()->blog_name)
		->with('categories' , App\Models\category::take(5)->get() )
		->with('query' , request('search') )   ;

        }) ;
});


Route::group([ 'middleware'=>['role:administrator']], function () {

    Route::resource('userss', 'UserssController') ;
    Route::resource('permission', 'PermissionController') ;
    Route::resource('roles', 'RolesController') ;
});

// make new role
Route::get('/newrole', function(){
    $owner = new App\Models\Role();
    $owner->name         = 'owner';
    $owner->display_name = 'Project Owner'; // optional
    $owner->description  = 'User is the owner of a given project'; // optional
    $owner->save();
    $admin = new App\Models\Role();
    $admin->name         = 'admin';
    $admin->display_name = 'User Administrator'; // optional
    $admin->description  = 'User is allowed to manage and edit other users'; // optional
    $admin->save();
    return back();
})->name('newrole');


    // make new permission
Route::get('/newpermission', function(){
    $createPost = new App\Models\Permission();
    $createPost->name         = 'create-post';
    $createPost->display_name = 'Create Posts'; // optional
    // Allow a user to...
    $createPost->description  = 'create new blog posts'; // optional
    $createPost->save();
    $editUser = new App\Models\Permission();
    $editUser->name         = 'edit-user';
    $editUser->display_name = 'Edit Users'; // optional
    // Allow a user to...
    $editUser->description  = 'edit existing users'; // optional
    $editUser->save();
    return back();
})->name('newpermission');

