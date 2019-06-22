<?php


namespace App\Modules\HeroModule\Domain;


use App\Modules\SharedKernel\Enum;

class HeroClass extends Enum
{
    const Paladin = 1;
    const Ranger = 2;
    const Barbarian = 3;
    const Wizard = 4;
    const Cleric = 5;
    const Warrior = 6;
    const Thief = 7;
}
