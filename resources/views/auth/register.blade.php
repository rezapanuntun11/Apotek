@extends('layouts.auth')

@section('content')

<div class="page-content page-auth" id="register">
    <div class="section-store-auth" data-aos="fade-up">
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-4">
            <h2>
              Register Account
            </h2>
            <p>
              - Apotek Rizki Farma -
            </p>
            <form method="POST" action="{{ route('register') }}">
              @csrf
              <div class="form-group">
                <label>Full Name</label>
                <input id="name" type="text" v-model="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                      @error('name')
                          <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                          </span>
                      @enderror
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input id="email" 
                @change="checkForEmailAvailability()" 
                type="email" v-model="email" 
                class="form-control @error('email') is-invalid @enderror"
                :class="{ 'is-invalid' : this.email_unavailable }" 
                name="email" 
                value="{{ old('email') }}" 
                required 
                autocomplete="email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <div class="form-group">
                <label>Password Confirmation</label>
                <input id="password-confirm" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="new-password">
                    @error('password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              </div>
              <button type="submit"
              class="btn btn-success btn-block mt-4"
              :disabled="this.email_unavailable" >
                Sign Up Now
              </button>
              <a href="{{ route('login') }}" class="btn btn-signup btn-block mt-2">
                Back to Sign In
              </a>
            </form>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
  <script src="https://unpkg.com/vue-toasted"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script>
    Vue.use(Toasted);

    var register = new Vue({
      el: '#register',
      mounted() {
        AOS.init();
      },
      methods: {
        checkForEmailAvailability: function(){
          var self = this;
          axios.get('{{ route('api-register-check') }}', {
            params: {
              email: this.email
            }
          })
            .then(function (response) {
              if(response.data == 'Available') {
                self.$toasted.success(
                    "Email Available!.", {
                      position: "top-center",
                      className: "rounded",
                      duration: 5000
                }
              );
              self.email_unavailable = false;

              } else {
                self.$toasted.error(
                    "Sorry, Email already exist in our database!", {
                      position: "top-center",
                      className: "rounded",
                      duration: 5000
                }
              );
              self.email_unavailable = true;
              }
            // handle success
          console.log(response);
         });
        }
      },
      data() {
        return {
          name: "",
          email: "",
          email_unavailable: false
        }
      },
    });
  </script>
@endpush
