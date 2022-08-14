@extends('TaskManagement.parent')

@section('page-title','Role')

@section('big-title','Edit')
@section('sm-title','Edit')

@section('content')
<section class="content">
  <div class="container-fluid">
    <div class="row">
    <!-- left column -->
    <div class="col-md-12">
      <!-- general form elements -->
      <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Edit Role</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  id="resetForm">
            @csrf
          <div class="card-body">
            
            <div class="form-group">
              <label for="Name">Name</label>
              <input type="text" class="form-control" id="name" value="{{$role->name}}"  placeholder="Enter Name">
            </div>
            
            <div class="form-group">
              <label for="guard_name">User Type</label>
              <select class="form-control" id="guard_name" >
                <option value="employee" @selected($role->guard_name=='employee')>employee</option>
              </select>
            </div>
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
        axios.put('/Task-Management/roles/{{$role->id}}',{
          name:document.getElementById('name').value,
          guard_name:document.getElementById('guard_name').value,
          
        })
        .then(function (response) {

          // handle success
          console.log(response);
          toastr.success(response.data.message);
          window.location.href='/Task-Management/roles'
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