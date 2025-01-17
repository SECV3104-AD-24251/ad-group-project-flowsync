<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ParticipantsGroup extends Model
{
    use HasFactory;
    protected $table = 'participants_group';


    protected $fillable = ['groupID', 'email'];


    public function groupChecklist()
    {
        return $this->belongsTo(GroupChecklist::class, 'groupID');
    }
}



