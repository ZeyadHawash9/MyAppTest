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
                                            @if (!isset($role)) action= "{{ route('dashboard.roles.store') }}"
                                           @else
                                           action= "{{ route('dashboard.roles.update', $role) }}" @endif
                                            enctype="multipart/form-data">
                                            @csrf
                                            @if (isset($role))
                                                @method('PUT')
                                            @endif

                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">{{ __('dashboard.name') }}</label>
                                                <input type="text" name="name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="Name" value="{{ $role->name ?? old('name') }}" />
                                            </div>
                                            <div class="fv-row mb-7">
                                                <label class="required fw-semibold fs-6 mb-2">{{ __('dashboard.guard_name') }}</label>
                                                <input type="text" name="guard_name"
                                                    class="form-control form-control-solid mb-3 mb-lg-0"
                                                    placeholder="Guard Name"
                                                    value="{{ $role->guard_name ?? old('guard_name') }}" />
                                            </div>
                                            <div class="text-center pt-15">
                                                <a href="{{ route('dashboard.roles.index') }}" class="btn btn-light me-3">{{ __('dashboard.discard') }}</a>

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
