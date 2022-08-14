@extends('TaskManagement.parent')

@section('page-title','Tasks')

@section('big-title','Index')
@section('sm-title','Index')


@section('content')
<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
                
  
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
                    <th style="width:  15%">Name</th>
                    <th style="width:  15%">Task leader</th>
                    <th style="width:  15%">project</th>
                    <th style="width:  15%">Status</th>
                    <th style="width:  20%">Status Setting</th>
                    <th style="width:  15%">Settings</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ( $tasks as $task)
                    <tr id="delete">
                      <td>{{$loop->index +1}}</td>
                      <td>{{$task->name}}</td>
                      <td>{{$task->taskLeaderKey}}</td>
                      <td>{{$task->projectNameKey}}</td>
                      <td> 
                        <span class="badge
                         @if ($task->status=='toDo')bg-danger 
                         @elseif($task->status=='inprogress') bg-success 
                         @elseif($task->status=='completed') bg-primary
                         @endif ">
                            {{$task->statusKey}}
                          </span>
                      </td>
                      
                      <td>
                        {{-- <div class="margin">
                          <div class="btn-group">
                            <button type="button" class="btn btn-default">Status</button>
                            <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <button class="dropdown-menu" role="menu" style="">
                              <button class="dropdown-item"  value="toDo" onclick="statusUpdate()" >To Do</button>
                              <button class="dropdown-item"   value="inprogress" onclick="statusUpdate()">Inprogress</button>
                              <button class="dropdown-item"  value="completed" onclick="statusUpdate()">Completed</button>
                              
                            </button>
                          </div>
                         
                        </div> --}}
                      </td>
          
                    <td> <div class="btn-group">
                      <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-warning">
                        <i class="fas fa-edit"></i>
                      </a>
          
                      <a  id="delete" onclick="confirmDelete('{{$task->id}}')" class="btn btn-danger">
                        <i class="fas fa-trash"></i>
                      </a>
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
    
@endsection

@section('script')

    {{-- <script>
      function statusUpdate(){
        axios.put('/Task-Management/tasks/{{$tasks->id}}',{
          // name:document.getElementById('name').value,
          // description:document.getElementById('description').value,
          status:document.getElementById('status').value,
          
          // project_id:document.getElementById('project_id').value,
          // employee_id:document.getElementById('employee_id').value,
        })
        .then(function (response) {

          // handle success
          console.log(response);
          toastr.success(response.data.message);
          window.location.href='/Task-Management/tasks'
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
    </script> --}}

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
    axios.delete('/Task-Management/tasks/'+id)
        .then(function (response) {

          // handle success
          console.log(response);
          showSwalMessage(response.data);
          document.getElementById('delete').remove();
          // $('#delete').remove();
          window.location.href="/Task-Management/tasks"
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
