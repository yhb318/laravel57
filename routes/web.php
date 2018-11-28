<?php

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

	//使用/home，而不是home。
	Route::get('/home', function () {
	    return 'hello word';
	});

	Route::post('/post1', function () {
	    return 'hello post1';
	});

	//指定多种访问类型的路由
	Route::match(['get','post'],'/more', function () {
	    return 'hello get,post....';
	});

	//允许所有的路由
	Route::any('/any', function () {
	    return 'hello any';
	});

	//路由参数
	Route::get('/user/{id}', function ($id) {
	    return 'User '.$id;
	});
	//可以按需要在路由中定义多个路由参数： 参数必须写完才能正常访问
	Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
	    return 'posts '.$postId.'<br>      comments '.$commentId;
	});

	//***********************************************************
	//* 可选参数路由  $name=null必须赋值   前面的参数必须传  最后一个才是可选的 user2 comments threes地址这几个不可少
	//* 这里路由 user和上面的重复了 如果访问没comments参数的话会直接访问前面的  有就访问下面的    现在改成user2
	//* 多个参数时最后一个参数才是可选的 其他参数必传
	//***********************************************************
	Route::get('/user2/{name?}/comments/{comment?}/threes/{three?}', function ($name=null,$comment=null) {
	    return 'Username '.$name.'<br>      comments '.$comment;
	});

	Route::get('/kx/{id?}', function ($id) {
	    return 'kx '.$id;
	});

	//只能正则匹配的字母才能正常访问
	Route::get('/kx2/{id?}', function ($id) {
	    return 'kx2 '.$id;
	})->where('id', '[A-Za-z]+');
	//只能正则匹配的才能正常访问  多参数匹配
	Route::get('pipei/{id}/{name?}', function ($id, $name='测试可选参数') {
	    return 'id :'.$id.'<br> name: '.$name;
	})->where(['id' => '[0-9]+', 'name' => '[a-z]+']);



	//***********************************************************
	//*路由别名 无法使用 
	//*
	//***********************************************************
	Route::get('/user2/kx3-te', ['as' => 'profile1', function () {
	    return route('profile1');
	}]);

	Route::get('/user2/kx', function () {
	    return 'kx ';
	})->name('profile');
	//***********************************************************
	//*路由调用控制器
	//*
	//***********************************************************

	// Route::get('/member/info/{id}', 'MemberController@info1');


	// Route::any('/member/info', 
	// 			['uses'=>'MemberController@info1',
	// 			 'as'=>	'memberinfo'
	// 			]);

	//调用控制器 并传输参数  '/member/info/{id}' 传参是错的
	Route::any('/member/{id}',['uses'=>'MemberController@info1'])->where('id', '[0-9-A-Za-z]+');




	//***********************************************************
	//* DB facade实现curd(数据库原子操作)
	//* 查询构造器操作数据库
	//*
	//***********************************************************
	
	// DB::insert(); 添加数据数据 
	Route::any('/insert',['uses'=>'MemberController@insert_data']);
	// DB::select('select * from l_member where id = :id', ['id' => 1]); 查询指定数据 
	Route::any('/select',['uses'=>'MemberController@select_data']);

	// DB::table('l_member')->get(); 查询所有数据 
	Route::any('/query',['uses'=>'MemberController@query_data']);


	// DB::table('l_member')->where('id',1)->update(['other'=>'number']); 修改更新数据	 
	Route::any('/update',['uses'=>'MemberController@update_data']);
	// DB::delete('delete from l_member'); 删除数据 
	Route::any('/delete',['uses'=>'MemberController@delete_data']);

	//	构造器聚合函数
	Route::any('/polymerization',['uses'=>'MemberController@DB_table']);



	// DB::delete('delete from l_member'); 添加数据 
	Route::any('/delete_',['uses'=>'MemberController@delete_a']);



	//***********************************************************
	//* ORM    理解为ModelMember::加操作函数等  
	//*
	//*
	//***********************************************************
	Route::any('/orm1',['uses'=>'MemberController@orm_model']);

	//orm新增
	Route::any('/orm2/{name?}/{id?}',['uses'=>'MemberController@orm_insert']);

	//orm更新
	Route::any('/orm3/{id?}',['uses'=>'MemberController@orm_update']);

	

	//———————————————————————————————————————
	//|Software: 模型关系映射测试
	//|	
	//|=======================================
	Route::any('/hasOne/{id?}',['uses'=>'EloquentsController@get_bank']);
	Route::any('/belongsTo/{id?}',['uses'=>'EloquentsController@belongsTo_']);
	Route::any('/hasMany/{id?}',['uses'=>'EloquentsController@hasMany_']);


// Auth::routes();
// Route::get('/home', 'HomeController@index');