<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Testimoni;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $totalStock = Product::sum('stock');
        $totalRevenue = Product::sum(DB::raw('price * stock'));
        $userCount = User::count();

        $featuredProducts = Product::where('is_featured', true)->get();
        $testimonis = Testimoni::with('user')->latest()->take(3)->get();

        // ✅ arahkan ke view admin, bukan user
        return view('backend.dashboard.index', [
            'products' => $featuredProducts,
            'productCount' => $productCount,
            'totalStock' => $totalStock,
            'totalRevenue' => $totalRevenue,
            'userCount' => $userCount,
            'testimonis' => $testimonis,
        ]);
    }
}
