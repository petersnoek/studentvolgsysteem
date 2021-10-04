<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Student extends Model
{
    use \Backpack\CRUD\app\Models\Traits\CrudTrait;
    use HasFactory;
    protected $guarded = [];

    public function groups(){
        return $this->belongsToMany(Group::class);
    }

    public function getGroupSlugs(){
        if($this->groups->isNotEmpty()){
            $slugs = array();
            foreach($this->groups as $group){
                array_push($slugs, '<a href="' . $group->slug("show").'">'.$group->code.'</a>');
            }
            return implode(', ', $slugs);
        }
        else{
            return '-';
        }
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

    public function getDisplayname(){
        return collect([$this->firstname, $this->suffix, $this->lastname])->join(' ');
    }
}
