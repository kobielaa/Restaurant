<div class="col-lg-6 col-md-12">
    <div class="form-group">
        <div class="input-group @if ($errors->has('main_image')) is-invalid @endif">
            <label for="main_image">@lang('adverts.images.main'):</label>
            <label class="custom-file">
                <input type="file" name="main_image" id="main_image" class="custom-file-input">
                <span class="custom-file-control form-control-file"></span>
                <i class="fa fa-file-image-o"></i>
            </label>            
            @if ($errors->has('main_image'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('main_image') }}</strong>
            </span>
            @endif
        </div>        
    </div>
    <div class="form-group additional-image">
        <div class="input-group @if ($errors->has('image_2')) is-invalid @endif">
            <label for="image_2">@lang('adverts.images.second'):</label>
            <label class="custom-file">
                <input type="file" name="image_2" id="image_2" class="custom-file-input">
                <span class="custom-file-control form-control-file"></span>
                <i class="fa fa-file-image-o"></i>
            </label>            
            @if ($errors->has('image_2'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('image_2') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group additional-image">
        <div class="input-group @if ($errors->has('image_3')) is-invalid @endif">
            <label for="image_3">@lang('adverts.images.third'):</label>
            <label class="custom-file">
                <input type="file" name="image_3" id="image_3" class="custom-file-input">
                <span class="custom-file-control form-control-file"></span>
                <i class="fa fa-file-image-o"></i>
            </label>            
            @if ($errors->has('image_3'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('image_3') }}</strong>
            </span>
            @endif
        </div>
    </div>
</div>
<div class="col-lg-6 col-md-12">
    <div class="form-group additional-image">
        <div class="input-group @if ($errors->has('image_4')) is-invalid @endif"> 
        <label for="image_4">@lang('adverts.images.fourth'):</label>
            <label class="custom-file">
                <input type="file" name="image_4" id="image_4" class="custom-file-input">
                <span class="custom-file-control form-control-file"></span>
                <i class="fa fa-file-image-o"></i>
            </label>            
            @if ($errors->has('image_4'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('image_4') }}</strong>
            </span>
            @endif
        </div>            
    </div>
    <div class="form-group additional-image">
        <div class="input-group @if ($errors->has('image_3')) is-invalid @endif">
            <label for="image_5">@lang('adverts.images.fifth'):</label>
            <label class="custom-file">
                <input type="file" name="image_5" id="image_5" class="custom-file-input">
                <span class="custom-file-control form-control-file"></span>
                <i class="fa fa-file-image-o"></i>
            </label>            
            @if ($errors->has('image_5'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('image_5') }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="form-group additional-image">
        <div class="input-group @if ($errors->has('image_3')) is-invalid @endif">
            <label for="image_6">@lang('adverts.images.sixth'):</label>
            <label class="custom-file">
                <input type="file" name="image_6" id="image_6" class="custom-file-input">
                <span class="custom-file-control form-control-file"></span>
                <i class="fa fa-file-image-o"></i>
            </label>            
            @if ($errors->has('image_6'))
            <span class="invalid-feedback">
                <strong>{{ $errors->first('image_6') }}</strong>
            </span>
            @endif
        </div>
    </div>
</div>