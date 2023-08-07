<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use sisVentas\Http\Requests\ArticleFormRequest;
use sisVentas\Models\Article;

class ArticleController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if ($request) {
            $search = $request->get('searchText');
            $articles = Article::findArticlesByName($search);
            return view('store.articles.index', compact('articles', 'search'));
        }
    }

    public function create()
    {
        $categories = Article::getCategories();
        return view('store.articles.create', compact('categories'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('store.articles.show', compact('article'));
    }

    public function store(ArticleFormRequest $request)
    {
        $image = '';
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file->move(public_path() . '/images/articles/', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        Article::saveProduct($request, $image);

        return Redirect::to('productos/articulo');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        $categories = Article::getCategories();
        return view('store.articles.edit', compact('article', 'categories'));
    }

    public function update(ArticleFormRequest $request, Article $articulo)
    {
        $image = '';
        if ($request->file('image')->isValid()) {
            $file = $request->file('image');
            $file->move(public_path() . '/images/articles/', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        Article::updateProduct($request, $image, $articulo);
        return Redirect::to('productos/articulo');
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->status = '0';
        $article->update();
        return Redirect::to('productos/articulo');
    }
}
