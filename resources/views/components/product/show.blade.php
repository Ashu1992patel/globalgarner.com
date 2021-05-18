@extends('master')
@section('content')

<div class="tableblock">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('products.index')}}">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('products.index')}}">Product</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">
                {{ $product->title }}
            </li>
        </ol>
    </nav>

    <div class="table-header">
        <h2>Product Details</h2>
    </div>
    <div class="p-4">
        <div class="row">
            <div class="col-sm-5 pt-4 float-right">
                <div class="card" style="width: 22rem;">
                    <img class="card-img-top" src="{{  $product->custom_image }}" alt="Card image cap">
                </div>
            </div>
            <div class="col-md-7 float-left">
                <h2 class="pt-4">
                    {{ $product->title }}
                </h2>
                <p class="pt-4">
                    {{ $product->description }}
                </p>
                <p class="pt-2">
                    <label>
                        Category:
                    </label>
                    <strong class="text-blue">
                        {{ $product->category->name ?? 'N/A' }}
                    </strong>
                </p>
                <p>
                    <label>
                        Price:
                    </label>
                    <strong>
                        {{ 'Rs. '.$product->price }}
                    </strong>
                </p>
                <p>
                    <!-- <label>
                        Rating:
                    </label> -->
                    <strong>
                        @php
                        $starRate = $product->rating;
                        $rate = 5-$product->rating;
                        @endphp
                        @for($starRate; $starRate > 0; $starRate--)
                        <i class="fa fa-star fa-2x" style="color: rgb(45, 177, 255);"></i>
                        @endfor

                        @for($rate; $rate > 0; $rate--)
                        <i class="fa fa-star fa-2x"></i>
                        @endfor
                    </strong>
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-footer pt-4 mt-3">
                    <div class="com-md-4 float-left">
                        <!-- <button class="btn btn-success px-4" type="button">
                            <b>Go Back</b>
                        </button> -->
                        <a href="{{route('products.index')}}" class="btn btn-info px-4">
                            <i class="fa fa-arrow-left"></i>
                            Go Back
                        </a>
                    </div>
                    <div class="com-md-4 float-right">
                        <!-- <button class="btn btn-success px-4" type="button">
                            <b>Go Back</b>
                        </button> -->
                        <a href="{{route('products.create')}}" class="btn btn-info px-4">
                            <i class="fa fa-plus"></i>
                            Add New Product
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection