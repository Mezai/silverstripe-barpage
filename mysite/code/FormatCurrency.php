<?php

class FormatCurrency extends Currency
{

    protected static $currency_symbol_sek = 'SEK';
    
    public function formatSEK()
    {
        $val = number_format(abs($this->value), 2) . " " . self::$currency_symbol_sek;

        return ($this->value < 0) ? "($val)" : $val;
    }
}
