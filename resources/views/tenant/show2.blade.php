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


<div class="d-flex justify-content-center gap-5 mt-5">

{{-- blogs table --}}
<div class="mt-2">
    <title>Blogs Table</title>
<table class="table table-bordered">
   
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Post</th>
            <th scope="col">Description</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($blogs as $blog)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $blog->name }}</td>
                <td>{{ $blog->post }}</td>
                <td>{{ $blog->description }}</td>
                <td>
                    <a class="btn btn-primary btn-sm" href="/mimi/blog_edit/{{$blog->id}}">edit</a>
                    <a class="btn btn-danger btn-sm" href="/mimi/blog_delete/{{ $blog->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
</div>

    
 {{-- Product table --}}

 <div class="mt-2 mb-2">
    <title>Products Table</title>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $product->name }}</td>
                    <td>{{ $blog->description }}</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/mimi/product_edit/{{$product->id}}">edit</a>
                        <a class="btn btn-danger btn-sm" href="/mimi/product_delete/{{ $product->id }}">Delete</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


</div>

</body>

</html>
