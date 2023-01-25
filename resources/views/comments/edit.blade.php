@extends('layouts.master')
@section('title')
Dashboard | Edit comment
@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit comment</h4>
                            @if(session('error'))
                                <div class="alert alert-danger">
                                    {{session('error')}}
                                </div>
                            @endif
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <form class="custom-validation" action="{{route('comments.update',$id_comment->id)}}" method="POST" enctype="multipart/form-data" >
                                @csrf
                                @method('PATCH')

                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">post_title</label>
                                    <select name="post_id" class="form-select" id="validationCustom03" required>
                                        @foreach($posts as $value)
                                            <option value="{{$value->id}}">{{$value->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('post_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>




                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Author</label>
                                    <select name="user_id" class="form-select" id="validationCustom03"  required>
                                        @foreach($auther as $value)
                                            <option value="{{$value->id}}">{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('user_id')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>


                                <div class="form-row">
                                    <div class="col">
                                        <label for="title">Date</label>
                                        <div class='input-group date'>
                                            <input class="form-control" value="{{$id_comment->Joining_Date}}" type="date"  id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" required>
                                        </div>
                                        @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label>content</label>
                                    <input type="text" name="comment" value="{{$id_comment->comment}}" class="form-control"  placeholder="content text" />
                                </div>




                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Update
                                        </button>
                                        <button type="reset" class="btn btn-secondary waves-effect">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>


@endsection
@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="{{asset('backend/assets/libs/parsleyjs/parsley.min.js')}}"></script>

    <script src="{{asset('backend/assets/js/pages/form-validation.init.js')}}"></script>
@endsection
