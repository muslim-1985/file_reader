<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 03.04.19
 * Time: 21:54
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name'];
    public function document ()
    {
        return $this->belongsTo('App\Document','doc_id');
    }
}
