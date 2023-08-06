<?php declare(strict_types=1);

namespace App\Components\PigLatinFormControl;

interface IPigLatinFormControlFactory
{

    public function create(): PigLatinFormControl;

}