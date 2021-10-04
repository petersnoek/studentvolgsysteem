<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Group extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $guarded = [];

    public function students(){
        return $this->belongsToMany(Student::class);
    }

    public function slug($action){
        try {
            $reflection = new ReflectionClass($this);
            $reflection = strtolower($reflection->getShortName());
            return url(config('backpack.base.route_prefix') . '/' . $reflection . '/' . $this->id . '/' . $action);

        } catch (\ReflectionException $e) {
            return url('/');
        }
    }

    public function getStudentSlugs(){
        if($this->students->isNotEmpty()){
            $slugs = array();
            foreach($this->students as $student){
                array_push($slugs, '<a href="' . $student->slug("show").'">'.$student->studentnumber.' ('.$student->getDisplayname() .')</a>');
            }
            return implode(', ', $slugs);
        }
        else{
            return '-';
        }
    }
}
