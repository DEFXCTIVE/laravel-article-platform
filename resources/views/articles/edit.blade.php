@extends('layouts.app')

@push('stylesheets')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/css/bootstrap.min.css" rel="stylesheet" />
@endpush
@section('content')

<div class='container-xxl my-md-3 border bg-white rounded'>
    <div class="container-sm my-md-3">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form method="POST" action="{{ route('articles.update',$article->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="mb-3">
                <label for="InputTitle" class="form-label">Title</label>
                <input type="text" class="form-control" name="Title" id="InputTitle" value="{{$article->title}}" />
            </div>
            <div class="mb-3">
                <label for="InputDescription" class="form-label">Description</label>
                <textarea class="form-control" name="Description" id="InputDescription" rows="3" value="{{$article->body}}"></textarea>
            </div>
            <div class="mb-3">
                <label for="formImageFile" class="form-label">Image</label>
                <input class="form-control" accept=".png,.jpg,.gif" type="file" name="Image" id="formImageFile" /></input>
            </div>
            <div class="mb-3">
                <label for="input_tags" class="form-label">Tags</label>
                <select class="form-select" id="input_tags" name="tags_json[]" multiple data-server="{{ route('tags.autocomplete') }}" data-allow-new="false" data-live-server="1" data-allow-clear="true">
                    <option disabled hidden value="">Choose a tag...</option>
                    @foreach ($article->tags as $key => $tag)
                    <option value="{{$tag->id}}" selected="selected">{{$tag->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="input_cats" class="form-label">Category</label>
                <select class="form-select" id="input_cats" name="cats_json[]" data-allow-clear="1" data-suggestions-threshold="0" data-allow-new="false" data-server="{{ route('cats.autocomplete') }}" data-live-server="1">
                    <option disabled hidden value="">Choose a category...</option>
                    <option value="{{$article->category->id}}" selected="selected">{{$article->category->name}}</option>
                </select>
            </div>
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
</div>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5/dist/js/bootstrap.bundle.min.js" type="module"></script>
<script type="module">
    import Tags from "https://cdn.jsdelivr.net/gh/lekoala/bootstrap5-tags@master/tags.js";
    Tags.init("select");
</script>
@endpush


@endsection