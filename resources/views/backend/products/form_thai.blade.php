<div class="row mb-3">                          
        <div class="col-lg-6 col-sm-12">
            <div class="form-group m-form__group row {{ $errors->has('name') ? ' has-danger' : '' }}">
                <label class="col-form-label col-lg-3 col-md-3 col-sm-12">
                    Name
                </label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <input type="text" name="name" class="form-control m-input" id="name" aria-describedby="" placeholder="Enter product name" value="{{ isset($data->name) ? old('name' , $data->name) : '' }}" required>
                    @if ($errors->has('name'))
                        <div class="form-control-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
            <div class="form-group m-form__group row {{ $errors->has('slug') ? 'has-danger' : '' }}">
                <label class="col-form-label col-lg-3 col-md-3 col-sm-12">
                    Slug URI
                </label>
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <input type="text" id="slug" name="slug" class="form-control m-input" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product slug" value="{{ isset($data->slug) ?  old('slug' , $data->slug) : '' }}" required>
                    @if ($errors->has('slug'))
                        <div class="form-control-feedback">
                            {{ $errors->first('slug') }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="form-group m-form__group">
                <label>Short description </label>
                <textarea rows="5" type="text" name="short_description" maxlength="250" class="form-control m-input" id="short_description" aria-describedby="emailHelp" placeholder="Enter short description">{{ isset($data->short_description) ? $data->short_description : old('short_description') }}</textarea>
                <span id="short_description_count" class="m-form__help"></span>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 mt-3">
            <div class="form-group m-form__group">
                <label>Body description </label>
                <textarea id="body_description" class="summernote body_description form-control m-input" name="body_description">{{ isset($data->body_html) ? $data->body_html : old('body_description') }}</textarea>
            </div>
        </div>
    </div>