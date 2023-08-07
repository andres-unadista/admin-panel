<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;

    protected $table = 'voucher';

    protected $primaryKey = 'idvoucher';

    public $timestamps = false;

    protected $fillable = [
        'type_voucher',
        'serie_voucher',
        'num_voucher',
    ];
}
