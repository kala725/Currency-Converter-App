<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;
use Spatie\Activitylog\LogsActivity;

class CurrencyController extends Controller
{
	use LogsActivity;
    /**
     * Show the conversion tools screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function conversion()
    {
    	$currency_list = Currency::all();
        return view('currency/conversion', ['currency_list' => $currency_list] );
    }

    /**
     * Show the conversion tools screen.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin()
    {
    	$currency_list = Currency::all();
        return view('currency/admin', ['currency_list' => $currency_list] );
    }

    /**
     * Adds the currency to the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
    	$inputs = $request->only( ['currency', 'currency_code', 'exchange_rate'] );

    	\Activity::log( 'Users Trying to add the currency with data : ' . json_encode( $inputs ) );
    	$currency_model = new Currency;
    	$currency_model::create($inputs);

    	return redirect('/currency/admin');
    }
}
