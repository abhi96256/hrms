<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hierarchy extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'employee_id', 'reporting_manager_id','relation'];


     // Table Name
     protected $table = 'reporting_structure';
     // Primary Key
     public $primaryKey = 'id';
     // Timestamps
     public $timestamps = true;

 
     public function user()
     {
         return $this->belongsTo(Employee::class, 'user_id');
     }

    // Employee's manager (self-referencing)
    public function manager()
    {
        return $this->belongsTo(Hierarchy::class, 'reporting_manager_id');
    }

    // Employee's subordinates
    public function subordinates()
    {
        return $this->hasMany(Hierarchy::class, 'reporting_manager_id')->with('subordinates');  // Recursive
    }

}
