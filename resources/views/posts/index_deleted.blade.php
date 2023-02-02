@extends('layouts.master')
@section('title')
Dashboard | Categories
@endsection
@section('css')
<link href="{{asset('backend/assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('backend/assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Category Table</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item active">Posts Table</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Posts
                            </h4><br><br>
                            @if(session('message'))
                            <div class="alert alert-success">
                                {{session('message')}}
                            </div>
                            @endif
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
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title Name</th>
                                        <th>Author</th>
                                        <th>Content</th>
                                        <th>Date</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($posts as $post)
                                    <tr>
                                        <td>{{$loop->iteration}}</td>
                                        <td>{{$post->title}}</td>
                                        <td>{{$post->author}}</td>
                                        <td>{{$post->content}}</td>
                                        <td>{{$post->Joining_Date}}</td>
                                        <td><img class="rounded avatar-lg" src="{{$post->image}}"  alt="not loading image"></td>
                                        <td>
                                            <form action="{{route('restore',$post->id)}}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="post_id" value="{{$post->id}}">

                                                <button type="submit" onclick="return confirm('Are You Sure')" class="btn btn-primary waves-effect waves-light">RestorePost</button>
                                            </form>


                                            <form action="{{'posts.forcedelete',$post->id}}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="post_id" value="{{$post->id}}">
                                                <button type="submit" onclick="return confirm('Are You Sure')" class="btn btn-danger waves-effect waves-light">ForceDelete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div>
    </div>
</div>

@endsection
@section('js')
<!-- Datatable init js -->
<script src="{{asset('backend/assets/js/pages/datatables.init.js')}}"></script>

<script src="{{asset('backend/assets/js/app.js')}}"></script>
<!-- Buttons examples -->
<script src="{{asset('backend/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/jszip/jszip.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/pdfmake/build/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>

<script src="{{asset('backend/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('backend/assets/libs/datatables.net-select/js/dataTables.select.min.js')}}"></script>
@endsection
