@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')

	<div class="container">
		<div class="row">
			<div class="col-12">
				@if (session('status'))
					<div class="alert alert-success">
						{{ session('status') }}
					</div>
				@endif
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul class="m-0">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12 col-md-6">
				<div class="card mb-3" style="width: 20rem;">
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
			<div class="col-sm-12 col-md-6">
				<div class="content">
					<form method="post" id="payment-form" action="{{route('checkout',$apartment->id)}}">
						@csrf
						<section>
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
						<button class="btn btn-primary" type="submit"><span>Test Transaction</span></button>
					</form>
				</div>
			</div>
		</div>
	</div>

	{{-- FOOTER --}}
	@include('partials.footer')

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