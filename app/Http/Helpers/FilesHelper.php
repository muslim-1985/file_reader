<?php
/**
 * Created by PhpStorm.
 * User: muslim
 * Date: 04.04.19
 * Time: 2:50
 */

namespace App\Http\Helpers;

use App\Http\Contracts\FilesOperations;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class FilesHelper implements FilesOperations
{
    public function uploadFiles(Model $model, Request $request)
    {
        $path = [];
        if ($request->hasfile('files')) {
            foreach ($request->file('files') as $file) {
                $name = $file->getClientOriginalName();
                $p = $file->store('files', ['disk' => 'public']);
                $path[] = ['name' => $name,
                    'path' => $p,
                    'doc_id' => $model->id,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()];
            }
            DB::table('files')->insert($path);
        }
    }

    public function deleteFiles(Model $model)
    {
        foreach ($model->files as $file) {
            @unlink('storage/' . $file->path);
        }
    }

    public function copyFiles(Model $newDoc, Model $copyingDoc)
    {
        $files = [];
        foreach ($copyingDoc->files as $file) {
            $name = Carbon::now() . $file->name;
            Storage::copy('public/' . $file->path, 'public/files/' . $name);
            $p = 'files/' . $name;
            $files[] = ['name' => $file->name,
                'path' => $p,
                'doc_id' => $newDoc->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()];
        }
        DB::table('files')->insert($files);
    }
}
