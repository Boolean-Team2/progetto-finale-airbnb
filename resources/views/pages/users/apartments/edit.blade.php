@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')

{{-- INCLUDE SCRIPT VUE --}}
@include('comps.addressEdit')

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
        <div class="col-sm-12">
            <h3>Edit apartment</h3>
            <p>Here you can edit your apartment</p>
        </div>
        <div id="app" class="col-sm-12">
            <form action="{{ route('account.apartment.update', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("PATCH")
                <div class="form-row">
                    {{-- INPUT NAME --}}
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $apartment->name }}">
                    </div>
                    {{-- /INPUT NAME --}}
                    {{-- INPUT IMG --}}
                    {{-- <div class="col-sm-12 col-md-6 mb-3">
                        <label for="img">Image</label>
                        <input type="file" name="img" class="form-control">
                    </div> --}}
                    {{-- /INPUT IMG --}}

                    {{-- INPUT ADDRESS --}}
                    {{-- <div class="col-sm-12 col-md-6 mb-3">
                        <label for="address">Address</label>
                        <input class="form-control" type="text" name="address" value="{{ $apartment->address }}">
                    </div> --}}
                    <myaddressedit 
                        {{-- :latitude = "{{ $apartment->latitude }}"
                        :longitude = "{{ $apartment->longitude }}" --}}
                    ></myaddressedit>
                    {{-- /INPUT ADDRESS --}}
                    
                    {{-- INPUT DESCR --}}
                    <div class="col-sm-12 mb-3">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" class="form-control">{{ $apartment->description }}</textarea>
                    </div>
                    {{-- /INPUT DESCR --}}
                    {{-- INPUT ROOMS --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="rooms">Rooms</label>
                        <input type="text" name="rooms" class="form-control" value="{{ $apartment->rooms }}">
                    </div>
                    {{-- /INPUT ROOMS --}}

                    {{-- INPUT BEDS --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="beds">Beds</label>
                        <input type="text" name="beds" class="form-control" value="{{ $apartment->beds }}">
                    </div>
                    {{-- /INPUT BEDS --}}

                    {{-- INPUT BATHS --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="baths">Baths</label>
                        <input type="text" name="baths" class="form-control" value="{{ $apartment->baths }}">
                    </div>
                    {{-- /INPUT BATHS --}}

                    {{-- INPUT MQ --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="mq">Mq</label>
                        <input type="text" name="mq" class="form-control" value="{{ $apartment->mq }}">
                    </div>
                    {{-- /INPUT MQ --}}
                    {{-- INPUT INFO --}}
                    <div class="d-flex flex-wrap">
                        @foreach($services as $service)
                            <span class="d-flex align-items-center mr-3 text-capitalize">
                                    <input
                                        @if ($apartment->services()->find($service->id))
                                            checked
                                        @endif
                                    class="mr-1" type="checkbox" name="services[]" value="{{ $service->id }}" >{{ $service->name }}
                            </span>
                        @endforeach
                    </div>
                    {{-- INPUT INFO --}}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
    </div>
{{-- FOOTER --}}
@include('partials.footer')
@endsection