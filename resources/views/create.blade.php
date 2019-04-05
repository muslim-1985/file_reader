@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
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
                <div class="card">
                    <h3 class="card-header">Create document</h3>
                    <div class="col-5">
                        <form method="post" action="{{ route('createDoc') }}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="input-group input-group-sm mb-3" style="margin-top: 15px">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroup-sizing-sm">Document Name</span>
                                </div>
                                <input type="text" name="name" class="form-control" aria-label="Small"
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
@endsection
