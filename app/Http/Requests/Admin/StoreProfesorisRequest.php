<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreProfesorisRequest extends FormRequest
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
            'ime' => 'max:100|required',
            'prezime' => 'max:100|required',
            'zvanje' => 'required',
            'slika' => 'nullable|mimes:png,jpg,jpeg,gif',
            'status' => 'required',
            'fakultet' => 'required',
            'fakultet.*' => 'exists:fakultetis,id',
            'predmeti.*' => 'exists:predmetis,id',
        ];
    }
}
