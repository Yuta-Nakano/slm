<?php

namespace App\Http\Requests;

use App\Models\Inventory;
use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function attributes(): array
    {
        return [
            'branch_id'  => '拠点',
            'product_id' => '商品',
        ];
    }

    public function rules(): array
    {
        return [
            'branch_id'  => 'required|integer|exists:App\Models\Branch,id',
            'product_id' => 'required|integer|exists:App\Models\Product,id',
        ];
    }

    public function makeInventory(): Inventory
    {
        return new Inventory($this->validated());
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.integer' => ':attributeは整数でなければなりません。',
            '*.exists'  => '選択した:attributeが無効です。',
        ];
    }
}
