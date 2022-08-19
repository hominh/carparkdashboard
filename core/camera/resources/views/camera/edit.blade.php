@extends('carparkdashboard-base::layout')
@section('title', 'Edit camera')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/camera/style.css')}}">
<div class="content-wrapper">
        <section class="content-header">
            <h1>Cập nhật camera</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Camera</li>
                <li class="active">Edit</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form method="POST" action="{{ route('camera.update',$camera['id']) }}" accept-charset="UTF-8">
                    @csrf
                    <div class="col-md-9">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">Tên:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{!! old('name',isset($camera) ? $camera['name']:null ) !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">Slug:</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{!! old('slug',isset($camera) ? $camera['slug']:null ) !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Công bố</h4>
                            </div>
                            <div class="box-body">
                                <div class="btn-set">
                                    <button type="submit" name="submit" value="save" class="btn btn-info">
                                        <i class="fa fa-save"></i> Lưu
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script type="text/javascript">
        $(function() {
            $('#name').blur(function() {
                $.ajax({
                    type: 'POST',
                    url: '/camera/create-slug',
                    data: {
                        "_token": '{{ csrf_token() }}',
                        "key" : $("#name").val(),
                    },
                    success:function(data) {
                        $('#slug').val(data);
                    }
                });
            });
        })
    </script>
@endsection
