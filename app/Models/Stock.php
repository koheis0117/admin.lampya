<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    // テーブル名
    protected $table = 'stocks';

    //可変項目
    protected $fillable =
    [
        'item_id',
        'status',
        'count',
        'summary'
    ];

    public function item()
    {
    return $this->belongsTo(Item::class);
    }
}
