<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserRequest extends FormRequest
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
            // autre syntaxe'username'=>'required|unique:users,username',
            'username'=>['required',Rule::unique('users','username')],
            'name'=> ['required','min:3'],
            'email'=> 'required|email|unique:users,email',
            'password'=>'required|min:3|max:32',
            //le nom de nos champs dans le formulaire
        ];
    }
}
