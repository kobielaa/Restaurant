<?php 
/**
 * UserTypeController Class Doc Comment
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

use App\Models\UserType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * UserTypeController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class UserTypeController extends Controller
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
        $types = UserType::all();
        
        $translations = [];
        foreach ($types as $type) {
            $translationArray = $type->getTranslationsArray();
            $translationArray['element_id'] = $type->id;
            $translations[] = $translationArray;
        }
        
        $params = [
            'typesTranslations' => $translations,
            'locales' => config('translatable.locales'),
        ];

        return view('admin.users.types.list')->with($params);
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
        return view('admin.users.types.create')->with($params);
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
        foreach ($locales as $locale) {
            $temp[] = [
                'name_' . $locale => 'required',
            ];
        }     
        // $this->validate(
        //     $request, 
        //     $temp
        // );

        $temp = [];
        foreach ($locales as $locale) {
            if (strlen($request->input('name_' . $locale)) > 0) {
                $temp[$locale] = ['name' => $request->input('name_' . $locale)];
            }
        }
        $country = UserType::create($temp);

        return redirect()->route('admin.users.types.index')->with(
            [
                'flash_message' => 'Created',
                'flash_message_important' => false
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id UserType ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $userType = UserType::findOrFail($id);

            $params = [
                'userType' => $userType,
            ];

            return view('admin.users.types.delete')->with($params);
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
     * @param int $id UserType ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $userType = UserType::findOrFail($id);

            $translations = $userType->getTranslationsArray();
            $translations['element_id'] = $userType->id;

            $params = [
                'translations' => $translations,
                'locales' => config('translatable.locales'),
            ];

            return view('admin.users.types.edit')->with($params);
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
     * @param int                      $id      UserType ID 
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $locales = config('translatable.locales');
            
            $temp = [];
            foreach ($locales as $locale) {
                $temp[] = [
                    'name_' . $locale => 'required',
                ];
            }     

            $userType = UserType::findOrFail($id);
            
            foreach ($locales as $locale) {
                if (strlen($request->input('name_' . $locale)) > 0) {
                    $userType->translateOrNew($locale)->name = $request->input('name_' . $locale);
                } else {
                    $userType->deleteTranslations($locale);
                }
            }

            $userType->save();

            return redirect()->route('admin.users.types.index')->with(
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
     * @param int $id UserType ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $userType = UserType::findOrFail($id);

            $userType->delete();

            return redirect()->route('admin.users.types.index')->with(
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
}