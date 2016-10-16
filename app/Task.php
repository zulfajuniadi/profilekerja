<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Task extends Model implements SluggableInterface
{

    use SluggableTrait;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 100;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'code',
        'duty_id',
        'level_id',
        'name',
        'subtasks',
        'performance_standard',
        'enabling_requirement',
        'materials',
    ];
    public function getRevisionFormattedFieldNames()
    {
        return [
            'code' => trans('tasks.code'),
            'duty_id' => trans('tasks.duty_id'),
            'level_id' => trans('tasks.level_id'),
            'name' => trans('tasks.name'),
            'subtasks' => trans('tasks.subtasks'),
            'performance_standard' => trans('tasks.performance_standard'),
            'enabling_requirement' => trans('tasks.enabling_requirement'),
            'materials' => trans('tasks.materials'),
        ];
    }

    public function getRevisionFormattedFields()
    {
        return [
            'Code' => 'string:%s',
            'Duty' => 'string:%s',
            'Level' => 'string:%s',
            'Name' => 'string:%s',
            'Subtasks' => 'string:%s',
            'Performance Standard' => 'string:%s',
            'Enabling Requirement' => 'string:%s',
            'Materials' => 'string:%s',
        ];
    }

    public function scopeOptions()
    {
        return static::orderBy('name')->lists('name', 'id');
    }

    public function duty()
    {
        return $this->belongsTo(Duty::class, 'duty_id');
    }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public static function boot()
    {
        parent::boot();
    }

}
