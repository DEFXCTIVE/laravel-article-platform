@extends('layouts.app')


@section('content')
<div class='container-xxl table-responsive my-md-3'>
    <div class='container-sm my-3 border bg-white rounded d-flex flex-row-reverse'>
        <a role="button" href="/tags/create" class="btn btn-primary my-3">Create Tag</a>
    </div>
        <table class="table table-striped custom-table --bs-tertiary-bg">
            <thead>            
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">　　　　　　　</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($tags->count())
                @foreach($tags as $key => $tag)
                <tr scope="row" class="active">
                    <td>
                        {{ $tag->id }}
                    </td>
                    <td class="pl-0">
                        <div class="d-flex align-items-center">
                            <small class="name">{{ $tag->name }}</small>
                        </div>
                    </td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>　　　　　　　</td>
                    <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a role="button" href='/tags/{!! $tag->id !!}' class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                        @auth
                            @if (auth()->user()->is_admin == 1)
                                <a role="button" href='/tags/edit/{!! $tag->id !!}' class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                                <a role="button" href='/tags/delete/{!! $tag->id !!}' class="btn btn-outline-primary"><i class="bi bi-trash"></i></a>                              
                            @endif
                        @endauth                                            
                        </div>
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    {{$tags->links('pagination::bootstrap-5')}}

</div>




@endsection