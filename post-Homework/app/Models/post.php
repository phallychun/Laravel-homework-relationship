<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','body'];

    // Relationship with User
    public function user(){
        return $this->belongsTo(User::class);
    }
    
    // Relationship with Comment 
    public function comment(){
        return $this->hasMany(Comment::class, 'comment_id');
    }
}
