@extends('TaskManagement.parent')

@section('page-title','Role')

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
            New Role
          </button>

          <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Create Role</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form  id="resetForm">
                    @csrf
                  <div class="card-body">
                    
                    <div class="form-group">
                      <label for="Name">Name</label>
                      <input type="text" class="form-control" id="name"  placeholder="Enter Name">
                    </div>
                 
                    <div class="form-group">
                      <label for="guard_name">User Type</label>
                      <select class="form-control" id="guard_name">
                        <option value="employee" >Employee</option>
                      </select>
                    </div>
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
                <th style="width: 25%">Name</th>
                <th style="width: 25%">User Type</th>
                <th style="width: 25%">Permission</th>
                <th style="width: 10%">Setting </th>
                
              </tr>
            </thead>
            <tbody>
              @foreach ( $roles as $role)
              <tr id="delete">
                <td>{{$loop->index +1}}</td>
                <td>{{$role->name}}</td>
                <td><span class="badge bg-success ">
                  {{$role->guard_name}}
                  </span>
                </td>
                <td>
                  <a href="{{route('rolePermission.edit',$role->id)}}" type="button" class="btn btn-block btn-outline-primary btn-sm">({{$role->permissions_count}}) / Permission </a>
                  
                </td>
              <td> <div class="btn-group">
                <a href="{{route('roles.edit',$role->id)}}" class="btn btn-warning">
                  <i class="fas fa-edit"></i>
                </a>

                <a href="#" id="delete" onclick="confirmDelete('{{$role->id}}')" class="btn btn-danger">
                  <i class="fas fa-trash"></i>
                </a>
                </div>
              </td>
              </tr>
              @endforeach
              
            </tbody>
          </table>
          {{$roles->links()}}
        </div>
        <!-- /.card-body -->
        
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
    axios.post('/Task-Management/roles',{
      name:document.getElementById('name').value,
      guard_name:document.getElementById('guard_name').value,
    })
    .then(function (response) {

      // handle success
      console.log(response);
      toastr.success(response.data.message);
      // document.getElementById('resetForm').reset();
      window.location.href="/Task-Management/roles"

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
            
          )
        }
        })}

  function performDelete(id){
    axios.delete('/Task-Management/roles/'+id)
        .then(function (response) {

          // handle success
          console.log(response);
          showSwalMessage(response.data);
          document.getElementById('delete').remove();
          // $('#delete').remove();
          window.location.href="/Task-Management/roles"
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