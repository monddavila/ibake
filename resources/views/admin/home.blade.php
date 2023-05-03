<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
        @include('admin.css')
  </head>
  <body>
    <div class="container-scroller">

        <!-- partial:sidebar -->
        @include('admin.sidebar')
        <!-- partial -->

        <!-- partial:navbar -->
        @include('admin.navbar')
        <!-- partial -->

        <!-- partial:body-content -->
        @include('admin.body')
        <!-- partial -->

    <!-- container-scroller -->
    <!-- plugins:js -->
        @include('admin.script')
    <!-- End custom js for this page -->
  </body>
</html>