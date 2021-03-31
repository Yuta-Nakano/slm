<?php

namespace App\Http\Requests;

use App\Models\ProductStock;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'in'              => 'nullable|integer',
            'out'             => 'nullable|integer',
            'total'           => 'nullable|integer',
            'branch_id'       => 'required|integer|exists:App\Models\Branch,id',
            'product_id'      => 'required|integer|exists:App\Models\Product,id',
            'updated_user_id' => 'nullable|integer|exists:App\Models\User,id',
        ];
    }

    public function makeProductStock(): ProductStock
    {
        return new ProductStock($this->validated());
    }
}
