<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/', [
	'uses' => 'MainController@getIndex',
	'as' => 'index',
]);

Route::get('/terms-of-service', [
	'uses' => 'Controller@getTerms',
	'as' => 'terms',
]);

Route::get('/privacy-policy', [
	'uses' => 'Controller@getPrivacy',
	'as' => 'privacy',
]);

Route::get('/sitemap', [
	'uses' => 'SitemapController@getSitemap',
	'as' => 'sitemap',
]);

Route::get('/advisors', [
	'uses' => 'AdvisorController@getAdvisors',
	'as' => 'advisors',
]);

Route::get('/why', [
	'uses' => 'Controller@getWhy',
	'as' => 'why',
]);

/**
 *  Support Routes
 */

Route::get('/support', [
	'uses' => 'SupportController@getSupport',
	'as' => 'support',
]);

Route::post('/support', [
	'uses' => 'SupportController@postSupport',
]);

/**
 *  Authentication Routes
 */

Route::get('/login', [
	'uses' => 'Auth\LoginController@getLoginView',
	'as' => 'login',
	'middleware' => ['guest'],
]);

Route::post('/login', [
	'uses' => 'Auth\LoginController@postLogin',
	'middleware' => ['guest'],
]);

Route::get('/logout', [
	'uses' => 'Auth\LoginController@getLogout',
	'as' => 'auth.logout',
]);

Route::get('/register', [
	'uses' => 'Auth\RegisterController@getRegisterView',
	'as' => 'auth.register',
	'middleware' => ['guest'],
]);

Route::post('/register', [
	'uses' => 'Auth\RegisterController@postRegister',
	'middleware' => ['guest'],
]);

Route::get('/login/error', [
	'uses' => 'Auth\LoginController@getLoginError',
	'as' => 'auth.error',
]);

	/**
	 *  Advisor Authentication Routes
	 */

	Route::post('/register/advisor/check', [
		'uses' => 'Auth\RegisterController@postAdvisorRegisterCheck',
		'middleware' => ['guest'],
	]);

	Route::get('/register/advisor/link', [
		'uses' => 'Auth\RegisterController@getAdvisorAccessLinkView',
		'as' => 'auth.register.advisor.link',
		'middleware' => ['guest'],
	]);

	// Send registration link to advisor
	Route::post('/register/advisor/link/{email}', [
		'uses' => 'Auth\RegisterController@postAdvisorAccessLink',
		'as' => 'auth.register.advisor.link.request',
		'middleware' => ['guest'],
	]);

	Route::get('/register/advisor/{key}', [
		'uses' => 'Auth\RegisterController@getRegisterAdvisor',
		'as' => 'advisor.register.key.get',
		'middleware' => ['guest'],
	]);

	Route::post('/register/advisor/{key}', [
		'uses' => 'Auth\RegisterController@postRegisterAdvisor',
		'as' => 'advisor.register.key.post',
		'middleware' => ['guest'],
	]);

	Route::get('/join/advisor', [
		'uses' => 'Auth\RegisterController@getAdvisorJoinRequestView',
		'as' => 'auth.register.advisor',
		'middleware' => ['guest'],
	]);

	Route::post('/join/advisor', [
		'uses' => 'Auth\RegisterController@postAdvisorJoinRequest',
		'middleware' => ['guest'],
	]);

/**
 *  Admin Routes
 */

Route::get('/admin/dashboard', [
	'uses' => 'AdminController@getDashboard',
	'as' => 'admin',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/dashboard/add', [
	'uses' => 'AdminController@getAddAdvisor',
	'as' => 'admin.add',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/dashboard/add', [
	'uses' => 'AdminController@postAddAdvisor',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/delete-user/{type}/{id}', [
	'uses' => 'AdminController@postDeleteUser',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/approve/advisor/{id}', [
	'uses' => 'AdminController@postApproveAdvisor',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::get('/admin/dashboard/email', [
	'uses' => 'AdminController@getEmail',
	'as' => 'admin.email',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

Route::post('/admin/dashboard/email', [
	'uses' => 'AdminController@postEmail',
	'middleware' => 'roles',
	'roles' => ['Admin']
]);

/**
 *  Password Reset Routes
 */

Route::get('/password/reset', ['uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('/password/email', ['uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('/password/reset/{token?}', [ 'uses' => 'Auth\ResetPasswordController@showResetForm', 'as' => 'password.reset']);
Route::post('/password/reset', ['uses' => 'Auth\ResetPasswordController@reset']);

/**
 *  User Profile Routes
 */

Route::get('/profile/{name}', [
	'uses' => 'ProfileController@getProfile',
	'as' => 'profile',
	'middleware' => ['auth'],
]);



	/**
	 *  Edit profile routes
	 */

	Route::post('/profile/edit/email', [
		'uses' => 'ProfileController@postEditEmail',
		'middleware' => ['auth'],
	]);

	Route::post('/profile/edit/password', [
		'uses' => 'ProfileController@postEditPassword',
		'middleware' => ['auth'],
	]);

	// Advisor info change form post route
	Route::post('/profile/advisor/edit', [
		'uses' => 'ProfileController@postAdvisorInfoChange',
		'middleware' => ['auth'],
	]);

/**
 *  Main Page Routes
 */

/*Route to post category form*/
Route::post('/main/topic/{topicText}', [
	'uses' => 'MainController@postTopics',
]);

/**
 *  Question Page Routes
 */

Route::get('/question', [
	'uses' => 'QuestionController@getQuestionView',
	'as' => 'question',
	'middleware' => ['auth'],
]);

Route::post('/question/submit', [
	'uses' => 'QuestionController@postQuestion',
	'middleware' => ['auth'],
]);

/**
 *  Question Response Routes
 */

Route::post('/question/response/{questionId}', [
	'uses' => 'QuestionController@postQuestionResponse',
	'middleware' => ['auth'],
]);

/**
 *  Question step-by-step details
 */

Route::post('/question/details/1', [
	'uses' => 'QuestionController@postQuestionDetailsStep1',
	'middleware' => ['auth'],
]);

Route::post('/question/details/2', [
	'uses' => 'QuestionController@postQuestionDetailsStep2',
	'middleware' => ['auth'],
]);

Route::post('/question/details/3', [
	'uses' => 'QuestionController@postQuestionDetailsStep3',
	'middleware' => ['auth'],
]);

Route::post('/question/details/4', [
	'uses' => 'QuestionController@postQuestionDetailsStep4',
	'middleware' => ['auth'],
]);

Route::post('/question/details/5', [
	'uses' => 'QuestionController@postQuestionDetailsStep5',
	'middleware' => ['auth'],
]);

Route::post('/question/details/final', [
	'uses' => 'QuestionController@postQuestionDetailsStepFinal',
	'middleware' => ['auth'],
]);

/**
 *  Discussion Routes
 */

Route::get('/discussion/create/{questionId}/{advisorId}/{responseId}', [
	'uses' => 'DiscussionController@createDiscussion',
	'as' => 'discussion.create',
	'middleware' => ['auth'],
]);

Route::get('/discussion/{id}', [
	'uses' => 'DiscussionController@getDiscussion',
	'as' => 'discussion',
	'middleware' => ['auth'],
]);

Route::post('/discussion/{id}', [
	'uses' => 'DiscussionController@postDiscussion',
	'as' => 'discussion.post',
	'middleware' => ['auth'],
]);

Route::post('/discussion/notification/{id}', [
	'uses' => 'DiscussionController@postDiscussionNotification',
	'middleware' => ['auth'],
]);

