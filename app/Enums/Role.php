<?php

namespace App\Enums;

enum Role : int
{
    case Admin = 1;
    case Student = 2;
    case Teacher = 3;
}
