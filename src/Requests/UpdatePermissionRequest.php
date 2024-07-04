<?php

namespace Usermp\LaravelPermission\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePermissionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            
           'name' => 'string|max:255',

        ];
    }
}
