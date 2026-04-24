<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Utilisateur extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "utilisateur";
    protected $primaryKey = "code_user";

    public $incrementing = false;
    protected $keyType = "string";
    public $timestamps = true;
    protected $fillable = [
        "code_user",
        "nom_user",
        "prenom_user",
        "login_user",
        "password_user",
        "tel_user",
        "sex_user",
        "role_user",
        "etat_user"
    ];

    public function competences() {
       return $this->belongsToMany(Competences::class, 'user_competence', 'code_user', 'code_comp');
    }
    public function getAuthPassword()
    {
        return $this->password_user;
    }





}
