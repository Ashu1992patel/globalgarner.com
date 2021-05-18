@extends('master')
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{route('products.index')}}">Home</a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
            Trashed Products
        </li>
    </ol>
</nav>
<div class="d-flex align-items-center py-3">
    <h2>ALL THE TRASHED PRODUCT</h2>
</div>
<div class="tableblock p-4">
    <div class="row">
        <div class="col-sm-12" id="myProducts">
            <div class="row">
                @forelse($products as $key=>$product)
                <div class="col-sm-3 pt-4 mr-4 ml-4 ">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" src="{{ $product->custom_image }}" alt="Card image cap" style="max-height: 200px;">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="{{route('products.showTrashed', $product->id)}}" style="text-decoration: none;">
                                    {{ $product->title }}
                                </a>
                            </h5>
                            <p class="card-text">
                                {{ $product->custom_description }}
                            </p>
                            <a class="btn btn-sm btn-info float-left" href="{{  route('products.restore', $product->id) }}" title="Restore Now" style="text-decoration: none;cursor: pointer;">
                                <i class="fa fa-undo"></i>
                                Restore
                            </a>
                            <a class="btn btn-sm btn-danger float-right" href="{{  route('products.destroyPermanent', $product->id) }}" title="Remove this product permanently." style="text-decoration: none;cursor: pointer;">
                                <i class="fa fa-trash"></i>
                                Remove
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-sm-12 pt-4 " style="text-align: center;">
                    <img src="{{url('images/notfound.gif')}}" style="max-height: 250px;" alt="Not Found">
                    <p>
                        <strong>Oops!! No Record Found</strong>
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

<script>
    function removeProductPermanently(product_id) {
        if (confirm('Are you sure you want to remove this product permanently?')) {
            $('#restore-form-' + product_id).submit();
        }
    }
</script>

@endsection
@section('script')

@endsection