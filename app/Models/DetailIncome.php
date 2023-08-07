<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailIncome extends Model
{
    use HasFactory;

    protected $table = 'detail_income';

    protected $primaryKey = 'iddetail_income';

    public $timestamps = false;

    protected $fillable = [
        'id_income',
        'id_article',
        'quantity',
        'price_sale',
        'price_purchase',
    ];
}
