<?php
/**
 * AdvertController Class Doc Comment
 * 
 * PHP version 5
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
namespace App\Http\Controllers;

use Lang;
use Auth;
use Storage;
use App\Models\City;
use App\Models\Country;
use App\Models\Advert;
use App\Models\AdvertType;
use App\Models\AdvertCategory;
use App\Models\Language;
use App\Models\PaymentPeriod;
use App\Models\Cusine;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * AdvertController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class AdvertController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware(['auth','isVerified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adverts = Advert::where('user_id', Auth::user()->id)
        ->orderBy('id', 'desc')->get();
        $params = [
            'adverts' => $adverts,
        ];
        return view('users.adverts.list')->with($params);
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

        $cities = City::where('country_id', Auth::user()->country_id)
        ->orderBy('name', 'asc')->get();
        
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

        $advertCategories = AdvertCategory::join(
            'advert_category_translations as t', 
            function ($join) {
                $join->on('advert_categories.id', '=', 't.advert_category_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('advert_categories.id')
        ->orderBy('t.name', 'asc')
        ->select('advert_categories.*')
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

        $paymentPeriods = PaymentPeriod::join(
            'payment_period_translations as t', 
            function ($join) {
                $join->on('payment_periods.id', '=', 't.payment_period_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('payment_periods.id')
        ->orderBy('t.name', 'asc')
        ->select('payment_periods.*')
        ->with('translations')
        ->get();

        $params = [
            'countries'         => $countries,
            'cities'            => $cities,
            'advertTypes'       => $advertTypes,
            'advertCategories'  => $advertCategories,
            'cusines'           => $cusines,
            'languages'         => $languages,
            'paymentPeriods'    => $paymentPeriods,
        ];

        return view('users.adverts.create')->with($params);
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
                'advert_type'       => 'required',
                'language'          => 'required',
                'email'             => 'required',
                'cusine'            => 'required',
                'country'           => 'required',
                'city'              => 'required',
                'street'            => 'required',
                'payment_period'    => 'required',                
                'advert_text'       => 'required',                
                'advert_category'   => 'sometimes|required',
                'wifi'              => 'sometimes|required',
                'smoking'           => 'sometimes|required',
            ]
        );

        $image_1 = $request->file('main_image');
        $image_2 = $request->file('image_2');
        $image_3 = $request->file('image_3');
        $image_4 = $request->file('image_4');
        $image_5 = $request->file('image_5');
        $image_6 = $request->file('image_6');
        
        $advert = Advert::create(
            [
                'first_name'            => $request->input('first_name'),
                'last_name'             => $request->input('last_name'),
                'email'                 => $request->input('email'),
                'company'               => $request->input('company'),
                'phone'                 => $request->input('phone'),
                'mobile'                => $request->input('mobile'),
                'home_no'               => $request->input('home_no'),
                'zip'                   => $request->input('zip'),
                'street'                => $request->input('street'),
                'fax'                   => $request->input('fax'),
                'website'               => $request->input('website'),
                'text'                  => $request->input('advert_text'),
                'promo_text'            => $request->input('promo_text'),
                'discount'              => $request->input('discount'),
                'wifi'                  => $request->input('wifi'),
                'smoking'               => $request->input('smoking'),
                'add_date'              => Carbon::now(),
                'user_id'               => Auth::user()->id,
                'language_id'           => $request->input('language'),
                'city_id'               => $request->input('city'),
                'country_id'            => $request->input('country'),
                'advert_type_id'        => $request->input('advert_type'),
                'advert_category_id'    => $request->input('advert_category'),
                'payment_period_id'     => $request->input('payment_period'),
                'cusine_id'             => $request->input('cusine'),
            ]
        );

        if ($image_1 != null) {
            $ext = $image_1->guessClientExtension();
            $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_1, 'main_image.'.$ext);
            $advert->image_1 = $path;
        }
        if ($image_2 != null) {
            $ext = $image_2->guessClientExtension();
            $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_2, 'image_2.'.$ext);
            $advert->image_2 = $path;
        }
        if ($image_3 != null) {
            $ext = $image_3->guessClientExtension();
            $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_3, 'image_3.'.$ext);
            $advert->image_3 = $path;
        }
        if ($image_4 != null) {
            $ext = $image_4->guessClientExtension();
            $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_4, 'image_4.'.$ext);
            $advert->image_4 = $path;
        }
        if ($image_5 != null) {
            $ext = $image_5->guessClientExtension();
            $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_5, 'image_5.'.$ext);
            $advert->image_5 = $path;
        }
        if ($image_6 != null) {
            $ext = $image_6->guessClientExtension();
            $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_6, 'image_6.'.$ext);
            $advert->image_6 = $path;
        }

        if ($request->input('company') == null || strlen($request->input('company')) == 0) {
            $slug = SlugService::createSlug(Advert::class, 'slug', $request->input('first_name') . ' ' . $request->input('last_name'));
            $advert->slug = $slug;                
        }
        $advert->save();

        return redirect()->route('user.adverts.index')->with('success', "Advert created");
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
            $advert = Advert::findOrFail($id);

            $params = [
                'advert' => $advert,
            ];

            return view('users.adverts.delete')->with($params);
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
            $advert = Advert::findOrFail($id);
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
    
            $cities = City::where('country_id', $advert->country_id)
            ->orderBy('name', 'asc')->get();
            
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
    
            $advertCategories = AdvertCategory::join(
                'advert_category_translations as t', 
                function ($join) {
                    $join->on('advert_categories.id', '=', 't.advert_category_id')
                        ->where('t.locale', '=', Lang::getLocale());
                }
            ) 
            ->groupBy('advert_categories.id')
            ->orderBy('t.name', 'asc')
            ->select('advert_categories.*')
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
    
            $paymentPeriods = PaymentPeriod::join(
                'payment_period_translations as t', 
                function ($join) {
                    $join->on('payment_periods.id', '=', 't.payment_period_id')
                        ->where('t.locale', '=', Lang::getLocale());
                }
            ) 
            ->groupBy('payment_periods.id')
            ->orderBy('t.name', 'asc')
            ->select('payment_periods.*')
            ->with('translations')
            ->get();
            $params = [
                'advert' => $advert,
                'countries'         => $countries,
                'cities'            => $cities,
                'advertTypes'       => $advertTypes,
                'advertCategories'  => $advertCategories,
                'cusines'           => $cusines,
                'languages'         => $languages,
                'paymentPeriods'    => $paymentPeriods,
            ];

            return view('users.adverts.edit')->with($params);
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
            $advert = Advert::findOrFail($id);

            $this->validate(
                $request, 
                [
                    'advert_type'       => 'required',
                    'language'          => 'required',
                    'email'             => 'required',
                    'cusine'            => 'required',
                    'country'           => 'required',
                    'city'              => 'required',
                    'street'            => 'required',
                    'payment_period'    => 'required',                
                    'advert_text'       => 'required',                
                    'advert_category'   => 'sometimes|required',
                    'wifi'              => 'sometimes|required',
                    'smoking'           => 'sometimes|required',
                ]
            );

            $image_1 = $request->file('main_image');
            $image_2 = $request->file('image_2');
            $image_3 = $request->file('image_3');
            $image_4 = $request->file('image_4');
            $image_5 = $request->file('image_5');
            $image_6 = $request->file('image_6');
            
            $advert->first_name         = $request->input('first_name');
            $advert->last_name          = $request->input('last_name');
            $advert->email              = $request->input('email');
            $advert->company            = $request->input('company');
            $advert->phone              = $request->input('phone');
            $advert->mobile             = $request->input('mobile');
            $advert->home_no            = $request->input('home_no');
            $advert->zip                = $request->input('zip');
            $advert->street             = $request->input('street');
            $advert->fax                = $request->input('fax');
            $advert->website            = $request->input('website');
            $advert->text               = $request->input('advert_text');
            $advert->promotion          = $request->input('promotion_text');
            $advert->discount           = $request->input('discount');
            $advert->wifi               = $request->input('wifi');
            $advert->smoking            = $request->input('smoking');
            $advert->language_id        = $request->input('language');
            $advert->city_id            = $request->input('city');
            $advert->country_id         = $request->input('country');
            $advert->advert_type_id     = $request->input('advert_type');
            $advert->advert_category_id = $request->input('advert_category');
            $advert->payment_period_id  = $request->input('payment_period');
            $advert->cusine_id          = $request->input('cusine');

            if ($image_1 != null) {
                $ext = $image_1->guessClientExtension();
                $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_1, 'main_image.'.$ext);
                $advert->image_1 = $path;
            }
            if ($image_2 != null) {
                $ext = $image_2->guessClientExtension();
                $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_2, 'image_2.'.$ext);
                $advert->image_2 = $path;
            }
            if ($image_3 != null) {
                $ext = $image_3->guessClientExtension();
                $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_3, 'image_3.'.$ext);
                $advert->image_3 = $path;
            }
            if ($image_4 != null) {
                $ext = $image_4->guessClientExtension();
                $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_4, 'image_4.'.$ext);
                $advert->image_4 = $path;
            }
            if ($image_5 != null) {
                $ext = $image_5->guessClientExtension();
                $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_5, 'image_5.'.$ext);
                $advert->image_5 = $path;
            }
            if ($image_6 != null) {
                $ext = $image_6->guessClientExtension();
                $path = Storage::disk('adverts')->putFileAs(Auth::user()->id.'/'.$advert->id, $image_6, 'image_6.'.$ext);
                $advert->image_6 = $path;
            }

            if ($request->input('company') == null || strlen($request->input('company')) == 0) {
                $slug = SlugService::createSlug(Advert::class, 'slug', $request->input('first_name') . ' ' . $request->input('last_name'));
                $advert->slug = $slug;                
            }

            $advert->save();

            return redirect()->route('user.adverts.index')->with('success', 'Advert has been updated.');
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
            $advert = Advert::findOrFail($id);

            $advert->delete();
            Storage::disk('adverts')->deleteDir($id);
        

            return redirect()->route('user.adverts.index')->with(
                'success', 
                'Advert deleted'
            );
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Delete image for advert.
     *
     * @param \Illuminate\Http\Request $request    HTPP Request
     * @param int                      $advertId   Advert ID         
     * @param string                   $imageField field that contains image
     * 
     * @return \Illuminate\Http\Response
     */
    public function deleteImage(Request $request)
    {
        $advert = Advert::findOrFail($request->advertId);
        
        Storage::disk('adverts')->delete($advert->{$request->imageField});
        $advert->{$request->imageField} = null;

        $advert->save();
        return response('OK', 200)->header('Content-Type', 'text/plain');
    }
}
