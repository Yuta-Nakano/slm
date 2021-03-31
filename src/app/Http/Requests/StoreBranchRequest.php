<?php

namespace App\Http\Requests;

use App\Models\Branch;
use Illuminate\Foundation\Http\FormRequest;

class StoreBranchRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function attributes(): array
    {
        return [
            'name'               => '拠点名',
            'postal_code'        => '郵便番号',
            'prefecture'         => '都道府県',
            'municipality'       => '市区町村',
            'address'            => '番地',
            'building'           => '建物・部屋番号',
            'charge_name'        => '担当者名',
            'phone_number'       => '電話番号',
            'remarks'            => '備考',
            'registrant_user_id' => '登録者',
            'updated_user_id'    => '最終登録者',
        ];
    }

    public function rules(): array
    {
        return [
            'name'               => 'required|string|max:20',
            'postal_code'        => 'required|string|max:20',
            'prefecture'         => 'required|string|max:20',
            'municipality'       => 'required|string|max:20',
            'address'            => 'required|string|max:20',
            'building'           => 'required|string|max:20',
            'charge_name'        => 'required|string|max:20',
            'phone_number'       => 'required|string|max:20',
            'remarks'            => 'nullable|string',
            'registrant_user_id' => 'nullable|integer|exists:App\Models\User,id',
            'updated_user_id'    => 'nullable|integer|exists:App\Models\User,id',
        ];
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

    public function makeBranch(): Branch
    {
        return new Branch($this->validated());
    }
}
