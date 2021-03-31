<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'branch_id',
        'product_id',
    ];

    protected $casts = [
        'branch_id'  => 'int',
        'product_id' => 'int',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
