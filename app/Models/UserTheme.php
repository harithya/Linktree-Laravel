<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTheme extends Model
{
    use HasFactory, HasUuids;

    protected $table = "user_themes";

    protected $guarded = ['id'];

    public $timestamps = false;
}
