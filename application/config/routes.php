<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home_controller';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['test'] = 'user/test';

/**
 * Movie detail
 */
$route['movie/(:any)'] = 'user/movie_detail_controller/index/$1';
$route['movie/(:any)/review/(:num)'] = 'user/movie_detail_controller/data_review/$1/$2';
$route['movie/review/comment'] = 'user/movie_detail_controller/review';

/**
 * Movie
 */
$route['movie/(:any)/(:any)'] = 'user/movie_controller/index/$1/$2';
$route['movie/view/(:num)/(:num)'] = 'user/movie_controller/updateViewMovie/$1/$2';
$route['movie/view/like/(:num)/(:num)/(:num)'] = 'user/movie_controller/updateLikeAndDislike/$1/$2/$3';
/**
 * Account, login , register
 */
$route['account'] = 'user/account_controller/index';
$route['login'] = 'user/account_controller/login_template';
$route['login/ajax'] = 'user/account_controller/login';
$route['register'] = 'user/account_controller/register_template';
$route['register/ajax'] = 'user/account_controller/register';
$route['logout'] = 'user/account_controller/logout';
$route['account/follow'] = 'user/account_controller/addFollow';
/**
 * Search
 */
$route['search/popup'] = 'home_controller/searchPopup';
$route['search'] = 'user/category_controller/search';
/**
 * Genres page
 */
$route['genre'] = 'user/category_controller/index';
$route['genre/filter'] = 'user/category_controller/filterMovies';

