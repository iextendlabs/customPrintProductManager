<!DOCTYPE html>
<html lang="en">
  <head>
    @include('header')
  </head>
  <style>
      td img{
        height: 82px !important;
        width: 82px !important;
      }
      .navbar img{
        height: 70px;
        width: 161px;
        padding-top: 12px;
      }
  </style>
  <body>
  <div class="container-scroller">
    @include('navigation')
    <div class="container-fluid page-body-wrapper">
    <div class="main-panel">
          <div class="content-wrapper">
          </div>
    </div>
    </div>
  </div>
    @include('footer')
  </body>
</html>