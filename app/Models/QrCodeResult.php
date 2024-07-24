<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QrCodeResult extends Model
{
    use HasFactory;

    protected $fillable = ['result'];
}
