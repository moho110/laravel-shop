<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogUserLogins extends Model
{
    public $timestamps = false;
    protected $table = "log_user_logins";
}
