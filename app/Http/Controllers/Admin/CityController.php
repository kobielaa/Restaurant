<?php 
/**
 * CityController Class Doc Comment
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

use App\Models\City;
use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use \Cviebrock\EloquentSluggable\Services\SlugService;

/**
 * CityController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class CityController extends Controller
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
        $pageSize = $request->query('pageSize');
        if (strlen($pageSize) < 1) {
            $pageSize = env('ADMIN_PAGE_SIZE');
        }
        $cities = City::paginate($pageSize);
        $cities->appends('pageSize', $pageSize);

        $params = [
            'cities' => $cities,
        ];

        return view('admin.locations.cities.list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $params = [
            'countries' => $countries,
        ];

        return view('admin.locations.cities.create')->with($params);
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
                'name'          => 'required|unique:cities',
                'name_clean'    => 'required',
                'country'       => 'required',                
            ]
        );

        $city = City::create(
            [
                'name'          => $request->input('name'),
                'name_clean'    => $request->input('name_clean'),
                'country_id'    => $request->input('country'),
            ]
        );

        return redirect()->route('admin.locations.cities.index')->with(
            'success', 
            "The cities <strong>$city->name</strong> has successfully been created."
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id city ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $city = City::findOrFail($id);

            $params = [
                'city' => $city,
            ];

            return view('admin.locations.cities.delete')->with($params);
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
     * @param int $id city ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $city = City::findOrFail($id);
            $countries = Country::all();
            $params = [
                'city' => $city,
                'countries' => $countries,
            ];

            return view('admin.locations.cities.edit')->with($params);
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
     * @param int                      $id      city ID 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $this->validate(
                $request, 
                [
                    'name'          => 'required|unique:cities,name,'.$id,
                    'name_clean'    => 'required',
                    'country'       => 'required',
                ]
            );

            $city = City::findOrFail($id);
            $city->name         = $request->input('name');
            $city->name_clean   = $request->input('name_clean');
            $city->country_id   = $request->input('country');
            $city->slug         = null;

            $city->save();

            return redirect()->route('admin.locations.cities.index')->with(
                'success', 
                "The city <strong>$city->name</strong> has successfully been updated."
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
     * Remove the specified resource from storage.
     *
     * @param int $id city ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $city = City::findOrFail($id);

            $city->delete();

            return redirect()->route('admin.locations.cities.index')->with(
                'success', 
                "The city <strong>$city->name</strong> has successfully been deleted."
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