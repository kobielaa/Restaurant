<?php
/**
 * UserController Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
namespace App\Http\Controllers\Admin;

use Lang;
use Carbon\Carbon;
use App\Models\User;
use App\Models\UserType;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Cusine;
use App\Models\Language;
use App\Models\Country;
use App\Models\City;
use App\Models\Job;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * UserController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class UserController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('permission:users');
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::filter($request->all())
                        ->orderBy('created_at', 'desc')
                        ->paginate(20); 
        foreach ($users as $user) {
            $user->birth_date = Carbon::createFromFormat('Y-m-d', $user->birth_date)->format('d.m.Y');
            if ($user->validity_date != '0000-00-00')
                $user->validity_date = Carbon::createFromFormat('Y-m-d', $user->validity_date)->format('d.m.Y');
            else
                $user->validity_date = null;
        }
        $params = [
            'users' => $users,
        ];
        return view('admin.users.users.list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        $cities = [];
        
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

        $genders = Gender::join(
            'gender_translations as t', 
            function ($join) {
                $join->on('genders.id', '=', 't.gender_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('genders.id')
        ->orderBy('t.name', 'asc')
        ->select('genders.*')
        ->with('translations')
        ->get();

        $specializations = Specialization::join(
            'specialization_translations as t', 
            function ($join) {
                $join->on('specializations.id', '=', 't.specialization_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('specializations.id')
        ->orderBy('t.name', 'asc')
        ->select('specializations.*')
        ->with('translations')
        ->get();

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

        $params = [
            'countries'         => $countries,
            'cities'            => $cities,
            'userTypes'         => $userTypes,
            'genders'           => $genders,
            'specializations'   => $specializations,
            'languages'         => $languages,
            'jobs'              => $jobs,
            'cusines'           => $cusines,
        ];

        return view('admin.users.users.create')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request, 
            [
                'first_name'        => 'required',
                'last_name'         => 'required',
                'email'             => 'required|unique:users',
                'password'          => 'required|string|min:6|confirmed',
                'country'           => 'required',
                'user_type'         => 'required',
                'birth_date'        => 'required|date|date_format:d.m.Y',
                'gender'            => 'required',
                'street'            => 'required',
                'mobile'            => 'required',
                'language'          => 'required',
                'company'           => 'sometimes|required',
                'nip'               => 'sometimes|required',
                'specialization'    => 'sometimes|required',
                'job'               => 'sometimes|required',
            ]
        );

        $user = User::create(
            [
                'user_type_id'          => $request->input('user_type'),
                'email'                 => $request->input('email'),
                'first_name'            => $request->input('first_name'),
                'last_name'             => $request->input('last_name'),
                'password'              => bcrypt($request->input('password')),
                'birth_date'            => Carbon::createFromFormat('d.m.Y', $request->input('birth_date'))->format('Y-m-d'),
                'gender_id'             => $request->input('gender'),
                'language_id'           => $request->input('language'),
                'job_address'           => $request->input('job_address'),
                'job_id'                => $request->input('job'),
                'phone'                 => $request->input('phone'),
                'mobile'                => $request->input('mobile'),
                'fax'                   => $request->input('fax'),
                'website'               => $request->input('website'),
                'company'               => $request->input('company'),
                'nip'                   => $request->input('nip'),
                'specialization_id'     => $request->input('specialization'),
                'cusine_id'             => $request->input('cusine'),
                'country_id'            => $request->input('country'),
                'city_id'               => $request->input('city'),
                'other_city'            => $request->input('other_city'),
                'zip'                   => $request->input('zip'),
                'street'                => $request->input('street'),
                'home_no'               => $request->input('home_number'),
                'specialization_desc'   => $request->input('home_number'),
            ]
        );

        return redirect()->route('admin.users.users.index')->with('success', "The user <strong>$user->name</strong> has successfully been created.");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id user ID
     * 
     * @return \Illuminate\Http\Response HTTP response
     */
    public function show($id)
    {
        try
        {
            $user = User::findOrFail($id);

            $params = [
                'user' => $user,
            ];

            return view('admin.users.users.delete')->with($params);
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id user ID
     * 
     * @return \Illuminate\Http\Response HTTP response
     */
    public function edit($id)
    {
        try
        {
            $user = User::findOrFail($id);
            $user->birth_date = Carbon::createFromFormat('Y-m-d', $user->birth_date)->format('d.m.Y');

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
    
            $cities = City::where('country_id', $user->country_id)
                            ->get();

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
    
            $genders = Gender::join(
                'gender_translations as t', 
                function ($join) {
                    $join->on('genders.id', '=', 't.gender_id')
                        ->where('t.locale', '=', Lang::getLocale());
                }
            ) 
            ->groupBy('genders.id')
            ->orderBy('t.name', 'asc')
            ->select('genders.*')
            ->with('translations')
            ->get();
    
            $specializations = Specialization::join(
                'specialization_translations as t', 
                function ($join) {
                    $join->on('specializations.id', '=', 't.specialization_id')
                        ->where('t.locale', '=', Lang::getLocale());
                }
            ) 
            ->groupBy('specializations.id')
            ->orderBy('t.name', 'asc')
            ->select('specializations.*')
            ->with('translations')
            ->get();
    
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
    
            $params = [
                'user'              => $user,
                'countries'         => $countries,
                'cities'            => $cities,
                'userTypes'         => $userTypes,
                'genders'           => $genders,
                'specializations'   => $specializations,
                'languages'         => $languages,
                'jobs'              => $jobs,
                'cusines'           => $cusines,
            ];

            return view('admin.users.users.edit')->with($params);
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     * @param int                      $id      user ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $user = User::findOrFail($id);

            $this->validate(
                $request, 
                [
                    'first_name'        => 'required',
                    'last_name'         => 'required',
                    'email'             => 'required|unique:users,email,'.$id,
                    'country'           => 'required',
                    'user_type'         => 'required',
                    'birth_date'        => 'required|date|date_format:d.m.Y',
                    'gender'            => 'required',
                    'street'            => 'required',
                    'mobile'            => 'required',
                    'language'          => 'required',
                    'company'           => 'sometimes|required',
                    'nip'               => 'sometimes|required',
                    'specialization'    => 'sometimes|required',
                    'job'               => 'sometimes|required',
                ]
            );
            
            $user->user_type_id          = $request->input('user_type');
            $user->email                 = $request->input('email');
            $user->first_name            = $request->input('first_name');
            $user->last_name             = $request->input('last_name');
            $user->birth_date            = Carbon::createFromFormat('d.m.Y', $request->input('birth_date'))->format('Y-m-d');
            $user->gender_id             = $request->input('gender');
            $user->language_id           = $request->input('language');
            $user->job_address           = $request->input('job_address');
            $user->job_id                = $request->input('job');
            $user->phone                 = $request->input('phone');
            $user->mobile                = $request->input('mobile');
            $user->fax                   = $request->input('fax');
            $user->website               = $request->input('website');
            $user->company               = $request->input('company');
            $user->nip                   = $request->input('nip');
            $user->specialization_id     = $request->input('specialization');
            $user->cusine_id             = $request->input('cusine');
            $user->country_id            = $request->input('country');
            $user->city_id               = $request->input('city');
            $user->other_city            = $request->input('other_city');
            $user->zip                   = $request->input('zip');
            $user->street                = $request->input('street');
            $user->home_no               = $request->input('home_number');
            $user->specialization_desc   = $request->input('home_number');

            $user->save();

            return redirect()->route('admin.users.users.index')->with('success', "The user <strong>$user->name</strong> has successfully been updated.");
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id user ID
     * 
     * @return \Illuminate\Http\Response HTTP response
     */
    public function destroy($id)
    {
        try
        {
            $user = User::findOrFail($id);

            $user->delete();

            return redirect()->route('admin.users.users.index')->with(
                'success', 
                "The user <strong>$user->name</strong> has successfully been archived."
            );
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }
}
