<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Article extends Model
{
    use HasFactory;

    protected $table = 'article';

    protected $primaryKey = 'idarticle';

    public $timestamps = false;

    protected $fillable = [
        'idcategory',
        'name',
        'description',
        'code',
        'stock',
        'image',
        'status',
    ];

    public static function findArticlesByName($search)
    {
        $articles = DB::table('article as a')
            ->join('category as c', 'a.idcategory', '=', 'c.idcategory')
            ->select('a.idarticle', 'a.name', 'a.code', 'a.stock', 'a.description', 'a.image', 'c.name as category', 'a.status')
            ->where('a.name', 'LIKE', '%' . $search . '%')
            ->orwhere('a.code', 'LIKE', '%' . $search . '%')
            ->orderBy('a.idarticle', 'desc')
            ->paginate(4);
        return $articles;
    }

    public static function getCategories()
    {
        $categories = DB::table('category')->where('condition', '=', '1')->get();
        return $categories;
    }

    public static function saveProduct($request, $image)
    {
        $article = new Article();
        $article->idcategory = $request->get('idcategory');
        $article->code = $request->get('code');
        $article->name = $request->get('name');
        $article->stock = $request->get('stock');
        $article->description = $request->get('description');
        $article->status = '1';
        $article->image = $image;
        return $article->save();
    }

    public static function updateProduct($request, $image, $article)
    {
        $article->idcategory = $request->get('idcategory');
        $article->code = $request->get('code');
        $article->name = $request->get('name');
        $article->stock = $request->get('stock');
        $article->description = $request->get('description');
        $article->image = $image;
        return $article->update();
    }
}
