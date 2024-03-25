<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuthModel extends Model
{
    protected $table = 'warmindo.tb_user';
    protected $primaryKey = 'id_user';
    public $timestamps = false;
}
