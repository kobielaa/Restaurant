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

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(), 
        'middleware' => [ 
            'localeSessionRedirect', 
            'localizationRedirect' 
        ]
    ], 
    function () {
        Route::get('getCitiesByCountry', 'Admin\CountryController@cities');
        Route::get('deleteAdvertImage', 'AdvertController@deleteImage');
        Route::get(
            '/', 
            [
                'uses' => 'HomeController@index',
                'as' => 'home',
            ]
        );
        Route::group(
            ['prefix' => 'adverts'], 
            function () {
                Route::get('/', ['uses' => 'HomeController@index', 'as' => 'adverts.index']);
                Route::get('/{id}', ['uses' => 'HomeController@show', 'as' => 'adverts.show']);
            }
        );
        // User routes
        Route::group(
            ['prefix' => 'user'], 
            function () {
                Route::resource('adverts', 'AdvertController', ['as' => 'user']);
            }
        );
        // Admin routes
        Route::group(
            [
                'prefix' => 'admin',
                'namespace' => 'Admin',
                'middleware' => [ 
                    'auth', 
                ]
            ], 
            function () {
                Route::get('toggleAdvert', 'AdvertController@toggle');
                // Cusines routes
                Route::resource('cusines', 'CusineController');
                // Locations routes
                Route::group(
                    ['prefix' => 'locations'],
                    function () {
                        Route::resource('countries', 'CountryController', ['as' => 'admin.locations']);
                        Route::resource('cities', 'CityController', ['as' => 'admin.locations']);
                        Route::resource('languages', 'LanguageController', ['as' => 'admin.locations']);
                    }
                );
                // Users routes
                Route::group(
                    ['prefix' => 'users'],
                    function () {
                        Route::resource('permissions', 'PermissionController', ['as' => 'admin.users']);
                        Route::resource('users', 'UserController', ['as' => 'admin.users']);
                        Route::resource('types', 'UserTypeController', ['as' => 'admin.users']);
                        Route::resource('jobs', 'JobController', ['as' => 'admin.users']);
                        Route::resource('genders', 'GenderController', ['as' => 'admin.users']);
                        Route::resource('specializations', 'SpecializationController', ['as' => 'admin.users']);
                    }
                );
                // Payments routes
                Route::group(
                    ['prefix' => 'payments'],
                    function () {
                        Route::resource('periods', 'PaymentPeriodController', ['as' => 'admin.payments']);
                        Route::resource('types', 'PaymentTypeController', ['as' => 'admin.payments']);
                        Route::resource('prices', 'PaymentPriceController', ['as' => 'admin.payments']);
                        Route::resource('codes', 'PaymentCodeController', ['as' => 'admin.payments']);
                    }
                );
                // Adverts routes
                Route::group(
                    ['prefix' => 'adverts'],
                    function () {
                        Route::resource('types', 'AdvertTypeController', ['as' => 'admin.adverts']);
                        Route::resource('categories', 'AdvertCategoryController', ['as' => 'admin.adverts']);
                        Route::resource('adverts', 'AdvertController', ['as' => 'admin.adverts']);
                    }
                );
                // Subdomains routes
                Route::group(
                    ['prefix' => 'subdomains'],
                    function () {
                        Route::resource('subdomains', 'SubdomainController', ['as' => 'admin.subdomains']);
                    }
                );
                Route::get(
                    '/', [
                        'uses' => 'DashboardController@index',
                        'as' => 'admin.index',
                    ]
                );
            }
        );

        // Auth::routes();
        Route::group(
            ['prefix' => 'auth', 'namespace' => 'Auth'],
            function () {
                // Authentication Routes...
                Route::get('login', 'LoginController@showLoginForm')->name('login');
                Route::post('login', 'LoginController@login');
                Route::post('logout', 'LoginController@logout')->name('logout');

                // Password Reset Routes...
                Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.reset');
                Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
                Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset.token');
                Route::post('password/reset', 'ResetPasswordController@reset');

                // Registration Routes...
                $this->get('register', 'RegisterController@showRegistrationForm')->name('register');
                $this->post('register', 'RegisterController@register');
            }
        );

        // Adverts Routes
        Route::group(
            [], 
            function () {
                Route::get('all/cusines/{cusine_slug}', ['uses' => 'HomeController@filterAdverts', 'as' => 'adverts.all']);
                Route::get('all/cusines/{cusine_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('restaurants/', ['uses' => 'HomeController@filterAdverts', 'as' => 'adverts.restaurants']);
                Route::get('restaurants/cusines/{cusine_slug}', 'HomeController@filterAdverts');
                Route::get('restaurants/cusines/{cusine_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('restaurants/{country_slug}', 'HomeController@filterAdverts');
                Route::get('restaurants/{country_slug}/{city_slug}', 'HomeController@filterAdverts');
                Route::get('restaurants/{country_slug}/{city_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('cookers/', ['uses' => 'HomeController@filterAdverts', 'as' => 'adverts.cookers']);
                Route::get('cookers/cusines/{cusine_slug}', 'HomeController@filterAdverts');
                Route::get('cookers/cusines/{cusine_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('cookers/{country_slug}', 'HomeController@filterAdverts');
                Route::get('cookers/{country_slug}/{city_slug}', 'HomeController@filterAdverts');
                Route::get('cookers/{country_slug}/{city_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('suppliers/', ['uses' => 'HomeController@filterAdverts', 'as' => 'adverts.suppliers']);
                Route::get('supliers/cusines/{cusine_slug}', 'HomeController@filterAdverts');
                Route::get('supliers/cusines/{cusine_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('supliers/{country_slug}', 'HomeController@filterAdverts');
                Route::get('supliers/{country_slug}/{city_slug}', 'HomeController@filterAdverts');
                Route::get('supliers/{country_slug}/{city_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('realities/', ['uses' => 'HomeController@filterAdverts', 'as' => 'adverts.realties']);
                Route::get('realities/cusines/{cusine_slug}', 'HomeController@filterAdverts');
                Route::get('realties/cusines/{cusine_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('realties/{country_slug}', 'HomeController@filterAdverts');
                Route::get('realties/{country_slug}/{city_slug}', 'HomeController@filterAdverts');
                Route::get('realties/{country_slug}/{city_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('jobs/', ['uses' => 'HomeController@filterAdverts', 'as' => 'adverts.jobs']);
                Route::get('jobs/cusines/{cusine_slug}', 'HomeController@filterAdverts');
                Route::get('jobs/cusines/{cusine_slug}/{advert_slug}', 'HomeController@filterAdverts');
                Route::get('jobs/{country_slug}', 'HomeController@filterAdverts');
                Route::get('jobs/{country_slug}/{city_slug}', 'HomeController@filterAdverts');
                Route::get('jobs/{country_slug}/{city_slug}/{advert_slug}', 'HomeController@filterAdverts');
            }
        );

        Route::get('slug/regenerate', 'HomeController@slugRegenerate');        
    }
);
