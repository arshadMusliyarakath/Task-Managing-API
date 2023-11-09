<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tasks | Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <div class="head">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1><i class="fa fa-tasks"></i> Tasks</h1>
                </div>
                <div class="col-md-6" style="text-align: right;">
                    <h5 class="profile">Welcome {{auth()->user()->name}}, <a href="{{ route('user.logout')}}">Logout</a></h5>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-area">
        <Button class="add-task" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add Task</Button>
    </div>
    <div class="task-area mt-5">
        <div class="container">
            <div class="row">

            @foreach ($tasks as $task)
                @php
                    $red = '#dc3545';
                    $green = '#28a745';
                    $orange = '#ffc107';
                    $lightBlue = '#007bff ';


                    if ($task->status == 1) {
                        $colour = $lightBlue;
                    } elseif ($task->status == 2) {
                        $colour = $green;
                    } elseif ($task->status == 3) {
                        $colour = $red;
                    }

                    if ($task->priority == 1) {
                        $pr_colour = $lightBlue;
                    } elseif ($task->priority == 2) {
                        $pr_colour = $orange;
                    } elseif ($task->priority == 3) {
                        $pr_colour = $red;
                    }

                    
                    
                @endphp
                <div class="task" style="border-color: {{ $pr_colour }};">
                    <div class="row">
                        <div class="col-md-12 content-area">
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="imag" style="background-image: url('{{ $task->ImageUrl }}')"></div>
                                </div>
                                <div class="col-md-6 pt-3">
                                    <h5>@if(strlen($task->title) > 40) {{ substr($task->title, 0, 40)."..."  }} @else  {{$task->title}} @endif</h5>
                                    <p class="date">Added : {{ $task->created_at}}</p>
                                </div>
                                <div class="col-md-2 pt-4">
                                    <p class="status" style="background-color: {{ $colour }}">{{$task->StatusText}}</p>
                                </div>
                                <div class="col-md-2 pt-3">
                                    <a href="#" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal_{{ $task->task_id}}"><i class="fa fa-gear"></i></a>
                                    <a href="{{ route('delete.task', encrypt($task->task_id)) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="editModal_{{ $task->task_id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    
                        
                        <form method="POST" action="{{ route('update.task') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" value="{{ $task->task_id}}" name="task_id">
                            <div class="mb-3">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" value="{{ $task->title}}" name="title" required>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Image</label>
                                <input type="file" class="form-control" name='image'>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Priority</label>
                                <select name="priority" id="" class="form-control" required>
                                    <option value="" >Select Priority</option>
                                    <option value="1" @if($task->priority == 1) selected @endif>Low</option>
                                    <option value="2" @if($task->priority == 2) selected @endif>Medium</option>
                                    <option value="3" @if($task->priority == 3) selected @endif>High</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Status</label>
                                <select name="status" id="" class="form-control" required>
                                    <option value="">Select Status</option>
                                    <option value="1" @if($task->status == 1) selected @endif>Working</option>
                                    <option value="2" @if($task->status == 2) selected @endif>Completed</option>
                                    <option value="3" @if($task->status == 3) selected @endif>Cancelled</option>
                                </select>
                            </div>
                            
                        
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        </form>
                    </div>
                    </div>
                </div>


            @endforeach

                

            </div>
        </div>
    </div>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Task</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
  
        
      <form method="POST" id='myForm' action="{{ route('add.task') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
            <input type="hidden" value="{{ auth()->user()->user_id}}" name="user_id">
            <div class="mb-3">
                <label for="" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <span class="error" style="color: red;font-size: 12px;"></span>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control" name='image'>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Priority</label>
                <select name="priority" id="" class="form-control" required>
                    <option value="">Select Priority</option>
                    <option value="1">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Status</label>
                <select name="status" id="" class="form-control" required>
                    <option value="">Select Status</option>
                    <option value="1">Working</option>
                    <option value="2">Completed</option>
                    <option value="3">Cancelled</option>
                </select>
            </div>
           
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add New Task</button>
        </div>
      </form>
    </div>
  </div>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<style>
body{
    font-family: 'Poppins', sans-serif;
}
.head {
	background-color: #6800ff;
	padding: 60px 0px;
	color: white;
}
h1 {
	font-weight: bold;
	font-size: 45px;
}
.task {
	width: 70%;
	margin: 0 auto;
	box-shadow: 0px 3px 9px 1px #0000001f;
	margin-bottom: 17px;
	border-radius: 6px;
	border-left: 8px solid;
}
p.date {
	margin: 0;
	font-size: 10px;
}
h5 {
	margin: 0;
	margin-bottom: 2px;
	font-size: 17px;
	color: black;
}
p.status {
	width: max-content;
	padding: 3px 10px;
	border-radius: 13px;
	color: white;
	font-size: 10px;
}
.priority {
	width: 10px;
	border-radius: 0;
	padding: 0;
	height: 82px;
}
.content-area {
	padding: 6px 0px;
}
.add-task {
	background: #0064ff;
	border: 0;
	color: white;
	padding: 11px 40px;
	border-radius: 49px;
	font-size: 20px;
	margin-top: -30px;
}
.btn-area {
	text-align: center;
	margin: -13px;
}
.imag {
	width: 70px;
	height: 70px;
	background-size: cover;
	margin: 0 auto;
	border-radius: 7px;
}
.task .btn {
	padding: 3px 8px;
}
.profile {
	color: white;
}
.profile a {
	background: #47a9ff;
	border-radius: 11px;
	padding: 5px 10px;
	text-decoration: none;
	font-size: 14px;
	color: white;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.profile a:hover {
	background: #0f34ff;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
        $(document).ready(function() {
    $("#title").on("input", function() {
        var titleLength = $(this).val().length;

        if (titleLength > 255) {
            $(".error").text("Title cannot exceed 255 characters.");
        } else {
            $(".error").text("");
        }
    });

    $("#myForm").submit(function(event) {
        var titleLength = $("#title").val().length;

        if (titleLength > 255) {
            $(".error").text("Title cannot exceed 255 characters.");
            event.preventDefault(); // Prevent form submission
        }
    });
});
</script>


  </body>
</html>