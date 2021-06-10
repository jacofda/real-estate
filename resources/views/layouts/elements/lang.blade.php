<li>
    <a href="#" class="@if(app()->getLocale() == 'it') active @endif slang" data-locale="it">
        <span><img src="{{asset('theme/it.svg')}}" style="width:20px;"/> IT</span>

    </a>
    <a href="#" class="@if(app()->getLocale() == 'en') active @endif slang" data-locale="en">
        <span><img src="{{asset('theme/en.svg')}}" style="width:20px;"/> EN</span>
    </a>
</li>

<form id="lang-form" action="{{ url('switch-locale') }}" method="POST" style="display: none;">
    @csrf
    <input name="route" value="{{\Route::currentRouteName()}}">
    <input name="locale" value="" id="sl-locale">
    <input name="slug" value="@isset($property){{$property->slug_it}}@endisset">
</form>

@push('scripts')
    <script>
        let elements = document.getElementsByClassName("slang");

        let myFunction = function() {
            console.log(this);
            document.getElementById('sl-locale').value = this.getAttribute("data-locale");
            document.getElementById('lang-form').submit();
        };

        Array.from(elements).forEach(function(element) {
            element.addEventListener('click', myFunction);
        });
    </script>
@endpush
