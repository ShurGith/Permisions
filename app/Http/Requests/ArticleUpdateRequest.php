<?php

    namespace App\Http\Requests;

    use Illuminate\Database\Eloquent\ModelNotFoundException;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Gate;

    class ArticleUpdateRequest extends FormRequest
    {
        public function authorize(): bool
        {
            $article = $this->route('article');
            $response = Gate::inspect('update', $article);

            if ($response->allowed()) {
                return true;
            }

            throw new ModelNotFoundException();
        }

        public function rules(): array
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string'],
            ];
        }
    }
