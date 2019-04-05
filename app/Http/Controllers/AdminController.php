<?php

namespace App\Http\Controllers;

use App\Document;
use App\File;
use App\Http\Helpers\FilesHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminController extends Controller
{
    private $filesHelper;

    public function __construct(FilesHelper $helper)
    {
        $this->filesHelper = $helper;
    }

    public function index()
    {
        $documents = DB::table('documents')->simplePaginate(15);
        return view('home', compact('documents'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request, $id = false)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'files' => 'required',
            'files.*' => 'max:10000|mimes:pdf'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        /*
            update operation
        */
        if ($id) {
            $document = Document::find($id);
            $this->filesHelper->uploadFiles($document, $request);
            $document->update(['name' => $request->input('name')]);
            return redirect()->back()->with('success', 'Your document has been successfully updated');
        }
        $document = Document::create(['name' => $request->input('name')]);

        $this->filesHelper->uploadFiles($document, $request);

        return back()->with('success', 'Your files has been successfully added');
    }

    public function show($id)
    {
        $document = Document::find($id);
        return view('show', compact('document'));
    }

    public function delete($id)
    {
        $document = Document::find($id);
        $this->filesHelper->deleteFiles($document);
        Document::destroy($id);
        return redirect()->back()->with('success', 'Your document has been successfully deleted');
    }

    public function copy($id)
    {
        $copyingDocument = Document::find($id);
        $newDocument = Document::create(['name' => $copyingDocument->name]);
        $this->filesHelper->copyFiles($newDocument, $copyingDocument);
        return redirect()->back();
    }

    public function fileDestroy($id)
    {
        $file = File::find($id);
        @unlink('storage/' . $file->path);
        File::destroy($id);
        return redirect()->back();
    }
}
