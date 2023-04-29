<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function theme()
    {
        return $this->belongsTo(Theme::class, 'themes_id', 'id');
    }
}
