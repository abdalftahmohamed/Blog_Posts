<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //علشان اسمح اني ادخل الصفحة دي
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|regex:/^[a-zA-Z]+$/|max:255|unique:posts,title',
            'content' => 'required|string|min:5',
            'image'=>'required|image|mimes:png,jpg,webp|max:2048',
            'Joining_Date' => 'required|date|date_format:Y-m-d',
        ];
    }
}
