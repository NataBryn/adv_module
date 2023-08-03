<?php

    namespace Modules\Banners\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class CampaignsRequest extends FormRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'name'           => 'required|max:255',
                'contact_person' => 'required|max:255',
                'phone'          => 'required|max:30',
                'email'          => 'required|email|unique:banners_campaigns,email,' . $this->route('campaign') . ',id',
            ];
        }

        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize()
        {
            return true;
        }
    }
