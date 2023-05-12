<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin.partials.head')
</head>

<body>
    <div class="container-scroller">

        @include('admin.partials.sidebar')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:navbar -->
            @include('admin.partials.navbar')
            <!-- partial:dashboard -->
            @include('admin.pages.dashboard')
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>

    <!-- plugins:js -->
    @include('admin.partials.script')

</body>

</html>
