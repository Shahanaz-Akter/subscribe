<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Tables</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    @if (url()->previous() == 'http://abc.localhost:8000/subscription')
        {{-- for abc.localhost sub domain tenant --}}
        <div>
            <div class="text-center mt-5">
                <a href="{{ url()->previous() }}">
                    <button class="btn btn-primary">Previous Page</button>
                    <button class="btn btn-primary">ABC Tenant</button>
                </a>
            </div>

            <div class="d-flex justify-content-center gap-5 mt-5">

                <div>

                    <form method="" action="/first-tenant-blogs">
                        @csrf
                        <!-- Blog -->
                        <div class="mb-2">
                            <label class="form-label" for="blog">Blog Name</label>
                            <div>
                                <input type="text" class="form-control" name="blog" :value="old('blog')"
                                    placeholder="abc" required autofocus autocomplete="blog">
                            </div>
                        </div>

                        {{-- post --}}
                        <div class="mb-2">
                            <label class="form-label" for="post">Blog post</label>
                            <div>
                                <input type="text" class="form-control" name="post" :value="old('post')"
                                    placeholder="post" required autofocus autocomplete="post">
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
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Blog1</td>
                                <td>Des1</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/edit">edit</a>
                                    <a class="btn btn-danger btn-sm" href="/delete">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Blog2</td>
                                <td>Des2</td>
                                <td>
                                    <a class href="/edit">edit</a>
                                    <a href="/delete">Delete</a>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Blog3</td>
                                <td>Des3</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" href="/edit">edit</a>
                                    <a class="btn btn-danger btn-sm" href="/delete">Delete</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
        @elseif (url()->previous() == 'http://mimi.localhost:8000/subscription')
        {{-- for mimi.localhost sub domain tenant --}}
        <div>
            <div class="text-center mt-5">
                <a href="{{ url()->previous() }}">
                    <button class="btn btn-primary">Previous Page</button>
                    <button class="btn btn-primary">Mimi Tenant</button>
                </a>
            </div>

            <div class="d-flex justify-content-center gap-5 mt-5">


                <div>
                    <form method="POST" action="/second-tenant-post">

                        @csrf

                        <!-- Blog -->
                        <div class="mb-2">
                            <label class="form-label" for="blog">Blog Name</label>
                            <div>
                                <input type="text" class="form-control" name="blog" :value="old('blog')"
                                    placeholder="Blog Name" required autofocus autocomplete="blog">
                            </div>
                        </div>

                         {{-- post --}}
                         <div class="mb-2">
                            <label class="form-label" for="post">Blog post</label>
                            <div>
                                <input type="text" class="form-control" name="post" :value="old('post')"
                                    placeholder="post" required autofocus autocomplete="post">
                            </div>
                        </div>

                        <!-- description -->
                        <div class="mb-2">
                            <label class="form-label" for="blog">Blog Description</label>

                            <textarea class="form-control" aria-label="With textarea" name="des"></textarea>
                        </div>


                        <div class="mb-2">
                            <label class="form-label" for="Product">Product Name</label>
                            <div>
                                <input type="text" class="form-control" name="name" :value="old('Product')"
                                    placeholder="Product Name" required autofocus autocomplete="Product">
                            </div>
                        </div>

                        <!-- description -->
                        <div class="mb-2">
                            <label class="form-label" for="des">Product Description</label>

                            <textarea class="form-control" aria-label="With textarea" name="des"></textarea>
                        </div>


                        <button class="btn btn-primary">
                            {{ __('Submit') }}
                        </button>

                    </form>
                </div>

{{-- Now I wanty to fetch all records fromn first tenant dbs blog table --}}
                <div class="mt-2 d-none">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    @else
        <div>
            There is no sub domain in the Parent domains.
        </div>
    @endif

</body>

</html>
