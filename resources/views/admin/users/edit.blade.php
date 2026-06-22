@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit User</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-8">
          <div class="card card-primary">
            <form method="POST" action="" enctype="multipart/form-data">
              {{ csrf_field() }}
              <div class="card-body row">

                <div class="form-group col-md-12">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{ old('name' , $user->name)  }}" name="name" required placeholder="Enter Name">
                </div>

                <div class="form-group col-md-12">
                  <label>Email address</label>
                  <input type="email" class="form-control" value="{{ old('email', $user->email) }}" name="email" required placeholder="Enter email">
                  <div style="color:red" >
                    {{ $errors->first('email') }}
                  </div>
                </div>

                <div class="form-group col-md-12">
                  <label>Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Password">
                  <p>Do you want to change password so please add new password</p>
                </div>

                <div class="form-group col-md-4">
                  <label>Phone 1</label>
                  <input type="text" class="form-control" value="{{ old('phone1') }}" name="phone1" placeholder="Enter Phone 1">
                </div>

                <div class="form-group col-md-4">
                  <label>Phone 2</label>
                  <input type="text" class="form-control" value="{{ old('phone2') }}" name="phone2" placeholder="Enter Phone 2">
                </div>

                <div class="form-group col-md-4">
                  <label>Phone 3</label>
                  <input type="text" class="form-control" value="{{ old('phone3') }}" name="phone3" placeholder="Enter Phone 3">
                </div>
                
                <div class="form-group col-md-2">
                  <label for="is_doctor">is doctor</label>
                  <input type="checkbox" name="is_doctor" value=1 @if (!empty($user->is_doctor)) checked @endif >
                </div>
                <div class="form-group col-md-2">
                  <label for="is_doctor">is assistant</label>
                  <input type="checkbox" name="is_assistant" value=1 @if (!empty($user->is_assistant)) checked @endif >
                </div>

            <div class="form-group col-md-12">
                <label>Status</label>
                <select class="form-control" required name="status">
                    <option value="">Select Status</option>
                    <option {{ (old('status' , $user->status) == 1 ) ? 'selected' : '' }} value="1">Active</option>
                    <option {{ (old('status' , $user->status) == 2 ) ? 'selected' : '' }} value="2">Inactive</option>
                </select>
                <div style="color:red" > {{ $errors->first('status') }} </div>
            </div>
            

              </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection