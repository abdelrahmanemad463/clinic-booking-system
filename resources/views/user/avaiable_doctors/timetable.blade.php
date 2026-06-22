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

          @include('_message')
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Timetable of Doctor : {{ $doctorName->name }} & Clinic : {{ $clinicName->name }} </h3>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <!-- <th>ID</th> -->
                    <th>Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Session Duration (mins)</th>
                    <th>Break Duration (mins)</th>
                    <th>Price</th>
                    <th>Max Requests</th>
                    <th>Remaining Requests</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                    @forelse($getRecord as $value)
                      <tr>
                        <!-- <td>{{ $value->id }}</td> -->
                        <td>{{ $value->date }}</td>
                        <td>{{ $value->start_time }}</td>
                        <td>{{ $value->end_time }}</td>
                        <td>{{ $value->session_duration }}</td>
                        <td>{{ $value->break_duration }}</td>
                        <td>{{ $value->price }}</td>
                        <td>{{ $value->max_requests }}</td>
                        <td>{{ $value->max_requests }}</td>

                        @php
                          if(!empty(Auth::user()->id)){
                            $CheckIfExist = App\Models\Bookings::CheckIfExist(Auth::user()->id , $value->doctor_id , $value->clinic_id , $value->date);
                          }else{
                            $CheckIfExist = collect();;
                          }
                        @endphp
                        
                        @if ($CheckIfExist->count() > 0)
                          <td>
                            <form action="{{ url('user/avaiable_doctors/remove_book') }}" method="post">
                              {{ csrf_field() }}
                              <input type="hidden" name="id" value={{ $value->id }}>
                              <button class="btn btn-danger">Remove Book</button>
                            </form>
                          </td>
                        @else
                        <td>
                          <form action="{{ url('user/avaiable_doctors/book') }}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" value={{ $value->id }}>
                            <button class="btn btn-primary">Book</button>
                          </form>
                        </td>
                        @endif
                        

                      </tr>
                    @empty
                      <tr>
                        <td colspan="100%"> Record Not Found </td>
                      </tr>
                    @endforelse
                </tbody>
              </table>
                
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection