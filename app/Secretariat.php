<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Venturecraft\Revisionable\RevisionableTrait;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class Secretariat extends Model implements SluggableInterface {

    use SluggableTrait;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 100;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'occupation_id',
        'role',
        'name',
    ];
    public function getRevisionFormattedFieldNames()
    {
        return [
            'occupation_id'  => trans('secretariats.occupation_id'),
            'role'  => trans('secretariats.role'),
            'name'  => trans('secretariats.name'),
        ];
    }

    public function getRevisionFormattedFields()
    {
        return [
            'Occupation'  => 'string:%s',
            'Role'  => 'string:%s',
            'Name'  => 'string:%s',
        ];
    }

    public function scopeOptions()
    {
        return static::orderBy('name')->lists('name', 'id');
    }

    public function occupation() {
        return $this->belongsTo(Occupation::class, 'occupation_id');
    }

    public static function boot()
    {
        parent::boot();
    }

}
