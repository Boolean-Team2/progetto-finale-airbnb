@extends('templates.template')

{{-- CONTENT --}}
@section('body')

    {{-- INCLUDE SCRIPT VUE --}}
    @include('comps.addressEdit')

    {{-- INCLUDE ERRORS/MESSAGES SECTION --}}
    <div class="container-fluid">
        @include('partials.showErrors')
    </div>

    <div class="container-fluid mb-5">
        @include('partials.topSectionUser')
        <div class="row">
            <div class="d-none d-md-block col-md-3 offset-md-1">
                @include('partials.leftSidebarUser')
            </div>
            <div id="app" class="col-sm-12 col-md-7">
                <h3>Edit apartment</h3>
                <form action="{{ route('account.apartment.update', $apartment->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method("PATCH")
                    <div class="form-row">
                        <div class="col-sm-12 col-md-6">
                            {{-- INPUT VISIBILITY --}}
                            <div class="mb-3">
                                <label for="visibility">Visibility</label>
                                <select name="visibility" class="form-control">
                                    @if ($apartment->visibility === 1)
                                        <option value="{{ $apartment->visibility }}">Public</option>
                                        <option value="0">Private</option>
                                        @else
                                        <option value="{{ $apartment->visibility }}">Private</option>
                                        <option value="1">Public</option>
                                    @endif
                                </select>
                            </div>
                            {{-- INPUT NAME --}}
                            <div class="mb-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" value="{{ $apartment->name }}">
                            </div>
                            {{-- INPUT IMG --}}
                            <div class="mb-3">
                                <label for="img">Change image</label><br>
                                <input type="file" name="img">
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-5 offset-md-1 mb-5">
                            @if ($apartment->img)
                                <img class="img-fluid" src="{{ asset('assets/images/users/' . $apartment->user_id . "/apartments/" . $apartment->id . "/" . $apartment->img) }}" alt="Card image cap">
                                @else
                                <img class="img-fluid" src="{{ asset('assets/images/placeholder.jpg') }}" alt="Card image cap">
                            @endif
                        </div>
                    </div>
                    <div class="form-row">
                        {{-- INPUT ADDRESS --}}
                        <myaddressedit></myaddressedit>
                        {{-- INPUT DESCR --}}
                        <div class="col-sm-12 mb-3">
                            <label for="description">Description</label>
                            <textarea type="text" name="description" class="form-control">{{ $apartment->description }}</textarea>
                        </div>
                        {{-- INPUT ROOMS --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="rooms">Rooms</label>
                            <input type="text" name="rooms" class="form-control" value="{{ $apartment->rooms }}">
                        </div>
                        {{-- INPUT BEDS --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="beds">Beds</label>
                            <input type="text" name="beds" class="form-control" value="{{ $apartment->beds }}">
                        </div>
                        {{-- INPUT BATHS --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="baths">Baths</label>
                            <input type="text" name="baths" class="form-control" value="{{ $apartment->baths }}">
                        </div>
                        {{-- INPUT MQ --}}
                        <div class="col-sm-12 col-md-3 mb-3">
                            <label for="mq">Mq</label>
                            <input type="text" name="mq" class="form-control" value="{{ $apartment->mq }}">
                        </div>
                        {{-- INPUT INFO --}}
                        <div class="col-sm-12 mb-3">
                            <h4>Select optional services</h4>
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
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

@endsection