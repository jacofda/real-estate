@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
<img src="{{asset('theme/images/Logo-Cortinese-200x64.png')}}" alt="{{config('app.name')}}">
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
<!-- Write your comments here -->


<tr>
    <td style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box;">
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
            <tr>
                <td class="content-cell" align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; padding: 20px 35px 10px;">
                    <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; line-height: 1.5em; margin: 0; color: #aeaeae; font-size: 12px; text-align: left;">
                        <b>Sede Cortina</b><br>
                        Piazza S. Francesco 15 - 32043 Cortina d'Ampezzo (BL)<br>
                        Telefono: <a target="_BLANK" href="call:00390436863886">+39 0436 863886</a><br>
                        Email: <a target="_BLANK" href="mailto:agenzia@cortinese.it">agenzia@cortinese.it</a>
                    </p>
                </td>
                <td class="content-cell" align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; padding: 20px 35px 10px;">
                    <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; line-height: 1.5em; margin: 0; color: #aeaeae; font-size: 12px; text-align: left;">
                        <b>Sede San Vito</b><br>
                        Corso Italia 8 - 32046 San Vito di Cadore (BL)<br>
                        Telefono: <a target="_BLANK" href="call:0039043699020">+39 0436 99020</a><br>
                        Email: <a target="_BLANK" href="mailto:agsanvito@cortinese.it">agsanvito@cortinese.it</a>
                    </p>
                </td>
            </tr>
        </table>
        <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; margin: 0 auto; padding: 0; text-align: center; width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px;">
            <tr>
                <td class="content-cell" align="center" style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; padding: 20px 35px 0;">
                    <p style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; box-sizing: border-box; line-height: 1.5em; margin: 0; color: #aeaeae; font-size: 12px; text-align: center;">
                        <a target="_BLANK" href="{{config('app.url')}}">{{str_replace("http://", '',config('app.url'))}}</a>
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. {{__('Tutti i diritti riservati.')}}
@endcomponent
@endslot
@endcomponent
