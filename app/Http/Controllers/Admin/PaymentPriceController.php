<?php 
/**
 * PaymentPriceController Class Doc Comment
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
use App\Models\PaymentPrice;
use App\Models\PaymentType;
use App\Models\PaymentPeriod;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * PaymentPriceController Class Doc Comment
 * 
 * @category Controller
 * @package  AllRestaurant
 * @author   AllRestaurant <info@allrestaurant.eu>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License 
 * @link     http://allrestaurant.eu 
 */
class PaymentPriceController extends Controller
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
        $prices = PaymentPrice::all();
        $params = [
            'prices' => $prices,
        ];

        return view('admin.payments.prices.list')->with($params);
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


        $params = [
            'paymentTypes' => $paymentTypes, 
            'paymentPeriods' => $paymentPeriods
        ];
        return view('admin.payments.prices.create')->with($params);
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
                'price' => 'required|numeric',
                'payment_type' => 'required|uniqueTwoFields:payment_prices,payment_type_id,payment_period_id,'.$request->payment_period,
                'payment_period' => 'required|uniqueTwoFields:payment_prices,payment_period_id,payment_type_id,'.$request->payment_type,
            ]
        );

        $paymentPrice = PaymentPrice::create(
            [
                'price' => $request->input('price'),
                'payment_type_id' => $request->input('payment_type'),
                'payment_period_id' => $request->input('payment_period'),
            ]
        );

        return redirect()->route('admin.payments.prices.index')->with(
            [
                'flash_message' => 'Created',
                'flash_message_important' => false
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id PaymentPrice ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $paymentPrice = PaymentPrice::findOrFail($id);

            $params = [
                'paymentPrice' => $paymentPrice,
            ];

            return view('admin.payments.prices.delete')->with($params);
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
     * @param int $id PaymentPrice ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $paymentPrice = PaymentPrice::findOrFail($id);
            $paymentTypes = PaymentType::all();
            $paymentPeriods = PaymentPeriod::all();

            $params = [
                'paymentPrice' => $paymentPrice,
                'paymentTypes' => $paymentTypes,
                'paymentPeriods' => $paymentPeriods,
            ];

            return view('admin.payments.prices.edit')->with($params);
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
     * @param int                      $id      PaymentPrice ID 
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
                    'price' => 'required|numeric',
                    'payment_type' => 'required|uniqueTwoFields:payment_prices,payment_type_id,payment_period_id,'.$request->payment_period.',id,'.$id,
                    'payment_period' => 'required|uniqueTwoFields:payment_prices,payment_period_id,payment_type_id,'.$request->payment_type.',id,'.$id,
                ]
            );   

            $paymentPrice = PaymentPrice::findOrFail($id);
            $paymentPrice->price = $request->price;
            $paymentPrice->payment_type_id = $request->payment_type;            
            $paymentPrice->payment_period_id = $request->payment_period;

            $paymentPrice->save();

            return redirect()->route('admin.payments.prices.index')->with(
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
     * @param int $id PaymentPrice ID
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try
        {
            $paymentPrice = PaymentPrice::findOrFail($id);

            $paymentPrice->delete();

            return redirect()->route('admin.payments.prices.index')->with(
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