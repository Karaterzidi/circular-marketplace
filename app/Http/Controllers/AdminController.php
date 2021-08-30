<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $newUsers = User::where('is_activated', 'Pending')->count();
        $totalCustomers = User::where('is_activated', 'Accepted')->where('role', 'Customer')->count();
        $totalCompanies = User::where('is_activated', 'Accepted')->where('role', 'Company')->count();
        $totalCats = Category::count();
        $totalSubcats = Subcategory::count();
        $totalProducts = Product::count();

        return view('admin.index', compact('newUsers', 'totalCustomers', 'totalCompanies', 'totalCats', 'totalSubcats', 'totalProducts'));
    }
}
