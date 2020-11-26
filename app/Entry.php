<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

/**
 * Class Entry
 * @package App
 */
class Entry extends Model
{
    /**
     * @var string
     */
    public $table = 'entries';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sender_log()
    {
        return $this->hasMany(SenderLog::class, 'entry_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
