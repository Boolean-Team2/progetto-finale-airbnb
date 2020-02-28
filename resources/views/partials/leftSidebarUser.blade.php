<h3>Account menu</h3>
<ul class="list-unstyled list-group-item-action">
    <li>
        <a class="list-group-item list-group-item-action" href="{{ route('account.show', Auth::user()->id) }}">{{ __('Profile') }}</a>
    </li>
    <li>
        <a class="list-group-item list-group-item-action" href="{{ route('account.apartments.show', Auth::user()->id) }}">{{ __('Apartments') }}</a>
    </li>
    <li>
        <a class="list-group-item list-group-item-action" href="{{ route('account.statistics.show', Auth::user()->id) }}">{{ __('Statistics') }}</a>
    </li>
    <li>
        <a class="list-group-item list-group-item-action" href="{{ route('user.sponsor.payments', Auth::user()->id) }}">{{ __('Payments') }}</a>
    </li>
    <li>
        <a class="list-group-item list-group-item-action" href="{{ route('account.messages.show', Auth::user()->id) }}">{{ __('Emails') }}</a>
    </li>
    <li>
        <a class="list-group-item list-group-item-action" href="{{ route('chats') }}">{{ __('Chat messages') }}</a>
    </li>
</ul>