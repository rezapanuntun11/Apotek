@extends('layouts.dashboard')

@section('title')
    Store Dashboard Transaction Detail
@endsection

@section('content')
    <div class="section-content section-dashboard-home" data-aos="fade-up">
          <div class="container-fluid">
            <div class="dashboard-heading">
              <h2 class="dashboard-title">{{ $transaction->code }}</h2>
              <p class="dashboard-subtitle">
                Transactions Details
              </p>
            </div>
            <div class="dashboard-content" id="transactionDetails">
              <div class="row">
                <div class="col-12">
                  <div class="card">
                    <div class="card-body">
                      @foreach ($transaction->transactiondetails as $details)
                      <div class="row">
                        <div class="col-12 col-md-2">
                          <img src="{{ Storage::url($details->product->galleries->first()->photos ?? '') }}" style="max-height: 200px; max-width:100px" class="w-100 mb-3" alt="">
                        </div>
                        <div class="col-12 col-md-2">
                          <div class="product-title">Customer Name</div>
                          <div class="product-subtitle">{{ $details->transaction->user->name }}</div>
                        </div>
                        <div class="col-12 col-md-2">
                          <div class="product-title">Product Name</div>
                          <div class="product-subtitle">{{ $details->product->name }}</div>
                        </div>
                        <div class="col-12 col-md-2">
                          <div class="product-title">Date Of Transaction</div>
                          <div class="product-subtitle">{{ $details->created_at }}</div>
                        </div>
                        <div class="col-12 col-md-2">
                          <div class="product-subtitle">{{ $details->quantity }}</div>
                          <div class="product-title">Quantity</div>
                        </div>
                        <div class="col-12 col-md-2">
                          <div class="product-title">Harga</div>
                          <div class="product-subtitle">Rp.{{number_format($details->price) }}</div>
                        </div>
                        {{-- <div class="col-12 col-md-8">
                          <div class="row">
                            
                            
                            
                          
                            <div class="col-12 col-md-6">
                              <div class="product-title">Total Amount</div>
                              <div class="product-subtitle">Rp.{{ number_format($details->transaction->total_price) }}</div>
                            </div>
                            <div class="col-12 col-md-6">
                              <div class="product-title">Phone Number</div>
                              <div class="product-subtitle">{{ $details->transaction->phone_number }}</div>
                            </div>
                          </div>
                        </div> --}}
                      </div>
                      @endforeach
                      <hr>
                      <div class="row justify-content-end">
                        <div class="col-12 col-md-4">
                          <div class="row">
                            <div class="col-md-5"><b>Courier</b></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-5">{{ $transaction->courier }}</div>
                          </div>
                          <div class="row">
                            <div class="col-md-5"><b>Ongkir</b></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-5">Rp.{{ number_format($transaction->shipping_price) }} {{ $transaction->service }}</div>
                          </div>
                          <div class="row">
                            <div class="col-md-5"><b>Total Amount</b></div>
                            <div class="col-md-1">:</div>
                            <div class="col-md-5">
                              <h6>Rp.{{ number_format($transaction->total_price) }}</h6></div>
                            
                          </div>
                          <div class="row">
                            <div class="col-md-12">
                              @if ($transaction->transaction_status == "PENDING")
                              <a href="{{ $transaction->midtrans ?? "#" }}" class="btn btn-primary ml-1 mt-2">Bayar</a>
                            @endif
                            </div>
                          </div>
                          
                        </div>
                      </div>
                      <form action="{{ route('dashboard-transaction-update', $transaction->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                  <div class="col-12 mt-4">
                    <h5>Shipping Information</h5>
                  </div>
                  <div class="col-12">
                    <div class="row">
                      <div class="col-12 col-md-6">
                        <div class="product-title">Address I</div>
                        <div class="product-subtitle">
                          {{ $transaction->address_one ?? "data tida ada" }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Address II</div>
                        <div class="product-subtitle">
                          {{ $transaction->address_two }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Province</div>
                        <div class="product-subtitle">
                          {{ App\Models\Province::find($transaction->provinces_id)->name ?? '' }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">City</div>
                        <div class="product-subtitle">
                          {{ App\Models\Regency::where('city_id',$transaction->regencies_id)->first()->name ?? '' }}
                        </div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Postal Code</div>
                        <div class="product-subtitle">{{ $transaction->zip_code }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Country</div>
                        <div class="product-subtitle">{{ $transaction->country }}</div>
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Nomor Resi</div>
                        <div class="product-subtitle">{{ $transaction->resi ? : "Belum ada Resi" }}</div>
                        <!-- <select
                          name="shipping_status"
                          id="status"
                          class="form-control"
                          v-model="status"
                        >
                          <option value="PENDING">Pending</option>
                          <option value="SHIPPING">Shipping</option>
                          <option value="SUCCESS">Success</option>
                        </select> -->
                      </div>
                      <div class="col-12 col-md-6">
                        <div class="product-title">Phone Number</div>
                        <div class="product-subtitle">{{ $transaction->phone_number }}</div>
                      </div>
                      <!-- <template v-if="status == 'SHIPPING'">
                        <div class="col-md-3">
                          <div class="product-title">Input Resi</div>
                          <input
                            type="text"
                            class="form-control"
                            name="resi"
                            v-model="resi"
                          />
                        </div>
                        <div class="col-md-2">
                          <button
                            type="submit"
                            class="btn btn-success btn-block mt-4"
                          >
                            Update Resi
                          </button>
                        </div>
                      </template> -->
                    </div>
                  </div>
                </div> 
                <div class="row mt-4">
                  <div class="col-12 text-right">
                    <a href="{{ url()->previous() }}" class="btn btn-success btn-lg mt-4">Back</a>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('addon-script')
  <script src="/vendor/vue/vue.js"></script>
  <script>
    var transactionDetails = new Vue({
      el: "#transactionDetails",
      data: {
        status: "{{ $transaction->shipping_status }}",
        resi: "{{ $transaction->resi }}",
      },
    });
  </script>
@endpush