<?php
/**
 * SubdomainController Class Doc Comment
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
use Auth;
use Storage;
use App\Models\User;
use App\Models\Subdomain;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * SubdomainController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class SubdomainController extends Controller
{
    /**
     * Class constructor
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subdomains = Subdomain::all();
        $params = [
            'subdomains' => $subdomains,
        ];
        return view('admin.subdomains.list')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::orderBy('email')->get();

        $params = [
            'users'             => $users,
        ];

        return view('admin.subdomains.create')->with($params);
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
                'name' => 'required|string|unique:subdomains',
            ]
        );

        $subdomain = Subdomain::create(
            [
                'user_id' => $request->input('user'),
                'name' => $request->input('name'),
            ]
        );

        Storage::disk('subdomains')->copy('index.php', $subdomain->name.'/index.php');
        Storage::disk('subdomains')->copy('main_image.jpeg', $subdomain->name.'/main_image.jpeg');

        return redirect()->route('subdomains.index')->with('success', "Subdomain created");
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
            $subdomain = Subdomain::findOrFail($id);

            $params = [
                'subdomain' => $subdomain,
            ];

            return view('admin.subdomains.delete')->with($params);
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
            $subdomain = Subdomain::findOrFail($id);
            $users = User::orderBy('email')->get();
            
            $params = [
                'subdomain'         => $subdomain,
                'users'             => $users,
            ];

            return view('admin.subdomains.edit')->with($params);
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
            $subdomain = Subdomain::findOrFail($id);

            $this->validate(
                $request, 
                [
                    'name' => 'required|string|unique:subdomains,id,'.$subdomain->id,
                ]
            );

            Storage::disk('subdomains')->copy('index.php', $request->input('name').'/index.php');
            Storage::disk('subdomains')->copy('main_image.jpeg', $request->input('name').'/main_image.jpeg');
            Storage::disk('subdomains')->deleteDir($subdomain->name);

            $subdomain->name = $request->input('name');
            $subdomain->user_id = $request->input('user');
            $subdomain->save();

            return redirect()->route('subdomains.index')->with('success', 'Subdomain has been updated.');
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
            $subdomain = Subdomain::findOrFail($id);

            $subdomain->delete();
            Storage::disk('subdomains')->deleteDir($id);

            return redirect()->route('subdomains.index')->with(
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
}
