@extends('admin.layouts.base')


@section('contents')

    <div class="bg-dark text-light py-2 mb-3">
        <h1 class="ms-4" style="font-weight: 700">Lista Projects</h1>
    </div>

    @if (session('delete_success'))
            
    @php
        $project = session('delete_success') 
    @endphp

    <div class="alert alert-danger">
        Project '{{$project->title}}' è stato cancellato
        <form 
            action="{{ route('admin.projects.restore', ['project' => $project]) }}"
            class="d-inline-block" 
            method="POST" 
            >
            @csrf
            <button class="btn btn-warning">Ripristina</button>
        </form>
    </div>

    @endif

    @if (session('restore_success'))

    @php
        $project = session('restore_success')
    @endphp

    <div class="alert alert-success">
        Project '{{$project->title}}' è stato ripristinato
    </div>

    @endif

    <button type="button" class="btn btn-primary mt-4 mx-4">
        <a href="{{ route("admin.projects.create") }}" class="card-link text-decoration-none text-light" style="font-weight: 700; font-size:25px">Creare un nuovo Progetto</a>
    </button>
    <div class="container_table m-4">
        <table class="table table-striped mt-4">
            <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Creation Date</th>
                    <th scope="col">Last Update</th>
                    <th scope="col">Collaborators</th>
                    <th scope="col">Description</th>
                    <th scope="col">Languages</th>
                    <th scope="col">Link</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($projects as $project)
                    <tr>
                        <th scope="row">{{ $project->title }}</th>
                        <td>{{ $project->author }}</td>
                        <td>{{ $project->creation_date}}</td>
                        <td>{{ $project->last_update }}</td>
                        <td>{{ $project->collaborators }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->languages }}</td>
                        <td><a href="{{ $project->link_github }}">Link</a></td>
                        
                        <td>
                            <a class="btn btn-primary" href="{{ route('admin.projects.show', ['project' => $project->id]) }}">View</a>
                            <a class="btn btn-warning" href="{{ route('admin.projects.edit', ['project' => $project->id]) }}">Edit</a>
                            <form
                                action="{{ route('admin.projects.destroy', ['project' => $project->id]) }}"
                                method="post"
                                class="d-inline-block"
                            >
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="px-4 d-flex flex-column justify-content-start" style=" font-size:20px; font-weight: 700">
        {{ $projects->links() }}
    </div>
@endsection