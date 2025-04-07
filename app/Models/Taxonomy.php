<?php

namespace App\Models;

use Kalnoy\Nestedset\NodeTrait;
use Illuminate\Database\Eloquent\Model;
use Neo\UserStamps\Concerns\HasUserStamps;
use Illuminate\Database\Eloquent\SoftDeletes;

class Taxonomy extends Model
{
    use HasUserStamps;
    use SoftDeletes;
    use NodeTrait;

    public function getLftName()
    {
        return 'record_left';
    }

    /**
     * Get the rgt key name.
     *
     * @return  string
     */
    public function getRgtName()
    {
        return 'record_right';
    }


    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sys_taxonomies';

    /**
     * Indicates if the IDs are auto-incrementing.
     * Since we have composite keys, this is set to false.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     * These attributes can be filled during model creation.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'code',
        'description',
        'metadata',
        'parent_id',
        'record_status',
    ];

    /**
     * The attributes that should be cast to native types.
     * Metadata and settings are JSON, while timestamps are cast to datetime.
     *
     * @var array
     */
    protected $casts = [
        'metadata' => 'object',
    ];

    public function parent()
    {
        return $this->belongsTo(Taxonomy::class, 'parent_id');
    }

    public function getNumOfChildrens()
    {
        return $this->children()->count();
    }

    public function getNumOfPivots()
    {
        return TaxonomyPivot::where('taxonomy_id', $this->attributes['id'])->distinct('pivotable_type')->count();
    }

    public function getDepth()
    {
        return Taxonomy::withDepth()->find($this->attributes['id'])->depth;
    }
}
