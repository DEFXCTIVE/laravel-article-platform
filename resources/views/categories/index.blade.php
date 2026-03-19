@extends('layouts.app')


@section('content')
<div class='container-xxl table-responsive my-md-3'>
    <div class='container-sm my-3 border bg-white rounded d-flex flex-row-reverse'>
        <a role="button" href="/categories/create" class="btn btn-primary my-3">Create Category</a>
    </div>
    <table class="table table-striped custom-table --bs-tertiary-bg">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
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
            @if($categories->count())
            @foreach($categories as $key => $cat)
            <tr scope="row" class="active">
                <td>
                    {{ $cat->id }}
                </td>
                <td class="pl-0">
                    <div class="d-flex align-items-center">
                        <small class="name">{{ $cat->name }}</small>
                    </div>
                </td>

                <td>
                    <div class="d-flex align-items-center">
                        <small class="name">{{ $cat->description }}</small>
                    </div>
                </td>
                <td>　　　　　　　</td>
                <td>　　　　　　　</td>
                <td>　　　　　　　</td>
                <td>　　　　　　　</td>
                <td>　　　　　　　</td>
                <td>　　　　　　　</td>
                <td>　　　　　　　</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                        <a role="button" href='/categories/{!! $cat->id !!}' class="btn btn-outline-primary"><i class="bi bi-eye"></i></a>
                        @auth
                        @if (auth()->user()->is_admin == 1)
                        <a role="button" href='/categories/edit/{!! $cat->id !!}' class="btn btn-outline-primary"><i class="bi bi-pencil"></i></a>
                        <a role="button" href='/categories/delete/{!! $cat->id !!}' class="btn btn-outline-primary"><i class="bi bi-trash"></i></a>
                        @endif
                        @endauth
                    </div>
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    {{$categories->links('pagination::bootstrap-5')}}

</div>




@endsection