@extends('admin.admin_dashboard')
@section('admin')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Edit Amenitie</div>
                <form action="{{route('update.amenitie')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$type->id}}">
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group">
                                <label for="amenitie_name">Amenitie Name</label>
                                <input
                                    type="text"
                                    class="form-control  @error('amenitie_name') is-invalid @enderror"
                                    id="amenitie_name"
                                    name="amenitie_name"
                                    value="{{$amenitie->amenitie_name}}" />
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