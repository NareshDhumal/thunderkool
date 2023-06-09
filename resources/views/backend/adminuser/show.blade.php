@extends('backend.layouts.app')
@section('title', 'View User')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Backend Users</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <a href="{{ route('admin.backendmenu') }}" class="btn btn-secondary"> Back </a>
                      </div>
                      <div class="table-responsive">
                          <table class="table table-bordered table-striped table-hover">
                              <thead>
                                  <tr>
                                      <th>ID.</th> <th>User Name</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <tr>
                                      <td>{{ $backendmenu->menu_id }}</td> <td> {{ $backendmenu->menu_name }} </td>
                                  </tr>
                              </tbody>
                          </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('public/backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

<script>
  $(document).ready(function()
  {

  });
</script>
@endsection
