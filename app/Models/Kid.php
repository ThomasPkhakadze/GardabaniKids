<?php

namespace App\Models;

use \DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kid extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'kids';

    protected $dates = [
        'date_of_birth',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'lastname',
        'id_number',
        'date_of_birth',
        'branch_id',
        'group_id',
        'parent_guardian_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getDateOfBirthAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDateOfBirthAttribute($value)
    {
        $this->attributes['date_of_birth'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function branch()
    {
        return $this->belongsTo(KindergardenBranch::class, 'branch_id');
    }

    public function group()
    {
        return $this->belongsTo(KindergardenGroup::class, 'group_id');
    }

    public function parent_guardian()
    {
        return $this->belongsTo(ParentGuardian::class, 'parent_guardian_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
