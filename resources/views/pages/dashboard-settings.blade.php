@extends('layouts.dashboard')

@section('title')
    Store Setting
@endsection
    
@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">Store Settings</h2>
              <p class="dashboard-subtitle">
                Setup your store!
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
                              <label>Store Name</label>
                              <input type="text" class="form-control" placeholder="Input here...">
                            </div>
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Category</label>
                              <select name="category" class="form-control">
                                <option value="" disabled>Select Category</option>
                              </select>
                            </div>
                          </div>
                          <div class="col-md-6">
                            <label>Store Status</label>
                            <p class="text-muted">
                              *Is Store Open?
                            </p>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreTrue"
                                value="true">
                              <label for="openStoreTrue" class="custom-control-label">
                                Open
                              </label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                              <input type="radio" class="custom-control-input" name="is_store_open" id="openStoreFalse"
                                value="false">
                              <label for="openStoreFalse" class="custom-control-label">
                                Closed Temporary
                              </label>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col text-right">
                            <button type="submit" class="btn btn-success px-5">
                              Save Now
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
    </div>
@endsection