@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Clinics</h1>
        </div>

        <div class="col-sm-6" style="text-align:right;">
          <a href="{{ url('admin/clinics/add') }}" class="btn btn-primary">Add new clinic</a>
        </div>

      </div>
    </div>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">

         <div class="card">
          <div class="card-header">
            <h3 class="card-title">Search Clinics</h3>
          </div>
          <form method="get" action="">
            <div class="card-body">
              <div class="row">

                <div class="form-group col-md-2">
                  <label>Name</label>
                  <input type="text" class="form-control" value="{{ Request::get('name') }}" name="name" placeholder="Enter Name">
                </div>

                <div class="form-group col-md-2">
                  <label>Created Date From</label>
                  <input type="date" class="form-control" value="{{ Request::get('created_date_from') }}" name="created_date_from">
                </div>

                <div class="form-group col-md-2">
                  <label>Created Date To</label>
                  <input type="date" class="form-control" value="{{ Request::get('created_date_to') }}" name="created_date_to">
                </div>

                <div class="form-group col-md-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                  <a href="{{ url('admin/clinics/list') }}" class="btn btn-success" style="margin-top: 30px" >Reset</a>
                </div>

              </div>
            </div>
          </form>
        </div>

          @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Clinics List</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>picture</th>
                    <th style="min-width: 150px;">Name</th>
                    <th style="min-width: 250px;">Address</th>
                    <th>Gps Location</th>
                    <th style="min-width: 145px;">Phone</th>
                    <th>Status</th>
                    <th style="min-width: 100px;">Created By</th>
                    <th style="min-width: 165px;">Created Date</th>
                    <th style="min-width: 165px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->image }}</td>
                        <td>{{ $value->name }}</td>
                        <td>{{ $value->address }}</td>
                        <td><a target="_blank" href="{{ $value->gps_location }}">{{ $value->gps_location }}</a></td>

                        <td>
                          <div>phone 1 : {{ $value->phone1 }}</div>
                          <div>phone 2 : {{ $value->phone2 }}</div>
                          <div>phone 3 : {{ $value->phone3 }}</div>
                        </td>

                        <td>{{ ($value->status == 1) ? 'Active' : '' }} {{ ($value->status == 2) ? 'Non Active' : '' }} {{ ($value->status != 1 && $value->status != 2) ? 'unexpected error' : '' }}</td>
                        <td>{{ $value->created_by_name }}</td>
                        <td>{{ $value->created_at }}</td>
                        <td>
                          <a href="{{ url('admin/clinics/edit/'.$value->id) }}" class="btn btn-primary">Edit</a>
                          <a href="{{ url('admin/clinics/edit/'.$value->id) }}" class="btn btn-danger">Delete</a>
                        </td>
                      </tr>
                    @empty
                      <tr>
                        <td colspan="100%"> Record Not Found </td>
                      </tr>
                    @endforelse
                </tbody>
              </table>

                <div style="padding: 10px; float:right;">
                   {!! $getRecord->appends(Request::except('page'))->links('pagination::bootstrap-5') !!} 
                </div>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection