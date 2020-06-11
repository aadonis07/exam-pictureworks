@extends('layouts.app')
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>PHP Exam</title>

    </head>
    <body>
        @section('content')
            <div class="content">
                <div class="row justify-content-center" style="margin-top:4cm;">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-6">
                                        Dashboard
                                    </div>
                                    <div class="col-md-6" align="right">
                                        <a class="btn btn-primary text-white" data-toggle="modal" data-target="#myModal">
                                            <span>Add Comment</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="table-content">
                                        <tr>
                                            <th>User</th>
                                            <th>Comment</th>
                                        </tr>
                                        @foreach($comment_list as $comments)
                                        <tr>
                                            <td>{{$comments->name}}</td>
                                            <td>{{$comments->comment}}</td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Modal Start --}}
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Add Comment</h5>
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                      <div class="form-group">
                          <label>Comment :</label>
                          <input class="form-control" id="comment_data" />
                      </div>
                      <div class="form-group">
                            <label>To :</label>
                           <select class="form-control" id="user_id">
                               <option value="">--Select User--</option>
                               @foreach($user_list as $users)
                               <option value="{{ $users->id }}">{{ $users->name }}</option>
                               @endforeach
                           </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button class="btn btn-primary" id="submitCommentBtn">Submit</button>
                    </div>
                  </div>
              
                </div>
              </div>

            {{-- Modal End --}}
            @endsection
            @section('scripts')
            <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
            <script>
               $(document).ready(function(index){
                    $(document).on('click','#submitCommentBtn',function(){
                        formData = new FormData();
                            var comment = $('#comment_data').val();
                            var user_id = $('#user_id').val();

                            formData.append('comment',comment);
                            formData.append('user_id',user_id);
                            formData.append('_token',"{{ csrf_token() }}");
                        if($.trim(comment)){
                            if($.trim(user_id)){
                                $.ajax({
                                    type: "POST",
                                    url: "{{ route('all-functions',['id' => 'add-comment']) }}",
                                    data: formData,
                                    CrossDomain:true,
                                    contentType: !1,
                                    processData: !1,
                                    success: function(e) {
                                        if(e==3){
                                            alert('This comment is the same');
                                        }else{
                                            $('#table-content').append(e);
                                        }
                                    },
                                    error: function(result){
                                    alert('error');
                                    }
                                });
                            }else{
                                alert('please select user');
                            }
                        }else{
                            alert('please input comment');
                        }
                           
                    });
                });
            </script>
          
            @endsection
            @section('head_data')
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        
            <!-- CSRF Token -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <script>
                $.ajaxSetup({
                     headers: {
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                     }
                 });
             </script>
        @endsection
    </body>
</html>
