<h3>Link utili</h3>
<ul class="list-unstyled list-group">
    <li>
        <a class="list-group-item text-primary" href="{{ route('account.show', Auth::user()->id) }}">{{ __('Profile') }}</a>
    </li>
    <li>
        <a class="list-group-item text-primary" href="{{ route('account.apartments.show', Auth::user()->id) }}">{{ __('Apartments') }}</a>
    </li>
    <li>
        <a class="list-group-item text-primary" href="{{ route('account.statistics.show', Auth::user()->id) }}">{{ __('Statistics') }}</a>
    </li>
    <li>
        <a class="list-group-item text-primary" href="{{ route('user.sponsor.payments', Auth::user()->id) }}">{{ __('Payments') }}</a>
    </li>
    <li>
        <a class="list-group-item text-primary" href="{{ route('account.messages.show', Auth::user()->id) }}">{{ __('Messages') }}</a>
    </li>
</ul>