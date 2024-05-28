<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Calculation\Category;

class HomeController extends Controller
{
    public function index(): View
    {
        $categories = RestaurantCategory::all();
        return view('home', compact('categories'));
    }
}
