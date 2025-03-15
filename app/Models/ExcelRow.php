<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom', 'email', 'telephone',
    ];

    protected $table = 'excel_rows'; // Si nécessaire, modifiez le nom de la table
}