<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatosArchivo extends Model
{
    use HasFactory;

    protected $table = 'datos_archivo';

    protected $fillable = ['nombre', 'email', 'password'];

    public function up()
{
    Schema::create('datos_archivo', function (Blueprint $table) {
        $table->id();
        $table->string('nombre');
        $table->string('email');
        $table->string('password');
        $table->timestamps();
    });
}

}

