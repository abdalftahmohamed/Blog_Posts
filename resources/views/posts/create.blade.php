@extends('layouts.master')
@section('title')
Dashboard | Add Category
@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Add Post</h4><br>

                            <form class="custom-validation" action="{{route('posts.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label>Title</label>
                                    <input type="text" name="title" value="{{old('title')}}" class="form-control"  placeholder="Title Name" />
                                    @error('title')
                                    <span class="text-danger" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>




                                <div class="mb-3">
                                    <label for="validationCustom03" class="form-label">Author</label>
                                    <select name="user_id" class="form-select" id="validationCustom03" required>
                                        <option selected disabled value="">Choose...</option>
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
                                            <input class="form-control" type="date" value="{{old('Joining_Date')}}" id="datepicker-action" name="Joining_Date" data-date-format="yyyy-mm-dd" placeholder="yyyy-mm-dd" >
                                        </div>
                                        @error('Joining_Date')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="mb-3">
                                    <label>content</label>
                                    <input type="text" name="content" value="{{old('content')}}" class="form-control"  placeholder="content text" />
                                    @error('content')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    <label>Images</label>
                                    <div class="col-lg-12">
                                        <div class="input-group">
                                            <input type="file" name="image" value="{{old('image')}}" class="form-control" accept="image/*" id="image">
                                            <img id="showImage" class="rounded avatar-lg" src="{{asset('backend/assets/images/users/no_image.jpg') }}" style="width: 15%; height:15%;" alt="No Image">
                                            @error('image')
                                            <span class="text-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>



                                <div class="mb-0">
                                    <div>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light me-1">
                                            Save
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
<script type="text/javascript">
    $(document).ready(function() {
        $('#image').change(function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>
<script src="{{asset('backend/assets/libs/parsleyjs/parsley.min.js')}}"></script>

<script src="{{asset('backend/assets/js/pages/form-validation.init.js')}}"></script>

@endsection
