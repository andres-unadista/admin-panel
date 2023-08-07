<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';

    protected $primaryKey = 'idcategory';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'condition',
        'description'
    ];

    public static function findCategoryByName($search)
    {
        $categories = DB::table('category')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->where('condition', '=', '1')
            ->orderBy('idcategory', 'desc')
            ->paginate(2);
        return $categories;
    }


    // protected $guarded
}
