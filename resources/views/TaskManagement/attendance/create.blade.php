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
                    <th style="width:  20%">Name</th>
                    <th style="width:  15%">ID</th>
                    <th style="width:  40%">Status</th>
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
                          <div class="icheck-success d-inline">
                            <input type="radio" name="status_{{$employee->id}}" id="statusPresence_{{$employee->id}}" 
                            value="#" onclick="preformSave({{$employee->id}})" >
                            <label for="statusPresence_{{$employee->id}}">
                              Presence
                            </label>
                          </div>
                          <div class="icheck-warning d-inline">
                            <input type="radio" name="status_{{$employee->id}}" id="statusLate_{{$employee->id}}" 
                            value="{{true}}" onclick="preformSave({{$employee->id}})">
                            <label for="statusLate_{{$employee->id}}">
                              Late
                            </label>
                          </div>
                          <div class="icheck-danger d-inline">
                            <input type="radio" name="status_{{$employee->id}}" id="statusAbsence_{{$employee->id}}" 
                            value="true" onclick="preformSave({{$employee->id}})" >
                            <label for="statusAbsence_{{$employee->id}}">
                              Absence
                            </label>
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
  function preformSave(id){
      axios.post('/Task-Management/attendances',{
        employee_id:id,
        date:{{$date}},
        presence:document.getElementById('statusPresence_{{$employee->id}}').value,
        late:document.getElementById('statusLate_{{$employee->id}}').value,
        absence:document.getElementById('statusAbsence_{{$employee->id}}').value,
        
        
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
