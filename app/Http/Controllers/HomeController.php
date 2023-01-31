<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // 在庫の種類の合計値を取得
        $item_kinds = Item::count("id");

        // 在庫金額の合計値を取得
        $total_costs = Stock::sum("summary");

        // 在庫数が下限在庫数を下回っている商品を取得
        $lower_items = Stock::join('items', 'items.id', '=', 'stocks.item_id')
        ->selectRaw('items.control_number')
        ->selectRaw('items.name')
        ->selectRaw('items.lower_count')
        ->selectRaw('SUM(count) as max_count')
        ->orderBy("control_number", "asc")
        ->groupBy("item_id")
        ->get();

        // dd($lower_items);

        return view('home', compact('item_kinds', 'total_costs', 'lower_items'));
    }
}
