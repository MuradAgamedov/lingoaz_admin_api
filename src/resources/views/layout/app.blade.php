<!DOCTYPE html>
<html lang="en">

@include('layout.includes.head')
<body>

    <div class="wrapper">
    @include('layout.includes.partials._aside')

        <!-- Start Page Content here -->
        @yield('content')
        <!-- End Page content -->
    </div>

    @include('layout.includes.foot')

</body>

</html>
