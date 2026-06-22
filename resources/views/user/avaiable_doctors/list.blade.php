@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Available Doctors</h1>
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
            <h3 class="card-title">Search Doctors</h3>
          </div>
          <form method="get" action="">
            <div class="card-body">
              <div class="row">

                <div class="form-group col-md-2">
                  <label>Doctor Name</label>
                  <input type="text" class="form-control" value="{{ Request::get('doctor_name') }}" name="doctor_name" placeholder="Enter Doctor Name">
                </div>

                <div class="form-group col-md-2">
                  <label>Clinic Name</label>
                  <input type="text" class="form-control" value="{{ Request::get('clinic_name') }}" name="clinic_name" placeholder="Enter Clinic Name">
                </div>

                <div class="form-group col-md-2">
                  <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                  <a href="{{ url('user/avaiable_doctors/list') }}" class="btn btn-success" style="margin-top: 30px" >Reset</a>
                </div>

              </div>
            </div>
          </form>
        </div>

          @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Available Doctors List</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>picture</th>
                    <th style="min-width: 150px;">Doctor Name</th>
                    <th style="min-width: 150px;">Clinic Name</th>
                    <th style="min-width: 250px;">Clinic Address</th>
                    <th>Clinic Gps Location</th>
                    <th style="min-width: 145px;">Clinic Phone</th>
                    <th>Clinic Description</th>
                    <th style="min-width: 165px;">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($getRecord as $value)
                      <tr>
                        <td>{{ $value->id }}</td>
                        <td>{{ $value->image }}</td>
                        <td>{{ $value->doctor_name }}</td>
                        <td>{{ $value->clinic_name }}</td>
                        <td>{{ $value->address }}</td>
                        <td><a target="_blank" href="{{ $value->gps_location }}">{{ $value->gps_location }}</a></td>

                        <td>
                          <div>phone 1 : {{ $value->phone1 }}</div>
                          <div>phone 2 : {{ $value->phone2 }}</div>
                          <div>phone 3 : {{ $value->phone3 }}</div>
                        </td>

                        <td>{{ $value->description }}</td>
                        <td>
                          <a href="{{ url('user/avaiable_doctors/timetable/'.$value->doctor_id.'/'.$value->clinic_id) }}" class="btn btn-primary">timetable</a>
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