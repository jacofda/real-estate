<table>
    <thead>
        <tr>
            <th>RAGIONAE SOCIALE</th>
            <th>INDIRIZZO</th>
            <th>CAP</th>
            <th>COMUNE</th>
            <th>PROVINCIA</th>
            <th>NAZIONE</th>
            <th>LINGUA</th>
            <th>PRIVATO</th>
            <th>PEC</th>
            <th>PIVA</th>
            <th>CF</th>
            <th>SDI</th>
            <th>FORNITORE</th>
            <th>PARTNER</th>
            <th>TELEFONO</th>
            <th>EMAIL</th>
            <th>EMAIL_ORDINI</th>
            <th>EMAIL_FATTURAZIONE</th>
            <th>ESENZIONE</th>
            <th>CATEGORIA</th>
            <th>TIPO</th>
            <th>SCONTO TOTALE</th>
            <th>SCONTO 1</th>
            <th>SCONTO 2</th>
            <th>SCONTO 3</th>
        </tr>
    </thead>
    <tbody>
    @foreach($clients as $company)

        <tr>
            <td>{{$client->rag_soc}}</td>
            <td>{{$client->address}}</td>
            <td>{{$client->zip}}</td>
            <td>{{$client->city}}</td>
            <td>{{$client->province}}</td>
            <td>{{$client->nation}}</td>
            <td>{{$client->lang}}</td>
            <td>
                @if($client->private)
                    Sì
                @else
                    No
                @endif
            </td>
            <td>{{$client->pec}}</td>
            <td>{{$client->piva}}</td>
            <td>{{$client->cf}}</td>
            <td>{{$client->sdi}}</td>
            <td>
                @if($client->supplier)
                    Sì
                @else
                    No
                @endif
            </td>
            <td>
                @if($client->partner)
                    Sì
                @else
                    No
                @endif
            </td>
            <td>{{$client->phone}}</td>
            <td>{{$client->email}}</td>
            <td>{{$client->email_ordini}}</td>
            <td>{{$client->email_fatture}}</td>
            <td>
                @if($client->exemption_id)
                    {{$client->exemption->nome}}
                @endif
            </td>
            <td>
                @if($client->sector_id)
                    {{$client->sector->nome}}
                @endif
            </td>
            <td>
                @foreach($client->clients as $type)
                    @if($loop->last)
                        {{$type->nome}}
                    @else
                        {{$type->nome}} |
                    @endif
                @endforeach
            </td>
            <td>{{$client->sconto}}</td>
            <td>{{$client->s1}}</td>
            <td>{{$client->s2}}</td>
            <td>{{$client->s3}}</td>
        </tr>

    @endforeach
    </tbody>
</table>
