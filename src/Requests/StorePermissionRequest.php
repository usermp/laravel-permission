<?php

namespace Usermp\LaravelPermission\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
           'name' => 'string|required|max:255',

        ];
    }
}
