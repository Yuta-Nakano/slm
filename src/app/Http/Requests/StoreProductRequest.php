<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function attributes(): array
    {
        return [
            'code'               => '商品名',
            'name'               => '商品コード ',
            'remarks'            => '備考',
            'registrant_user_id' => '登録者',
            'updated_user_id'    => '最終登録者',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code'               => 'required|string|max:20|unique:App\Models\Product,code',
            'name'               => 'required|string|max:20|unique:App\Models\Product,name',
            'remarks'            => 'nullable|string',
            'registrant_user_id' => 'nullable|integer|exists:App\Models\User,id',
            'updated_user_id'    => 'nullable|integer|exists:App\Models\User,id',
        ];
    }

    public function makeProduct(): Product
    {
        return new Product($this->validated());
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
            '*unique'   => ':attributeはすでに取得されています。',
        ];
    }
}
