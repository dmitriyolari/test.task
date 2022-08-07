<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'code' => ['required', 'string', 'unique:brands,code'],
            'display_on_home' => ['boolean'],
            'banner_title' => ['string'],
            'banner_description' => ['string']
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
