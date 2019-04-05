@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        Dashboard
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <a href="{{ route('create') }}" type="button" target="_blank" rel="noopener noreferrer"
                           class="btn btn-primary btn-sm" style="float: right">+ Add Document</a>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($documents) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Document</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($documents as $document)
                                    <tr>
                                        <th scope="row">1</th>
                                        <td><a href="{{ route('show',$document->id) }}">{{ $document->name }}</a></td>
                                        <td>
                                            <a href="{{ route('copy', $document->id) }}" type="button"
                                               class="btn btn-primary btn-sm">Copy</a>
                                            <form method="post" action="{{ route('delDoc', $document->id) }}" style="display: inline">
                                                {{csrf_field()}}
                                                <input  onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm" type="submit" value="Delete"/>
                                                <input type="hidden" name="_method" value="delete" />
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
