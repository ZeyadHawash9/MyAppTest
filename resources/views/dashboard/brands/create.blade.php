@extends('dashboard.layouts.app')
@section('content')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">
            <div class=" flex-column flex-row-fluid" id="kt_app_wrapper">
                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">
                    <div class="d-flex flex-column flex-column-fluid">
                        <div id="kt_app_content" class="app-content flex-column-fluid">
                            <div id="kt_app_content_container" class="app-container container-xxl">
                                <div class="card">
                                    <div class="card-body py-4">
                                        <div class="col-xxl-8">
                                            <!--begin::Toolbar-->
                                            <div class="card-toolbar">
                                                <ul class="nav nav-tabs nav-line-tabs nav-stretch border-transparent fs-5 fw-bold"
                                                    id="kt_security_summary_tabs">

                                                    @foreach ($languages as $language)
                                                        <li class="nav-item">
                                                            <a class="nav-link text-active-primary @if ($loop->first) active @endif"
                                                                data-kt-countup-tabs="true" data-bs-toggle="tab"
                                                                href="#kt_security_summary_tab_pane_{{ $language->iso }}">
                                                                {{ $language->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <!--end::Toolbar-->
                                        </div>
                                        <form class="form" id="kt_modal_add_user_form" method="POST"
                                            @if (!isset($brand)) action= "{{ route('dashboard.brands.store') }}"
                                           @else
                                           action= "{{ route('dashboard.brands.update', $brand) }}" @endif
                                            enctype="multipart/form-data">
                                            @csrf
                                            @if (isset($brand))
                                                @method('PUT')
                                            @endif
                                            <div class="fv-row mb-7">
                                                <div class="tab-content">

                                                    @foreach ($languages as $language)
                                                        <div class="tab-pane fade @if ($loop->first) active show @endif"
                                                            id="kt_security_summary_tab_pane_{{ $language->iso }}"
                                                            role="tabpanel">

                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-semibold fs-6 mb-2">description
                                                                    {{ $language->name }}</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text"
                                                                    name="description[{{ $language->iso }}]"
                                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                                    placeholder="description"
                                                                    value="{{ $brand?->getTranslation('description', $language->iso) ?? old('description') }}" />
                                                                <!--end::Input-->
                                                            </div>
                                                        </div>
                                                        <!--end::Tab panel-->
                                                    @endforeach
                                                </div>
                                                <div class="fv-row mb-7">
                                                    <label class="required fw-semibold fs-6 mb-2">{{ __('dashboard.name') }}</label>
                                                    <input type="text" name="name"
                                                        class="form-control form-control-solid mb-3 mb-lg-0"
                                                        placeholder="Full name" value="{{ $brand->name ?? old('name') }}" />
                                                </div>
                                                <label
                                                    class="d-block fw-semibold fs-6 mb-5">{{ __('dashboard.image') }}</label>
                                                <div class="image-input image-input-outline image-input-placeholder"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url('/dashboard/media/avatars/300-6.jpg');">
                                                    </div>
                                                    <label
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="change" data-bs-toggle="tooltip"
                                                        title="Change avatar">
                                                        <i class="bi bi-pencil-fill fs-7"></i>
                                                        <input type="file" name="image" accept=".png, .jpg, .jpeg" />
                                                        <input type="hidden" name="avatar_remove" />
                                                    </label>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="cancel" data-bs-toggle="tooltip"
                                                        title="Cancel avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                    <span
                                                        class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                                        data-kt-image-input-action="remove" data-bs-toggle="tooltip"
                                                        title="Remove avatar">
                                                        <i class="bi bi-x fs-2"></i>
                                                    </span>
                                                </div>




                                            </div>




                                            <div class="text-center pt-15">
                                                <a href="{{ route('dashboard.admins.index') }}"
                                                    class="btn btn-light me-3">{{ __('dashboard.discard') }}</a>

                                                <button type="submit" class="btn btn-primary"
                                                    data-kt-users-modal-action="submit">
                                                    <span class="indicator-label">{{ __('dashboard.submit') }}</span>
                                                    <span class="indicator-progress">Please wait...<span
                                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </div>

                                        </form>
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
@section('js')
    <script>
        document.getElementById('toggleCheckbox').addEventListener('change', function() {
            var div = document.getElementById('toggleDiv');
            div.style.display = this.checked ? 'block' : 'none';
        });
    </script>
@endsection
