<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogsActivityInterface;
use Spatie\Activitylog\LogsActivity;

class Currency extends Model implements LogsActivityInterface {
    use LogsActivity;

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

    /**
     * Get the message that needs to be logged for the given event name.
     *
     * @param string $eventName
     * @return string
     */
    public function getActivityDescriptionForEvent($eventName)
    {
        switch( $eventName ) {
            case 'created':
                $message = 'Currency "' . $this->currency . '" was created';
                break;
            case 'updated':
                $message = 'Currency "' . $this->currency . '" was updated';
                break;
            default:
                $message = '';
                break;
        }
        return $message;
    }
}
