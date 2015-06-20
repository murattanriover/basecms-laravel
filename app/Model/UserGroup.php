<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'user_group';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['group_id','user_id'];

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
