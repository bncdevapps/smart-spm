<?php

namespace App;

enum otorisasi: string
{
    case BENDAHARA = 'bendahara';
    case PPK = 'ppk';
    case VERIFIKATOR = 'verifikator';
    case ADMIN = 'admin';
}
