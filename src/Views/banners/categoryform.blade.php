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
         if (isset($category)) {
            $action = 'extensionsvalley.admin.updatebannercategory';
        } else {
            $action = 'extensionsvalley.admin.savebannercategory';
        }
        if (isset($viewmode)) {
            $readonly = "readonly";
        } else {
            $readonly = "";
        }

        ?>

            {!!Form::open(array('route' => $action, 'method' => 'post'))!!}
            <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-10 col-lg-12">
            <div class="x_panel">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }} control-required">
                    {!! Form::label('name', 'Name') !!}<span class="mand_star"> *</span>
                    {!! Form::text('name', isset($category->name) ? $category->name : \Input::old('name'), [
                        'class'       => 'form-control',
                        'placeholder' => 'Name',
                        'required'    => 'required',
                        $readonly
                    ]) !!}
                    <span class="error_span">{{ $errors->first('name') }}</span>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                     <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }} control-required">
                    {!! Form::label('description', 'Descriptions') !!}<span class="mand_star"> *</span>
                    {!! Form::textArea('description', isset($category->description) ? $category->description : \Input::old('description'), [
                        'class'       => 'form-control texteditor',
                        'placeholder' => 'Category Descriptions',
                        $readonly
                    ]) !!}
                    <span class="error_span"> {{ $errors->first('address') }}</span>
                </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                    <div class="form-group {{ $errors->has('status') ? 'has-error' : '' }} control-required">
                    {!! Form::label('status', 'Status') !!}
                    {!! Form::select('status',  array('1'=>'Publish','0'=>'Unpublish'), isset($category->status) ? $category->status :null, [
                        'class'       => 'form-control',
                        'required'    => 'required',
                        $readonly
                    ]) !!}
                </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                </div>

            </div>



            @if(isset($category->id))
            <Input type="hidden" name="category_id" value="{{$category->id}}"/>
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


             <!--  <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            
              </div> -->
            </div>

            <input type="hidden" name="accesstoken" value="{{\Input::has('accesstoken') ? \Input::get('accesstoken') : ''}}" />
            
            {!! Form::token() !!}
            {!! Form::close() !!}

    </div>
    </div>

    <!-- /page content -->
@stop
