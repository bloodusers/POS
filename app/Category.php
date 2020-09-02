<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $fillable = [
        'name','description','organization_id',
    ];
    protected $guarded = [
        'name','description','organization_id',
    ];
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }


}
