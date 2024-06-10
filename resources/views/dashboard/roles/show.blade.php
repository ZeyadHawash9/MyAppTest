@extends(dashboard_layout_vw())

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">

                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <h2 class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                {{ __('dashboard.name') }}: {{ $role->name }}</h2>


                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="fv-row mb-7">
                                <label
                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.permissions') }}</label>
                                @foreach ($rolePermissions as $Permission)
                                    <div class="form-check mt-3">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $Permission }}
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
