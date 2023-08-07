<?php

namespace sisVentas\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Person extends Model
{
    use HasFactory;

    protected $table = 'person';

    protected $primaryKey = 'idperson';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'type_person',
        'type_document',
        'num_document',
        'address',
        'tel',
        'email',
    ];


    public static function findPersonByName($search, $typePerson)
    {
        $categories = DB::table('person')
            ->where('name', 'LIKE', '%' . $search . '%')
            ->where('type_person', '=', $typePerson)
            ->orWhere('num_document', 'LIKE', '%' . $search . '%')
            ->where('type_person', '=', $typePerson)
            ->orderBy('idperson', 'desc')
            ->paginate(2);
        return $categories;
    }
}
