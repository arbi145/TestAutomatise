<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerformanceScore extends Model
{
    protected $table = 'performance_scores';

    protected $fillable = [
        'page_number',
         'href',
         'response_time'];
}
