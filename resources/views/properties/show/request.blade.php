<div class="sidebar-module">
    <h4 class="border-bottom">{{__('Invia Richiesta Gratuita')}}</h4>
    <p>{{__('Puoi contattarci in qualsiasi modo sia conveniente per te. Saremo lieti di rispondere alle tue domande.')}}</p>

    {!! Form::open(['url' => '#', 'class' => 'rd-mailform text-left offset-11']) !!}

        <div class="form-group">
            <label for="contact-name2" class="form-label">{{__('Nome e Cognome')}}</label>
            <input id="contact-name2" type="text" name="name" data-constraints="@Required" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact-phone2" class="form-label">{{__('Phone')}}</label>
            <input id="contact-phone2" type="text" name="phone" data-constraints="@Required @Numeric" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact-email2" class="form-label">Email</label>
            <input id="contact-email2" type="email" name="email" data-constraints="@Required @Email" class="form-control">
        </div>
        <div class="form-group">
            <label for="contact-message2" class="form-label">{{__('Messaggio')}}</label>
            <textarea id="contact-message2" name="message" data-constraints="@Required"
            placeholder="{{__('Salve, vorrei avere maggiori informazioni riguardo all`immobile Rif.').$property->rif}}" class="form-control min-height"></textarea>
        </div>

        <div class="form-group">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="1">
              <p style="display:inline-block; margin-top:-24px;margin-left:20px;">Letta l'informativa ai sensi dell’<a href="#">art. 13 Reg. nr. UE 679/2016</a>, presto il mio specifico consenso al trattamento dei dati forniti per le specifiche finalità ivi indicate</p>
            </div>
        </div>

        <button type="submit" class="btn btn-sushi btn-sm">{{__('Invia Richiesta')}}</button>

    {!! Form::close() !!}
</div>
