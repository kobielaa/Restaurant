<?php 
/**
 * PaymentCodeController Class Doc Comment
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
use App\Models\Country;
use App\Models\PaymentCode;
use App\Models\PaymentType;
use App\Models\PaymentPeriod;
use App\Models\PaymentPrice;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * PaymentCodeController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class PaymentCodeController extends Controller
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
        $paymentCodes = PaymentCode::filter($request->all())
                                        ->orderBy('created_at', 'desc')
                                        ->get();
        $agents = User::where('user_type_id', 2)->get();
        $users = User::all();
        $paymentTypes = PaymentType::join(
            'payment_type_translations as t', 
            function ($join) {
                $join->on('payment_types.id', '=', 't.payment_type_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
            ->groupBy('payment_types.id')
            ->orderBy('t.name', 'asc')
            ->select('payment_types.*')
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
            'paymentCodes'      => $paymentCodes,
            'agents'            => $agents,
            'users'             => $users,
            'paymentTypes'      => $paymentTypes,
            'paymentPeriods'    => $paymentPeriods,
        ];

        return view('admin.payments.codes.list')->with($params);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id PaymentPeriod ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $paymentCode = PaymentCode::findOrFail($id);

            $params = [
                'paymentCode' => $paymentCode,
            ];

            return view('admin.payments.codes.delete')->with($params);
        }
        catch (ModelNotFoundException $ex) 
        {
            if ($ex instanceof ModelNotFoundException) {
                return response()->view('errors.'.'404');
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentTypes = PaymentType::join(
            'payment_type_translations as t', 
            function ($join) {
                $join->on('payment_types.id', '=', 't.payment_type_id')
                    ->where('t.locale', '=', Lang::getLocale());
            }
        ) 
        ->groupBy('payment_types.id')
        ->orderBy('t.name', 'asc')
        ->select('payment_types.*')
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

        $paymentPrices = PaymentPrice::all();

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

        $params = [
            'paymentTypes'      => $paymentTypes, 
            'paymentPeriods'    => $paymentPeriods, 
            'paymentPrices'    => $paymentPrices, 
            'countries'         => $countries,
        ];
        return view('admin.payments.codes.create')->with($params);
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
        if ($request->input('multicode') == 1) {
            $this->validate(
                $request, 
                [
                    'code'              => 'required|unique:payment_codes',
                    'multicode'         => 'required',
                    'country'           => 'required',
                    'from_date'         => 'required|date|before:to_date|date_format:d.m.Y',
                    'to_date'           => 'required|date|after:from_date|date_format:d.m.Y',
                    'payment_type'      => 'required',
                    'payment_period'    => 'required',
                ]
            );
            $paymentCode = PaymentCode::create(
                [
                    'code'              => $request->input('code'),
                    'multicode'         => $request->input('multicode'),
                    'country_id'        => $request->input('country'),
                    'from_date'         => Carbon::createFromFormat('d.m.Y', $request->input('from_date'))->format('Y-m-d'),
                    'to_date'           => Carbon::createFromFormat('d.m.Y', $request->input('to_date'))->format('Y-m-d'),
                    'payment_type_id'   => $request->input('payment_type'),
                    'payment_period_id' => $request->input('payment_period'),
                ]
            );
        } else if ($request->input('multicode') == 0) {
            $paymentPrices = PaymentPrice::all();
            foreach ($paymentPrices as $row) {
                if ($request->input('payment_code_'.$row->id) !== null) {
                    $this->validate(
                        $request, 
                        [
                            'payment_code_'.$row->id => 'required|numeric|min:0'   
                        ]
                    );
                    for ($i = 0; $i < $request->input('payment_code_'.$row->id); $i++) {
                        $code = '';
                        $count = 0;
                        do {                    
                            $code = strtoupper(str_random(16));
                            $paymentCodes = PaymentCode::where('code', $code);
                            $count = $paymentCodes->count();
                        } while ($count > 0); 
                        $paymentCode = PaymentCode::create(
                            [
                                'code'              => $code,
                                'multicode'         => 0,
                                'country_id'        => 0,
                                'payment_type_id'   => $row->type->id,
                                'payment_period_id' => $row->period->id,
                            ]
                        );
                    }
                }
            }
        }

        return redirect()->route('admin.payments.codes.index')->with(
            [
                'flash_message' => 'Created',
                'flash_message_important' => false
            ]
        );
    }

    /**
     * Destroy the specified resource.
     *
     * @param int $id PaymentCode ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $paymentCode = PaymentCode::findOrFail($id);

            $paymentCode->delete();

            return redirect()->route('admin.payments.codes.index')->with(
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