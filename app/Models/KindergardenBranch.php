<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KindergardenBranch extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'kindergarden_branches';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'address',
        'branch_manager',
        'phone',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function kindergardenBranchKindergardenGroups()
    {
        return $this->hasMany(KindergardenGroup::class, 'kindergarden_branch_id', 'id');
    }

    public function branchKids()
    {
        return $this->hasMany(Kid::class, 'branch_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
