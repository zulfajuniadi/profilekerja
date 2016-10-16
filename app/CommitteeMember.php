<?php namespace App;

use Cviebrock\EloquentSluggable\SluggableInterface;
use Venturecraft\Revisionable\RevisionableTrait;
use Cviebrock\EloquentSluggable\SluggableTrait;
use Illuminate\Database\Eloquent\Model;

class CommitteeMember extends Model implements SluggableInterface {

    use SluggableTrait;
    use RevisionableTrait;

    protected $revisionEnabled = true;
    protected $revisionCleanup = true;
    protected $historyLimit = 100;
    protected $revisionCreationsEnabled = true;

    protected $fillable = [
        'occupation_id',
        'name',
        'company',
    ];
    public function getRevisionFormattedFieldNames()
    {
        return [
            'occupation_id'  => trans('committee-members.occupation_id'),
            'name'  => trans('committee-members.name'),
            'company'  => trans('committee-members.company'),
        ];
    }

    public function getRevisionFormattedFields()
    {
        return [
            'Occupation'  => 'string:%s',
            'Name'  => 'string:%s',
            'Company'  => 'string:%s',
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
