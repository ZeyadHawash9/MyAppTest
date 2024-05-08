@extends('dashboard.admins.index')


@section('content')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <!--begin::Page-->
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <!--begin::Wrapper-->
            <div class=" flex-column flex-row-fluid" id="kt_app_wrapper">

                <!--begin::Main-->
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <!--begin::Content wrapper-->
                    <div class="d-flex flex-column flex-column-fluid">
                        <!--begin::Toolbar-->
                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
                            <!--begin::Toolbar container-->
                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                                <!--begin::Page title-->
                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                                    <!--begin::Title-->
                                    <h1
                                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        Users List</h1>
                                    <!--end::Title-->
                                    <!--begin::Breadcrumb-->
                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">
                                            <a href="../../demo1/dist/index.html"
                                                class="text-muted text-hover-primary">Home</a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">User Management</li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="breadcrumb-item text-muted">Users</li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Breadcrumb-->
                                </div>
                                <!--end::Page title-->
                                <!--begin::Actions-->
                                <div class="d-flex align-items-center gap-2 gap-lg-3">
                                    <!--begin::Primary button-->
                                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_create_app">Create</a>
                                    <!--end::Primary button-->
                                </div>
                                <!--end::Actions-->
                            </div>
                            <!--end::Toolbar container-->
                        </div>
                        <!--end::Toolbar-->
                        <!--begin::Content-->
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <!--begin::Content container-->
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <!--begin::Card-->
                                <div class="card">
                                    <!--begin::Card body-->
                                    <div class="card-body py-4">
                                        <!--begisn::Table-->
                                        <!--begin::Col-->
                                        <div class="col-xxl-8">
                                            <div class="col-xxl-8">
                                                <!--begin::Security summary-->
                                                <div class="card card-xxl-stretch mb-5 mb-xl-10">
                                                    <!--begin::Header-->
                                                    <div class="card-header card-header-stretch">

                                                        <!--begin::Toolbar-->
                                                        <div class="card-toolbar">
                                                            <ul class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold"
                                                                id="kt_security_summary_tabs">

                                                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                                    <li class="nav-item">
                                                                        <a class="nav-link text-active-primary @if ($loop->first) active @endif"
                                                                            data-kt-countup-tabs="true" data-bs-toggle="tab"
                                                                            href="#kt_security_summary_tab_pane_{{ $properties['native'] }}">
                                                                            {{ $properties['native'] }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                        <!--end::Toolbar-->
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Body-->
                                                    <form class="form" id="kt_modal_add_user_form"
                                                        action="{{ route('dashboard.categories.store') }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        @if ($errors->any())
                                                            <div class="alert alert-danger">
                                                                <ul>
                                                                    @foreach ($errors->all() as $error)
                                                                        <li>{{ $error }}</li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        @endif
                                                        <div class="card-body pt-7 pb-0 px-0">
                                                            <!--begin::Tab content-->
                                                            <div class="tab-content">
                                                                <!--begin::Tab panel-->
                                                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                                                    <div class="tab-pane fade @if ($loop->first) active show @endif"
                                                                        id="kt_security_summary_tab_pane_{{ $properties['native'] }}"
                                                                        role="tabpanel">
                                                                        <div class="fv-row mb-7">
                                                                            <!--begin::Label-->
                                                                            <label
                                                                                class="required fw-semibold fs-6 mb-2">Full
                                                                                Name {{ $properties['native'] }}</label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text"
                                                                                name="name[{{ $localeCode }}]"
                                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                                placeholder="Full name"
                                                                                value="{{ $Category->name ?? old('name') }}" />
                                                                            <!--end::Input-->
                                                                        </div>
                                                                        <div class="fv-row mb-7">
                                                                            <!--begin::Label-->
                                                                            <label
                                                                                class="required fw-semibold fs-6 mb-2">description
                                                                                {{ $properties['native'] }}</label>
                                                                            <!--end::Label-->
                                                                            <!--begin::Input-->
                                                                            <input type="text"
                                                                                name="description[{{ $localeCode }}]"
                                                                                class="form-control form-control-solid mb-3 mb-lg-0"
                                                                                placeholder="description"
                                                                                value="{{ $Category->description ?? old('description') }}" />
                                                                            <!--end::Input-->
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Tab panel-->
                                                                @endforeach
                                                                <div class="fv-row mb-7">
                                                                    <!--begin::Label-->
                                                                    <label
                                                                        class="d-block fw-semibold fs-6 mb-5">Avatar</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Image input-->
                                                                    <div class="image-input image-input-outline image-input-placeholder"
                                                                        data-kt-image-input="true">
                                                                        <!--begin::Preview existing avatar-->
                                                                        <div class="image-input-wrapper w-125px h-125px"
                                                                            style="background-image: url('/Admin/media/avatars/300-6.jpg');">
                                                                        </div>
                                                                        <!--end::Preview existing avatar-->
                                                                        <!--begin::Label-->
                                                                        <label
                                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                            data-kt-image-input-action="change"
                                                                            data-bs-toggle="tooltip" title="Change avatar">
                                                                            <i class="bi bi-pencil-fill fs-7"></i>
                                                                            <!--begin::Inputs-->
                                                                            <input type="file" name="image"
                                                                                accept=".png, .jpg, .jpeg" />
                                                                            <input type="hidden" name="image" />
                                                                            <!--end::Inputs-->
                                                                        </label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Cancel-->
                                                                        <span
                                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                            data-kt-image-input-action="cancel"
                                                                            data-bs-toggle="tooltip" title="Cancel avatar">
                                                                            <i class="bi bi-x fs-2"></i>
                                                                        </span>
                                                                        <!--end::Cancel-->
                                                                        <!--begin::Remove-->
                                                                        <span
                                                                            class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                                            data-kt-image-input-action="remove"
                                                                            data-bs-toggle="tooltip" title="Remove avatar">
                                                                            <i class="bi bi-x fs-2"></i>
                                                                        </span>
                                                                        <!--end::Remove-->
                                                                    </div>
                                                                    <!--end::Image input-->
                                                                    <!--begin::Hint-->
                                                                    <div class="form-text">Allowed file types: png, jpg,
                                                                        jpeg.</div>
                                                                    <!--end::Hint-->
                                                                </div>
                                                                <div class="fv-row mb-7">

                                                                    <span
                                                                        class="form-check form-check-custom form-check-solid">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="dbengine" value="0" />
                                                                    </span>

                                                                </div>
                                                                <div class="fv-row mb-7">

                                                                    <select name="parent"
                                                                        class="form-select form-select-solid"
                                                                        data-control="select2" data-hide-search="true"
                                                                        data-placeholder="Year">
                                                                        @foreach ($Categories as $Category)
                                                                            <option value=" {{ $Category->id }}">
                                                                                {{ $Category->name }}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="text-center pt-15">
                                                                <button type="reset" class="btn btn-light me-3"
                                                                    data-kt-users-modal-action="cancel">Discard</button>
                                                                <button type="submit" class="btn btn-primary"
                                                                    data-kt-users-modal-action="submit">
                                                                    <span class="indicator-label">Submit</span>
                                                                    <span class="indicator-progress">Please wait...<span
                                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                            </div>
                                                            <!--end::Tab content-->
                                                        </div>
                                                    </form>

                                                    <!--end::Body-->
                                                </div>
                                                <!--end::Security summary-->
                                            </div>
                                        </div>
                                        <!--end::Col-->

                                        <!--end::Table-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </div>
                            <!--end::Content container-->
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Content wrapper-->
                    <!--begin::Footer-->

                    <!--end::Footer-->
                </div>
                <!--end:::Main-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
@endsection
