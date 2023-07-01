<div class="navbar navbar-toggleable-sm flex-row align-items-center">
    <!-- Open side - Naviation on mobile -->
    <a data-toggle="modal" data-target="#aside" class="hidden-lg-up mr-3">
        <i class="material-icons">&#xe5d2;</i>
    </a>
    <!-- / -->

    <!-- Page title - Bind to $state's title -->
    <div class="mb-0 h5 no-wrap" ng-bind="$state.current.data.title" id="pageTitle"></div>

    <!-- navbar collapse -->
    <div class="collapse navbar-collapse" id="collapse">
        <!-- link and dropdown -->
        <ul class="nav navbar-nav mr-auto">
            <li class="pull-right">

                <div >
                </div>
            </li>
        </ul>

        <div ui-include="'../views/blocks/navbar.form.html'"></div>
        <!-- / -->
    </div>
    <!-- / navbar collapse -->

    <!-- navbar right -->
    <ul class="nav navbar-nav ml-auto flex-row">
        <li class="nav-item dropdown pos-stc-xs">
            <form action="{{route('logout')}}" method="post">
                @csrf
            <button class=" btn btn-outline b-danger border-0 text-danger p-2 "> <i class="material-icons">power_settings_new </i></button>
            </form>
        </li>
        <li class="nav-item dropdown">

        </li>
        <li class="nav-item hidden-md-up">

        </li>
    </ul>
    <!-- / navbar right -->
</div>
