@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Assign clinic to doctor</h1>
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
                        <p><b>Doctor Name</b> : {{ $getRecord->name }}</p>
                  </div>

                  @foreach ($getClinics as $clinic)
                    @php
                      $checked = "";
                    @endphp

                    @foreach ($getAssignDoctorID as $doctorAssign )
                      @if ($doctorAssign->clinic_id == $clinic->id)
                        @php
                          $checked = "checked";
                        @endphp
                      @endif
                    @endforeach 

                    <div class="form-group col-md-1">
                    {{ $clinic->name }} <input {{ $checked }} type="checkbox" name="assign_clinics[]" value={{ $clinic->id }} >
                    </div>

                  @endforeach

            </div>

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Assign</button>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection