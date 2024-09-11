<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Utills extends Model
{


    public static function returnException(\Exception $exception)
    {
        return [
            'msg' => 'Ocorreu um erro ao cadastrar',
            'type' => 'error',
            'msg_ti' => $exception->getMessage()
        ];
    }
}
