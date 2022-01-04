<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'subject' => 'required|string',
            'keywords' => 'required|min:1',
            'remarks' => 'required|string',
            'received' => 'required',
            'document' => 'required',
            'type_id' => 'required|integer',
            'company_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'is_incoming' => 'required',
            'files.*' => "mimes:pdf,docx|max:2000"
        ];
    }
}
