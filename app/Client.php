<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const ACTIVE = 'Active';
    const DEACTIVE = 'Deactive';

    protected $fillable = [
        'client_name',
        'client_contact_first_name',
        'client_contact_last_name',
        'client_contact_full_name',
        'client_contact_phone',
        'client_contact_email',
        'client_address',
        'client_city',
        'client_state',
        'client_zip',
        'client_notes',
        'client_status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($lead) {
            $lead->client_contact_full_name = $lead->client_contact_first_name . ' ' . $lead->client_contact_last_name;
        });
    }

    public static function getClientStatus()
    {
        return [
            self::ACTIVE => self::ACTIVE,
            self::DEACTIVE => self:: DEACTIVE,
        ];
    }
}
