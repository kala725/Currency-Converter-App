<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model {
    public $table = "currency";

	public $primaryKey = "id";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'currency', 'currency_code', 'exchange_rate',
    ];

    public static $rules = [
    	'currency' => 'required',
    	'currency_code' => 'required',
    	'exchange_rate' => 'required'
    ];

    public function getCurrencyExchangeRate( $currency_from, $currency_to ) {

        $exchange_rate = 1;
        $currencies = $this->all();
        foreach( $currencies as $currency_item ) {
            if ( $currency_to === $currency_item->currency_code ) {
                $exchange_to_rate = $currency_item->exchange_rate;
            } else if ( $currency_from === $currency_item->currency_code ) {
                $exchange_from_rate = $currency_item->exchange_rate;
            }
        }

        if ( isset( $exchange_to_rate ) && isset( $exchange_from_rate ) ) {
            $exchange_rate = ( 1 / $exchange_from_rate ) * $exchange_to_rate;
        }
        return $exchange_rate;
    }

}
