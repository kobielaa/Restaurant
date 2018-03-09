<?php
/**
 * RegisterController Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */

namespace App\Http\Controllers\Auth;

use Lang;
use App\Models\User;
use App\Models\UserType;
use App\Models\Gender;
use App\Models\Specialization;
use App\Models\Cusine;
use App\Models\Language;
use App\Models\Country;
use App\Models\City;
use App\Models\Job;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Jrean\UserVerification\Traits\VerifiesUsers;
use Jrean\UserVerification\Facades\UserVerification;
use Illuminate\Http\Request;


/**
 * RegisterController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    use VerifiesUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest',['except' => ['getVerification', 'getVerificationError']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data data to validate
     * 
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make(
            $data, 
            [
                'user_type'     => 'required',
                'email'         => 'required|string|email|unique:users',
                'password'      => 'required|string|confirmed',
                'first_name'    => 'required',
                'last_name'     => 'required',
                'gender'        => 'required',
                'birth_date'    => 'required|date',
                'language'      => 'required',
                'mobile'        => 'required',
                'company'       => 'required',
                'nip'           => 'required',
                'country'       => 'required',
                'city'          => 'required',
                'street'        => 'required',
                'cusine'        => 'required',
            ]
        );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data user data
     * 
     * @return \App\User
     */
    protected function create(array $data)
    {
        if (!isset($data['language'])) {
            $data['language'] = null;
        }
        if (!isset($data['user_type'])) {
            $data['user_type'] = null;
        }
        if (!isset($data['first_name'])) {
            $data['first_name'] = null;
        }
        if (!isset($data['last_name'])) {
            $data['last_name'] = null;
        }
        if (!isset($data['gender'])) {
            $data['gender'] = null;
        }
        if (!isset($data['birth_date'])) {
            $data['birth_date'] = null;
        }
        if (!isset($data['phone'])) {
            $data['phone'] = null;
        }
        if (!isset($data['fax'])) {
            $data['fax'] = null;
        }
        if (!isset($data['website'])) {
            $data['website'] = null;
        }
        if (!isset($data['company'])) {
            $data['company'] = null;
        }
        if (!isset($data['nip'])) {
            $data['nip'] = null;
        }
        if (!isset($data['specialization'])) {
            $data['specialization'] = null;
        }
        if (!isset($data['cusine'])) {
            $data['cusine'] = null;
        }
        if (!isset($data['country'])) {
            $data['country'] = null;
        }
        if (!isset($data['city'])) {
            $data['city'] = null;
        }
        if (!isset($data['other_city'])) {
            $data['other_city'] = null;
        }
        if (!isset($data['zip'])) {
            $data['zip'] = null;
        }
        if (!isset($data['street'])) {
            $data['street'] = null;
        }
        if (!isset($data['home_number'])) {
            $data['home_number'] = null;
        }
        if (!isset($data['description'])) {
            $data['description'] = null;
        }
        if (!isset($data['job'])) {
            $data['job'] = null;
        }
        if (!isset($data['job_address'])) {
            $data['job_address'] = null;
        }
        
        return User::create(
            [
                'email'             => $data['email'],               
                'language_id'       => $data['language'],
                'user_type_id'      => $data['user_type'],
                'first_name'        => $data['first_name'],
                'last_name'         => $data['last_name'],
                'gender_id'         => $data['gender'],
                'birth_date'        => $data['birth_date'],
                'phone'             => $data['phone'],
                'fax'               => $data['fax'],
                'website'           => $data['website'],
                'company'           => $data['company'],
                'nip'               => $data['nip'],
                'specialization_id' => $data['specialization'],
                'cusine_id'         => $data['cusine'],
                'country_id'        => $data['country'],
                'city_id'           => $data['city'],
                'other_city'        => $data['other_city'],
                'zip'               => $data['zip'],
                'street'            => $data['street'],
                'home_no'           => $data['home_number'],
                'description'       => $data['description'],
                'job_id'            => $data['job'],
                'job_desc'          => $data['job_address'],
                'password'          => bcrypt($data['password']),
            ]
        );
    }

    /**
     * Sends verification e-mail.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $user = $this->create($request->all());
        UserVerification::generate($user);
        UserVerification::send($user, 'Please - verify Your e-mail');
        return redirect()->route('adverts.index')->withAlert('Register successfully, please verify your email.');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm()
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

        return view('auth.register')->with($params);
    }
}
