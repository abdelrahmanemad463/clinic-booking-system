@extends('layouts.app')
@section('content')

<div class="content-wrapper">

  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Edit Role</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-9">
          <div class="card card-primary">

            <form method="POST" action="">
              {{ csrf_field() }}
              <div class="card-body">
                
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{ old('name' , $getRecord->name) }}" name="name" required placeholder="Enter Name">
                </div>

                <div class="form-group">
                  <label style="margin-bottom: 20px;">Permission</label>
                  
                    @foreach ($getPermission as $value)

                      <div class="row" style="margin-bottom: 20px;">
                        <div class="col-md-3">
                          {{ $value['name'] }}
                        </div>

                        <div class="col-md-9">
                          <div class="row">
                            @foreach ($value['group'] as $group)

                                @php
                                  $checked = '';
                                @endphp

                              @foreach ($getRolePermission as $role)

                                @if ($role->permission_id == $group['id'])
                                
                                  @php
                                    $checked = 'checked';
                                  @endphp

                                @endif
                              @endforeach
                              <div class="col-md-3">
                                <input type="checkbox" {{ $checked }} value="{{ $group['id'] }}" name="permission_id[]"> {{ $group['name'] }}
                              </div>
                            @endforeach
                          </div>
                              
                        </div>
                      </div>
                      <hr>
                    @endforeach
                </div>

              </div>
              <div class="card-footer" style="text-align: right;">
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