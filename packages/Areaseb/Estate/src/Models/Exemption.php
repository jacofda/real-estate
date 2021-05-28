<?php

namespace Areaseb\Estate\Models;


class Exemption extends Primitive
{
    public $timestamps = false;

    public static function getIdByCode($code)
    {
        return self::where('codice', $code)->first();
    }

    public static function esenzioneBollo()
    {
        return 1;
    }

}
