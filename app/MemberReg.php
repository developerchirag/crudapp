<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class MemberReg extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'org_id', 'email', 'password',
    ];

    public function org_id()
    {
        return $this->hasOne('App\GroupReg');
    }

}
