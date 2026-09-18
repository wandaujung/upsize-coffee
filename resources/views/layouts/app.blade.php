<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'UpSize Coffee')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>


<body>

    @include('components.navbar')


    <main class="pt-20">

        @yield('content')

    </main>


    @include('components.footer')


</body>

</html>