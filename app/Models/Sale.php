<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sale';

    protected $primaryKey = 'idsale';

    public $timestamps = false;

    protected $fillable = [
        'id_client',
        'type_voucher',
        'num_voucher',
        'serie_voucher',
        'data_time',
        'tax',
        'state',
        'idvoucher',
    ];
}
