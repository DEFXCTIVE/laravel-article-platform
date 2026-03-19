@extends('layouts.app')


@section('content')
<div class="container-md d-flex flex-row justify-content-between px-3 py-3">
    <a role="button" href="/articles/" class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back to articles</a>
</div>
<div class="container-md border bg-white rounded px-3 py-3 ">
    <div class="d-flex flex-row align-items-start justify-content-between">
        <div class="d-flex flex-column mb-3">
            <div class="col"><h3>{{$article->title}}</h3></div>
            <p>{{$article->author->name}}</p>
        </div>
        <small>{{$article->updated_at->format('d-m-Y')}}</small>
    </div>
    <div class="text-center">
        <img src="data:image/jpeg;base64,{{ chunk_split(base64_encode($article->image)) }}" class="rounded img-fluid" alt="..."/>
    </div>
    <p>{{$article->body}}</p>
    <div class="row">
        <div class="col d-flex flex-column mb-3 justify-content-start flex-wrap mt-3">
            <small>Category:</small>
            <small class="d-flex flex-row align-content-start flex-wrap mt-1">
                <a class="badge text-bg-primary rounded-pill text-decoration-none" href='/articles/category/{{$article->category->id}}'>{{$article->category->name}}</a>
            </small>
        </div>
        <div class = "col d-flex flex-column mb-3 justify-content-start flex-wrap mt-3">
            <small class>Tags:</small>
            <small class="d-flex flex-row align-content-start flex-wrap mt-1">
            @foreach($article->tags as $key => $tag)
                    <a  class="badge  text-bg-primary rounded-pill text-decoration-none" href='/articles/tag/{!! $tag->id !!}' >{{ $tag->name }}</a>
            @endforeach
            </small>
        </div>
    </div>
</div>
@endsection

