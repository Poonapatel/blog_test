@extends('layouts.app')

@section('style')
<!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" /> -->
<link rel="stylesheet" type="text/css" href="{{ asset('select2/dist/css/select2.min.css') }}">

<style type="text/css">
    body {
        background-color: #f2e4bd;
    }
</style>

@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add New Blog') }}</div>

                <div class="card-body">
                <a href="{{ route('home')}}" class="btn btn-info"> Home </a>
                    <form method="POST" action="{{ route('add-blog-submit') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea rows="5" class="form-control @error('description') is-invalid @enderror" name="description" value="" required >{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Add Categories ') }}</label>

                            <div class="col-md-6">
                               <select class="form-control js-example-basic-single" name="categories[]" required="" multiple="multiple">
                                @foreach($categories as $cat)
                                  <option value="{{ $cat->id }}"> {{ $cat->name }}</option>            
                                @endforeach
                                </select>

                                @error('categories')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Blog') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script') 
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script> -->
<script src="{{ asset('select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('select2/dist/js/select2.min.js') }}"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

@endsection