<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Category extends Model
{
    protected $fillable = [
        'name','organization_id',
    ];
    protected $guarded = [
        'name','organization_id',
    ];
    public function children()
    {
        return $this->hasMany(Category::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }


}
