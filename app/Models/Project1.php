<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project1 extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tableau';

    protected $fillable = [
        'url',
        'value1',
        'value2',
        'value3',
        'value4',
        'output',
    ];
}
