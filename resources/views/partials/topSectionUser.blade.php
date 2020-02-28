<div class="row mb-4">
    <div class="col-10 offset-0 offset-md-1 d-flex">
        @if (Auth::user()->avatar)
            <img style="width: 110px; height:110px;" class="rounded" src="{{ asset('assets/images/users/' . Auth::user()->id . '/avatar/' . Auth::user()->avatar) }}" alt="Profile picture">
            @else
            <img style="width: 110px; height:110px;" class="rounded" src="https://via.placeholder.com/150">
        @endif
        <div class="ml-4 d-flex flex-column justify-content-between">
            <div>
                @if (Auth::user()->firstname)
                    <h3 class="m-0">Welcome back {{ Auth::user()->firstname }}</h3>
                    @else
                        <h3 class="m-0">Welcome back {{ Auth::user()->email }}</h3>
                @endif
                <p class="m-0">Registration date: {{ Auth::user()->created_at }}</p>
            </div>
            <a class="btn btn-danger w-50" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
            </a>
        </div>
    </div>
</div>