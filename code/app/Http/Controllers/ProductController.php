<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function setLanguage($language)
    {
        if(!in_array($language, ['english', 'dutch', 'german'])) {
            return response()->json(['error' => 'Invalid language']);
        }

        session(['language' => $language]);

        return response()->json(['language' => $language]);
    }

    public function setOrderType($orderType)
    {
        if(!in_array($orderType, ['eatHere', 'takeAway'])) {
            return response()->json(['error' => 'Invalid order type']);
        }

        session(['orderType' => $orderType]);

        return response()->json(['orderType' => $orderType]);
    }

    public function removeOrderType()
    {
        session()->forget('orderType');

        return to_route('images.index');
    }

    public function chooseOrder() {
        if (null === session('orderType')) {
            return to_route('images.index');
        }

        return Inertia::render('ChooseOrder/ChooseOrder', [
            'language' => session('language'),
        ]);
    }
}
