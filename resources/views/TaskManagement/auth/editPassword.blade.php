@extends('TaskManagement.parent')

@section('page-title','Edit Password')

@section('big-title','Edit')
@section('sm-title','Edit')


@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
         <!-- general form elements -->
        <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit Password</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form  id="resetForm">
            @csrf
            <div class="card-body">
            
            <div class="form-group">
                <label for="current_password">Current Password</label>
                <input type="password" class="form-control" id="current_password"  placeholder="Enter Current Password">
            </div>
            <div class="form-group">
                <label for="new_password">New Password</label>
                <input type="password" class="form-control" id="new_password"  placeholder="Enter New Password">
            </div>
            <div class="form-group">
                <label for="new_password_confirmation">New Password Confirmation</label>
                <input type="password" class="form-control" id="new_password_confirmation"  placeholder="Enter New Password Confirmation">
            </div>

            

            <div class="card-footer">
            <button type="button" onclick="preformSave()" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
    <!-- /.card -->
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
      axios.put('/Task-Management/edit-password',{
        current_password:document.getElementById('current_password').value,
        new_password:document.getElementById('new_password').value,
        new_password_confirmation:document.getElementById('new_password_confirmation').value,
       
      })
      .then(function (response) {

        // handle success
        console.log(response);
        toastr.success(response.data.message);
        document.getElementById('resetForm').reset();
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
