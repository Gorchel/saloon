<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Entry extends Model
{
    public $table = 'entries';

    public function sender_log()
    {
        return $this->hasMany(SenderLog::class, 'entry_id', 'id');
    }
}
