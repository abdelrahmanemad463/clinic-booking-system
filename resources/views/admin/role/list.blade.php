@extends('layouts.app')

@section('content')
  

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Role</h1>
        </div>

        <div class="col-sm-6" style="text-align:right;">
          @if (!empty($PermissionAdd))
            <a href="{{ url('admin/role/add') }}" class="btn btn-primary">Add new Role</a>
          @endif
      </div>

      </div>
    </div>
  </div>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        @include('_message')
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Role List</h3>
            <!-- <a href="{{ url('panel/role/add') }}" class="btn-sm btn-primary" style="float: right;">Add new Role</a> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0" style="overflow: auto;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Date</th>
                  @if (!empty($PermissionEdit) || !empty($PermissionDelete))
                    <th>Action</th>
                  @endif
                </tr>
              </thead>
              <tbody>
                @foreach ($getRecord as $value)
                
                <tr>
                  <td>{{ $value->id }}</td>
                  <td>{{ $value->name }}</td>
                  <td>{{ $value->created_at }}</td>
                  <td>
                    @if (!empty($PermissionEdit))
                      <a href="{{ url('admin/role/edit/'.$value->id) }}" class="btn btn-primary btn-sm">Edit</a>
                    @endif
                    @if (!empty($PermissionDelete))
                      <a href="{{ url('admin/role/delete/'.$value->id) }}" class="btn btn-danger btn-sm">Delete</a>
                    @endif
                  </td>
                </tr>

              @endforeach
              </tbody>
            </table>
            <div style="padding: 10px; float:right;">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>

@endsection  