<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HtmlAnalysisResult extends Model
{
    protected $fillable = [
        'performance_scores',
        'seo_score',
        'pwa_score',
        'accessibility_score',
        'best_practices_score',
        'lcp_metric',
        'cls_metric',
        'fcp_metric',
        'inp_metric',
        'ttfb_metric',
    ];}
