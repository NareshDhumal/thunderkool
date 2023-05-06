@extends('backend.layouts.app')
@section('content')
<div class="content">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats " style="padding: 40px">
              <div class="card-body ">
                <div class="row">
                  <div class="col-3 col-md-3">
                    <div class="icon-big  icon-warning">
                      <i class="nc-icon nc-single-copy-04 "></i>
                    </div>
                  </div>
                  <div class="col-9 col-md-9">
                    <div class="numbers">
                      <p class="card-category">TOTAL FEEDBACK QUESTIONS</p>
                      <p class="card-title">{{ $total_feedback_question }}<p>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats" style="padding: 40px">
              <div class="card-body ">
                <div class="row">
                  <div class="col-3 col-md-3">
                    <div class="icon-big  icon-warning">
                      <i class="nc-icon nc-bulb-63 text-success"></i>
                    </div>
                  </div>
                  <div class="col-9 col-md-9">
                    <div class="numbers">
                      <p class="card-category">TOTAL FEEDBACK  RECEIVED</p>
                      <p class="card-title">{{ $total_feedback_recived }}<p>
                    </div>
                  </div>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                
                 
                  <div class="">
                    <h5 class="mb-4">Last 10 Feedback Questions</h6>
                     
                      </table>
                      <div class="table-responsive">
                        <table class="table zero-configuration" id="tbl-datatable" style="white-space: nowrap;">
                            <thead>
                                <tr>

                                    <th style="text-align: center">Sr No</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($last_feeback) && count($last_feeback) > 0)
                                    @php $srno = 1; @endphp
                                    @foreach ($last_feeback as $last_feedback_recived)
                                        <tr>
                                            <td class='text-center'>{{ $srno }}</td>
                                            <td>{{ $last_feedback_recived->feedback_name }}</td>
                                            <td>{{ $last_feedback_recived->feedback_email }}</td>
                                            <td>{{ $last_feedback_recived->feedback_phone }}</td>

                                            <td class='p-0'>
                                                <a href="{{ url('admin/feedbacks/view/' . $last_feedback_recived->feedback_form_id) }}"
                                                    class="btn btn-primary">View</a>
                                                
                                            </td>
                                        </tr>
                                        @php $srno++; @endphp
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>




@endsection