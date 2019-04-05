<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 03.04.19
 * Time: 21:53
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['name'];
    public function files ()
    {
        return $this->hasMany('App\File','doc_id');
    }
}
