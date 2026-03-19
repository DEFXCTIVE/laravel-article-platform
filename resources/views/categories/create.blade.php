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
        <form method="POST" action="{{ route('cats.store') }}">
            @csrf
            <div class="mb-3">
                <label for="InputName" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="InputName" required />
            </div>
            <div class="mb-3">
                <label for="InputDescription" class="form-label">Description</label>
                <textarea class="form-control" name="description" id="InputDescription" rows="3"></textarea>
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