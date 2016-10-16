<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Duty extends Model implements SluggableInterface
{

    use SluggableTrait;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 100;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'occupation_id',
        'code',
        'name',
    ];
    public function getRevisionFormattedFieldNames()
    {
        return [
            'occupation_id' => trans('duties.occupation_id'),
            'code' => trans('duties.code'),
            'name' => trans('duties.name'),
        ];
    }

    public function getRevisionFormattedFields()
    {
        return [
            'Occupation' => 'string:%s',
            'Code' => 'string:%s',
            'Name' => 'string:%s',
        ];
    }

    public function scopeOptions()
    {
        return static::orderBy('name')->lists('name', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function occupation()
    {
        return $this->belongsTo(Occupation::class, 'occupation_id');
    }

    public static function boot()
    {
        parent::boot();
    }

}
