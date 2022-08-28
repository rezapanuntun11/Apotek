@extends('layouts.admin')

@section('title')
    Product
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">Product</h2>
              <p class="dashboard-subtitle">
                List of Products
              </p>
            </div>
            <div class="dashboard-content">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-body">
                      <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">
                        + Add New Product
                      </a>
                      <div class="table-responsive">
                        <table class="table table-hover scroll-horizontal-vertical w-100" id="crudTable">
                          <thead>
                            <tr>
                              <th>ID</th>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Price</th>
                              <th>Stock</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody></tbody>
                        </table>
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
  <script>
    var datatable = $('#crudTable').DataTable({
      processing: true,
      serverSide: true,
      ordering: true,
      ajax: {
        url: '{!! url()->current() !!}',
      },
      columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
        { data: 'name', name: 'name' },
        { data: 'category.name', name: 'category.name' },
        { data: 'price', render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )},
        { data: 'stock', name: 'stock' },

        { 
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
          width: '15%'
        },
      ]
    })
  </script>
@endpush