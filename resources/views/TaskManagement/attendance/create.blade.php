@extends('TaskManagement.parent')

@section('page-title','Attendances')

@section('big-title','Attendances')
@section('sm-title','Attendances')


@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                
                
                <h3 class="card-title">today's date: {{$date}}  </h3>
             
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">
  
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <table class="table">
                <thead>
                  <tr>
                    <th style="width: 10%">#</th>
                    <th style="width:  30%">Name</th>
                    <th style="width:  10%">ID</th>
                    <th style="width:  35%">Status</th>
                    <th style="width:  15%">Edit</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ( $employees as $employee)
                  <tr id="delete">
                    <td>{{$loop->index +1}}</td>
                    <td>{{$employee->name}}</td>
                    <td>{{$employee->id}}</td>
                    
                    <td> 
           
                        <!-- radio -->
                        <div class="form-group clearfix">
                          
                          
                          @if ($employee->id == $employee->EmployeeAttendanceID)
                          <div class="icheck-success d-inline">
                            <input type="radio" disabled name="status_{{$employee->id}}" id="statusPresence_{{$employee->id}}" 
                             onclick="preformSave('{{$employee->id}}','presence')" @checked($employee->StatusKey=='presence')>
                            <label for="statusPresence_{{$employee->id}}">
                              Presence
                            </label>
                          </div>

                          <div class="icheck-warning d-inline">
                            <input type="radio" disabled name="status_{{$employee->id}}" id="statusLate_{{$employee->id}}" 
                            onclick="preformSave('{{$employee->id}}','late')" @checked($employee->StatusKey=='late')>
                            <label for="statusLate_{{$employee->id}}">
                              Late
                            </label>
                          </div>

                          <div class="icheck-danger d-inline">
                            <input type="radio" disabled name="status_{{$employee->id}}" id="statusAbsence_{{$employee->id}}" 
                            onclick="preformSave('{{$employee->id}}','absence')"  @checked($employee->StatusKey=='absence') >
                            <label for="statusAbsence_{{$employee->id}}">
                              Absence
                            </label>
                          </div>
                          @else

                          <div class="icheck-success d-inline">
                            <input type="radio" name="status_{{$employee->id}}" id="statusPresence_{{$employee->id}}" 
                             onclick="preformSave('{{$employee->id}}','presence')" >
                            <label for="statusPresence_{{$employee->id}}">
                              Presence
                            </label>
                          </div>

                          <div class="icheck-warning d-inline">
                            <input type="radio" name="status_{{$employee->id}}" id="statusLate_{{$employee->id}}" 
                            onclick="preformSave('{{$employee->id}}','late')">
                            <label for="statusLate_{{$employee->id}}">
                              Late
                            </label>
                          </div>

                          <div class="icheck-danger d-inline">
                            <input type="radio" name="status_{{$employee->id}}" id="statusAbsence_{{$employee->id}}" 
                            onclick="preformSave('{{$employee->id}}','absence')" >
                            <label for="statusAbsence_{{$employee->id}}">
                              Absence
                            </label>
                          </div>
                          @endif
                        </div>
                    </td>
                    <td>
                      <div class="margin">
                        <div class="btn-group">
                          <button type="button" class="btn btn-default">Status</button>
                          <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu" role="menu" style="">
                            <button   onclick="statusUpdate('presence','{{$employee->attendanceID}}')" class="dropdown-item" >Presence</button>
                            <button  onclick="statusUpdate('late','{{$employee->attendanceID}}')" class="dropdown-item" >Late</button>
                            <button   onclick="statusUpdate('absence','{{$employee->attendanceID}}')" class="dropdown-item" >Absence</button>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
              </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@section('style')
    <!-- iCheck for checkboxes and radio inputs -->
    <link rel="stylesheet" href="{{asset('Task-Management/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

@endsection

@section('script')
<script>
  function statusUpdate(statusValue,id){
    axios.put('/Task-Management/attendances/'+id,{
      status:statusValue,
      
    })
    .then(function (response) {

      // handle success
      console.log(response);
      toastr.success(response.data.message);
      window.location.href='/Task-Management/attendances/create'
    })
    .catch(function (error) {
      // handle error
      console.log(error);
      toastr.error(error.response.data.message)
    })
    .then(function () {
      // always executed
    });

  }
</script>

<script>
  function preformSave(id,attendanceStatuse){
      axios.post('/Task-Management/attendances',{
        employee_id:id,
        // date:{{$date}},
        status:attendanceStatuse,
        
      })
      .then(function (response) {
  
        // handle success
        console.log(response);
        toastr.success(response.data.message);
        window.location.href='/Task-Management/attendances/create'
        
      })
      .catch(function (error) {
        // handle error
        console.log(error);
        toastr.error(error.response.data.message)
      })
      .then(function () {
        // always executed
      });
  }
  </script> 
@endsection
