<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function chatUsers() {
        return $this->hasMany(ChatUser::class);
    }

    public function users() {
        return $this->chatUsers;
    }
}
