@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Feature</div>
                <form action="{{route('update.feature')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$feature->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="feature_name">Feature Name</label>
                                <input
                                    type="text"
                                    class="form-control  @error('feature_name') is-invalid @enderror"
                                    id="feature_name"
                                    name="feature_name"
                                    value="{{$feature->feature_name}}" />
                                @error('feature_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-action">
                        <button class="btn btn-success" type="submit">Submit</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
</div>
@endsection