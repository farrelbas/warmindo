<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $table = 'warmindo.tb_menu';
    protected $primaryKey = 'id_menu';
    public $timestamps = false;
}
