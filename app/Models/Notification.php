<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'notifiable_id',
        'notifiable_type',
        'data',
        'read_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notifiable()
    {
        return $this->morphTo();
    }

    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }
    public static function getUnreadNotificationsBetweenUsers(int $userId, int $fromId)
    {

        $notify =  Notification::where('user_id', $userId)
        ->where('from', $fromId)
        ->where(function($query) {
            $query->where('is_read', false)
                  ->orWhere('created_at', '>=', now()->subDay());
        })
        ->with(['notifiable'])
        ->orderBy('created_at', 'desc')
        ->get();

        foreach ($notify as $notification) {
            if($notification->is_read == false){
            $notification->update(['is_read' => true]);
            }
        }
        return $notify;
    }
}
