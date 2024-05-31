<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LogoModel extends Model
{
    use HasFactory;
    protected $table = "logo";
    public static function get_record()
    {
        return self::select('logo.*')
            ->get();
    }
    public static function get_single($id)
    {
        return self::find($id);
    }
}
