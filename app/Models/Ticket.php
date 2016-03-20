<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model 
{
    protected $guarded = [];
    protected $with = ['department', 'replies', 'user'];

    public static function boot()
    {
        parent::boot();

        Ticket::creating(function (Ticket $ticket) {
            $ticket->code = $ticket->generateCode();
        });
    }

    public function generateCode($i = 1)
    {
        $datetime = date('YmdHi', time());
        $suffix = str_pad($i, 4, '0', STR_PAD_LEFT);
        $format = $datetime . '_' . $suffix;

        $ticket = Ticket::where('code', $format)->first();

        if ($ticket) {
            return $this->generateCode($i+1);
        } else {
            return $format;
        }
    }

    public function department()
    {
        return $this->belongsTo(TicketDepartment::class, 'ticket_department_id');
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}