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
          <h3 class="card-title"></h3>
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
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
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