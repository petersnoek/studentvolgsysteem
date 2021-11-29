<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomColumn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'column_type_id',
    ];

    public function columnType(){
        return $this->belongsTo(ColumnType::class);
    }
}
