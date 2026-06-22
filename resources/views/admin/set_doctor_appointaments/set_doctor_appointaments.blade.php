@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Doctor Appointaments</h1>
        </div>
      </div>
    </div>
    <!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Search Doctor Appointaments</h3>
            </div>
            <form method="get" action="">
              <div class="card-body">
                <div class="row">
                  <div class="form-group col-md-3">
                    <label>Doctor Name</label>
                    <select class="form-control getDoctor" name="doctor_id" required>
                      <option value="">Select</option>
                      @foreach ($getDoctor as $doctor)
                      <option {{ ( Request::get('doctor_id') == $doctor->id ) ? 'selected' : '' }} value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Clinic Name</label>
                    <select class="form-control getClinic" name="clinic_id">
                      <option value="">Select</option>
                      @if (!empty($getMyClinics))
                        @foreach ($getMyClinics as $clinic)
                              <option {{ ( Request::get('clinic_id') == $clinic->clinic_id ) ? 'selected' : '' }} value="{{ $clinic->clinic_id }}">{{ $clinic->clinic_name }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <button class="btn btn-primary" type="submit" style="margin-top: 30px">Search</button>
                    <a href="{{ url('admin/set_doctor_appointaments') }}" class="btn btn-success" style="margin-top: 30px" >Reset</a>
                  </div>
                </div>
              </div>
            </form>
          </div>
          @include('_message')
          @if (!empty(Request::get('doctor_id')) && !empty(Request::get('clinic_id')))
          @if ($getIfExist->count() > 0)
          <form action="{{ url('admin/set_doctor_appointaments/add') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="doctor_id" value="{{ Request::get('doctor_id') }}">
            <input type="hidden" name="clinic_id" value="{{ Request::get('clinic_id') }}">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Doctor Timetable</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body p-0">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>Date</th>
                      <th>Start Time</th>
                      <th>End Time</th>
                      <th>Session Duration in mins</th>
                      <th>Break Duration in mins</th>
                      <th>Price</th>
                      <th>Max Requests</th>
                    </tr>
                  </thead>
                  <tbody>

                  @for ($i = 0; $i < 7; $i++)

                  @php
                    $row = $doctorClinic[$i] ?? null;
                  @endphp

                    <tr>
                      <th>
                      <input type="date" name="timetable[{{ $i }}][date]" value="{{ $row?->date }}" class="form-control minToday"></th>
                      <td>
                        <input type="time" name="timetable[{{ $i }}][start_time]" value="{{ $row?->start_time }}" class="form-control">
                      </td>
                      <td>
                        <input type="time" name="timetable[{{ $i }}][end_time]" value="{{ $row?->end_time }}" class="form-control">
                      </td>
                      <td>
                        <input type="number" name="timetable[{{ $i }}][session_duration]" min="0" value="{{ $row?->session_duration }}" class="form-control">
                      </td>
                      <td>
                        <input type="number" name="timetable[{{ $i }}][break_duration]" value="{{ $row?->break_duration }}" min="0" class="form-control">
                      </td>
                      <td>
                        <input type="number" name="timetable[{{ $i }}][price]" value="{{ $row?->price }}" min="0" class="form-control">
                      </td>
                      <td>
                        <input type="number" name="timetable[{{ $i }}][max_requests]" value="{{ $row?->max_requests }}" min="0" class="form-control">
                      </td>
                    </tr>

                  @endfor
                    
                  </tbody>
                </table>
                <div style="text-align: center; padding: 20px;"> 
                  <button class="btn btn-primary">Submit</button>
                </div>
              </div>
            </div>
          </form>
          @endif
          @endif
        </div>
      </div>
    </div>
  </section>
</div>
@endsection  
@section('script')
<script type="text/javascript">

$('.getDoctor').change(function(){
      var doctor_id = $(this).val();
      // console.log(value);
      
      $.ajax({
            url: "{{ url('admin/set_doctor_appointaments/get_clinic') }}",
            type: "POST",
            data:{
                  "_token": "{{ csrf_token() }}",
                  doctor_id:doctor_id,
            },
            dataType:"json",
            success: function (response) {
                  $('.getClinic').html(response.html)
            },
      });

});

const today = new Date().toISOString().split('T')[0];

document.querySelectorAll('.minToday').forEach(input => {
    input.setAttribute('min', today);
});

</script>
@endsection