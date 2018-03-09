<?php
/**
 * AppServiceProvider Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category ServiceProvider
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */

namespace App\Providers;

use View;
use Lang;
use DB;
use App\Models\Cusine;
use App\Models\Language;
use App\Models\UserType;
use App\Models\Country;
use App\Models\Job;
use App\Models\AdvertType;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;

/**
 * AppServiceProvider Class Doc Comment
 * 
 * @category ServiceProvider
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        View::composer(
            '*', 
            function ($view) {
                $view->with('globalData', $this->_getSharedData());
            }
        );

        Validator::extend(
            'uniqueTwoFields', 
            function ($attribute, $value, $parameters, $validator) {
                if (count($parameters) > 4) {
                    $count = DB::table($parameters[0])->where($parameters[1], $value)
                                            ->where($parameters[2], $parameters[3])
                                            ->where($parameters[4], '<>', $parameters[5])
                                            ->count();
                } else {
                    $count = DB::table($parameters[0])->where($parameters[1], $value)
                                            ->where($parameters[2], $parameters[3])
                                            ->count();
                }
        
                return $count === 0;
            }
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'dev') {
            $this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            $this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        }
    }

    /**
     * Get shared data.
     *
     * @return array params
     */
    private function _getSharedData() 
    {
        $globalData = [
            'cusines'       => $this->_getCusines(),
            'languages'     => $this->_getLanguages(),
            'user_types'    => $this->_getUserTypes(),
            'countries'     => $this->_getCountries(),
            'jobs'          => $this->_getJobs(),
            'advert_types'  => $this->_getAdvertTypes(),
        ];

        return $globalData;
    }

    /**
     * Get cusines.
     *
     * @return array cusines
     */
    private function _getCusines() 
    {
        $cusines = Cusine::join(
            'cusine_translations as t', 
            function ($join) {
                $join->on('cusines.id', '=', 't.cusine_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('cusines.id')
        ->orderBy('t.name', 'asc')
        ->select('cusines.*')
        ->with('translations')
        ->get();

        return $cusines;
    }

    /**
     * Get languages.
     *
     * @return array languages
     */
    private function _getLanguages() 
    {
        $languages = Language::join(
            'language_translations as t', 
            function ($join) {
                $join->on('languages.id', '=', 't.language_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('languages.id')
        ->orderBy('t.name', 'asc')
        ->select('languages.*')
        ->with('translations')
        ->get();

        return $languages;
    }

    /**
     * Get user user types.
     *
     * @return array user types
     */
    private function _getUserTypes() 
    {
        $userTypes = UserType::join(
            'user_type_translations as t', 
            function ($join) {
                $join->on('user_types.id', '=', 't.user_type_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('user_types.id')
        ->orderBy('t.name', 'asc')
        ->select('user_types.*')
        ->with('translations')
        ->get();

        return $userTypes;
    }

    /**
     * Get user countries.
     *
     * @return array countries
     */
    private function _getCountries() 
    {
        $countries = Country::join(
            'country_translations as t', 
            function ($join) {
                $join->on('countries.id', '=', 't.country_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('countries.id')
        ->orderBy('t.name', 'asc')
        ->select('countries.*')
        ->with('translations')
        ->get();

        return $countries;
    }

    /**
     * Get jobs.
     *
     * @return array jobs
     */
    private function _getJobs() 
    {
        $jobs = Job::join(
            'job_translations as t', 
            function ($join) {
                $join->on('jobs.id', '=', 't.job_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('jobs.id')
        ->orderBy('t.name', 'asc')
        ->select('jobs.*')
        ->with('translations')
        ->get();

        return $jobs;
    }

    /**
     * Get user advert types.
     *
     * @return array user types
     */
    private function _getAdvertTypes() 
    {
        $advertTypes = AdvertType::join(
            'advert_type_translations as t', 
            function ($join) {
                $join->on('advert_types.id', '=', 't.advert_type_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('advert_types.id')
        ->orderBy('t.name', 'asc')
        ->select('advert_types.*')
        ->with('translations')
        ->get();

        return $advertTypes;
    }
}
