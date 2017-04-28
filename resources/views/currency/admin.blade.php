@extends('layouts.app')

@section('content')
	<h1> Currency List Management </h1>

	<div class="container">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	            <div class="panel panel-default">
	                <div class="panel-body">
	                    <form class="form-horizontal" role="form" method="POST" action="{{ route('currency.add') }}">
	                        {{ csrf_field() }}

	                        <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
	                            <label for="currency" class="col-md-4 control-label">Currency</label>

	                            <div class="col-md-6">
	                                <input id="currency" type="text" class="form-control" name="currency" value="{{ old('currency') }}" required autofocus>

	                                @if ($errors->has('currency'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('currency') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('currency_code') ? ' has-error' : '' }}">
	                            <label for="currency_code" class="col-md-4 control-label">Currency Code</label>

	                            <div class="col-md-6">
	                                <input id="currency_code" type="text" class="form-control" name="currency_code" value="{{ old('currency_code') }}" required>

	                                @if ($errors->has('currency_code'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('currency_code') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group{{ $errors->has('exchange_rate') ? ' has-error' : '' }}">
	                            <label for="exchange_rate" class="col-md-4 control-label">Rate (To USD)</label>

	                            <div class="col-md-6">
	                                <input id="exchange_rate" type="number" step="0.01" class="form-control" name="exchange_rate" required>

	                                @if ($errors->has('exchange_rate'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('exchange_rate') }}</strong>
	                                    </span>
	                                @endif
	                            </div>
	                        </div>

	                        <div class="form-group">
	                            <div class="col-md-2 col-md-offset-4">
	                                <button type="submit" class="btn btn-primary">
	                                    Add
	                                </button>
	                            </div>
	                            <div class="col-md-4">
	                                <button type="reset" class="btn btn-primary">
	                                    Reset
	                                </button>
	                            </div>
	                        </div>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	    	<table class="table panel">
				<thead>
					<tr>
						<th>Currency</th>
						<th>Currency Code</th>
						<th>Exchange Rate</th>
			    	</tr>
			 	</thead>
			 	<tbody>
			    	@foreach( $currency_list as $currency_item )
			    	<tr>
				    	<td> {{ $currency_item->currency }} </td>
				    	<td> {{ $currency_item->currency_code }} </td>
				    	<td> {{ $currency_item->exchange_rate }} </td>
				    </tr>
			    	@endforeach
			    </tbody>
			</table>
		</div>
	</div>
@endsection