@extends('templates.template')

{{-- CONTENT --}}
@section('body')

	{{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>

	<div class="container-fluid mb-5">
		<div class="row">
			<div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
			<div class="col-sm-12 col-md-3 mt-2 m-md-0">
				<h3>Sponsorship payment</h3>
				<div class="card mb-3">
					@if ($apartment->img)
						<img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
						@else
						<img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
					@endif
					<div class="card-body">
						<h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
						<p class="card-text text-capitalize">{{ $apartment->description }}</p>
						<p class="card-text text-capitalize">{{ $apartment->address }}</p>
						<p class="card-text text-capitalize">
							@if ($apartment->visibility === 1)
								<span class="text-success">Public</span>
								@else
								<span class="text-danger">Private</span>
							@endif
						</p>
					</div>
				</div>        
			</div>
			<div class="col-sm-12 col-md-3 offset-md-1 py-2">
				<div class="content">
					<form method="post" id="payment-form" action="{{ route('checkout', [Auth::user()->id, $apartment->id]) }}">
						@csrf
						<section class="mt-4">
							<label for="amount">Select the ad</label> 
							<select name="amount" class="form-control">
								@foreach ($ads as $ad)
								<option value="{{ $ad -> price }}">{{$ad -> name}} - {{$ad -> price}}€</option>
								@endforeach
							</select>
							<div class="bt-drop-in-wrapper">
								<div id="bt-dropin"></div>
							</div>
						</section>
						<input id="nonce" name="payment_method_nonce" type="hidden" />
						<button class="btn btn-primary" type="submit"><span>Pay</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- BRAINTREE SCRIPT --}}
	<script src="https://js.braintreegateway.com/web/dropin/1.13.0/js/dropin.min.js"></script>
	<script>
		var form = document.querySelector('#payment-form');
		var client_token = "{{ $token }}";

		braintree.dropin.create({
			authorization: client_token,
			selector: '#bt-dropin'
		}, function (createErr, instance) {
			if (createErr) {
			console.log('Create Error', createErr);
			return;
			}
			form.addEventListener('submit', function (event) {
			event.preventDefault();

			instance.requestPaymentMethod(function (err, payload) {
				if (err) {
				console.log('Request Payment Method Error', err);
				return;
				}

				// Add the nonce to the form and submit
				document.querySelector('#nonce').value = payload.nonce;
				form.submit();
			});
			});
		});
	</script>

@endsection