@extends('layout.main')
@section('head')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
@section('contentId',"result")
@section('content')

{{-- section content: products list --}}
<div id="sc-products" class="container-fluid">
    <div class="container">

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-light px-0">
                <li class="breadcrumb-item">
                    <b><a class="text-primary" href="{{ url('') }}"><i class="fas fa-home"></i>&nbsp;Home</a></b></li>
                <li class="breadcrumb-item">Product</li>
                <li class="breadcrumb-item active" aria-current="page">{{ ucfirst($page) }}</li>
            </ol>
        </nav>
        <div class="card-wrapper container">
            <div class="row justify-content-md-start justify-content-around products-card-wrapper">
                @php
                if(empty($products[0]))
                {
                echo '
                <div class="col text-center">
                    <h3>Belum ada product</h3>
                </div>';
                }
                foreach ($products as $k => $d) {

                @endphp
                <a class="card products-card mx-1 col-md-3 col-sm-4"
                    href="{{ url('products/') }}/{{ $d->short?$d->short:$d->id }}" data-type="{{ $d->type }}">
                    <div class="card-img">
                        <img src="{{ !empty($d->img[0]) ? $d->img[0] : '' }}">
                    </div>
                    <div class="card-header text-left">
                        <h5 class="product-name font-light mb-1">{{ $d->brand }}</h5>
                        <h5 class="product-author">{{ $d->name }}</h5>
                        <h5 class="products-type mb-2">
                            @php
                            if($d->type == "motor"){
                            @endphp
                            <i class="fas fa-motorcycle"></i>
                            @php
                            }
                            else{
                            @endphp
                            <i class="fas fa-car"></i>
                            @php
                            }
                            @endphp
                        </h5>
                        <h6 class="product-price font-bold text-blue">{{ formating($d->price,'price') }}</h5>
                    </div>
                </a>
                @php

                }
                @endphp
            </div>
        </div>
    </div>
</div>
@endsection