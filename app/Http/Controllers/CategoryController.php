<?php

namespace sisVentas\Http\Controllers;

use Illuminate\Http\Request;
use sisVentas\Models\Category;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use sisVentas\Http\Requests\CategoryFormRequest;

class CategoryController extends Controller
{
    public function __construct()
    {
    }

    public function index(Request $request)
    {
        if ($request) {
            $search = $request->get('searchText');
            $categories = Category::findCategoryByName($search);
            return view('store.category.index', compact('categories', 'search'));
        }
    }

    public function create()
    {

        return view('store.category.create');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return route('categoria.index');
    }

    public function store(CategoryFormRequest $request)
    {
        $category = new Category();
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->condition = '1';
        $category->save();
        return Redirect::to('productos/categoria');
    }

    public function edit(Category $categorium)
    {
        return view('store.category.edit', ['category' => $categorium]);
    }

    public function update(CategoryFormRequest $request, Category $categorium)
    {
        $categorium->name = $request->get('name');
        $categorium->description = $request->description;
        $categorium->update();
        return Redirect::to('productos/categoria');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->condition = '0';
        $category->update();
        return Redirect::to('productos/categoria');
    }
}
