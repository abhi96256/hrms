<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MeasuresMaster
 */
class MeasuresMaster extends Model
{
    protected $table = 'measures_master';

    protected $primaryKey = 'measure_id';

	public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    protected $guarded = [];

    public function unit(){
    	return $this->hasmany('App\Models\Inventory\UnitOfMeasuresMaster','measure_id','measure_id');
    }

        
}