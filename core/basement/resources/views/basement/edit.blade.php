@extends('carparkdashboard-base::layout')
@section('title', 'Edit basement')
@section('page')
<link rel="stylesheet" type="text/css" href="{{asset('css/basement/style.css')}}">
<div class="content-wrapper">
        <section class="content-header">
            <h1>Cập nhật bãi giữ xe</h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Bãi giữ xe</li>
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
                <form method="POST" action="{{ route('basement.update',$basement['id']) }}" accept-charset="UTF-8">
                    @csrf
                    <div class="col-md-9">
                        <div class="box">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="name" class="control-label required" aria-required="true">Tên:</label>
                                            <input type="text" class="form-control" id="name" name="name" value="{!! old('name',isset($basement) ? $basement['name']:null ) !!}">
                                        </div>
                                        <div class="form-group">
                                            <div class="preview-image-wrapper ">
                                                <img src="{{$basement["image"] != "" ? $basement["image"] : URL::asset('/images/placeholder.png')}}" alt="preview image" class="preview_image" width="150" id="preview_image">
                                                <a href="javascript:;" id="remove_image" class="btn_remove_image" title="Remove image">
                                                    <i class="fa fa-times"></i>
                                                </a>
                                            </div>
                                            <br />
                                            <a href="#" id="ckfinder-modal" class="btn_select_gallery">Chọn ảnh</a>
                                            <input type="hidden" name="image" id="image_choose" value="{!! old('name',isset($basement) ? $basement['image']:null ) !!}">
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
    <script type="text/javascript" src="/js/ckfinder/ckfinder.js"></script>
    <script>CKFinder.config( { connectorPath: '/ckfinder/connector' } );</script>
    <script>
        var button = document.getElementById( 'ckfinder-modal' );
        button.onclick = function() {
            CKFinder.modal( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        var file = evt.data.files.first();
                        showUploadedImage( file.getUrl() )
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        var output = document.getElementById( elementId );
                        output.value = evt.data.resizedUrl;
                    } );
                }
            })
        };
        function showUploadedImage(url)
        {
            $("#image_choose").val(url);
            $('#preview_image').attr('src',url);
        }
        $('#remove_image').click(function(){
            $("#image_choose").val('');
            $('#preview_image').attr('src','/images/placeholder.png');
        });
    </script>
@endsection
