@extends('carparkdashboard-base::layout')
@section('title', 'Create new kiosk')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/blog/style.css')}}">
<div class="content-wrapper">
		<section class="content-header">
			<h1>Dashboard<small>Control panel</small></h1>
			<ol class="breadcrumb">
				<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
				<li class="active">Kiosk</li>
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
				<form method="POST" action="{!! route('kiosk.store') !!}" accept-charset="UTF-8">
					@csrf
					<div class="col-md-9">
						<div class="box">
							<div class="box-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="name" class="control-label required" aria-required="true">Tên:</label>
                  							<input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
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
						<div class="box">
							<div class="box-header with-border">
								<label for="name" class="control-label required" aria-required="true">Bãi giữ xe</label>
							</div>
                            <div class="box-body">
                            	<select class="form-control" name="basement" id="basement">
                            		<option value="0">Chọn bãi giũ xe</option>
                            		@foreach ($basements as $basement)
                            		<option value="{{ $basement->id }}">{{ $basement->name }}</option>
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