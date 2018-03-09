<?php 
/**
 * CountryController Class Doc Comment
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
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Cviebrock\EloquentSluggable\Services\SlugService;


/**
 * CountryController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class CountryController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('permission:create', ['only' => ['create', 'store']]);    
        $this->middleware('permission:edit', ['only' => ['edit', 'update']]);   
        $this->middleware('permission:delete', ['only' => ['show', 'delete']]);
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
        // $pageSize = $request->query('pageSize');
        // if (strlen($pageSize) < 1) {
        //     $pageSize = env('DEFAULT_PAGE_SIZE');
        // }
        // $countries = Country::paginate($pageSize);
        // $countries->appends('pageSize', $pageSize);
        $countries = Country::all();
        
        $translations = [];
        foreach ($countries as $country) {
            $translationArray = $country->getTranslationsArray();
            $translationArray['element_id'] = $country->id;
            $translationArray['iso'] = $country->iso;
            $translationArray['iso3'] = $country->iso3;
            $translations[] = $translationArray;
        }
        
        $params = [
            'translations' => $translations,
            'locales' => config('translatable.locales'),
        ];

        return view('admin.locations.countries.list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $params = [
            'locales' => config('translatable.locales'),
        ];
        return view('admin.locations.countries.create')->with($params);
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
        $locales = config('translatable.locales');
        $temp = [];
        $this->validate(
            $request, 
            [
                'iso'       => 'required|unique:countries',
                'iso3'      => 'required|unique:countries',
                'continent' => 'required',
            ]
        );
        $temp = [];
        $slug = SlugService::createSlug(Country::class, 'slug', $request->input('name_en'));
        $temp['iso']        = $request->input('iso');
        $temp['iso3']       = $request->input('iso3');
        $temp['continent']  = $request->input('continent');
        if (strlen($slug) > 0) {        
            $temp['slug']   = $slug;
        }
        foreach ($locales as $locale) {
            $name = $request->input('name_' . $locale);
            if (strlen($name) > 0) {
                $temp[$locale] = [
                    'name'  => $name
                ];
            }
        }
        $country = Country::create($temp);

        return redirect()->route('admin.locations.countries.index')->with(
            [
                'flash_message' => 'Created',
                'flash_message_important' => false
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id country ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $country = Country::findOrFail($id);

            $params = [
                'country' => $country,
            ];

            return view('admin.locations.countries.delete')->with($params);
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
     * @param int $id country ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $country = Country::findOrFail($id);

            $translations = $country->getTranslationsArray();
            $translations['iso']        = $country->iso;
            $translations['iso3']       = $country->iso3;
            $translations['continent']  = $country->continent;
            $translations['element_id'] = $country->id;

            $params = [
                'translations' => $translations,
                'locales' => config('translatable.locales'),
            ];

            return view('admin.locations.countries.edit')->with($params);
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
     * @param \Illuminate\Http\Request $request HTPP Request
     * @param int                      $id      country ID 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $locales = config('translatable.locales');
                
            $this->validate(
                $request, 
                [
                    'iso' => 'required|unique:countries,iso,'.$id,
                    'iso3' => 'required|unique:countries,iso3,'.$id,
                    'continent' => 'required',
                ]
            );

            $country = Country::findOrFail($id);

            $country->iso       = $request->input('iso');
            $country->iso3      = $request->input('iso3');
            $country->continent = $request->input('continent');
            $slug = SlugService::createSlug(Country::class, 'slug', $request->input('name_en'));
            if (strlen($slug) > 0) {
                $country->slug = $slug;
            }

            foreach ($locales as $locale) {
                $name = $request->input('name_' . $locale);
                if (strlen($name) > 0) {
                    $country->translateOrNew($locale)->name = $name;
                } else if (isset($country->translate($locale)->name) 
                    && strlen($name) == 0
                ) {
                    $country->deleteTranslations($locale);
                }
            }

            $country->save();

            return redirect()->route('admin.locations.countries.index')->with(
                [
                    'flash_message' => 'Updated',
                    'flash_message_important' => false
                ]
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
     * Destroy the specified resource.
     *
     * @param int $id country ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $country = Country::findOrFail($id);

            $country->delete();

            return redirect()->route('admin.locations.countries.index')->with(
                [
                    'flash_message' => 'Deleted',
                    'flash_message_important' => false
                ]
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
     * Returns cities for this country.
     *
     * @param \Illuminate\Http\Request $request HTPP Request
     * 
     * @return \Illuminate\Http\Response
     */
    public function cities(Request $request)
    {
        $emptyCity = [
            'id'            => -1, 
            'name'          => trans('general.form.select'),
            'name_clean'    => trans('general.form.select'),
            'country_id'    => -1,
        ];
        $cities = City::where('country_id', $request->country_id)
                        ->orderBy('name', 'asc')
                        ->get();
        $cities->prepend($emptyCity);
        return response($cities);
    }
}