@extends('layouts.app')

@section('content')
<form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
    @csrf
    @include('backend.product.form')
    <div class="row justify-content-end">
        <div class="col-4">
            <div class="row justify-content-end">
                <div class="col">
                    <button
                        type="button"
                        class="btn btn-warning text-white form-control"
                        onclick="window.location='{{route('product.index')}}'">
                            back
                    </button>
                </div>
                <div class="col">
                    <button
                        type="submit"
                        class="btn btn-primary form-control">
                            submit
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
