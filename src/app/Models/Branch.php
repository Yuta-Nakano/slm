<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'postal_code',
        'prefecture',
        'municipality',
        'address',
        'building',
        'charge_name',
        'phone_number',
        'remarks',
        'registrant_user_id',
        'updated_user_id',
    ];

    protected $casts = [
        'registrant_user_id' => 'int',
        'updated_user_id'    => 'int',
    ];

    public function registrant_user()
    {
        return $this->belongsTo('App\Models\User', 'registrant_user_id');
    }

    public function updated_user()
    {
        return $this->belongsTo('App\Models\User', 'updated_user_id');
    }

    public function inventores()
    {
        return $this->hasMany(Inventory::class);
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function firstNewestStockByProduct(Product $product)
    {
        return $this
            ->hasOne(ProductStock::class)
            ->where('product_id', $product->id)
            ->latest('id')
            ->first();
    }

    public function scopeSearchText($query, string $condition = null)
    {
        return $query
            ->where(function ($query) use ($condition) {
                $query
                    ->where('name', 'like', $condition)
                    ->orWhere('postal_code', 'like', $condition)
                    ->orWhere('prefecture', 'like', $condition)
                    ->orWhere('municipality', 'like', $condition)
                    ->orWhere('address', 'like', $condition)
                    ->orWhere('building', 'like', $condition);
            });
    }

    public function scopeWhereNotInInventory($query, Product $product)
    {
        return $query
            // 遅いらしい
            // https://qiita.com/mpyw/items/0761a5e44836c9bebcd5
            // https://qiita.com/tyamahori/items/07a1cc2b7c78710b151e
            // ->whereDoesntHave('inventores', function($query) use ($product) {
            //     $query->where('product_id', $product->id);
            // });
            ->whereNotIn(
                'branches.id',
                Inventory::query()
                    ->select('inventories.branch_id')
                    ->where('inventories.product_id', $product->id)
            );
    }
}
