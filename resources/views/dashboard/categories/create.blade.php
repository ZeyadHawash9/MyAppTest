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
                                            @if (!isset($category)) action= "{{ route('dashboard.categories.store') }}"
                                           @else
                                           action= "{{ route('dashboard.categories.update', $category) }}" @endif
                                            enctype="multipart/form-data">
                                            @csrf
                                            @if (isset($category))
                                                @method('PUT')
                                            @endif
                                            <div class="fv-row mb-7">
                                                <div class="tab-content">
                                                    @forelse ($languages as $language)
                                                        <div class="tab-pane fade @if ($loop->first) active show @endif"
                                                            id="kt_security_summary_tab_pane_{{ $language->iso }}"
                                                            role="tabpanel">
                                                            <div class="fv-row mb-7">
                                                                <!--begin::Label-->
                                                                <label class="required fw-semibold fs-6 mb-2">Full
                                                                    Name {{ $language->name }}</label>
                                                                <!--end::Label-->
                                                                <!--begin::Input-->
                                                                <input type="text" name="name[{{ $language->iso }}]"
                                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                                    placeholder="Full name"
                                                                    value="{{ $category?->getTranslation('name', $language->iso) ?? old('name') }}" />
                                                                <!--end::Input-->
                                                            </div>
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
                                                                    value="{{ $category?->getTranslation('description', $language->iso) ?? old('description') }}" />
                                                            </div>
                                                        </div>
                                                    @empty
                                                        <div class=" ">

                                                            <div class="fv-row mb-7">
                                                                <label class="required fw-semibold fs-6 mb-2">Full Name
                                                                </label>
                                                                <input type="text" name="name[{{ $locale }}]"
                                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                                    placeholder="Full name"
                                                                    value="{{ $category?->getTranslation('name', $locale) ?? old('name') }}" />
                                                            </div>
                                                            <div class="fv-row mb-7">
                                                                <label
                                                                    class="required fw-semibold fs-6 mb-2">description</label>
                                                                <input type="text"
                                                                    name="description[{{ $locale }}]"
                                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                                    placeholder="description"
                                                                    value="{{ $category?->getTranslation('description', $locale) ?? old('description') }}" />
                                                            </div>
                                                        </div>
                                                    @endforelse
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
                                                <div class="form-check mt-5">
                                                    <input class="form-check-input" @if (isset($category->parent)) checked @endif type="checkbox" id="toggleCheckbox">
                                                    <label class="form-check-label" for="toggleCheckbox">
                                                        Is Child
                                                    </label>
                                                </div>

                                                <div id="toggleDiv"  @if (! isset($category->parent)) style="display: none;" @endif >
                                                    <label
                                                        class="d-block fw-semibold fs-6 mb-5 mt-5">{{ __('dashboard.parent') }}</label>
                                                    <div class="fv-row mb-7">

                                                        <select name="parent" class="form-select form-select-solid"
                                                            data-control="select2" data-hide-search="true"
                                                            data-placeholder="parent">
                                                            <option selected value=''>
                                                                Choose a parent </option>
                                                            @foreach ($categories as $categorySelect)
                                                                @if (isset($category->parent))
                                                                    @if ($category->parent->id == $categorySelect->id)
                                                                        <option selected
                                                                            value=" {{ $categorySelect->id }}">
                                                                            {{ $categorySelect->name }}</option>
                                                                    @else
                                                                        <option value=" {{ $categorySelect->id }}">
                                                                            {{ $categorySelect->name }}</option>
                                                                    @endif
                                                                @else
                                                                    <option value="{{ $categorySelect->id }}">
                                                                        {{ $categorySelect->name }}</option>
                                                                @endif
                                                            @endforeach


                                                        </select>

                                                    </div>
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
