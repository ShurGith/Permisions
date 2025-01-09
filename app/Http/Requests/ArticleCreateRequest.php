<?php

    namespace App\Http\Requests;

    use App\Models\Article;
    use Illuminate\Auth\Access\AuthorizationException;
    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Support\Facades\Gate;

    class ArticleCreateRequest extends FormRequest
    {
        public function authorize(): bool
        {
            $response = Gate::inspect('create', Article::class);

            if ($response->allowed()) {
                return true;
            }

            throw new AuthorizationException('Unauthorized to create an article.');
        }

        public function rules(): array
        {
            return [
                'title' => ['required', 'string', 'max:255'],
                'content' => ['required', 'string'],
            ];
        }
    }
