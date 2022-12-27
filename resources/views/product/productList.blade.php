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
        <nav class="navbar p-0 fixed-top d-flex flex-row">
          <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
            <ul class="navbar-nav w-100">
              <li class="nav-item w-100">
                <form action="searchProduct" method="post" enctype="multipart/form-data" id="form-product" class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">
                  @csrf
                  <input type="text" class="form-control" placeholder="Search products" @if(isset($search)) value="{{ $search}}" @endif name="search">
                  <button type="submit" form="form-product" data-toggle="tooltip" title="Search" class="btn btn-outline-secondary" style="border-color: #545b79 !important"><i class="mdi mdi-magnify"></i></button>
                </form>
              </li>
            </ul>
          </div>
        </nav>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-8 grid-margin">
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
                            <th> ArtCut Files </th>
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
                            <td> {{ substr($product->name,0,30)}}.... </td>
                            <td> @if($product->artcut_file != 'null')<a href="{{url('/download',$product->artcut_file)}}"><i class="icon-md mdi mdi-download text-primary ms-auto"></i></a>@endif @if($product->other_artcut_file != 'null')<a href="{{url('/download',$product->other_artcut_file)}}"><i class="icon-md mdi mdi-download text-primary ms-auto"></i></a>@endif </td>
                            <td> @if($product->drive_link != 'null') <a href="{{$product->drive_link}}">Click</a>@else Empty @endif</td>
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
              <div class="col-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Filter</h4>
                    <hr>
                    <form action="filterProduct" method="post" enctype="multipart/form-data" id="form-filter" class="form-horizontal">
                      @csrf
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" placeholder="Entry Name" id="input-name" @if(isset($old_data)) value="{{ $old_data['name'] }}" @endif class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="input-drive-link">Drive Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="drive_link"  placeholder="Entry Drive Link" id="input-drive-link" @if(isset($old_data)) value="{{ $old_data['drive_link'] }}" @endif class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-3 control-label" for="input-sku">SKU</label>
                        <div class="col-sm-10">
                          <input type="text" name="sku" placeholder="Entry SKU" id="input-sku" @if(isset($old_data)) value="{{ $old_data['sku'] }}" @endif class="form-control" />
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="input-artcut-file">Artcut File 1</label>
                        <div class="col-sm-10 radio">
                          @if(isset($old_data))
                            @if($old_data['artcut_file'] == 1)
                              <label class="radio-inline"><input type="radio" name="artcut_file" value="1" checked> Yes</label>
                              <label class="radio-inline"><input type="radio" name="artcut_file" value="0"> No</label>
                            @else
                              <label class="radio-inline"><input type="radio" name="artcut_file" value="1"> Yes</label>
                              <label class="radio-inline"><input type="radio" name="artcut_file" value="0" checked> No</label>
                            @endif
                          @else
                          <label class="radio-inline"><input type="radio" name="artcut_file" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="artcut_file" value="0"> No</label>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="input-other-artcut-file">Artcut File 2</label>
                        <div class="col-sm-10 radio">
                          @if(isset($old_data))
                            @if($old_data['other_artcut_file'] == 1)
                              <label class="radio-inline"><input type="radio" name="other_artcut_file" value="1" checked> Yes</label>
                              <label class="radio-inline"><input type="radio" name="other_artcut_file" value="0"> No</label>
                            @else
                              <label class="radio-inline"><input type="radio" name="other_artcut_file" value="1"> Yes</label>
                              <label class="radio-inline"><input type="radio" name="other_artcut_file" value="0" checked> No</label>
                            @endif
                          @else
                          <label class="radio-inline"><input type="radio" name="other_artcut_file" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="other_artcut_file" value="0"> No</label>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 control-label" for="input-daraz">Daraz</label>
                        <div class="col-sm-10 radio">
                          @if(isset($old_data))
                            @if($old_data['daraz'] == 1)
                              <label class="radio-inline"><input type="radio" name="daraz" value="1" checked> Yes</label>
                              <label class="radio-inline"><input type="radio" name="daraz" value="0"> No</label>
                            @else
                              <label class="radio-inline"><input type="radio" name="daraz" value="1"> Yes</label>
                              <label class="radio-inline"><input type="radio" name="daraz" value="0" checked> No</label>
                            @endif
                          @else
                          <label class="radio-inline"><input type="radio" name="daraz" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="daraz" value="0"> No</label>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-form-label" for="input-decorguys">Decorguys</label>
                        <div class="col-sm-10 radio">
                          @if(isset($old_data))
                            @if($old_data['decorguys'] == 1)
                              <label class="radio-inline"><input type="radio" name="decorguys" value="1" checked> Yes</label>
                              <label class="radio-inline"><input type="radio" name="decorguys" value="0"> No</label>
                            @else
                              <label class="radio-inline"><input type="radio" name="decorguys" value="1"> Yes</label>
                              <label class="radio-inline"><input type="radio" name="decorguys" value="0" checked> No</label>
                            @endif
                          @else
                          <label class="radio-inline"><input type="radio" name="decorguys" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="decorguys" value="0"> No</label>
                          @endif
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-4 col-form-label" for="input-carstickers">Carstickers</label>
                        <div class="col-sm-10 radio">
                          @if(isset($old_data))
                            @if($old_data['carstickers'] == 1)
                              <label class="radio-inline"><input type="radio" name="carstickers" value="1" checked> Yes</label>
                              <label class="radio-inline"><input type="radio" name="carstickers" value="0"> No</label>
                            @else
                              <label class="radio-inline"><input type="radio" name="carstickers" value="1"> Yes</label>
                              <label class="radio-inline"><input type="radio" name="carstickers" value="0" checked> No</label>
                            @endif
                          @else
                          <label class="radio-inline"><input type="radio" name="carstickers" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="carstickers" value="0"> No</label>
                          @endif
                        </div>
                      </div>
                      <button type="submit" form="form-filter" data-toggle="tooltip" title="Filter" class="badge badge-outline-success">Filter</button>
                    </form>
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