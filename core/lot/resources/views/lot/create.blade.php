@extends('carparkdashboard-base::layout')
@section('title', 'Create new lot')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/blog/style.css')}}">
<div class="content-wrapper">
		<section class="content-header">
			<h1>Dashboard<small>Control panel</small></h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Lot</li>
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
				<form method="POST" action="{!! route('lot.store') !!}" accept-charset="UTF-8">
					@csrf
					<div class="col-md-9">
						<div class="box">
							<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">Name:</label>
                  							<input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
										</div>
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">x1:</label>
                  							<input type="text" class="form-control" id="x1" name="x1" placeholder="Enter x1">
										</div>
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">y1:</label>
                  							<input type="text" class="form-control" id="y1" name="y1" placeholder="Enter y1">
										</div>
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">x2:</label>
                  							<input type="text" class="form-control" id="x2" name="x2" placeholder="Enter x2">
										</div>
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">y2:</label>
                  							<input type="text" class="form-control" id="y2" name="y2" placeholder="Enter y2">
										</div>
										<div class="form-group">
											<label for="overlap" class="control-label required" aria-required="true">overlap:</label>
                  							<input type="text" class="form-control" id="overlap" name="overlap" placeholder="Enter overlap">
										</div>
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">id_forS:</label>
                  							<input readonly type="text" class="form-control" id="id_forS" name="id_forS" placeholder="Enter id_forS">
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
                						<i class="fa fa-save"></i> Lưu
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
                            		@foreach ($cameras as $camera)
                            		<option value="{{ $camera->id }}">{{ $camera->name }}</option>
									@endforeach
								</select>
                            </div>
						</div>
						<div class="box">
							<div class="box-header with-border">
								<label for="name" class="control-label required" aria-required="true">Cảm biến</label>
							</div>
                            <div class="box-body">
                            	<select class="form-control" name="camera" id="camera">
                            		<option value="0">Chọn cảm biến</option>
                            		@foreach ($sensors as $sensor)
                            		<option value="{{ $sensor->id }}">{{ $sensor->name }}</option>
									@endforeach
								</select>
                            </div>
						</div>
					</div>
				</form>
			</div>
		</section>
	</div>
@endsection