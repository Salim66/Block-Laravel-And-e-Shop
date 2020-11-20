<!DOCTYPE html>
<html lang="en">

@include('layouts.head')
<body>

<!-- Main Wrapper -->
<div class="main-wrapper">

@include('layouts.header')

@include('layouts.menu')

@section('main')
    @show

</div>
<!-- /Main Wrapper -->

@include('layouts.partials.scripts')

</body>

</html>
@include('layouts.logout')
