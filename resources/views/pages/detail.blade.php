@extends('layouts.app')

@section('title')
    Store Detail Page
@endsection

@section('content')
    <div class="page-content page-details"  id="gallery">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
            <div class="col-12">
                <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                    <a href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Details {{ $product->name }}</li>
                </ol>
                </nav>
            </div>
            </div>
        </div>
        </section>

        <section class="store-gallery mb-3">
        <div class="container">
            <div class="row">
            <div class="col-lg-8" data-aos="zoom-in">
                <transition name="slide-fade" mode="out-in">
                <img :src="photos[activePhoto].url" :key="photos[activePhoto].id" class="w-50 main-image" alt="">
                </transition>
            </div>
            <div class="col-lg-2">
                <div class="row">
                <div class="col-3 col-lg-12 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id" data-aos="zoom-in"
                    data-aos-delay="100">
                    <a href="#" @click="changeActive(index)">
                    <img :src="photo.url" alt="" class="w-100 thumbnail-image" :class="{ active: index == activePhoto }">
                    </a>
                </div>
                </div>
            </div>
            </div>
        </div>
        </section>

        <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
            <div class="container">
            <div class="row">
                <div class="col-lg-8">
                <h1>{{ $product->name }}</h1>
                <div class="price">Rp. {{ number_format($product->price) }}</div>
                </div>
                <div class="col-lg-2" data-aos="zoom-in">
                    @auth
                    <form action="{{ route('detail-add', $product->id) }}" method="POST" enctype="multipart/form-data">
                      @csrf
                      Stock : 
                      {{ $product->stock }}
    
                      <br>
                      <br>
                      <label for="">Stock</label>
                      <div class="d-flex my-2">
                        <button type="button" @click="GetMin()" class="btn btn-sm btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                        <input
                          type="number"
                          name="quantity"
                          class="form-control"
                          readonly
                          min="1"
                          max="{{ $product->stock }}"
                          v-model="quantity"
                          style="width: 70px !important;"
                        />
                        <button type="button" @click="GetPlush()" class="btn btn-sm btn-primary"><i class="fa fa-plus" aria-hidden="true"></i></button>
    
                      </div>
                            <button type="submit" class="btn btn-success px-4 text-white btn-block mb-3  
                                    " {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                Add to Cart
                            </button>
                        </form>
                    @else
                    Stock : 
                    {{ $product->stock }}
  
                    <br>
                    <br>    
                        <a href="{{ route('login') }}" class="btn btn-success px-4 text-white btn-block mb-3">
                            Sign in to Add Cart
                        </a>
                    @endauth
                </div>
            </div>
            </div>
        </section>

        <section class="store-description">
            <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <p><strong><u>
                         Description
                    </u></strong></p>
                {!! $product->description !!}
                </div>
            </div>
            </div>
        </section>
        </div>
    </div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>
    <script>
      var gallery = new Vue({
        el: "#gallery",
        mounted() {
          AOS.init();
        },
        data: {
          activePhoto: 0,
          quantity: 1,
          photos: [
            @foreach ($product->galleries as $gallery)
            {
              id: {{ $gallery->id }},
              url: "{{ Storage::url($gallery->photos) }}",
            },
            @endforeach
          ],
        },
        methods: {
          changeActive(id) {
            this.activePhoto = id;
          },
          GetMin(){
            if(this.quantity > 1){
              this.quantity--;
            }
          },
          GetPlush(){
            if(this.quantity < {{ $product->stock }}){
              this.quantity++;
            }
            // this.quantity += 1;
          },
        },
      });
    </script>
@endpush