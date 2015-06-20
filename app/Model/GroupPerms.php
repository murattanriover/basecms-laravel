<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupPerms extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'group_perms';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id','controller','action'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    public function scopeLive($query)
    {
        return $query->where('status','>=',0);
    }

}
