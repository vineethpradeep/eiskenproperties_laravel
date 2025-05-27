@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Property Type</div>
                <form action="{{route('update.property_type')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$type->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="property_type_name">Property Type Name</label>
                                <input
                                    type="text"
                                    class="form-control  @error('property_type_name') is-invalid @enderror"
                                    id="property_type_name"
                                    name="property_type_name"
                                    value="{{$type->property_type_name}}" />
                                @error('property_type_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="property_icon">Property Icon</label>
                                <input
                                    type="text"
                                    class="form-control @error('property_icon') is-invalid @enderror"
                                    id="property_icon"
                                    name="property_icon"
                                    value="{{$type->property_icon}}" />
                                @error('property_icon')
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