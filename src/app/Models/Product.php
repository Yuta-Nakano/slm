<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $dates = [
        'deleted_at',
    ];

    protected $fillable = [
        'code',
        'name',
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
        return $this->belongsTo(User::class, 'registrant_user_id');
    }

    public function updated_user()
    {
        return $this->belongsTo(User::class, 'updated_user_id');
    }

    public function stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function inventores()
    {
        return $this->hasMany(Inventory::class);
    }
}
