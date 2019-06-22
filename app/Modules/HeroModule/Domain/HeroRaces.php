<?php


namespace App\Modules\HeroModule\Domain;


use App\Modules\SharedKernel\Enum;

class HeroRaces extends Enum
{
    const Human = 1;
    const Elf = 2;
    const Halfling = 3;
    const Dwarf = 4;
    const HalfOrc = 5;
    const HalfElf = 6;
    const Dragonborn = 7;
}
