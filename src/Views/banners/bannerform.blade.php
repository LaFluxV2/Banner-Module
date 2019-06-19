@extends('Dashboard::dashboard.dashboard')
@section('content-header')

    <!-- Navigation Starts-->
    @include('Dashboard::dashboard.partials.headersidebar')
    <!-- Navigation Ends-->

@stop
@section('content-area')

 <!-- page content -->
        <div class="right_col"  role="main">
          <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="x_panel">
                    <h2>{{$title}}</h2>
                </div>
            </div>
        </div>

        <?php
        if (isset($banner)) {
            $action = 'extensionsvalley.admin.updatebanners';
        } else {
            $action = 'extensionsvalley.admin.savebanners';
        }

        if (isset($viewmode)) {
            $readonly = "readonly";
        } else {
            $readonly = "";
        }

        ?>

        {!!Form::open(array('route' => $action, 'method' => 'post','files'=>true))!!}
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12">
            <div class="x_panel">

            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                   <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} control-required">
                    {!! Form::label('name', 'Name') !!}<span class="mand_star"> *</span>
                    {!! Form::text('name', isset($banner->name) ? $banner->name : \Input::old('name'), [
                        'class'       => 'form-control',
                        'placeholder' => 'Name',
                        'required'    => 'required',
                        $readonly
                    ]) !!}
                    <span class="error_span">{{ $errors->first('name') }}</span>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} control-required">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status',  array('1'=>'Publish','0'=>'Unpublish'), isset($banner->status) ? $banner->status :null, [
                        'class'       => 'form-control select2',
                        'required'    => 'required',
                        $readonly
                    ]) !!}
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }} control-required">
                    {!! Form::label('description', 'Descriptions') !!}<span class="mand_star"> *</span>
                    {!! Form::textArea('description', isset($banner->description) ? $banner->description : \Input::old('description'), [
                        'class'       => 'form-control texteditor',
                        'placeholder' => 'Banner Description',
                        $readonly
                    ]) !!}
                    <span class="error_span">{{ $errors->first('description') }}</span>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }} control-required">
                    {!! Form::label('category', 'Banner Category') !!}<span class="mand_star"> *</span>
                    {!! Form::select('category_id', ExtensionsValley\Banners\Models\BannercategoryModel::getBannerCategory() , isset($banner->category_id) ? $banner->category_id :null, [
                    'class'       => 'form-control select2',
                    'required'    => 'required',
                        $readonly
                ]) !!}
                    <span class="error_span">{{ $errors->first('category_id') }}</span>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }} control-required">
                    {!! Form::label('ordering', 'Ordering') !!}<span class="mand_star"> *</span>
                    {!! Form::text('ordering', isset($banner->ordering) ? $banner->ordering : \Input::old('ordering'), [
                        'class'       => 'form-control',
                        'placeholder' => 'Order By Banner eg: 1,2,3',
                        'required'    => 'required',
                        $readonly
                    ]) !!}
                    <span class="error_span">{{ $errors->first('ordering') }}</span>
                </div>
                </div>
            </div>


<div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                     <div class="form-group {{ $errors->has('link') ? 'has-error' : '' }} control-required">
                    {!! Form::label('link', 'Link') !!}<span class="mand_star"> *</span><span>(Please ad http:// before URL)</span>
                    {!! Form::text('link', isset($banner->link) ? $banner->link : \Input::old('link'), [
                        'class'       => 'form-control',
                        'placeholder' => 'Link eg. http://www.yourwebsite.com',
                        $readonly
                    ]) !!}
                </div>
                </div>

            </div>






            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       <div class="form-group {{ $errors->has('media') ? 'has-error' : '' }} control-required">
                    {!! Form::label('file_media', 'Media') !!}<span class="mand_star"> *</span>
                    {!! Form::file('media')!!}
                    <span class="error_span">  {{ $errors->first('media') }}</span>
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                       @if(isset($banner->media))
                    @if($banner->media !="")
                        <a href="#" data-toggle="modal" data-target="#mypopup"><img
                                    src="{{Request::root()}}/{{ $banner->media }}?img={{rand(1,10)}}" width="100"/></a>
                    @endif
                @endif
                </div>
            </div>





 @if(isset($banner->media))
          <div id="mypopup" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">{{$banner->name}}</h4>
                        </div>
                        <div class="modal-body">
                        <center>
                            <img src="{{Request::root()}}/{{ $banner->media }}" width="500"/>
                            </center>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            </div>
        @endif










        @if(isset($banner->id))
            <Input type="hidden" name="banner_id" value="{{$banner->id}}"/>
        @endif



            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <a onclick="history.go(-1);" class="btn btn-success">Cancel</a>
                    @if(!isset($viewmode))
                        {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
                    @endif
                </div>
            </div>

            </div>
            </div>


              <!-- <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
              </div> -->
            </div>

            <input type="hidden" name="accesstoken" value="{{\Input::has('accesstoken') ? \Input::get('accesstoken') : ''}}" />

            {!! Form::token() !!}
            {!! Form::close() !!}

    </div>
    </div>

    <!-- /page content -->
@stop


