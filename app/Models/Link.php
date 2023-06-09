<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory, HasUuids;

    public $timestamps = false;

    protected $guarded = ['id'];

    public function getImageAttribute($value)
    {
        if ($value == null) return null;
        return url('images/link/' . $value);
    }
}
