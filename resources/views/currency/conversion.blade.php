@extends('layouts.app')

@section('content')
	<h1> Currency Conversion Tool </h1>
	<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-body">
                	<div class="form-group">
                		<label for="value_from" class="col-md-4 control-label">Currency Conversion From</label>
                        <div class="col-md-4">
                            <input id="value_from" type="number" step="0.01" class="form-control" name="value_from" value="{{ old('value_from') }}" required>
                        </div>
                        <div class="col-md-4">
                        	<select id="currency_from" class="form-control" name="currency_from" value="{{ old('currency_from') }}" required>
                        	@foreach( $currency_list as $currency_item)
                        		<option value={{ $currency_item->currency_code }}> 
                        			{{ $currency_item->currency }} 
                        		</option>
                        	@endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                    	<label for="value_to" class="col-md-4 control-label">Currency Conversion To</label>
                        <div class="col-md-4">
                            <input id="value_to" type="number" step="0.01" disabled class="form-control" name="value_to" value="{{ old('value_to') }}" required>
                        </div>
                        <div class="col-md-4">
                        	<select id="currency_to" class="form-control" name="currency_to" value="{{ old('currency_to') }}" required>
                        		@foreach( $currency_list as $currency_item)
                        		<option value={{ $currency_item->currency_code }}> 
                        			{{ $currency_item->currency }} 
                        		</option>
                        	@endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <a class="btn btn-primary" href={{ route('currency.admin') }} > Manage Currencies </a>
        </div>
    </div>
	
@endsection

@section('script')
	$( "#value_from" ).keyup(function () {
		setup_conversion_value()
	});

	$( "#currency_from" ).change(function () {
		setup_conversion_value()
	});

	$( "#currency_to" ).change(function () {
		setup_conversion_value()
	});

	function setup_conversion_value() {
		var data = {}
		data.currency_from = $('#currency_from').val()
		data.currency_to = $('#currency_to').val()
		data.value_from = $('#value_from').val()
		data._token = "{{ csrf_token() }}"

		if( data.value_from.length ) {
			$.ajax({
		        type: "POST",
			    url: '/api/currency-convert',
			    data: data,
			    success: function(data) {
			    	if( data.success ) {
			    		$("#value_to").val( data.data.exchanged_value );
			    	}
			    	
			    },
		    })
		} else {
			$("#value_to").val('');
		}
	}
@endsection