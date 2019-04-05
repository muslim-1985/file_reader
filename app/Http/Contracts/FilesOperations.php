<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 04.04.19
 * Time: 2:48
 */

namespace App\Http\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

interface FilesOperations
{
    public function uploadFiles (Model $model, Request $request);

    public function deleteFiles (Model $model);

}
