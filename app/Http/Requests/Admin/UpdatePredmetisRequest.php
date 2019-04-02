<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePredmetisRequest extends FormRequest
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
            
            'naziv' => 'required',
            'profesor_id' => 'required',
            'semestar' => 'min:1|max:16|required|numeric',
            'fakulteti' => 'required',
            'fakulteti.*' => 'exists:fakultetis,id',
        ];
    }
}
