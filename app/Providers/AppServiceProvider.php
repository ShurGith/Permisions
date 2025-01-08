<?php

    namespace App\Providers;

    use App\Models\Article;
    use App\Models\User;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Blade;
    use Illuminate\Support\Facades\Gate;
    use Illuminate\Support\ServiceProvider;

    class AppServiceProvider extends ServiceProvider
    {
        public function register(): void
        {
            /**
             * //Cambiado por la directiva Blade role
             * Gate::define('access-admin', function (User $user) {
             * return $user->hasRole('admin') || ($user->hasRole('editor') && $user->hasRole('author'));
             * });
             */

            Gate::define('manage-articles', function (User $user, Article $article) {
                return ($user->hasRole('admin') || $user->hasRole('editor'))
                    || ($user->hasRole('author') && $user->id === $article->author_id);
            });

            /*      Blade::directive('role', function ($expression) {
                      return "<?php if(Auth::user()->hasAnyRole([$expression])): ?>";
                  });
                  Blade::directive('endrole', function () {
                      return "<?php endif;?>";
                  });*/

            Blade::if('role', fn($expression) => Auth::user()->hasAnyRole([$expression]));
        }

        public function boot(): void
        {
            //
        }
    }
