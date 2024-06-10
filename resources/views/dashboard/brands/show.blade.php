@extends(dashboard_layout_vw())

@section('content')
    <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
        <div class="d-flex flex-column flex-column-fluid">
            <div id="kt_app_content" class="app-content flex-column-fluid">
                <div id="kt_app_content_container" class="app-container container-xxl">
                    <div class="card mb-5 mb-xl-10">
                        <div class="card-body pt-9 pb-0">
                            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                                <div class="me-7 mb-4">
                                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                        <img src="{{ $brand->image }}" alt="image" class="img-fluid rounded-circle" />
                                        <div
                                            class="position-absolute bottom-0 start-100 translate-middle mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center mb-2">
                                            <h2 class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                {{ __('dashboard.name') }}: {{ $brand->name }}</h2>

                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <h2 class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">
                                                {{ __('dashboard.description') }}: {{ $brand->description }}</h2>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
