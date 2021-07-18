<?php


namespace App\Base;


use Elao\Enum\AutoDiscoveredValuesTrait;
use Elao\Enum\Enum;

abstract class AbstractEnum extends Enum
{
    use AutoDiscoveredValuesTrait;
}