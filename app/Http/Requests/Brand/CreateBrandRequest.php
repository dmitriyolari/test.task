<?php

namespace App\Http\Requests\Brand;

use Illuminate\Foundation\Http\FormRequest;

class CreateBrandRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['required', 'string'],
            'code' => ['required', 'string', 'unique:brands,code'],
            'display_on_home' => ['boolean'],
            'banner_title' => ['string'],
            'banner_description' => ['string'],
            'logo' => ['sometimes', 'image'],
        ];
    }

    /**
     * @return void
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'display_on_home' => $this->displayOnHome,
            'banner_title' => $this->bannerTitle,
            'banner_description' => $this->bannerDescription
        ]);
    }
}
