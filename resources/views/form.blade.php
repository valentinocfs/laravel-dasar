<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laravel - CSRF</title>
</head>
<body>
    <form action="/form" method="POST">
       @csrf
       {{-- <input type="hidden" name="_token" value="{{ csrf_token() }}"> --}}
        <label for="name">
            <input type="text" name="name" id="name" placeholder="Enter name">
        </label>
        <input type="submit" value="Say Hello">
    </form>
</body>
</html>
