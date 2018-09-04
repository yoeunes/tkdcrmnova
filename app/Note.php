<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Actionable;

class Note extends Model
{
    const LOW_PRIORITY = 'Low';
    const MEDIUM_PRIORITY = 'Medium';
    const HIGH_PRIORITY = 'High';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    public static function getPriorities()
    {
        return [
          self::LOW_PRIORITY => self::LOW_PRIORITY,
          self::MEDIUM_PRIORITY => self::MEDIUM_PRIORITY,
          self::HIGH_PRIORITY => self::HIGH_PRIORITY,
        ];
    }
}
