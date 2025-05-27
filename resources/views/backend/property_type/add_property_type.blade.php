@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Property Type</div>
                <form action="{{route('store.property_type')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="property_type_name">Property Type Name</label>
                                <input
                                    type="text"
                                    class="form-control  @error('property_type_name') is-invalid @enderror"
                                    id="property_type_name"
                                    name="property_type_name" />
                                @error('type_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="property_icon">Property Icon</label>
                                <input
                                    type="text"
                                    class="form-control @error('property_icon') is-invalid @enderror"
                                    id="property_icon"
                                    name="property_icon" />
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