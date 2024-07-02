<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basic Add Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>


    @if (session('msg'))
        <div class="alert alert-success text-center">
            {{ session('msg') }}
        </div>
    @endif

    {{-- for abc.localhost sub domain tenant --}}
    <div>
        <div class="text-center mt-5">
            <a href="{{ url()->previous() }}">
                <button class="btn btn-primary">Previous Page</button>

                <button class="btn btn-primary">
                    {{ tenant()->domain }} Tenant
                </button>

            </a>
        </div>

        <div class="d-flex justify-content-center mt-5">

            <div>
                <form action="/post-blog" method="POST">

                    {{-- <form action="{{ route('post.blogg') }}" method="POST"> --}}

                    @csrf



                    <!-- Blog -->
                    <div class="mb-2">
                        <label class="form-label" for="blog">Blog Name</label>
                        <div>
                            <input type="text" class="form-control" name="blog" :value="old('blog')"
                                placeholder="abc" required autofocus autocomplete="blog">
                        </div>
                    </div>

                    <!-- description -->
                    <div class="mb-2">
                        <label class="form-label" for="blog">Blog Description</label>

                        <textarea class="form-control" aria-label="With textarea" name="des"></textarea>
                    </div>


                    <button class="btn btn-primary" type="submit">
                        {{ __('Submit') }}

                    </button>

                </form>

            </div>


            <div class="mt-2 d-none">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Blog Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        @if(session('blogs'))

                         @foreach(session('blogs') as $blog)
                            <tr>
                                <th scope="row">{{ $blog->id }}</th>
                                <td>{{ $blog->name }}</td>
                                <td>{{ $blog->description }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/edit/{{ $blog->id }}">edit</a>
                                    <a class="btn btn-danger btn-sm" href="/delete/{{ $blog->id }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach

                        @endif

                    </tbody>
                </table>
            </div>

        </div>
    </div>




</body>

</html>
