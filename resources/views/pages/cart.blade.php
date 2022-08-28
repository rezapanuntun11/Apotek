@extends('layouts.app')

@section('title')
    Store Cart Page
@endsection

@section('content')
    <div class="page-content page-cart">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Cart</li>
                </ol>
                </nav>
            </div>
            </div>
        </div>
        </section>

        <section class="store-cart">
        <div class="container">
          {{-- session error --}}
          @if (session('error'))

          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif
            <div class="row" data-aos="fade-up" data-aos-delay="100">
            <div class="col-12 table-responsive">
                <table class="table table-borderless table-cart">
                <th>
                    <tr>
                    <td><u><strong>Image</strong></u></td>
                    <td><u><strong>Product Name</strong></u></td>
                    <td><u><strong>Price</strong></u></td>
                    <td><u><strong>Quantity</strong></u></td>
                    <td><u><strong>Menu</strong></u></td>
                    </tr>
                </th>
                <tbody>
                    @php $totalPrice = 0 @endphp
                  @foreach ($carts as $cart)
                    <tr>
                      <td style="width: 20%;">
                        @if($cart->product->galleries)
                          <img
                            src="{{ Storage::url($cart->product->galleries->first()->photos) }}"
                            alt=""
                            class="cart-image"
                          />
                        @endif
                      </td>
                      <td style="width: 30%;">
                        <div class="product-title">{{ $cart->product->name }}</div>
                      </td>
                      <td style="width: 30%;">
                        <div class="product-title">Rp. {{ number_format($cart->product->price) }}</div>
                        <div class="product-subtitle">Rupiah</div>
                      </td>
                      <td style="width: 10%;">
                        <div class="product-title">{{ $cart->quantity }}</div>
                      </td>
                      <td style="width: 20%;">
                        <form action="{{ route('cart-delete', $cart->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-remove-cart" type="submit">
                            Remove
                          </button>
                        </form>
                      </td>
                    </tr>
                    @php $totalPrice += $cart->quantity * $cart->product->price @endphp
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr />
            </div>
            <div class="col-12">
              <h2 class="mb-4">Shipping Details</h2>
            </div>
          </div>
          <form action="{{ route('checkout') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="total_price" id="total_price" value="{{ $totalPrice }}">
            <input type="hidden" name="total_pay" id="total_pay" value="{{ $totalPrice }}">
            <input type="hidden" name="ship_total" id="ship_total" value="">
            <div class="row mb-2" data-aos="fade-up" data-aos-delay="200" id="locations">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_one">Address 1</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address_one"
                    name="address_one"
                    value="{{ Auth::user()->address_one }}"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="address_two">Address 2</label>
                  <input
                    type="text"
                    class="form-control"
                    id="address_two"
                    name="address_two"
                    value="{{ Auth::user()->address_two }}"
                  />
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="provinces_id">Province</label>
                  <select name="provinces_id" id="provinces_id" class="form-control" v-model="provinces_id" v-if="provinces">
                    <option v-for="province in provinces" :value="province.province_id">@{{ province.province }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="regencies_id">City</label>
                  <select name="regencies_id" id="regencies_id" class="form-control" v-model="regencies_id" v-if="regencies">
                    <option v-for="regency in regencies" :value="regency.city_id">@{{regency.city_name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="zip_code">Postal Code</label>
                  <input
                    type="text"
                    class="form-control"
                    id="zip_code"
                    name="zip_code"
                    value="{{ Auth::user()->zip_code }}"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="courier_code">Kurir</label>
                  <select name="courier_code" id="courier_code" class="form-control" v-model="courier_code" v-if="couriers">
                    <option v-for="courier in couriers" :value="courier.code">@{{courier.name }}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="costService">Harga Pengiriman</label>
                  <select name="costService" id="costService" class="form-control" v-model="costService" v-if="costs">
                    <option v-for="costed in costs" :value="costed.cost[0].value+'|'+costed.service">@{{costed.service}}-@{{costed.cost[0].value}}</option>
                  </select>
                  <select v-else class="form-control"></select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="country">Country</label>
                  <input
                    type="text"
                    class="form-control"
                    id="country"
                    name="country"
                    value="Indonesia"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone_number">Phone Number</label>
                  <input
                    type="text"
                    class="form-control"
                    id="phone_number"
                    name="phone_number"
                    value="{{ Auth::user()->phone_number }}"
                  />
                </div>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="150">
              <div class="col-12">
                <hr />
              </div>
              <div class="col-12">
                <h2 class="mb-1">Payment Informations</h2>
              </div>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="200">
              <div class="col-4 col-md-3">
                <div class="product-title">Rp.0</div>
                <div class="product-subtitle">Product Insurance</div>
              </div>
              <div class="col-4 col-md-3">
                <div class="product-title" id="courier_cost">Rp.0</div>
                <div class="product-subtitle">Shipping Cost</div>
              </div>
              <div class="col-4 col-md-3">
                <div class="product-title text-success" id="grand_total">Rp. {{ number_format($totalPrice ?? 0) }}</div>
                <div class="product-subtitle">Total</div>
              </div>
              <div class="col-8 col-md-3">
                <button
                  type="submit"
                  class="btn btn-success mt-4 px-4 btn-block"
                  {{  (!empty($cart)) ? '' : 'disabled'  }}
                >
                  Checkout Now
                </button>
              </div>
            </div>
          </form>
        </div>
      </section>
    </div>
@endsection

@push('addon-script')
<script src="/vendor/jquery/jquery.slim.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/vendor/vue/vue.js"></script>
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
          this.getProvincesData();
          this.getCourierData()
          
        },
        data: {
          provinces: null,
          regencies: null,
          couriers: null,
          costs:[],
          user_id: {{ Auth::user()->id }},
          courier_cost:0,
          service:null,
          description:null,
          costService:null,
          provinces_id: null,
          regencies_id: null,
          courier_code: null,
          courier_service:null,
        },
        methods: {
          getProvincesData() {
            var self = this;
            axios.get('{{ route('get-provinces') }}')
              .then(function (response) {
                  self.provinces = response.data;
              })
          },
          getRegenciesData() {
            var self = this;
           
            axios.get('{{ url('api/get-cities') }}/' + self.provinces_id)
              .then(function (response) {
                  self.regencies = response.data;
              })
          },
          getCourierData() {
           var self = this
            axios.get('{{ url('api/get-courier') }}')
              .then(function (response) {
                self.couriers = response.data;
              })
          },
          checkOngkir() {
            var self = this;
            var destination = self.regencies_id
            axios.post('{{ url('api/check-ongkir') }}',{destination:self.regencies_id,courier:self.courier_code,user_id:self.user_id})
              .then(function (response) {
                self.costs = response.data['rajaongkir']['results'][0].costs
              
              })
          },
          getTotal(){
            var self = this;
            let shipping = self.costService.split("|")
            
            self.courier_cost = shipping[0];
            self.courier_service = shipping[1]
            let formatCost = parseFloat(self.courier_cost);
            document.getElementById('courier_cost').innerHTML = `Rp. ${formatCost}`
            let total = document.getElementById('total_pay').value;
            let totalPayment = parseInt(total) + parseInt(self.courier_cost)
            let formatPayment = parseFloat(totalPayment);
            document.getElementById('grand_total').innerHTML = `Rp. ${formatPayment}`
            document.getElementById('total_price').value = formatPayment
            document.getElementById('ship_total').value = formatCost
          }
        },
        watch: {
          provinces_id: function (val, oldVal) {
            this.regencies_id = null;
            this.getRegenciesData();
            
          },
          courier_code:function(val,oldVal){
           
            this.checkOngkir()
          },
          costService:function(val,oldVal){
            this.getTotal()
          }
        }
      });
    </script>
@endpush