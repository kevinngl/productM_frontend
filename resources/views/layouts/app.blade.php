<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product App</title>
</head>
<body>
<h1>Product Management SpringBoot</h1>
@include('products.add')
    <div>
        @yield('content')
    </div>
</body>
</html>
