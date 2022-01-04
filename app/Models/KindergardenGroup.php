<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KindergardenGroup extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'kindergarden_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'vacancy',
        'kindergarden_branch_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function groupKids()
    {
        return $this->hasMany(Kid::class, 'group_id', 'id');
    }

    public function kindergarden_branch()
    {
        return $this->belongsTo(KindergardenBranch::class, 'kindergarden_branch_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
