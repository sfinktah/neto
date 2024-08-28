<?php

namespace Sfinktah\Neto;

use DateTime;

class NetoDateTime
{
    /**
     * @param string $dateTime 2023-10-30 or 'now' or 'yesterday' or '-5 weeks' etc
     * @return string
     * @throws \Exception
     * @see https://www.php.net/manual/en/class.datetime.php
     *
     */
    public static function make(string $dateTime): string {
        $date = new DateTime($dateTime);
        /** @noinspection PhpUnnecessaryLocalVariableInspection */
        $iso8601 = $date->format(DateTime::ATOM);
        return $iso8601;
    }

}