@extends('layouts.app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users List</h1>
          </div>
          @if (!empty($PermissionAdd))
            <div class="col-sm-6" style="text-align:right;">
              <a href="{{ url('admin/users/add') }}" class="btn btn-success">Add New User</a>
            </div>
          @endif
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('_message')
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="users_list" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Is Doctor ?</th>
                    <th>Is Assistant ?</th>
                    <th>Status</th>
                    <th>Created By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    @if (!empty($PermissionEdit) || !empty($PermissionDelete))
                      <th>Action</th>
                    @endif
                    
                  </tr>
                  </thead>
                  <tbody>
                    @foreach ($users as $user)
                      <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>

                        <td>
                          <div>phone 1 : {{ $user->phone1 }}</div>
                          <div>phone 2 : {{ $user->phone2 }}</div>
                          <div>phone 3 : {{ $user->phone3 }}</div>
                        </td>

                        <td>{{ ($user->is_doctor == 1) ? 'Yes' : 'No' }}</td>
                        <td>{{ ($user->is_assistant == 1) ? 'Yes' : 'No' }}</td>
                        <td>{{ ($user->status == 1) ? 'Active' : '' }} {{ ($user->status == 2) ? 'Non Active' : '' }} {{ ($user->status != 1 && $user->status != 2) ? 'unexpected error' : '' }}</td>
                        <td>{{ $user->created_by_name }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>

                        
                          @if (!empty($PermissionEdit) || !empty($PermissionDelete))
                            <td>
                              <div class="btn-group">
                              <button type="button" class="btn btn-info">Action</button>
                              <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                              </button>

                                <div class="dropdown-menu" role="menu" style="">

                                @if (!empty($PermissionEdit))
                                  <a class="dropdown-item" href="{{ url('admin/users/edit/'.$user->id) }}">Edit</a>
                                @endif

                                @if (!empty($PermissionDelete))
                                  <a class="dropdown-item" href="{{ url('admin/users/delete/'.$user->id) }}">Delete</a>
                                @endif  
                                  
                                </div>

                              </div>
                            </td>
                          @endif 
                        

                      </tr>
                    @endforeach ()
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>

</div>

@endsection  

@section('script')

<script>
  $(function () {
    $("#users_list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#users_list_wrapper .col-md-6:eq(0)');
  });
</script>
@endsection