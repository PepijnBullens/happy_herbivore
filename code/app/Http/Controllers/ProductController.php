<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function setLanguage($language)
    {
        session(['language' => $language]);

        return response()->json(['language' => $language]);
    }
}
