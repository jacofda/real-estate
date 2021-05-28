<?php

namespace Areaseb\Estate\Models;

use \Carbon\Carbon;
use Areaseb\Estate\Models\{Calendar, Category, Cost, Event, Expense};
//use App\Classes\Fe\Actions\UploadIn;

class Cost extends Primitive
{
    protected $dates = ['data', 'data_scadenza', 'data_ricezione'];

    public function expense()
    {
        return $this->belongsTo(Expense::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

//SETTER
    public function setDataAttribute($value)
    {
        $this->attributes['data'] = is_null($value) ? null : Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setDataScadenzaAttribute($value)
    {
        $this->attributes['data_scadenza'] = is_null($value) ? null : Carbon::createFromFormat('d/m/Y', $value);
    }

    public function setDataRicezioneAttribute($value)
    {
        $this->attributes['data_ricezione'] = is_null($value) ? null : Carbon::createFromFormat('d/m/Y', $value);
    }


//GETTER
    public function getNomeAttribute()
    {
        if($this->numero)
        {
            return $this->numero;
        }
        return $this->expense->nome . ' ' . $this->data->format('m');
    }

    public function getImponibileFormattedAttribute()
    {
        return $this->fmt($this->imponibile);
    }

    public function getTotaleFormattedAttribute()
    {
        return $this->fmt($this->totale);
    }

    public function getXmlAttribute()
    {
        if($this->media()->xml()->exists())
        {
            return asset('storage/fe/ricevute/'.$this->media()->xml()->first()->filename);
        }
        return false;
    }

    public function getRealXmlAttribute()
    {
        if($this->media()->xml()->exists())
        {
            return asset('storage/fe/ricevute/'.$this->media()->xml()->first()->filename);
        }
        return false;
    }

    public function getPdfAttribute()
    {
        if($this->media()->pdf()->exists())
        {
            return asset('storage/fe/pdf/ricevute/'.$this->media()->pdf()->first()->filename);
        }
        return false;
    }

    public function getIsMyCompanyAttribute()
    {
        if( strtolower($this->company->rag_soc) ==  strtolower(Setting::base()->rag_soc) )
        {
            return true;
        }
        return false;
    }


//SCOPES
    public function scopeAnno($query, $value)
    {
        $query = $query->whereYear('data', $value);
    }

    public function scopeMese($query, $value)
    {
        $anno = $value['year'];
        $mese = $value['month'];
        $query = $query->whereYear('data', $anno)->whereMonth('data', $mese);
    }

    public static function inScadenzaPrev($days)
    {
        return self::where('data_scadenza', '>=', Carbon::today()->subDays($days))
            ->where('saldato', false)
            ->orderBy('data_scadenza', 'DESC')
            ->get();
    }

    public static function filter($data)
    {
        $query = Cost::query();

        if($data->get('client_id'))
        {
            $query = $query->where('client_id', $data->get('client_id'));
        }

        if($data->get('category_id'))
        {
            $query = $query->whereIn('expense_id', Category::find($data->get('category_id'))->expenses()->pluck('id')->toArray());
        }

        if($data->get('anno'))
        {
            $query = $query->where('anno', $data->get('anno'));
            if($data->get('mese'))
            {
                $query = $query->whereMonth('data', '=', $data->get('mese'));
            }
        }

        if($data->get('id'))
        {
            $query = Cost::where('id', $data->get('id'));
        }

        if($data->get('sort'))
        {
            $arr = explode('|', $data->get('sort'));
            $query = Cost::orderBy($arr[0], $arr[1]);
        }
        else
        {
            $query = $query->orderBy('data', 'DESC');
        }

        return $query;
    }

    public static function storeCostInCalendar($cost)
    {

        $link = '<br><a href="'.$cost->url.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-link"></i></a>';

        Event::create([
            'user_id' => 1,
            'calendar_id' => Calendar::Scadenze(),
            'title' => 'Pagare Acquisto €'. number_format($cost->totale, 2, ',', '.'),
            'summary' => 'Pagare fattura N. ' .$cost->numero . ' ricevuta il '. $cost->data_ricezione->format('d/m/Y') . ' a conto di '.$cost->company->rag_soc.$link,
            'starts_at' => $cost->data_scadenza->format('Y-m-d') . ' 09:00:00',
            'ends_at' => $cost->data_scadenza->format('Y-m-d') . ' 10:00:00',
            'backgroundColor' => ($cost->saldato) ? '#28a745' : '#dc3545',
            'eventable_id' => $cost->id,
            'eventable_type' => get_class($cost),
            'done' => ($cost->saldato) ? 1 : 0
        ]);
        return true;
    }

    public static function updateCostInCalendar($cost)
    {
        $link = '<br><a href="'.$cost->url.'/edit" class="btn btn-primary btn-sm"><i class="fas fa-link"></i></a>';
        $event = Event::where('eventable_id', $cost->id)->where('eventable_type', get_class($cost))->first();
            $event->starts_at = $cost->data_scadenza->format('Y-m-d') . ' 09:00:00';
            $event->ends_at = $cost->data_scadenza->format('Y-m-d') . ' 10:00:00';
            $event->backgroundColor = ($cost->saldato) ? '#28a745' : '#dc3545';
            $event->done = ($cost->saldato) ? 1 : 0;
            $event->summary = 'Pagare fattura N. ' .$cost->numero . ' ricevuta il '. $cost->data_ricezione->format('d/m/Y') . ' a conto di '.$cost->company->rag_soc.$link;
        $event->save();
        return true;
    }

    public static function deleteCostFromCalendar($cost)
    {
        $event = Event::where('eventable_id', $cost->id)->where('eventable_type', get_class($cost))->first();
        $event->delete();
        return true;
    }


}
