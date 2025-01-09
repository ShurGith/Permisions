<?php

    namespace App\Policies;

    use App\Models\Article;
    use App\Models\User;
    use Illuminate\Auth\Access\Response;

    class ArticlePolicy
    {
        /**
         * Determine whether the user can view any models.
         */
        public function viewAny(User $user): bool
        {
            //
        }

        /**
         * Determine whether the user can view the model.
         */
        public function view(User $user, Article $article): bool
        {
            //
        }

        /**
         * Determine whether the user can create models.
         */
        public function create(User $user): Response
        {
            return $user->hasAnyRole(['admin', 'author']) ?
                Response::allow() :
                Response::denyAsNotFound('nada');
        }

        /**
         * Determine whether the user can delete the model.
         */
        public function delete(User $user, Article $article): Response
        {
            return $this->update($user, $article);
        }

        /**
         * Determine whether the user can update the model.
         */
        public function update(User $user, Article $article): Response
        {
            if ($user->hasAnyRole(['admin', 'editor'])) {
                return Response::allow();
            }

            return $user->hasRole('author') && $user->id === $article->author_id ?
                Response::allow() :
                Response::denyAsNotFound();
        }

    }
