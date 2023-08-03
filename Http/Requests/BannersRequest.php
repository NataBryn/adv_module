<?php

    namespace Modules\Banners\Http\Requests;

    use Illuminate\Foundation\Http\FormRequest;

    class BannersRequest extends FormRequest
    {
        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules()
        {
            return [
                'name'        => 'required|max:255',
                'size_id'     => 'required',
                'target_url'  => 'required',
                'date_start'  => 'required|date_format:"d.m.Y"',
                'date_finish' => 'required|date_format:"d.m.Y"',
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
