@extends('layouts.app')


@section('content')
<div class="container-md d-flex flex-row justify-content-between px-3 py-3">
    <a role="button" href="/tags/" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back to tags</a>
</div>
<div class="container-md border bg-white rounded px-3 py-3 ">
    <div class="d-flex flex-row align-items-start justify-content-between">
        <div class="d-flex flex-column mb-3">
            <div class="col"><h3>{{$tag->name}}</h3></div>
        </div>
    </div>
</div>
@endsection

