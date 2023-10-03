<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('labels.backend.access.preciption-types.all') }}</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.preciption-types.index') }}">@lang('menus.backend.access.preciption-types.active')</a>
                <a class="dropdown-item" href="{{ route('admin.preciption-types.create') }}">@lang('menus.backend.access.preciption-types.create')</a>
              
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>