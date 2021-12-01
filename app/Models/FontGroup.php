<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FontGroup extends Model
{
    use HasFactory;

    public function fonts()
    {
        return $this->belongsToMany(FontFamily::class, 'font_pricing_groups');
    }
}
