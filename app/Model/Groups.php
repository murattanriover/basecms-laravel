<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Groups extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','value','status'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function Perms(){
        return $this->hasMany('\App\Model\GroupPerms','group_id');
    }

    public function scopeLive($query)
    {
        return $query->where('status','>=',0);
    }

}
