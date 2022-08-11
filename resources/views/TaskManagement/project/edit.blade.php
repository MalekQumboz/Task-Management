@extends('TaskManagement.parent')

@section('page-title','Project')

@section('big-title','Edit')
@section('sm-title','Edit')


@section('content')
<section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Project</h3>
              </div>
        <form id="resetForm">
        @csrf
          <div class="card-body" style="display: block;">
            <div class="form-group">
              <label for="name">Project Name</label>
              <input type="text" id="name" value="{{$projects->name}}" class="form-control">
            </div>
            <div class="form-group">
              <label for="description">Project Description</label>
              <textarea id="description"  class="form-control" rows="4"> old{{$projects->description}}</textarea>
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select id="status" class="form-control custom-select">
                <option selected="" disabled="">Select one</option>
                <option value="completed" @selected($projects->status=='completed')>Completed</option>
                <option value="inprogress" @selected($projects->status=='inprogress')>Inprogress</option>
                <option value="canceled" @selected($projects->status=='canceled')>Canceled</option>
              </select>
            </div>
            
            <div class="form-group">
              <label for="projectManager">Project Leader</label>
              <select id="projectManager" class="form-control custom-select">
                <option selected="" disabled="">Select one</option>
                @foreach ($projectManagers as $projectManager)
                    <option value="{{$projectManager->name}}" @selected($projectManager->name==$projects->projectManager)>{{$projectManager->name}}</option>
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
      axios.put('/Task-Management/projects/{{$projects->id}}',{
        name:document.getElementById('name').value,
        description:document.getElementById('description').value,
        status:document.getElementById('status').value,
        projectManager:document.getElementById('projectManager').value,
      })
      .then(function (response) {

        // handle success
        console.log(response);
        toastr.success(response.data.message);
        window.location.href='/Task-Management/projects'
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
