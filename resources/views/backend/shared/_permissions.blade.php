<div class="m-portlet m-portlet--brand m-portlet--head-solid-bg m-portlet--head-sm">
        <div class="m-portlet__head" role="tab" id="{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
			<div class="m-portlet__head-caption">
                <div class="m-portlet__head-title">
                    <h3 class="m-portlet__head-text">
                        <a role="button" class="m-portlet__head-text" data-toggle="collapse" data-parent="#accordion" href="#dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" aria-expanded="true" aria-controls="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
                            {{ isset($title) ? str_slug($title) : 'Override Permissions' }}
                        </a>
                    </h3>
                </div>
			</div>
        </div>
        <div id="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="dd-{{ isset($title) ? str_slug($title) :  'permissionHeading' }}">
            <div class="m-portlet__body">
                <div class="row">
            
                    @foreach($permissions as $perm)
                        <?php

                            $per_found = null;
                            if( isset($role) ) {
                                
                                $per_found = $role->hasPermissionTo($perm->name);
                            }
                            if( isset($user)) {
                                $per_found = $user->hasPermissionTo($perm->name);
                            }
                        ?>
                        <div class="col-md-3">
                            <div class="checkbox">
                                <label class="{{ str_contains($perm->name, 'delete') ? 'text-danger' : '' }}">
                                    {!! Form::checkbox("permissions[]", $perm->name, $per_found, isset($options) ? $options : []) !!} {{ $perm->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @can('edit_roles')
                <div class="m-portlet__foot">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            @endcan
        </div>
    </div>