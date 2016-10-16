<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;
use Venturecraft\Revisionable\RevisionableTrait;

class Level extends Model implements SluggableInterface
{

    use SluggableTrait;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 100;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'occupation_id',
        'level',
        'name',
    ];
    public function getRevisionFormattedFieldNames()
    {
        return [
            'occupation_id' => trans('levels.occupation_id'),
            'level' => trans('levels.level'),
            'name' => trans('levels.name'),
        ];
    }

    public function getRevisionFormattedFields()
    {
        return [
            'Occupation' => 'string:%s',
            'Level' => 'string:%s',
            'Name' => 'string:%s',
        ];
    }

    public function scopeOptions()
    {
        return static::orderBy('level')->get()->reduce(function ($last, $level) {
            $last[$level->id] = $level->level . ' - ' . $level->name;
            return $last;
        }, []);
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
