<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id'];

    public $timestamps = false;

    public function colors()
    {
        return $this->hasOne(Color::class, 'themes_id', 'id');
    }
}
