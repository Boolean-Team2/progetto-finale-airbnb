@extends('templates.template')

{{-- NAVBAR --}}
<div class="bg-primary">
    @include('partials.navbar')
</div>

{{-- CONTENT --}}
@section('body')

{{-- INCLUDE SCRIPT VUE --}}
@include('comps.addressCreate')

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
            <h3>Create apartment</h3>
            <p>Here you can create your apartment</p>
        </div>
        <div id="app" class="col-sm-12">
            <form action="{{ route('account.apartments.store', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method("POST")
                <div class="form-row">
                    {{-- INPUT NAME --}}
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter name" value="Test">
                    </div>
                    {{-- /INPUT NAME --}}
                    {{-- INPUT IMG --}}
                    <div class="col-sm-12 col-md-6 mb-3">
                        <label for="img">Image</label>
                        <input type="file" name="img" class="form-control">
                    </div>
                    {{-- /INPUT IMG --}}

                    {{-- INPUT ADDRESS --}}
                   <myaddress></myaddress>
                    {{-- /INPUT ADDRESS --}}
                    
                    {{-- INPUT DESCR --}}
                    <div class="col-sm-12 mb-3">
                        <label for="description">Description</label>
                        <textarea type="text" name="description" class="form-control" placeholder="Enter description">TEST DESCRIPTION</textarea>
                    </div>
                    {{-- /INPUT DESCR --}}
                    {{-- INPUT ROOMS --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="rooms">Rooms</label>
                        <input type="text" name="rooms" class="form-control" placeholder="Enter number of rooms" value="1">
                    </div>
                    {{-- /INPUT ROOMS --}}

                    {{-- INPUT BEDS --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="beds">Beds</label>
                        <input type="text" name="beds" class="form-control" placeholder="Enter number of beds" value="2">
                    </div>
                    {{-- /INPUT BEDS --}}

                    {{-- INPUT BATHS --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="baths">Baths</label>
                        <input type="text" name="baths" class="form-control" placeholder="Enter number of baths"value="1"> 
                    </div>
                    {{-- /INPUT BATHS --}}

                    {{-- INPUT MQ --}}
                    <div class="col-sm-12 col-md-3 mb-3">
                        <label for="mq">Mq</label>
                        <input type="text" name="mq" class="form-control" placeholder="Enter mq" value="75">
                    </div>
                    {{-- /INPUT MQ --}}
                    {{-- INPUT INFO --}}
                    <div class="d-flex flex-wrap">
                        @foreach($services as $service)
                            <span class="d-flex align-items-center mr-3 text-capitalize"><input class="mr-1" name="services[]" type="checkbox" value="{{ $service->id }}">{{ $service->name }}</span>
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