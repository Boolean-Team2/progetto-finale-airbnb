@extends('templates.template')
    {{-- CONTENT --}}
    @section('body')
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
                <div class="col-sm-12 col-md-7 mt-2 m-md-0">
                    <h3>Your informations</h3>
                    <form action="{{ route('account.edit', Auth::user()->id) }}" method="post" enctype="multipart/form-data">
                        <input id="mjs_user" type="hidden" value="{{ Auth::user()->id }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-row mb-2">
                            <div class="col-4">
                                <label for="firstname">Firstname</label>
                                <input type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname}}">
                            </div>
                            <div class="col-4">
                                <label for="lastname">Lastname</label>
                                <input type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname}}">
                            </div>
                            <div class="col-4">
                                <label for="date_of_birth">Date of birth</label>
                                <input type="date" class="form-control" name="date_of_birth" value="{{ Auth::user()->date_of_birth}}">
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-12">
                                <label for="email">Email address</label>
                                <input type="text" class="form-control" name="email" value="{{ Auth::user()->email}}">
                            </div>
                        </div>
                        <div class="form-row mb-2">
                            <div class="col-12">
                                <label for="avatar">Avatar</label><br>
                                <input type="file" name="avatar"><br>
                                <small>* Squared image and max 1024mb only</small>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end my-3">
                            <button type="submit" class="my-2 my-md-0 btn btn-success">Edit informations <i class="fas fa-edit"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection