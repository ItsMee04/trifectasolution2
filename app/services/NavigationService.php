<?php

namespace App\Services;

use Illuminate\Support\Facades\Route;

class NavigationService
{
    /**
     * Mengecek apakah route saat ini aktif
     */
    public function isActive($routeName): string
    {
        return Route::is($routeName) ? 'active' : '';
    }
}
