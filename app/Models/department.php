<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class department extends Model
{
    public function employees()
    {
        return $this->hasMany(\App\Models\Employees::class);
    }
    use HasFactory;
}
