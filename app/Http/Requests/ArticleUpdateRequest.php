<?php

    namespace App\Http\Requests;

    use Illuminate\Contracts\Validation\ValidationRule;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Gate;

    class ArticleUpdateRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         */
        public function authorize(): bool
        {
            $article = $this->route('article');
            return Gate::allows('manage-articles', $article);
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array<string, ValidationRule|array<mixed>|string>
         */
        public function rules(): array
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string'],
            ];
        }
    }
