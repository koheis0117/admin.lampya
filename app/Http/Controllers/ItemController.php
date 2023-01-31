<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\AppServiceProvider;
use App\Http\Requests\ItemRequest;

class ItemController extends Controller
{
    /**
     * 商品登録画面を表示する
     * @param int $id
     * @return view
     */
    public function index(){
        $items = Item::all();

        // dd($items);

        return view('item.list', compact('items'));
    }


    /**
     * 商品を登録する
     * 
     * @return view
     */
    public function store(ItemRequest $request){
        //商品のデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            //ブログ登録
            Item::create($inputs);
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
    
        \Session::flash('err_msg', '商品を登録しました');
        return redirect(route('item_list'));
    }


    /**
     * 商品編集フォームを表示する
     * @param int $id
     * @return view
     */
    public function edit($id)
    {
        $item = Item::find($id);

        if (is_null($item)){
            \Session::flash('err_masg', 'データがありません。');
            return redirect(route('item_list'));
        }

        return view('item.edit', compact('item'));
    }


    /**
     * 商品を更新する
     * 
     * @return view
     */
    public function update(ItemRequest $request){
        //商品のデータを受け取る
        $inputs = $request->all();

        \DB::beginTransaction();
        try {
            //商品更新
            $item = Item::find($inputs['id']);
            $item->fill([
                'name' => $inputs['name'],
                'control_number' => $inputs['control_number'],
                'cost_price' => $inputs['cost_price'],
                'lower_count' => $inputs['lower_count']
            ]);
            $item->save();
            \DB::commit();
        } catch(\Throwable $e){
            \DB::rollback();
            abort(500);
        }
    
        \Session::flash('err_msg', '商品を更新しました');
        return redirect(route('item_list'));
    }


    /**
     * 商品削除
     * @param int $id
     * @return view
     */
    public function delete($id)
    {
        if (empty($id)){
            \Session::flash('err_masg', 'データがありません。');
            return redirect(route('item_list'));
        }
        try {
            //商品削除
            Item::destroy($id);
        } catch(\Throwable $e){
            abort(500);
        }
       
        \Session::flash('err_msg', '商品を削除しました');
        return redirect(route('item_list'));
    }
}
