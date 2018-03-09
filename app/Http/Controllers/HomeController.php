<?php
/**
 * HomeController Class Doc Comment
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

use App\Models\AdvertType;
use App\Models\Advert;
use App\Models\City;
use App\Models\Country;
use App\Models\Cusine;
use Illuminate\Http\Request;
use GeoIP;
use \Cviebrock\EloquentSluggable\Services\SlugService;

/**
 * HomeController Class Doc Comment
 *
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     http://allrestaurant.eu
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $geoip = geoip()->getLocation(geoip()->getClientIP());
        // $geoip = geoip()->getLocation('178.43.250.7');

        $pageSize = $request->query('pageSize');
        if (strlen($pageSize) < 1) {
            $pageSize = env('DEFAULT_PAGE_SIZE');
        }

        $country = Country::where('iso', $geoip->iso_code)
                            ->firstOrFail();

        $adverts = Advert::where('country_id', $country->id)
                            ->orWhere('country_id', -1)
                            ->orderBy('add_date', 'desc')
                            ->paginate($pageSize);

        $params = [
            'adverts' => $adverts,
        ];
        return view('home')->with($params);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id advert ID
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

            return view('adverts.show')->with($params);
        }
        catch (ModelNotFoundException $ex)
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Filters adverts based on URLs.
     *
     * @param \Illuminate\Http\Request $request HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function filterAdverts(Request $request)
    {
        if (strlen($request->advert_slug) > 0) {
            $advert = Advert::where('slug', $request->advert_slug)
                                ->firstOrFail();
            $params = [
                'advert' => $advert,
            ];
            return view('adverts.show')->with($params);
        }

        $advertType = null;
        if ($request->segment(2) != null && $request->segment(2) != 'null') {
            $advertType = AdvertType::where('slug', $request->segment(2))->firstOrFail();
        }

        $pageSize = $request->query('pageSize');
        if (strlen($pageSize) < 1) {
            $pageSize = env('DEFAULT_PAGE_SIZE');
        }

        $adverts = Advert::query();
        if ($advertType != null) {
            $adverts = $adverts->where('advert_type_id', $advertType->id);
        }
        $baseUrl = $advertType->slug.'/';


        // $geoip = geoip()->getLocation(geoip()->getClientIP());
        // $geoip = geoip()->getLocation('178.43.250.7');

        // $country = Country::where('iso', $geoip->iso_code)
        //                     ->firstOrFail();

        // $adverts = Advert::where('country_id', $country->id)
        //                     ->orWhere('country_id', -1)
        //                     ->orderBy('add_date', 'desc')
        //                     ->paginate($pageSize);
        if ($request->cusine_slug != null) {
            $cusine = Cusine::where('slug', $request->cusine_slug)->firstOrFail();
            $adverts = $adverts->where('cusine_id', $cusine->id); // all food
            $baseUrl = $baseUrl.$advertType->slug.'/'.$cusine->slug.'/';
        }
        if ($request->city_slug == null && $request->country_slug != null) {
            $country = Country::where('slug', $request->country_slug)
                            ->first();
            if ($country != null) {
                $adverts = $adverts->where('country_id', $country->id)->orWhere('country_id', -1);
                $baseUrl = $baseUrl.$country->slug.'/';
            } else {
                $advert = Advert::where('slug', $request->segment(3))
                                ->firstOrFail();
                $params = [
                    'advert' => $advert,
                ];
                return view('adverts.show')->with($params);
            }
        } else if ($request->advert_slug == null && $request->city_slug != null) {
            $city = City::where('slug', $request->city_slug)
                            ->firstOrFail();
            $adverts = $adverts->where('city_id', $city->id)->orWhere('city_id', -1);
            $baseUrl = $baseUrl.$city->slug.'/'.$city->slug.'/';
        }

        $adverts = $adverts->orderBy('add_date', 'desc')->paginate($pageSize);

        $params = [
            'adverts'   => $adverts,
            'baseUrl'   => $baseUrl,
        ];
        return view('home')->with($params);
    }

    /**
     * Rgenerates slugs
     *
     * @param \Illuminate\Http\Request $request HTTP request
     *
     * @return \Illuminate\Http\Response
     */
    public function slugRegenerate(Request $request)
    {
        // $countries = Country::all();
        // foreach ($countries as $item) {
        //     $slug = SlugService::createSlug(Country::class, 'slug', $item->translate('en')->name);
        //     $item->slug = $slug;
        //     $item->save();
        // }

        // $cities = City::all();
        // foreach ($cities as $item) {
        //     $item->save();
        // }

        // $adverts = Advert::all();
        // foreach ($adverts as $item) {
        //     $item->slug = null;
        //     $item->save();
        //     if (!isset($item->company) || strlen($item->company) == 0) {
        //         $slug = SlugService::createSlug(Advert::class, 'slug', $item->first_name . ' ' . $item->last_name);
        //         $item->slug = $slug;
        //     }
        //     $item->save();
        // }

        // $cusines = Cusine::all();
        // foreach ($cusines as $item) {
        //     $item->slug = null;
        //     $item->save();
        //     $slug = SlugService::createSlug(Cusine::class, 'slug', $item->translate('en')->name);
        //     $item->slug = $slug;
        //     $item->save();
        // }

        // $advertTypes = AdvertType::all();
        // foreach ($advertTypes as $item) {
        //     $item->slug = null;
        //     $item->save();
        //     $slug = SlugService::createSlug(AdvertType::class, 'slug', $item->translate('en')->name);
        //     $item->slug = $slug;
        //     $item->save();
        // }
    }
}
