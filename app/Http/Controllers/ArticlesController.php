<?php

    namespace App\Http\Controllers;

    use App\Http\Requests\ArticleCreateRequest;
    use App\Http\Requests\ArticleUpdateRequest;
    use App\Models\Article;
    use Illuminate\Support\Facades\Gate;

    class ArticlesController extends Controller
    {
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
            return view('articles.index', [
                'articles' => Article::all(),
            ]);
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(ArticleCreateRequest $request)
        {
            $request->user()
                ->articles()
                ->create($request->all());

            return redirect()->route('articles.index');
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {
            Gate::authorize('create', Article::class);
            return view('articles.create');
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(Article $article)
        {
            Gate::authorize('update', $article);

            return view('articles.edit', [
                'article' => $article
            ]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(ArticleUpdateRequest $request, Article $article)
        {
            $article->update($request->all());

            return redirect()->route('articles.index');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(Article $article)
        {
            Gate::authorize('delete', $article);
            $article->delete();

            return redirect()->route('articles.index');
        }
    }
