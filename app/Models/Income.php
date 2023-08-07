<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $table = 'income';

    protected $primaryKey = 'idincome';

    public $timestamps = false;

    protected $fillable = [
        'idprovider',
        'data_time',
        'tax',
        'state',
        'idvoucher',
    ];
}
