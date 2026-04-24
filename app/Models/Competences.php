<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competences extends Model
{

    use HasFactory;

    protected $table = "competences";
    protected $primaryKey = "code_comp";
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;
    protected $fillable = [
        'label_compo',
        'description_comp',

    ];

    public function user() {
        return $this->belongsToMany(Utilisateur::class,"user_compentence", "code_comp");
    }

    public function interventions()  {

        return $this->hasMany(Intervation::class,"code_comp","code_comp");
    }

}
