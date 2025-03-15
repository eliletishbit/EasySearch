<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ExcelFile extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'filename',
        'path',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // Relation avec User
    }

    public function rows()
    {
        return $this->hasMany(ExcelRow::class); // Relation avec ExcelRow
    }
}