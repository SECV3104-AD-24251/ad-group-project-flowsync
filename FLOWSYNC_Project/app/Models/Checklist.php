<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Checklist extends Model
{
    use HasFactory;


    protected $primaryKey = 'checkID';
    protected $fillable = ['taskname', 'checked', 'groupID'];


    public function groupChecklist()
    {
        return $this->belongsTo(GroupChecklist::class, 'groupID');
    }
}

