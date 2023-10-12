<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>@yield('title')</title>
</head>
<body>

<nav class="navbar navbar-default"  style="background-color:#0A74DA">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ" target='_blank' class="flex items-center">
          <img src="https://i.ibb.co/q1h0JnS/Tur-Joy-Logo.png"  width="75" alt="Tur-Joy-Logo" border="0" alt='TurJoy' />
          <span class="self-center text-gray-custom-50 text-2xl font-semibold whitespace-nowrap dark:text-white">TurJoy</span>
       </a>
    </div>
  </nav>
  <main>
    @yield('content')
  </main>
</body>
</html>
