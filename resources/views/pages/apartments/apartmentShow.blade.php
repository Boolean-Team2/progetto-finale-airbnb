@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')   
    <div class="container">
        <section class="my-5">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <h3>{{ $apartment->name }}</h3>
                    <p>{{ $apartment->description }}</p>
                    <p><i class="mr-2 fas fa-map-marker"></i> {{ $apartment->address }}</p>              
                    <p><i class="mr-2 fas fa-ruler-combined"></i>{{ $apartment->mq }}</p>              
                    <p><i class="mr-2 fas fa-bed"></i>{{ $apartment->beds }}</p>              
                    <p><i class="mr-2 fas fa-toilet-paper"></i>{{ $apartment->baths }}</p>              
                    <p><i class="mr-2 fas fa-person-booth"></i>{{ $apartment->rooms }}</p>            
                    <p><i class="mr-2 fas fa-eye"></i>{{ $apartment->views }}</p> 
                    <hr>
                    <h4>Owner's contacts</h4>
                    <p class="mr-0"><i class="mr-2 fas fa-user"></i>{{ $apartment->user->firstname }} {{ $apartment->user->lastname }}</p>
                    <p class="m-0"><i class="mr-2 fas fa-envelope"></i><a href="mailto:{{ $apartment->user->email }}">{{ $apartment->user->email }}</a></p>
                    
                </div>
                <div class="col-sm-12 col-md-8 text-right">
                    <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-12">
                    <h4>Contact me</h4>
                    <form action="">
                        <div class="form-group">
                            @if (Auth::user())
                                <input type="email" class="form-control" placeholder="tuamail@mail.com" value="{{ Auth::user()->email }}">
                                @else
                                <input type="email" class="form-control" placeholder="tuamail@mail.com">
                            @endif
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Dear owner.."></textarea>
                        </div>
                        <div class="form-row">
                            <div class="col-sm-12 col-md-8">
                                <input class="mr-2" type="checkbox" required><span>Accept terms and conditions</span>
                            </div>
                            <div class="col-sm-12 col-md-4 text-right">
                                <button class="btn btn-primary">Send message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    {{-- FOOTER --}}
    @include('partials.footer')

@endsection