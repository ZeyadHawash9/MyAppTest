@extends(dashboard_layout_vw())
@section('content')
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->

        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Navbar-->

                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <!--begin::Card header-->

                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">Image</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                    <img src="{{ $Category->image }}"  alt="image" />
                                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--begin::Row-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">Name</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $Category->name }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                           <!--begin::Row-->
                           <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-semibold text-muted">Description</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 text-gray-800">{{ $Category->description }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->

                        <!--begin::Input group-->

                        <!--end::Input group-->


                        <!--end::Notice-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->
    <!--begin::Footer-->

    <!--end::Footer-->
</div>

@endsection

