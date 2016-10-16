<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Occupation extends Model implements SluggableInterface
{

    use SluggableTrait;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 100;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'name',
    ];
    public function getRevisionFormattedFieldNames()
    {
        return [
            'name' => trans('occupations.name'),
        ];
    }

    public function getRevisionFormattedFields()
    {
        return [
            'Name' => 'string:%s',
        ];
    }

    public function scopeOptions()
    {
        return static::orderBy('name')->lists('name', 'id');
    }

    public function duties()
    {
        return $this->hasMany(Duty::class);
    }

    public function levels()
    {
        return $this->hasMany(Level::class);
    }

    public function scopeLevelOptions()
    {
        return [
            'L1' => 'L1',
            'L2' => 'L2',
            'L3' => 'L3',
            'L4' => 'L4',
            'L5' => 'L5',
            'L6' => 'L6',
            'L7' => 'L7',
        ];
    }

    public static function boot()
    {
        parent::boot();
    }

}
