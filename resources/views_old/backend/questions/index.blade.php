@extends('backend.layouts.app')
@section('content')


    <div class="content">
        
       <section id="basic-datatable">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                             <h4 class="card-title page-title">Feedback Questions Details</h4>
                           
                            {{-- @can('Create Admin Users') --}}
                          <div class="text-end" style="position: absolute;right:50px;">
                            <a href="{{ route('admin.survey.question') }}" class="btn btn-inverse-primary btn-fw"><i class="bx bx-plus"></i> Add </a>
                            
                          </div></div>
                          {{-- @endcan --}}
                          <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable" style="white-space: nowrap;">
                                <thead>
                                    <tr>
                                        
                                    <th>#</th>
                                    <th>Questions</th>
                                    <th>Type</th>
                                    <th>Number Of Options</th>

                                    <th>Action</th>
                                      
                                    </tr>
                                </thead>
                                <tbody>
                                      @if (isset($data) && count($data) > 0)
                                      @php $srno = 1; @endphp
                                      @foreach ($data as $questiondata)
                                            <tr>
                                                       <td class='text-center'>{{ $srno }}</td>
                                                       <td>{{ $questiondata->question }}</td>
                                                       <td>{{ $questiondata->type }}</td>
                                                       <td>{{ count($questiondata->options)>0?count($questiondata->options):1 }}</td>

                                                       <td class='p-0'>
                                                        <a href="{{ url('admin/question/edit/'.$questiondata->question_id) }}" class="btn btn-primary">edit</a>
                                                        <a href="{{ url('admin/question/delete/'.$questiondata->question_id) }}" class="btn btn-danger" onclick="return confirm('Are you sure? You want to delete the entry!');">delete</a>
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
                </section>
            </div>
        
@endsection
    {{-- @foreach ($data as $variable)     --}}
    {{-- @if ($variable->type == 'cheackbox') --}}
    {{-- <div class="tab">
    <p><input placeholder="add question here..." oninput="this.className = ''" name="question"></p>
  </div>
    @else
    {{"hello"}}
    @endif --}}
{{-- @forelse ( $data as $variable)
@if($variable->type == 'checkbox') --}}

{{-- <label>{{$variable->question}}</label> --}}
{{-- <label>pls select the chekbox here</label>
<input type="text" name="checkbox"/>
 @elseif ($variable->type == 'textarea')
<label>Enter text here</label>
<input type="textarea" name="textarea"/>
  @endif
@empty
    
@endforelse --}}
  
    {{-- @endforeach --}}



{{-- @endsection
<script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
@section('scripts')
<script>
    $(document).ready(function(){
        $('#tbl-datatable').DataTable({
            dom: 'Bfrtip',
            scrollX: true,
            fixedHeader: true,
            buttons: [
                {
                    text: '<i class="feather icon-printer"></i> Print',
                    extend: 'print',
                    exportOptions: {
                        columns: [0,1]
                    },
                    title: function(){
                      var printTitle = 'Year Master';
                      return printTitle
                  },
                  className: 'btn btn-info text-white font-weight-bold pb-0 pt-0 px-1',
                  customize: function(win) {
                    $(win.document.body)
                        .css('font-size', '0.7em').css('font-family', 'calibri');

                    $(win.document.body).find('table')
                        .addClass('compact')
                        .css('font-size', 'inherit');
                    $(win.document.body).find('table tr th').css('text-align', 'center');


                        $(win.document.body).find('table tr th:nth-child(1)').css('width',
                        '20px').css('text-align', 'center');

                        $(win.document.body).find('table tr td:nth-child(1)').css('width',
                        '20px').css('text-align', 'center');

                        $(win.document.body).find('table tr th:nth-child(2)').css('width',
                        '200px').css('text-align', 'left');



                }



                },
                {
                    text: '<i class="feather icon-download-cloud"></i> Excel',
                    extend: 'excel',
                    exportOptions: {
                        columns: [0,1]
                    },

                    title: function() {
                        var printTitle = 'Year Master';
                        return printTitle
                    },
                    className: 'btn btn-success text-white font-weight-bold pb-0 pt-0 px-1',
                },
        ],
        });
    });
</script>
@endsection --}}

