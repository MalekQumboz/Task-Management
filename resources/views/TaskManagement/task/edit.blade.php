@extends('TaskManagement.parent')

@section('page-title','Tasks')

@section('big-title','Edit')
@section('sm-title','Edit')


@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Task</h3>
              </div>
        <form id="resetForm">
        @csrf
        <div class="card-body" style="display: block;">
          <div class="form-group">
            <label for="name">Task Name</label>
            <input type="text" id="name" value="{{$tasks->name}}" class="form-control">
          </div>
          <div class="form-group">
            <label for="description">Task Description</label>
            <textarea id="description" class="form-control" rows="4">{{$tasks->description}}</textarea>
          </div>
          <div class="form-group">
            <label for="status">Status</label>
            <select id="status" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              <option value="toDo" @selected($tasks->status=='toDo')>To Do</option>
              <option value="inprogress" @selected($tasks->status=='inprogress')>Inprogress</option>
              <option value="completed" @selected($tasks->status=='completed')>Completed</option>
            </select>
          </div>
          
          <div class="form-group">
            <label for="project_id">Project Name</label>
            <select id="project_id" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              @foreach ($projects as $project)
                  <option value="{{$project->id}}" @selected($tasks->project_id==$project->id)>{{$project->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <label for="employee_id">Employee Name</label>
            <select id="employee_id" class="form-control custom-select">
              <option selected="" disabled="">Select one</option>
              @foreach ($employees as $employee)
                  <option value="{{$employee->id}}" @selected($tasks->employee_id==$employee->id)>{{$employee->name}}</option>
              @endforeach
            </select>
          </div>
        </div>

          <div class="card-footer">
            <button type="button" onclick="preformUpdate()" class="btn btn-primary">Save</button>
          </div>
        </form>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      
    </div>
   
  </section>
@endsection

@section('style')
    
@endsection

@section('script')
<script>
    function preformUpdate(){
      axios.put('/Task-Management/tasks/{{$tasks->id}}',{
        name:document.getElementById('name').value,
        description:document.getElementById('description').value,
        status:document.getElementById('status').value,
        project_id:document.getElementById('project_id').value,
        employee_id:document.getElementById('employee_id').value,
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
  </script>
@endsection
