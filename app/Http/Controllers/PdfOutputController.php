<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Providers\AppServiceProvider;

class PdfOutputController extends Controller
{
    public function output() {

        // 本日の日付を取得
        $now = Carbon::now('Asia/Tokyo');

        // 在庫の種類の合計値を取得
        $item_amount = Stock::sum("count");

        // 在庫金額の合計値を取得
        $total_cost = Stock::sum("summary");

        $items = Stock::join('items', 'items.id', '=', 'stocks.item_id')
        ->selectRaw('items.control_number')
        ->selectRaw('items.name')
        ->selectRaw('items.cost_price')
        ->selectRaw('SUM(count) as max_count')
        // ->where('status', 1)
        ->orderBy("control_number", "asc")
        ->groupBy("item_id")
        ->get();

        $pdf = \PDF::loadView('pdf/pdf_output', compact('now', 'item_amount', 'total_cost', 'items'));
        $pdf->setPaper('A4');
        return $pdf->stream();
    }
}
