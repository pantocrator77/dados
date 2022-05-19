<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class dado extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable =[
        'id', //Autoincrement
        'valor1', //valor dado 1 - integer
        'valor2', //valor dado 2 - integer
        'resultado' //resultado ganador o perdedor
    ] 
    /**
     * Get the user that owns the dado
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'foreign_key', 'other_key');
    }
}
