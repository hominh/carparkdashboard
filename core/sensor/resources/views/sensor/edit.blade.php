@extends('carparkdashboard-base::layout')
@section('title', 'Edit sensor')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/sensor/style.css')}}">
<div class="content-wrapper">
        <section class="content-header">
            <h1>Cập nhật cảm biến</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Cảm biến</li>
                <li class="active">Cập nhật</li>
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
                <form method="POST" action="{{ route('sensor.update',$sensor['id']) }}" accept-charset="UTF-8">
                    @csrf
                    <div class="col-md-9">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">Tên:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{!! old('name',isset($sensor) ? $sensor['name']:null ) !!}">
                                        </div>
                                        <div class="form-group">
                                            <label for="slug" class="control-label required" aria-required="true">Slug:</label>
                                            <input type="text" class="form-control" id="slug" name="slug" value="{!! old('name',isset($sensor) ? $sensor['slug']:null ) !!}">
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
                    url: '/sensor/create-slug',
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
