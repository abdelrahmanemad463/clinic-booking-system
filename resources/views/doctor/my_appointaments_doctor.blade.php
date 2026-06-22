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
                <h3 class="card-title">Search Appointaments</h3>
              </div>
              <form method="get" action="">
                <div class="card-body">
                  <div class="row">

                    <div class="form-group col-md-2">
                      <label>Patient Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('patient_name') }}" name="patient_name" placeholder="Enter Patient Name">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Clinic Name</label>
                      <input type="text" class="form-control" value="{{ Request::get('clinic_name') }}" name="clinic_name" placeholder="Enter Clinic Name">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Phone Number</label>
                      <input type="number" class="form-control" value="{{ Request::get('phone_number') }}" name="phone_number" placeholder="Enter Phone Number">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Date From</label>
                      <input type="date" class="form-control" value="{{ Request::get('created_date_from') }}" name="created_date_from" placeholder="Enter Date From">
                    </div>

                    <div class="form-group col-md-2">
                      <label>Date To</label>
                      <input type="date" class="form-control" value="{{ Request::get('created_date_to') }}" name="created_date_to" placeholder="Enter Date To">
                    </div>

                    <div class="form-group col-md-2">
                      <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                      <a href="{{ url('user/my_appointaments/list') }}" class="btn btn-success" style="margin-top: 30px" >Reset</a>
                    </div>

                  </div>
                </div>
              </form>
            </div>
          
          @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">My Appointaments</h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Patient Name</th>
                    <th>Clinic</th>
                    <th>Date</th>
                    <th>Phone Number</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Session Duration (mins)</th>
                    <th>Break Duration (mins)</th>
                    <th>Price</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($getRecord as $value)
                      <tr>
                        <td>{{ $value->user_name }}</td>
                        <td>{{ $value->clinic_name }}</td>
                        <td>{{ $value->date }}</td>

                        <td>
                        <div>phone 1 : {{ $value->phone1 }}</div>
                        <div>phone 2 : {{ $value->phone2 }}</div>
                        <div>phone 3 : {{ $value->phone3 }}</div>
                        </td>

                        <td>{{ $value->start_time }}</td>
                        <td>{{ $value->end_time }}</td>
                        <td>{{ $value->session_duration }}</td>
                        <td>{{ $value->break_duration }}</td>
                        <td>{{ $value->price }}</td>
                        
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