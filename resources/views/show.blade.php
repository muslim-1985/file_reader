@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                        <a href="{{ route('home') }}" type="button" target="_blank" rel="noopener noreferrer"
                           class="btn btn-primary btn-sm" style="float: right">Back</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="card-header">
                                    {{ $document->name }}
                                </div>
                                <div class="card-body">
                                    <ul>
                                        @foreach($document->files as $file)
                                            <div class="row">
                                                <div class="col-6">
                                                    <a href="{{ asset('storage/'.$file->path) }}" target="_blank" rel="noopener noreferrer">{{ $file->name }}</a>
                                                </div>
                                                <div class="col-6" style="margin-top: 10px">
                                                    <form method="post" action="{{ route('delFile', $file->id) }}" style="float: right">
                                                        {{csrf_field()}}
                                                        <input class="btn btn-default btn-sm" type="submit" value="Delete" />
                                                        <input type="hidden" name="_method" value="delete" />
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card-header">
                                    Edit
                                    @if(!$errors->isEmpty())
                                        <div class="alert alert-danger">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            @foreach ($errors->all() as $message)
                                                <p> {{ $message }}</p>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if(session('success'))
                                        <div class="alert alert-success">
                                            {{ session('success') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="card-body">
                                    <form method="post" action="{{ route('update', $document->id) }}" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" name="_method" value="patch" />
                                        <div class="input-group input-group-sm mb-3" style="margin-top: 15px">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroup-sizing-sm">Document Name</span>
                                            </div>
                                            <input type="text" name="name" value="{{ $document->name }}" class="form-control" aria-label="Small"
                                                   aria-describedby="inputGroup-sizing-sm">
                                        </div>
                                        <div class="input-group control-group increment">
                                            <input id="fileupload" type="file" name="files[]" class="form-control form-control-sm multi with-preview"
                                                   style="margin-bottom: 15px">
                                        </div>
                                        <button type="submit" class="btn btn-primary" style="margin-top: 15px">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


