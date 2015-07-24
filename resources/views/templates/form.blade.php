<form class="form-horizontal" method="POST" action="{{ $action }}">
	<fieldset>
		<legend> {{ $name }} </legend>

		{!! csrf_field() !!}

		@section('content')
			@foreach($fields as $field)

				<div class="form-group">
					<label for="{{ $field['name'] }}" class="col-lg-2 control-label">
						{{ $field['text'] or $field['name'] }}
					</label>
					<div class="col-lg-10">
						@if (isset($field['type']) && $field['type'] == 'select')
							<select 
								class="form-control"
								name="{{ $field['name'] }}"
								id="{{ $field['name'] }}"
							>
								@foreach ($field['options'] as $option)
									@if (isset($field['selected']) && $field['selected'] == $option)	
										<option value="{{ $option }}" selected>
											{{ $option }}
										</option>
									@else
										<option value="{{ $option }}">
											{{ $option }}
										</option>
									@endif
								@endforeach
							</select>
						@else
							<input 
								class="form-control"
								type="{{ $field['type'] or 'text' }}" 
								name="{{ $field['name'] }}"
								id="{{ $field['name'] }}"
								placeholder="{{ $field['placeholder'] or $field['text'] }}"
								maxlength="{{ $field['max'] or 'none' }}"
								value="{{ $field['value'] or '' }}"
							>
						@endif
					</div>
				</div>

			@endforeach
		@show

		<div class="form-group">
			<div class="col-lg-10 col-lg-offset-2">
				<button type="reset" class="btn btn-default">Cancel</button>
				<button type="submit" class="btn btn-primary">Ready</button>
			</div>
		</div>

	</fieldset>
</form>