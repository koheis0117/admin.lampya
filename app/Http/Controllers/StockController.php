<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvider;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    /**
     * 在庫登録画面を表示する
     * @param int $id
     * @return view
     */
    public function index(){
        $stocks = Stock::all();
        $items = Item::all();

        // dd($stocks);

        return view('stock.create', compact('stocks', 'items'));
    }

    /**
     * 在庫一覧画面を表示する
     * @param int $id
     * @return view
     */
    public function show(){
        // $stocks = Stock::all();
        // $items = Item::all();

        // $syukko_sum = Stock::selectRaw('SUM(count) as max_count')->where('status', 1)->get();

        // dd($syukko_sum);

        $data = [];

        {
            // 合計
            $in_items = Stock::join('items', 'items.id', '=', 'stocks.item_id')
            ->selectRaw('items.control_number')
            ->selectRaw('items.name')
            ->selectRaw('SUM(count) as max_count')
            ->selectRaw('items.cost_price')
            // ->where('status', 1)
            ->orderBy("control_number", "desc")
            ->groupBy("item_id")
            ->get();

            $data['in_items'] = $in_items;
        }

        // dd($data);

        return view('stock.list', $data);
    }


    /**
     * 在庫を登録する
     * 
     * @return view
     */
    public function store(StockRequest $request){
        //在庫のデータを受け取る
        $inputs = $request->all();
        $item_id = $inputs['item_id'];
        $item_status = $inputs['status'];
        $item_count = $inputs['count'];

        // 選択した商品の仕入原価を取得
        $cost_price = Item::find($item_id)->cost_price;

        // 選択した商品の数に仕入原価をかける
        $item_cost = $item_count * $cost_price;

        // dd($item_cost);

        // ステータスが１（入庫）なら、countをそのまま登録
        if($item_count > 0 && $item_status == 1){
            \DB::beginTransaction();
            try {
                //在庫登録
                $stock = Stock::create([
                    'item_id' => $item_id,
                    'status' => $item_status, 
                    'count' => $item_count,
                    'summary' => $item_cost
                ]);
                \DB::commit();
            } catch(\Throwable $e){
                \DB::rollback();
                abort(500);
            }
        // ステータスが2（出庫）なら、countを負の数にして登録
        }elseif($item_count > 0 && $item_status == 2){
            $item_mcount = '-'.$item_count;
            $item_msummary = '-'.$item_cost;
            \DB::beginTransaction();
            try {
                //在庫登録
                $stock = Stock::create([
                    'item_id' => $item_id,
                    'status' => $item_status, 
                    'count' => $item_mcount,
                    'summary' => $item_msummary
                ]);
                \DB::commit();
            } catch(\Throwable $e){
                \DB::rollback();
                abort(500);
            }
        }else{
            \Session::flash('err_msg', '入力に誤りがあります');
            return redirect(route('stock_create'));
        }
    
        \Session::flash('err_msg', '在庫を登録しました');
        return redirect(route('stock_create'));
    }


    /**
     * 在庫編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function edit($id)
    {
        $stock = Stock::find($id);
        $items = Item::all();

        // dd($stock);

        if (is_null($stock)){
            \Session::flash('err_masg', 'データがありません。');
            return redirect(route('stock_create'));
        }

        return view('stock.edit', compact('stock', 'items'));
    }


    /**
     * 在庫を更新する
     * 
     * @return view
     */
    public function update(StockRequest $request){
        //在庫のデータを受け取る
        $inputs = $request->all();
        $item_id = $inputs['item_id'];
        $item_status = $inputs['status'];
        $item_count = $inputs['count'];

        // 選択した商品の仕入原価を取得
        $cost_price = Item::find($item_id)->cost_price;

        // 選択した商品の数に仕入原価をかける
        $item_cost = $item_count * $cost_price;

        // dd($inputs);

        // ステータスが１（入庫）なら、countをそのまま登録
        if($item_count > 0 && $item_status == 1){
            \DB::beginTransaction();
            try {
                //在庫更新
                $stock = Stock::find($inputs['id']);
                $stock->fill([
                    'item_id' => $item_id,
                    'status' => $item_status, 
                    'count' => $item_count,
                    'summary' => $item_cost
                ]);
                $stock->save();
                \DB::commit();
            } catch(\Throwable $e){
                \DB::rollback();
                abort(500);
            }
        // ステータスが2（出庫）なら、countを負の数にして登録
        }elseif($item_count > 0 && $item_status == 2){
            $item_mcount = '-'.$item_count;
            $item_msummary = '-'.$item_cost;
            \DB::beginTransaction();
            try {
                //在庫更新
                $stock = Stock::find($inputs['id']);
                $stock->fill([
                    'item_id' => $item_id,
                    'status' => $item_status, 
                    'count' => $item_mcount,
                    'summary' => $item_msummary
                ]);
                $stock->save();
                \DB::commit();
            } catch(\Throwable $e){
                \DB::rollback();
                abort(500);
            }
        }else{
            \Session::flash('err_msg', '入力に誤りがあります');
            return redirect(route('stock_create'));
        }
    
        \Session::flash('err_msg', '在庫数を変更しました');
        return redirect(route('stock_create'));
    }


    /**
     * 在庫削除
     * @param int $id
     * @return view
     */
    public function delete($id)
    {
        if (empty($id)){
            \Session::flash('err_masg', 'データがありません。');
            return redirect(route('stock_create'));
        }
        try {
            //在庫削除
            Stock::destroy($id);
        } catch(\Throwable $e){
            abort(500);
        }
       
        \Session::flash('err_msg', '在庫を削除しました');
        return redirect(route('stock_create'));
    }
}
