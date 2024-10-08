    <div class="row mb-3">                          
        <div class="col-lg-12 col-sm-12">
            <div class="form-group m-form__group">
                <label> Name </label>
                <input type="text" name="name_en" class="form-control m-input" aria-describedby="" placeholder="Enter product name" value="{{ isset($data->name_en) ? old('name' , $data->name_en) : '' }}">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <div class="form-group m-form__group">
                <label>Short description </label>
                <textarea rows="5" type="text" name="short_description_en" maxlength="250" class="form-control m-input" id="short_description" aria-describedby="emailHelp" placeholder="Enter short description">{{ isset($data->short_description_en) ? $data->short_description_en : old('short_description') }}</textarea>
                <span id="short_description_count" class="m-form__help"></span>
            </div>
        </div>
        <div class="col-lg-12 col-sm-12 mt-3">
            <div class="form-group m-form__group">
                <label>Body description </label>
                <textarea id="body_description_en" class="summernote form-control m-input" name="body_description_en">{{ isset($data->body_html_en) ? $data->body_html_en : old('body_description') }}</textarea>
            </div>
        </div>
    </div>