<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductStock extends Model
{
    const CREATED_AT = null;

    public $timestamps = false;

    protected $fillable = [
        'branch_id',
        'product_id',
        'in',
        'out',
        'total',
        'updated_user_id',
        'update_at',
    ];

    protected $casts = [
        'branch_id'       => 'integer',
        'product_id'      => 'integer',
        'in'              => 'integer',
        'out'             => 'integer',
        'total'           => 'integer',
        'updated_user_id' => 'integer',
    ];

    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function scopeHistoryIndex($query, Branch $branch, Product $product)
    {
        if ($branch && $product) {
            $query
                ->where([
                    ['branch_id', $branch->id],
                    ['product_id', $product->id],
                ])
                ->latest('id');
        }
        return $query
            ->with(['branch']);
    }
}
