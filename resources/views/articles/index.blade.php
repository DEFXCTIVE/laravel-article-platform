@extends('layouts.app')


@section('content')
<div class='container-xxl table-responsive my-md-3'>
    <div class='container-sm my-3 border bg-white rounded d-flex flex-row-reverse'>
        <a role="button" href="/articles/create" class="btn btn-primary my-3">Create Article</a>
    </div>
        <table class="table table-striped custom-table --bs-tertiary-bg">
            <thead>            
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Author</th>
                    <th scope="col">Title</th>
                    <th scope="col">Category</th>
                    <th scope="coi">Tags</th>
                    <th scope="col">@sortablelink('created_at')</th>
                    <th scope="col">@sortablelink('updated_at')</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($articles->count())
                @foreach($articles as $key => $article)
                <tr scope="row" class="active">
                    <td>
                        {{ $article->id }}
                    </td>
                    <td class="pl-0">
                        <div class="d-flex align-items-center">
                            <small class="name">{{ $article->author->name }}</small>
                        </div>
                    </td>
                    <td>
                        <small class="d-block">{{ $article->title }}</small>
                    </td>
                    <td>
                        <a class="badge text-bg-primary rounded-pill text-decoration-none" href='/articles/category/{!! $article->category->id !!}' >{{ $article->category->name  }}</a>
                    </td>
                    <td>
                        @foreach($article->tags as $key => $tag)
                        <a class="badge text-bg-primary rounded-pill text-decoration-none" href='/articles/tag/{!! $tag->id !!}' >{{ $tag->name }}</a>
                        @endforeach
                    </td>
                    <td>
                        <small class="d-block">{{ $article->created_at->format('d-m-Y') }}</small>
                    </td>
                    <td>
                        <small class="d-block">{{ $article->updated_at->format('d-m-Y') }}</small>
                    </td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a role="button" href='/articles/{!! $article->id !!}' class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                        @auth
                            @if ($article->author == auth()->user() || auth()->user()->is_admin == 1)
                                <a role="button" href='/articles/edit/{!! $article->id !!}' class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a role="button" href='/articles/delete/{!! $article->id !!}' class="btn btn-outline-primary"><i class="bi bi-trash"></i></a>                              
                            @endif
                        @endauth                                            
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    {{$articles->links('pagination::bootstrap-5')}}
</div>




@endsection