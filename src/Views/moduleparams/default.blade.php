 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group {{ $errors->has('category_id') ? 'has-error' : '' }} control-required">
                    {!! Form::label("category_id", 'Banner Category') !!}<span class="mand_star"> *</span>
                     {!! Form::select("module_params[category_id]", ExtensionsValley\Banners\Models\BannercategoryModel::getBannerCategory(), null, [
                        'class'       => 'form-control',
                    ]) !!}
                    <span class="error_span">{{ $errors->first('category_id') }}</span>
                </div>
</div>
 <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                <div class="form-group {{ $errors->has('module_layout') ? 'has-error' : '' }} control-required">
                    {!! Form::label('module_layout', 'Module layout') !!}
                    {!! Form::text('module_layout', 'Banners::front.slides', [
                        'class'       => 'form-control',
                        'placeholder' => 'Module Layout',
                        'required'    => 'required',
                        'readOnly' =>'readOnly'
                    ]) !!}
                    <span class="error_span">{{ $errors->first('module_layout') }}</span>
                </div>
</div>

