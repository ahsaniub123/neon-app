<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FontFamily extends Model
{
    use HasFactory;

    public function boards()
    {
        return $this->belongsToMany(Board::class, 'board_fonts');
    }
    public function font_groups()
    {
        return $this->belongsToMany(FontGroup::class, 'font_pricing_groups');
    }
}
