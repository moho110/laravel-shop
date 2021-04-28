<!-- 存放在 resources/views/layouts/app.blade.php -->

<html>
    <head>
        <title>应用名称 - @yield('title')</title>
    </head>
    <body>
        @section('sidebar')
            这里是侧边栏
        @show

        <div class="container">
            @yield('content')
        @foreach ($articlecats as $articlecat)
    		<p>This is user {{$articlecat->id}}</p>
		@endforeach
        </div>
    </body>
</html>