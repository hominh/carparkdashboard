@extends('carparkdashboard-base::layout')
@section('title', 'Edit kiosk')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/kiosk/style.css')}}">
<div class="content-wrapper">
        <section class="content-header">
            <h1>Dashboard<small>Control panel</small></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Kiosk</li>
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
                <form method="POST" action="{{ route('kiosk.update',$kiosk['id']) }}" accept-charset="UTF-8">
                    @csrf
                    <div class="col-md-9">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">Tên:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{!! old('name',isset($kiosk) ? $kiosk['name']:null ) !!}">
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
                                        <i class="fa fa-save"></i> Save
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="box">
                            <div class="box-header with-border">
                                <label for="basement" class="control-label required" aria-required="true">Bãi giữ xe</label>
                            </div>
                            <div class="box-body">
                                <select class="form-control" name="basement" id="basement">
                                    <option value="0">Chọn bãi giữ xe</option>
                                    @if(count($kiosk->basement) > 0)
                                    @foreach ($basements as $basement)
                                    <option value="{{ $basement->id }}" @if ($kiosk->basement[0]->id == $basement->id) selected @endif > {{ $basement->name }}</option>
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
