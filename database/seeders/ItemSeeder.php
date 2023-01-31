<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Item::create([ 
            'name' => '【S】スタンドランプ', 
            'control_number' => '1', 
            'cost_price' => '1750', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】スタンドランプ（ショート）', 
            'control_number' => '2', 
            'cost_price' => '1750', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】電池式スタンド', 
            'control_number' => '3', 
            'cost_price' => '2650', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】スワンネック', 
            'control_number' => '4', 
            'cost_price' => '1850', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】1本チェーン', 
            'control_number' => '5', 
            'cost_price' => '1600', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】3本チェーン', 
            'control_number' => '6', 
            'cost_price' => '1600', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】水差し型', 
            'control_number' => '7', 
            'cost_price' => '1800', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】3灯スタンド（低）', 
            'control_number' => '8', 
            'cost_price' => '2600', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】3灯スタンド（高）', 
            'control_number' => '9', 
            'cost_price' => '2600', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【S】3灯スタンド（ハルン）', 
            'control_number' => '10', 
            'cost_price' => '8000', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【M】スタンドランプ', 
            'control_number' => '11', 
            'cost_price' => '2250', 
            'lower_count' => '10', 
        ]); 

        Item::create([ 
            'name' => '【M】スタンドランプ（ショート）', 
            'control_number' => '12', 
            'cost_price' => '2250', 
            'lower_count' => '10', 
        ]); 
            
    }
}
