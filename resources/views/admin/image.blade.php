<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
    </head>
    <body>
        <form action="{{route('admin.images')}}" method="post" enctype="multipart/form-data">
            <input type="file" name="image" id="image">
            <input type="submit" name="submit" id="submit" value="submit">
            {!! csrf_field() !!}
        </form>
    </body>
</html>