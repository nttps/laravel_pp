@foreach ($shop_setups as $setting)
    <div class="col-xl-12 col-12">
        <div class="form-group m-form__group row">
            <label for="{{ $setting->name }}" class="col-lg-3 col-xl-3 col-form-label text-right">{{ $setting->title }}</label>
            <div class="col-lg-4 col-xl-4">
                @if($setting->type == 'text')
                    <input type="text" class="form-control m-input" id="{{ $setting->name }}" name="{{ $setting->name }}" aria-describedby="emailHelp" value="{{ $setting->value }}">
                @elseif($setting->type == 'checkbox')
                <input type='hidden' value='off' name='{{ $setting->name }}'>
                    <span class="m-switch m-switch--icon m-switch--success">
                        <label>
                        <input type="checkbox" name="{{ $setting->name }}" @if($setting->value == 'on') checked @endif>
                        <span></span>
                        </label>
                    </span>
                    
                @elseif($setting->type == 'textarea')
                    <textarea class="form-control m-input" id="{{ $setting->name }}" name="{{ $setting->name }}" rows="6" style="resize: none;">{{ $setting->value }}</textarea>
                @elseif($setting->type == 'image')
                    @if($setting->value != null)
                        <img src="{{ \Storage::url($setting->value) }}" alt="" style="height:50px">
                    @else
                        <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+Cjxzdmcgd2lkdGg9IjQ4cHgiIGhlaWdodD0iNDhweCIgdmlld0JveD0iMCAwIDQ4IDQ4IiB2ZXJzaW9uPSIxLjEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiPgogICAgPCEtLSBHZW5lcmF0b3I6IFNrZXRjaCA0MS4yICgzNTM5NykgLSBodHRwOi8vd3d3LmJvaGVtaWFuY29kaW5nLmNvbS9za2V0Y2ggLS0+CiAgICA8dGl0bGU+KzwvdGl0bGU+CiAgICA8ZGVzYz5DcmVhdGVkIHdpdGggU2tldGNoLjwvZGVzYz4KICAgIDxkZWZzPjwvZGVmcz4KICAgIDxnIGlkPSJidXNpbmVzcy1zZXR1cCIgc3Ryb2tlPSJub25lIiBzdHJva2Utd2lkdGg9IjEiIGZpbGw9Im5vbmUiIGZpbGwtcnVsZT0iZXZlbm9kZCIgc3Ryb2tlLWxpbmVjYXA9InNxdWFyZSI+CiAgICAgICAgPGcgaWQ9IjAyLWVycm9yIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMzY2LjAwMDAwMCwgLTUxNC4wMDAwMDApIiBzdHJva2U9IiMzODk5RUMiPgogICAgICAgICAgICA8ZyBpZD0iYnVzaW5lc3MtaW5mbyIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjQ1LjAwMDAwMCwgMTg1LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgPGcgaWQ9ImxvZ28iIHRyYW5zZm9ybT0idHJhbnNsYXRlKDQyLjAwMDAwMCwgMjUxLjAwMDAwMCkiPgogICAgICAgICAgICAgICAgICAgIDxnIGlkPSIrIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg3OS4wMDAwMDAsIDc4LjAwMDAwMCkiPgogICAgICAgICAgICAgICAgICAgICAgICA8cGF0aCBkPSJNMC43NjYzNTUxNCwyMy43NTcwMDkzIEw0Ni43NDc2NjM2LDIzLjc1NzAwOTMiIGlkPSJMaW5lIj48L3BhdGg+CiAgICAgICAgICAgICAgICAgICAgICAgIDxwYXRoIGQ9Ik0yMy43NTcwMDkzLDAuNzY2MzU1MTQgTDIzLjc1NzAwOTMsNDYuNzQ3NjYzNiIgaWQ9IkxpbmUiPjwvcGF0aD4KICAgICAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgICAgICA8L2c+CiAgICAgICAgICAgIDwvZz4KICAgICAgICA8L2c+CiAgICA8L2c+Cjwvc3ZnPg==" alt="" class="img-fluid">
                    @endif
                    <div class="custom-file">
                        <input type="file" name="{{ $setting->name }}" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">
                            {{ ($setting->value != '') ? $setting->value : 'Choose File' }}
                        </label>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach