<span id="hide_message">
    @if(session()->has('message'))
    <li class="message">{{ session()->get('message') }}</li>
    @endif
</span>