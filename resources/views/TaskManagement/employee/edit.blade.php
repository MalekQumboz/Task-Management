@extends('TaskManagement.parent')

@section('page-title','Employee')

@section('big-title','Create')
@section('sm-title','Create')

@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create Employee</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form id="resetForm">
              @csrf
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" value="{{$employees->name}}" placeholder="Enter Name">
                    </div>
                    
                    <div class="form-group">
                      <label for="gender">Gender</label>
                      <select class="form-control" id="gender">
                        <option value="M"   @selected($employees->gender=='M')>Male</option>
                        <option value="F"  @selected($employees->gender=='F')>Female</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label for="birthday">Date of Birth</label>
                      <input type="date" class="form-control" id="birthday" value="{{$employees->birthday}}" placeholder="Enter Date of Birth">
                    </div>
                    
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" class="form-control" id="email" value="{{$employees->email}}" placeholder="Enter Email">
                    </div>

                    <div class="form-group">
                      <label for="phone" >Phone </label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="fas fa-phone"></i></span>
                        </div>
                        <input type="text" id="phone" value="{{$employees->phone}}" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="numeric">
                      </div>
                    </div>
    
                  </div>
                  <div class="col-md-6">

                    <div class="form-group">
                      <label for="department">Department</label>
                      <select class="form-control" id="department">
                          <option value="HR"  @selected($employees->department=='HR')>HR</option>
                          <option value="PM" @selected($employees->department=='PM')>Project Manager</option>
                          <option value="E" @selected($employees->department=='E')>Employee</option>
                      </select>
                    </div> 

                    <div class="form-group">
                      <label for="salary">Salary</label>
                      <input type="number" class="form-control" id="salary" value="{{$employees->salary}}" placeholder=" Enter Salary">
                    </div>
                    <div class="form-group">
                      <label for="hiring">Hiring Date</label>
                      <input type="date" class="form-control" id="hiring" value="{{$employees->hiring}}" placeholder="Enter Hiring Date">
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" onclick="preformUpdate()" class="btn btn-primary">Save</button>
              </div>
            </form>


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
      function preformUpdate(){
        axios.put('/Task-Management/employees/{{$employees->id}}',{
          name:document.getElementById('name').value,
          gender:document.getElementById('gender').value,
          birthday:document.getElementById('birthday').value,
          email:document.getElementById('email').value,
          phone:document.getElementById('phone').value,
          department:document.getElementById('department').value,
          salary:document.getElementById('salary').value,
          hiring:document.getElementById('hiring').value,
          // password:document.getElementById('password').value,
        })
        .then(function (response) {

          // handle success
          console.log(response);
          toastr.success(response.data.message);
          window.location.href='/Task-Management/employees'
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