
<div class="row">
  <div class="col-12 mt-2 m-md-0 d-flex flex-wrap justify-content-between">
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
</div>

{{-- Aggiunto --}}
@if (session('success_message'))
<div class="alert alert-success">
    {{ session('success_message') }}
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="content">
  <form method="post" id="payment-form" action="#">
          @csrf
          <section>
              <label for="amount">
                  {{-- <span class="input-label">Amount</span>
                  <div class="input-wrapper amount-wrapper">
                      <input id="amount" name="amount" type="tel" min="1" placeholder="{{$price}}" value="{{$price}}">
                  </div> --}}
                  <select name="amount" class="form-control">
                    @foreach ($ads as $ad)
                      <option value="{{ $ad -> price }}">{{$ad -> name}} - {{$ad -> price}}€</option>
                    @endforeach
                  </select>
              </label> 

              <div class="bt-drop-in-wrapper">
                  <div id="bt-dropin"></div>
              </div>
          </section>

          <input id="nonce" name="payment_method_nonce" type="hidden" />
          <button class="button" type="submit"><span>Test Transaction</span></button>
      </form>
  </div>
