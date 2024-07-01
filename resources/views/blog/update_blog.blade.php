<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

<div>
   

    <div class="d-flex justify-content-center gap-5 mt-5">

        <div>

            <form method="POST" action="/post-edit-blog">

                @csrf
                <!-- Blog -->
                <div class="mb-2">
                    <label class="form-label" for="blog">Blog Name</label>
                    <div>
                        <input type="text" class="form-control" name="blog" value= 
                            placeholder="abc" required autofocus autocomplete="blog">
                    </div>
                </div>


                <!-- description -->
                <div class="mb-2">
                    <label class="form-label" for="blog">Blog Description</label>

                    <textarea class="form-control" aria-label="With textarea" name="des"> </textarea>
                </div>


                <button class="btn btn-primary" type="submit">
                    {{ __('Submit') }}
                </button>

            </form>

        </div>

    </div>
</div>

</body>

</html>