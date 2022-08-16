@extends('TaskManagement.parent')

@section('page-title','Employee')

@section('big-title','Index')
@section('sm-title','Index')


@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
              New Employee
            </button>

            <div class="modal fade" id="modal-lg">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 class="modal-title">Create Employee</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="resetForm">
                      @csrf
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="name">Name</label>
                              <input type="text" class="form-control" id="name" placeholder="Enter Name">
                            </div>
                            
                            <div class="form-group">
                              <label for="gender">Gender</label>
                              <select class="form-control" id="gender">
                                <option value="M" >Male</option>
                                <option value="F">Female</option>
                              </select>
                            </div>
                            <div class="form-group">
                              <label for="birthday">Date of Birth</label>
                              <input type="date" class="form-control" id="birthday" placeholder="Enter Date of Birth">
                            </div>
                            
                            <div class="form-group">
                              <label for="email">Email</label>
                              <input type="email" class="form-control" id="email" placeholder="Enter Email">
                            </div>
        
                            <div class="form-group">
                              <label for="phone" >Phone </label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                </div>
                                <input type="text" id="phone" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="numeric">
                              </div>
                            </div>
            
                          </div>
                          <div class="col-md-6">
        
                            <div class="form-group">
                              <label for="department_id">Department</label>
                              <select class="form-control" id="department_id">
                                @foreach ($departmentRole as $department )
                                <option value="{{$department->id}}">{{$department->name}}</option>
                                @endforeach
                              </select>
                            </div> 
        
                            <div class="form-group">
                              <label for="salary">Salary</label>
                              <input type="number" class="form-control" id="salary" placeholder=" Enter Salary">
                            </div>
                            <div class="form-group">
                              <label for="hiring">Hiring Date</label>
                              <input type="date" class="form-control" id="hiring" placeholder="Enter Hiring Date">
                            </div>
                            
                          </div>
                        </div>
                      </div>
                      <!-- /.card-body -->
                    </form>
                  </div>
                  <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" onclick="preformSave()" class="btn btn-primary">Save</button>
                  </div>
                </div>
                <!-- /.modal-content -->
              </div>
            </div>
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
                  <th style="width: 5%">#</th>
                  <th style="width: 20%">Name</th>
                  <th style="width: 20%">Email</th>
                  <th style="width: 15%">phone</th>
                  <th style="width: 20%">Department</th>
                  <th style="width: 10%">Salary </th>
                  <th style="width: 10%">Settings </th>
                  
                </tr>
              </thead>
              <tbody>
                @foreach ( $employees as $employee)
                <tr id="delete">
                  <td>{{$loop->index +1}}</td>
                  <td>{{$employee->name}}</td>
                  <td>{{$employee->email}}</td>
                  <td>{{$employee->phone}} </td>
                  <td> 
                 
                    {{$employee->roles[0]->name}}
                  </td>
                  
                  <td>{{$employee->salary}}</td>
      
                <td> <div class="btn-group">
                  <a href="{{route('employees.edit',$employee->id)}}" class="btn btn-warning">
                    <i class="fas fa-edit"></i>
                  </a>
      
                  <a  id="delete" onclick="confirmDelete('{{$employee->id}}')" class="btn btn-danger">
                    <i class="fas fa-trash"></i>
                  </a>
                  </div>
                </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
            {{$employees->links()}}
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
   
@endsection

@section('style')

@endsection

@section('script')
<script>
  function preformSave(){
    axios.post('/Task-Management/employees',{
      name:document.getElementById('name').value,
      gender:document.getElementById('gender').value,
      birthday:document.getElementById('birthday').value,
      email:document.getElementById('email').value,
      phone:document.getElementById('phone').value,
      department_id:document.getElementById('department_id').value,
      salary:document.getElementById('salary').value,
      hiring:document.getElementById('hiring').value,
      // password:document.getElementById('password').value,
    })
    .then(function (response) {

      // handle success
      console.log(response);
      toastr.success(response.data.message);
      // document.getElementById('resetForm').reset();
      window.location.href="/Task-Management/employees"

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
  function confirmDelete(id){
    Swal.fire({
    title: 'Are you sure?',
    text: "You won't be able to revert this!",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire(
          performDelete(id),
          'Deleted!',
          'Your file has been deleted.',
          'success'
        )
      }
      })}

      function performDelete(id){  
        axios.delete('/Task-Management/employees/'+id)
        .then(function (response) {

          // handle success
          console.log(response);
          showSwalMessage(response.data);
          document.getElementById('delete').remove();
          
          // window.location.href="/Task-Management/employees"
        })
        .catch(function (error) {
          // handle error
          console.log(error);
          showSwalMessage(error.response.data);
        })
        .then(function () {
          // always executed
        });
  }

  function showSwalMessage(data){
    Swal.fire(
            data.title,
            data.message,
            data.icon
          )
  }
  </script>
@endsection




