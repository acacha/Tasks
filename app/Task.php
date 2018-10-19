<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];
//    protected $fillable = ['name','completed'];

    public function file()
    {
        return $this->hasOne(File::class);
//        return $this->hasOne('App\Class');
    }

    public function assignFile(File $file)
    {
        $file->task_id = $this->id;
        $file->save();
    }
}
