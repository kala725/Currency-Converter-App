<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Currency;

class APIController extends Controller
{
    public function currencyConversion(Request $request) {
    	$input = $request->only( ['currency_from', 'currency_to', 'value_from'] );
    	$currency_model = new Currency;

    	$sanitized_input = filter_var_array( $input, array(
    			'currency_from' => FILTER_SANITIZE_STRING,
    			'currency_to' => FILTER_SANITIZE_STRING,
    			'value_from' => FILTER_SANITIZE_NUMBER_FLOAT
    		));

    	$exchange_rate = $currency_model->getCurrencyExchangeRate( $sanitized_input['currency_from'], $sanitized_input['currency_to']);
    	$exchanged_value = $exchange_rate * $sanitized_input['value_from'];

    	$response = ['success' => true, 'data' => ['exchanged_value' => $exchanged_value ] ];
    	return response()->json( $response, 200);
    }
}
