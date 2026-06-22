@extends('layouts.app')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Notifications</h1>
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
              <h3 class="card-title">Unread Notifications</h3>
              <a style="float: right;" class="btn btn-success btn-sm" href="{{ url('user/read-all-notifications') }}">Read All</a>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Message</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                    @forelse(auth()->user()->unreadNotifications as $notification)
                      <tr>
                        <td>{{ $notification->data['content'] }}</td>
                        <td>
                          <a class="btn btn-info" href="{{ url('user/read-notification/'.$notification->id) }}">Mark As Read</a>
                          <a class="btn btn-danger" href="{{ url('user/delete-notification/'.$notification->id) }}">Delete</a>
                        </td>
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
          
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Read Notifications</h3>
              <a style="float: right;" class="btn btn-success btn-sm" href="{{ url('user/unread-all-notifications') }}">Unread All</a>
            </div>
            <div class="card-body p-0" style="overflow: auto;">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>Message</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                    @forelse($notifications as $notification)
                      <tr>
                        <td>{{ $notification->data['content'] }}</td>
                        <td>
                          <a class="btn btn-info" href="{{ url('user/unread-notification/'.$notification->id) }}">Mark As Unread</a>
                          <a class="btn btn-danger" href="{{ url('user/delete-notification/'.$notification->id) }}">Delete</a>
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
                   {!! $notifications->appends(Request::except('page'))->links('pagination::bootstrap-5') !!} 
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</div>
@endsection