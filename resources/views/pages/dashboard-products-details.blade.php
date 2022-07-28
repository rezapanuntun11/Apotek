@extends('layouts.dashboard')

@section('title')
    Store Dashboard Product Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">Coffee Arabica</h2>
              <p class="dashboard-subtitle">
                  Product Details!
              </p>
            </div>
            <div class="dashboard-content">
              <div class="row">
                <div class="col-12">
                  <form action="">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Product Name</label>
                              <input type="text" class="form-control" value="Coffee Arabica"
                                placeholder="Input Product Name Here...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Product Price</label>
                              <div class="input-group prepend">
                                <div class="input-group-text">Rp</div>
                                <input type="number" class="form-control" value="15000"
                                  placeholder="Input Product Price Here...">
                              </div>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Category</label>
                              <select name="category" class="form-control">
                                <option value="" disabled>Select Category</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="form-group">
                              <label>Product Description</label>
                              <textarea name="editor"></textarea>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-right">
                            <button type="submit" class="btn btn-success px-5 btn-block">
                              Save
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      <div class="row">
                        <div class="col-md-4">
                          <div class="gallery-container">
                            <img src="/images/product-card-1.png" alt="" class="w-100">
                            <a href="#" class="delete-gallery">
                              <img src="/images/icon-delete.svg" alt="">
                            </a>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="gallery-container">
                            <img src="/images/product-card-2.png" alt="" class="w-100">
                            <a href="#" class="delete-gallery">
                              <img src="/images/icon-delete.svg" alt="">
                            </a>
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="gallery-container">
                            <img src="/images/product-card-3.png" alt="" class="w-100">
                            <a href="#" class="delete-gallery">
                              <img src="/images/icon-delete.svg" alt="">
                            </a>
                          </div>
                        </div>
                        <div class="col mt-3">
                          <input type="file" id="file" style="display: none;" multiple />
                          <button class="btn btn-secondary btn-block" onclick="thisFileUpload();">
                            Add Photo
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection

@push('addon-script')
  <script src="https://cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
  <script>
    function thisFileUpload() {
      document.getElementById("file").click();
    }
  </script>
  <script>
    CKEDITOR.replace('editor');
  </script>
@endpush