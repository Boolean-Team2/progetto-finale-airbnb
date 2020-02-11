@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')
    <div class="container my-5 py-5">
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
            <div class="col-sm-12 col-md-9">
                <h3>Your apartments</h3>
                <p>Here you can show/edit your apartments</p>
            </div>
            <div class="col sm-12 col-md-3">
                <a href="{{ route('account.apartments.create') }}" class="btn btn-primary">Add apartments</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-2 m-md-0 d-flex flex-wrap justify-content-between">
                @foreach ($apartments as $apartment)
                    <div class="card mb-3" style="width: 20rem;">
                        <img class="img-fluid" src="https://source.unsplash.com/random/?apartment" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title text-capitalize">{{ $apartment->name }}</h5>
                            <p class="card-text text-capitalize">{{ $apartment->description }}</p>
                            <a href="#" class="btn btn-primary">Edit</a>
                        </div>
                    </div>        
                @endforeach
            </div>
        </div>
    </div>
{{-- FOOTER --}}
@include('partials.footer')
@endsection