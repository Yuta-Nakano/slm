<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'code'            => '商品名',
            'name'            => '商品コード ',
            'remarks'         => '備考',
            'updated_user_id' => '最終登録者',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        $rules = [
            'code'            => 'required|string|max:20|unique:App\Models\Product,code',
            'name'            => 'required|string|max:20|unique:App\Models\Product,name',
            'remarks'         => 'nullable|string',
            'updated_user_id' => 'nullable|integer|exists:App\Models\User,id',
        ];

        if ($this->product && $this->code) {
            $rules['code'] = $rules['code'] . ',' . $this->product->id . ',code';
        }

        if ($this->product && $this->name) {
            $rules['name'] = $rules['name'] . ',' . $this->product->id . ',name';
        }

        return $rules;
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
