<!DOCTYPE html>
<html lang="en">
  <head>
    <base href="/public">
    @include('header')
  </head>
<body>
  <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row ">
              <div class="col-12 grid-margin">
                <div class="card">
                <div class="card-body">
                <a href="{{url('/')}}"><div class="badge badge-outline-primary float-end">Home</div></a>
                    <h3 class="card-title">Update Product</h3><br>
                    @if(Session::get('success'))
                    <span style="color: #9ae890 !important;">{{(Session::get('success'))}}</span>
                    @endif

                    @if(Session::get('fail'))
                    <span style="color: #f44336 !important;">{{(Session::get('fail'))}}</span>
                    @endif
                    <form action="updateProduct" method="post" enctype="multipart/form-data" id="form-product" class="form-horizontal">
                      @csrf
                      <input type="hidden" name="id" value="{{$product->id}}">
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-name">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" placeholder="Entry Name" id="input-name" value="{{ $product->name }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('name'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-drive-link">Drive Link</label>
                        <div class="col-sm-10">
                          <input type="text" name="drive_link"  placeholder="Entry Drive Link" id="input-drive-link" value="{{ $product->drive_link }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('drive_link'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-sku">SKU</label>
                        <div class="col-sm-10">
                          <input type="text" name="sku" placeholder="Entry SKU" id="input-sku" value="{{ $product->sku }}" class="form-control" />
                          <span style="color: #f44336 !important;">@error('sku'){{ $message }}@enderror</span>
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-daraz">Daraz</label>
                        <div class="col-sm-10 radio">
                          @if($product->daraz)
                          <label class="radio-inline"><input type="radio" name="daraz" value="1" checked> Yes</label>
                          <label class="radio-inline"><input type="radio" name="daraz" value="0"> No</label>
                          @else
                          <label class="radio-inline"><input type="radio" name="daraz" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="daraz" value="0" checked> No</label>
                          @endif
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-3 col-form-label" for="input-decorguys">Decorguys</label>
                        <div class="col-sm-10 radio">
                          @if($product->decorguys)
                          <label class="radio-inline"><input type="radio" name="decorguys" value="1" checked> Yes</label>
                          <label class="radio-inline"><input type="radio" name="decorguys" value="0"> No</label>
                          @else
                          <label class="radio-inline"><input type="radio" name="decorguys" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="decorguys" value="0" checked> No</label>
                          @endif
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-3 col-form-label" for="input-carstickers">Carstickers</label>
                        <div class="col-sm-10 radio">
                          @if($product->daraz)
                          <label class="radio-inline"><input type="radio" name="carstickers" value="1" checked> Yes</label>
                          <label class="radio-inline"><input type="radio" name="carstickers" value="0"> No</label>
                          @else
                          <label class="radio-inline"><input type="radio" name="carstickers" value="1"> Yes</label>
                          <label class="radio-inline"><input type="radio" name="carstickers" value="0" checked> No</label>
                          @endif
                        </div>
                      </div><br>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-image">New Image</label>
                        <div class="col-sm-10">
                        <img src="productImage/{{$product->image }}" height="120px" width="120px" alt="food image">
                          <input type="file" name="image" id="input-image" value="" class="form-control" />
                          <span style="color: #f44336 !important;">@error('image'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-artcut-file">New ArtCut File</label>
                        <div class="col-sm-10">
                          <input type="file" name="artcut_file" id="input-artcut-file" value="" class="form-control" />
                          <span style="color: #f44336 !important;">@error('artcut_file'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-sm-2 control-label" for="input-other-artcut-file">New Other ArtCut File</label>
                        <div class="col-sm-10">
                          <input type="file" name="other_artcut_file" id="input-other-artcut-file" value="" class="form-control" />
                          <span style="color: #f44336 !important;">@error('other_artcut_file'){{ $message }}@enderror</span>
                        </div>
                      </div>
                      <button type="submit" form="form-product" data-toggle="tooltip" title="Save" class="badge badge-outline-success">Save</button>
                      <a href="{{url('/')}}"><button type="button" data-toggle="tooltip" title="Cancel" class="badge badge-outline-warning">Cancel</button></a>
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