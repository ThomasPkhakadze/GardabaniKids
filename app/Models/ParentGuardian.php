<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParentGuardian extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'parent_guardians';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'lastname',
        'email',
        'guardian_type',
        'id_number',
        'created_at',
        'phone',
        'updated_at',
        'deleted_at',
    ];

    public function parentGuardianKids()
    {
        return $this->hasMany(Kid::class, 'parent_guardian_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
