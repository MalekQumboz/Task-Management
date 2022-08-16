@extends('TaskManagement.parent')

@section('page-title','Project Tasks')

@section('big-title','Project Tasks')
@section('sm-title','Project Tasks')


@section('content')
<div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Project ({{$projects->name}}) - Tasks</h3>
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
              <th style="width:  25%">Status Settings</th>
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
                <div class="margin">
                  <div class="btn-group">
                    <button type="button" class="btn btn-default">Status</button>
                    <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <button value="toDo"  onclick="statusUpdate('toDo','{{$task->id}}')" class="dropdown-item" >To Do</button>
                      <button value="inprogress" onclick="statusUpdate('inprogress','{{$task->id}}')" class="dropdown-item" >Inprogress</button>
                      <button value="completed"  onclick="statusUpdate('completed','{{$task->id}}')" class="dropdown-item" >Completed</button>
                    </div>
                  </div>
                </div>
              </td>
              </tr>
              @endforeach
          </tbody>
        </table>
        {{$tasks->links()}}
      </div>
      <!-- /.card-body -->
     
    </div>
    <!-- /.card -->

    
    <!-- /.card -->
</div>
@endsection

@section('style')
    
@endsection

@section('script')
<script>
  function statusUpdate(statusValue,id){
    axios.put('/Task-Management/status/'+id,{
      status:statusValue,
      
      // status:document.getElementById('3').value,
    })
    .then(function (response) {

      // handle success
      console.log(response);
      toastr.success(response.data.message);
      window.location.href='/Task-Management/projects/{{$projects->id}}/tasks'
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
