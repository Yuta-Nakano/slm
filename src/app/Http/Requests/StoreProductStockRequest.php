<?php

namespace App\Http\Requests;

use App\Models\ProductStock;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function attributes(): array
    {
        return [
            'in'              => '入庫数',
            'out'             => '出庫数',
            'total'           => '在庫数',
            'branch_id'       => '拠点',
            'product_id'      => '商品',
            'updated_user_id' => '変動実行者',
        ];
    }

    public function rules(): array
    {
        return [
            'in'              => 'nullable|integer',
            'out'             => 'nullable|integer',
            'total'           => 'nullable|integer',
            'branch_id'       => 'required|integer|exists:App\Models\Branch,id|exists:App\Models\Inventory,branch_id',
            'product_id'      => 'required|integer|exists:App\Models\Product,id|exists:App\Models\Inventory,product_id',
            'updated_user_id' => 'nullable|integer|exists:App\Models\User,id',
        ];
    }

    public function makeProductStock(): ProductStock
    {
        return new ProductStock($this->validated());
    }

    public function messages(): array
    {
        return [
            '*.required' => ':attributeは必須項目です。',
            '*.string'   => ':attributeは文字列である必要があります。',
            '*.max'      => [
                'string' => ':attributeは:max文字より大きくすることはできません。'
            ],
            '*.integer' => ':attributeは整数でなければなりません。',
            '*.exists'  => '選択した:attributeが無効です。',
        ];
    }
}
