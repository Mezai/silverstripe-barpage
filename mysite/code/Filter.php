<?php


class FilterProducts implements FilterInterface
{
    public function filter($value)
    {
        if ($value == 'DateOldest') {
            return Product::get()->sort('Date', 'DESC');
        }

        if ($value == 'DateNewest') {
            return Product::get()->sort('Date', 'ASC');
        }

        if ($value == 'PriceLowest') {
            return Product::get()->sort('Price', 'ASC');
        }

        if ($value == 'PriceHighest') {
            return Product::get()->sort('Price', 'DESC');
        }
    }
}
