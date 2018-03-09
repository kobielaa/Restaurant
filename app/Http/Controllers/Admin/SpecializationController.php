<?php 
/**
 * SpecializationController Class Doc Comment
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

use App\Models\Specialization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * SpecializationController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class SpecializationController extends Controller
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
        $specializations = Specialization::all();
        
        $translations = [];
        foreach ($specializations as $specialization) {
            $translationArray = $specialization->getTranslationsArray();
            $translationArray['element_id'] = $specialization->id;
            $translations[] = $translationArray;
        }
        
        $params = [
            'translations' => $translations,
            'locales' => config('translatable.locales'),
        ];

        return view('admin.users.specializations.list')->with($params);
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
        return view('admin.users.specializations.create')->with($params);
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
        $specialization = Specialization::create($temp);

        return redirect()->route('admin.users.specializations.index')->with(
            [
                'flash_message' => 'Created',
                'flash_message_important' => false
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Specialization ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $specialization = Specialization::findOrFail($id);

            $params = [
                'specialization' => $specialization,
            ];

            return view('admin.users.specializations.delete')->with($params);
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
     * @param int $id Specialization ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $specialization = Specialization::findOrFail($id);

            $translations = $specialization->getTranslationsArray();
            $translations['element_id'] = $specialization->id;

            $params = [
                'translations' => $translations,
                'locales' => config('translatable.locales'),
            ];

            return view('admin.users.specializations.edit')->with($params);
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
     * @param int                      $id      Specialization ID 
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

            $specialization = Specialization::findOrFail($id);
            
            foreach ($locales as $locale) {
                if (strlen($request->input('name_' . $locale)) > 0) {
                    $specialization->translateOrNew($locale)->name = $request->input('name_' . $locale);
                } else if (isset($specialization->translate($locale)->name) 
                    && strlen($request->input('name_' . $locale)) == 0
                ) {
                    $specialization->deleteTranslations($locale);
                }
            }

            $specialization->save();

            return redirect()->route('admin.users.specializations.index')->with(
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
     * @param int $id Specialization ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $specialization = Specialization::findOrFail($id);

            $specialization->delete();

            return redirect()->route('admin.users.specializations.index')->with(
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