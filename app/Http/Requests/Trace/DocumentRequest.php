<?php

namespace App\Http\Requests\Trace;

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
            'keywords' => 'required|string',
            'actions' => 'required|string',
            'remarks' => 'required|string',
            'received' => 'required',
            'document' => 'required',
            'type_id' => 'required|integer',
            'company_id' => 'required|integer',
            'sender_id' => 'required|integer',
            'is_incoming' => 'required',
            'files.*' => 'sometimes|required|mimes:pdf,docx|max:2000'
        ];
    }
}
