@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Add Amenities</div>
                <form action="{{route('store.amenitie')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="amenitie_name">Amenitie Name</label>
                                <input
                                    type="text"
                                    class="form-control  @error('amenitie_name') is-invalid @enderror"
                                    id="amenitie_name"
                                    name="amenitie_name" />
                                @error('amenitie_name')
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