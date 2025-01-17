<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


// class CreateGroupChecklistsTable extends Migration
// {
//     /**
//      * Run the migrations.
//      *
//      * @return void
//      */
//     public function up()
//     {
//         Schema::create('group_checklists', function (Blueprint $table) {
//             $table->id(); // Auto-increment primary key
//             $table->string('title'); // Checklist title
//             $table->json('checklist')->nullable(); // Checklist tasks stored as JSON
//             $table->json('participants')->nullable(); // Participants' emails stored as JSON
//             $table->timestamps(); // Created and updated timestamps
//         });
//     }


//     /**
//      * Reverse the migrations.
//      *
//      * @return void
//      */
//     public function down()
//     {
//         Schema::dropIfExists('group_checklists');
//     }
// }


class GroupChecklist extends Model
{
    use HasFactory;
    protected $fillable = ['title'];


    public function checklists()
    {
        return $this->hasMany(Checklist::class, 'groupID');
    }


    public function participants()
    {
        return $this->hasMany(ParticipantsGroup::class, 'groupID');
    }


   
}



