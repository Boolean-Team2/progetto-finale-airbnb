@extends('templates.template')

{{-- CONTENT --}}
@section('body')

    {{-- INCLUDE SCRIPT VUE --}}
    @include('comps.addressCreate')

    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>

    <div class="container-fluid mb-5">
        <div class="row mb-3">
            <div class="col-sm-12 col-md-3 offset-md-1">
                @if (Auth::user()->firstname)
                    <h3>Welcome back {{ Auth::user()->firstname }}</h3>
                    @else
                        <h3>Welcome back {{ Auth::user()->email }}</h3>
                @endif
                <p>Here you can edit your informations</p>
            </div>
        </div>
        <div class="row">
            <div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
            <div id="app" class="col-sm-12 col-md-7">
                <h3>Create apartment</h3>
                <p>Here you can create your apartment</p>
                <form action="{{ route('account.apartments.store', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="form-row">
                        {{-- INPUT VISIBILITY --}}
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="visibility">Visibility</label>
                            <select name="visibility" class="form-control">
                                <option value="1">Public</option>
                                <option value="0">Private</option>
                            </select>
                        </div>
                        {{-- INPUT NAME --}}
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="name">Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter name" value="Test">
                        </div>
                        {{-- INPUT IMG --}}
                        <div class="col-sm-12 col-md-4 mb-3">
                            <label for="img">Image</label><br>
                            <input type="file" name="img" class="mt-1">
                        </div>
                        {{-- INPUT ADDRESS --}}
                    <myaddress></myaddress>
                        {{-- INPUT DESCR --}}
                        <div class="col-sm-12 mb-3">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control" placeholder="Enter description">TEST DESCRIPTION</textarea>
                        </div>
                        {{-- INPUT ROOMS --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="rooms">Rooms</label>
                            <input type="text" name="rooms" class="form-control" placeholder="Enter number of rooms" value="1">
                        </div>
                        {{-- INPUT BEDS --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="beds">Beds</label>
                            <input type="text" name="beds" class="form-control" placeholder="Enter number of beds" value="2">
                        </div>
                        {{-- INPUT BATHS --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="baths">Baths</label>
                            <input type="text" name="baths" class="form-control" placeholder="Enter number of baths"value="1"> 
                        </div>
                        {{-- INPUT MQ --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="mq">Mq</label>
                            <input type="text" name="mq" class="form-control" placeholder="Enter mq" value="75">
                        </div>
                        {{-- INPUT INFO --}}
                        <div class="col-sm-12 mb-3">
                            <h4>Select optional services</h4>
                            <div class="d-flex flex-wrap">
                                @foreach($services as $service)
                                <span class="d-flex align-items-center mr-3 text-capitalize"><input class="mr-1" name="services[]" type="checkbox" value="{{ $service->id }}">{{ $service->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Create apartment</button>
                </form>
            </div>
        </div>
    </div>
@endsection