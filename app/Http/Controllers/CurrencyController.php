<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class CurrencyController extends Controller
{
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
    	$currency_model = new Currency;
    	$currency_model::create($inputs);

    	return redirect('/currency/admin');
    }
}
