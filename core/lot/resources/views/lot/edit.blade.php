@extends('carparkdashboard-base::layout')
@section('title', 'Edit lot')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/camera/style.css')}}">
<div class="content-wrapper">
        <section class="content-header">
            <h1>Cập nhật vị trí tọa độ theo ảnh camera</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Lot</li>
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
                <form method="POST" action="{{ route('lot.update',$lot['id']) }}" accept-charset="UTF-8">
                    @csrf
                    <div class="col-md-9">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">Name:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{!! old('name',isset($lot) ? $lot['name']:null ) !!}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="x1" class="control-label required" aria-required="true">x1:</label>
                                            <input type="text" class="form-control" id="x1" name="x1" value="{!! old('x1',isset($lot) ? $lot['x1']:null ) !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="y1" class="control-label required" aria-required="true">y1:</label>
                                            <input type="text" class="form-control" id="y1" name="y1" value="{!! old('y1',isset($lot) ? $lot['y1']:null ) !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="x2" class="control-label required" aria-required="true">x2:</label>
                                            <input type="text" class="form-control" id="x2" name="x2" value="{!! old('x2',isset($lot) ? $lot['x2']:null ) !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="y2" class="control-label required" aria-required="true">y2:</label>
                                            <input type="text" class="form-control" id="y2" name="y2" value="{!! old('y2',isset($lot) ? $lot['y2']:null ) !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="overlap" class="control-label required" aria-required="true">overlap:</label>
                                            <input type="text" class="form-control" id="overlap" name="overlap" value="{!! old('overlap',isset($lot) ? $lot['overlap']:null ) !!}">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="id_forS" class="control-label required" aria-required="true">id_forS:</label>
                                            <input readonly type="text" class="form-control" id="id_forS" name="id_forS" value="{!! old('id_forS',isset($lot) ? $lot['id_forS']:null ) !!}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Publish</h4>
                            </div>
                            <div class="box-body">
                                <div class="btn-set">
                                    <button type="submit" name="submit" value="save" class="btn btn-info">
                                        <i class="fa fa-save"></i> Cập nhật
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header with-border">
                                <label for="name" class="control-label required" aria-required="true">Camera</label>
                            </div>
                            <div class="box-body">
                                <select class="form-control" name="camera" id="camera">
                                    <option value="0">Chọn camera</option>
                                    @if(count($lot->camera) > 0)
                                    @foreach ($cameras as $camera)
                                    <option value="{{ $camera->id }}" @if ($lot->camera[0]->id == $camera->id) selected @endif > {{ $camera->name }}</option>
                                    @endforeach
                                    @else
                                    @foreach ($cameras as $camera)
                                    <option value="{{ $camera->id }}">{{ $camera->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header with-border">
                                <label for="name" class="control-label required" aria-required="true">Cảm biến</label>
                            </div>
                            <div class="box-body">
                                <select class="form-control" name="sensor" id="sensor">
                                    <option value="0">Chọn cảm biến</option>
                                    @if(count($lot->sensor) > 0)
                                    @foreach ($sensors as $sensor)
                                    <option value="{{ $sensor->id }}" @if ($lot->sensor[0]->id == $sensor->id) selected @endif > {{ $sensor->name }}</option>
                                    @endforeach
                                    @else
                                    @foreach ($sensors as $sensor)
                                    <option value="{{ $sensor->id }}">{{ $sensor->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header with-border">
                                <label for="basement" class="control-label required" aria-required="true">Bãi giữ xe</label>
                            </div>
                            <div class="box-body">
                                <select class="form-control" name="basement" id="basement">
                                    <option value="0">Chọn bãi giữ xe</option>
                                    @if(count($lot->basement) > 0)
                                    @foreach ($basements as $basement)
                                    <option value="{{ $basement->id }}" @if ($lot->basement[0]->id == $basement->id) selected @endif > {{ $basement->name }}</option>
                                    @endforeach
                                    @else
                                    @foreach ($basements as $basement)
                                    <option value="{{ $basement->id }}">{{ $basement->name }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection
