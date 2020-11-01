<?php

namespace PWWEB\Core\Controllers;

use App\Http\Controllers\Controller;
use PWWEB\Core\Models\Country;
use PWWEB\Core\Models\Currency;
use PWWEB\Core\Models\Language;

class IndexController extends Controller
{
    /**
     * Show the localisation dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $countries = Country::all();
        $currencies = Currency::all();
        $languages = Language::all();

        return view('core::dashboard', compact('countries', 'currencies', 'languages'));
    }
}
