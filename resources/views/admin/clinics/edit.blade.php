
@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Clinic</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9">
          <div class="card card-primary">
            <form method="POST" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-body row">

                <div class="form-group col-md-4">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{ old('name' ,$getRecord->name) }}" name="name" required placeholder="Enter Name">
                  <div style="color:red" >
                    {{ $errors->first('name') }}
                  </div>
                </div>

                <div class="form-group col-md-8">
                  <label>Gps Location</label>
                  <input type="text" class="form-control" value="{{ old('gps_location' , $getRecord->gps_location) }}" name="gps_location" placeholder="Enter Gps Location">
                </div>

                <div class="form-group col-md-12">
                  <label>Address</label>
                  <input type="text" class="form-control" value="{{ old('address' , $getRecord->address) }}" name="address" placeholder="Enter Address">
                </div>

                <div class="form-group col-md-4">
                  <label>Phone 1</label>
                  <input type="text" class="form-control" value="{{ old('phone1' , $getRecord->phone1) }}" name="phone1" placeholder="Enter Phone 1">
                </div>

                <div class="form-group col-md-4">
                  <label>Phone 2</label>
                  <input type="text" class="form-control" value="{{ old('phone2' , $getRecord->phone2) }}" name="phone2" placeholder="Enter Phone 2">
                </div>

                <div class="form-group col-md-4">
                  <label>Phone 3</label>
                  <input type="text" class="form-control" value="{{ old('phone3' , $getRecord->phone3) }}" name="phone3" placeholder="Enter Phone 3">
                </div>

                <div class="form-group col-md-2">
                  <label>Status <span style="color:red;">*</span> </label>
                  <select class="form-control" required name="status">
                      <option value="">Select Status</option>
                      <option {{ (old('status' , $getRecord->status) == 1 ) ? 'selected' : '' }} value="1">Active</option>
                      <option {{ (old('status' , $getRecord->status) == 2 ) ? 'selected' : '' }} value="2">Inactive</option>
                  </select>
                  <div style="color:red" > {{ $errors->first('status') }} </div>
                </div>
                
              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection