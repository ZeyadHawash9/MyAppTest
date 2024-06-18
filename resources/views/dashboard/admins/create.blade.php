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
                                        </div>
                                        <form class="form" id="kt_modal_add_user_form" method="POST"
                                            @if (!isset($admin)) action= "{{ route('dashboard.admins.store') }}"
                                           @else
                                           action= "{{ route('dashboard.admins.update', $admin) }}" @endif
                                            enctype="multipart/form-data">
                                            @csrf
                                            @if (isset($admin))
                                                @method('PUT')
                                            @endif
                                            <div class="fv-row mb-7">
                                                <label
                                                    class="d-block fw-semibold fs-6 mb-5">{{ __('dashboard.image') }}</label>
                                                <div class="image-input image-input-outline image-input-placeholder"
                                                    data-kt-image-input="true">
                                                    <div class="image-input-wrapper w-125px h-125px"
                                                        style="background-image: url('/Admin/media/avatars/300-6.jpg');">
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
                                            <div class="fv-row mb-7">
                                                <label
                                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.name') }}</label>
                                                <input type="text" name="name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="Full name" value="{{ $admin->name ?? old('name') }}" />
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label
                                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.user name') }}</label>
                                                <input type="text" name="user_name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="User Name"
                                                    value="{{ $admin->user_name ?? old('user_name') }}" />
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label
                                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.phone number') }}</label>
                                                <input type="text" name="phone_number"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="Phone Number"
                                                    value="{{ $admin->phone_number ?? old('phone_number') }}" />
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label
                                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.email') }}</label>
                                                <input type="email" name="email"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="example@domain.com"
                                                    value="{{ $admin->email ?? old('email') }}" />
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label
                                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.password') }}</label>
                                                <input type="password" name="password"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="password" value="" />
                                            </div>

                                            <div class="fv-row mb-7">
                                                <label
                                                    class="required fw-semibold fs-6 mb-2">{{ __('dashboard.roles') }}</label>
                                                @foreach ($roles as $role)
                                                    <div class="form-check mt-3">
                                                        <input class="form-check-input" type="checkbox" name="roles[]"
                                                            value="{{ $role->name }}" id="{{ $role->name }}"
                                                            @isset($adminRoles)
                                                          @if (in_array($role->name, $adminRoles->toArray())) checked @endif
                                                          @endisset>
                                                        <label class="form-check-label" for="{{ $role->name }}">
                                                            {{ $role->name }}
                                                        </label>
                                                    </div>
                                                @endforeach

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
