<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSale extends Model
{
    use HasFactory;
    protected $table = 'detail_sale';

    protected $primaryKey = 'iddetail_sale';

    public $timestamps = false;

    protected $fillable = [
        'id_sale',
        'id_article',
        'quantity',
        'subtotal',
        'discount',
    ];
}
