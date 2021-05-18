@extends('master')
@section('content')

<div class="d-flex align-items-center py-3">
    <h2>Add New Product</h2>
</div>
<div class="tableblock p-4">
    <div class="row">
        <div class="col-md-9 order-1 order-md-0">
            <form class="form" action="{{route('products.store')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="title">
                                Title
                            </label>
                            <input type="text" maxlength="50" class="form-control" name="title" id="title" value="{{ old('title') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="image">
                                Image URL
                            </label>
                            <input type="url" class="form-control" value="{{ old('image') }}" name="image" id="image" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="categories">
                                Category
                            </label>
                            <select class="form-control" name="categories" id="categories">
                                @forelse($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->name }}
                                </option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="price">
                                Price
                            </label>
                            <input type="number" value="0.00" class="form-control" name="price" id="price" value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="rating">
                                Rating
                            </label>
                            <input type="number" min="1" max="5" minlength="1" maxlength="2" value="4" class="form-control" name="rating" id="rating" value="{{ old('rating') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group pt-4">
                            <input type="radio" class="radio" name="stock" value="0" checked="{{ old('stock')==0?'checked':'' }}">
                            out of stock
                            <br>
                            <input type="radio" class="radio" name="stock" value="1" checked="{{ old('stock')==1?'checked':'' }}">
                            in stock

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="description">
                                Description
                            </label>
                            <textarea class="form-control" maxlength="150" required name="description" id="description">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-success px-4" type="submit">
                            <b>Add Product</b>
                        </button>
                        <a href="{{route('products.index')}}" class="btn blue-text">Cancel</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-3 order-0 order-md-1">
            <div class="text-center mt-4">
                <img class="mw-100" src="./images/upload-img.png" alt="">
            </div>
        </div>
    </div>
</div>

@endsection