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
  </style>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form action="\searchProduct" method="post" enctype="multipart/form-data" id="form-product" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  @csrf
                  <input type="text" class="form-control" placeholder="Search products" name="search">
                  <button type="submit" form="form-product" data-toggle="tooltip" title="Search" class="btn btn-outline-secondary" style="border-color: #545b79 !important"><i class="mdi mdi-magnify"></i></button>
                </form>
              </li>
            </ul>
          </div>
        </nav>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                  <a href="{{url('/productForm')}}"><div class="badge badge-outline-primary float-end">Add</div></a>
                    <h4 class="card-title">Products</h4>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <div class="table-responsive">
                      <table class="table"  style="text-align: center;">
                        <thead>
                          <tr>
                            <th> Image </th>
                            <th> Name </th>
                            <th> ArtCut File </th>
                            <th> Drive Link </th>
                            <th> SKU</th>
                            <th> Action </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if(count($products) != 0)
                          @foreach($products as $product)
                          <tr>
                            <td>
                              <img src="productimage/{{$product->image}}" alt="image" />
                            </td>
                            <td> {{$product->name}} </td>
                            <td> @if($product->artcut_file)<a href="{{url('/download',$product->artcut_file)}}"><i class="icon-md mdi mdi-download text-primary ms-auto"></i></a>@endif @if($product->other_artcut_file)<a href="{{url('/download',$product->other_artcut_file)}}"><i class="icon-md mdi mdi-download text-primary ms-auto"></i></a>@endif </td>
                            <td> @if($product->drive_link) <a href="{{$product->drive_link}}">Click</a>@else Empty @endif</td>
                            <td> {{$product->sku}} </td>
                            <td>
                              <a href="{{url('/deleteProduct',$product->id)}}"><div class="badge badge-outline-warning"> Delete</div></a>
                              <a href="{{url('/editProduct',$product->id)}}"><div class="badge badge-outline-success">Edit</div></a>
                            </td>
                          </tr>
                          @endforeach
                          @else
                          <tr>
                            <td class="text-center" colspan="6">No results!</td>
                          </tr>
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © iExtendLabs.com 2021</span>
            </div>
          </footer>
        </div>
      </div>
    </div>
    @include('footer')
    </body>
</html>