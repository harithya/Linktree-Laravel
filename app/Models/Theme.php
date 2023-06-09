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

    public function userTheme()
    {
        return $this->hasMany(UserTheme::class, 'themes_id', 'id');
    }

    public function attributes()
    {
        return $this->hasOne(Attribute::class, 'themes_id', 'id');
    }
}
