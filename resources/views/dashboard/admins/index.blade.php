 @extends('dashboard.layouts.layout')
 {{-- @section('content')

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">

        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <div class=" flex-column flex-row-fluid" id="kt_app_wrapper">


                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <div class="d-flex flex-column flex-column-fluid">

                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">

                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

                                    <h1
                                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        Users List</h1>


                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                                        <li class="breadcrumb-item text-muted">
                                            <a href="../../demo1/dist/index.html"
                                                class="text-muted text-hover-primary">Home</a>
                                        </li>


                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>


                                        <li class="breadcrumb-item text-muted">User Management</li>


                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>


                                        <li class="breadcrumb-item text-muted">Users</li>

                                    </ul>

                                </div>


                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                    <div class="m-0">

                                        <a href="#"
                                            class="btn btn-sm btn-flex bg-body btn-color-gray-700 btn-active-color-primary fw-bold"
                                            data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                                            <span class="svg-icon svg-icon-6 svg-icon-muted me-1">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                        fill="currentColor" />
                                                </svg>
                                            </span>



                                        <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true"
                                            id="kt_menu_637dc7679e179">

                                            <div class="px-7 py-5">
                                                <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                            </div>


                                            <div class="separator border-gray-200"></div>


                                            <div class="px-7 py-5">

                                                <div class="mb-10">

                                                    <label class="form-label fw-semibold">Status:</label>


                                                    <div>
                                                        <select class="form-select form-select-solid" data-kt-select2="true"
                                                            data-placeholder="Select option"
                                                            data-dropdown-parent="#kt_menu_637dc7679e179"
                                                            data-allow-clear="true">
                                                            <option></option>
                                                            <option value="1">Approved</option>
                                                            <option value="2">Pending</option>
                                                            <option value="2">In Process</option>
                                                            <option value="2">Rejected</option>
                                                        </select>
                                                    </div>

                                                </div>


                                                <div class="mb-10">

                                                    <label class="form-label fw-semibold">Member Type:</label>


                                                    <div class="d-flex">

                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="1" />
                                                            <span class="form-check-label">Author</span>
                                                        </label>


                                                        <label
                                                            class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="2"
                                                                checked="checked" />
                                                            <span class="form-check-label">Customer</span>
                                                        </label>

                                                    </div>

                                                </div>


                                                <div class="mb-10">

                                                    <label class="form-label fw-semibold">Notifications:</label>


                                                    <div
                                                        class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                                                        <input class="form-check-input" type="checkbox" value=""
                                                            name="notifications" checked="checked" />
                                                        <label class="form-check-label">Enabled</label>
                                                    </div>

                                                </div>


                                                <div class="d-flex justify-content-end">
                                                    <button type="reset"
                                                        class="btn btn-sm btn-light btn-active-light-primary me-2"
                                                        data-kt-menu-dismiss="true">Reset</button>
                                                    <button type="submit" class="btn btn-sm btn-primary"
                                                        data-kt-menu-dismiss="true">Apply</button>
                                                </div>

                                            </div>

                                        </div>

                                    </div>




                                    <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_create_app">Create</a>

                                </div>

                            </div>

                        </div>


                        <div id="kt_app_content" class="app-content flex-column-fluid">

                            <div id="kt_app_content_container" class="app-container container-xxl">

                                <div class="card">

                                    <div class="card-header border-0 pt-6">

                                        <div class="card-title">

                                            <div class="d-flex align-items-center position-relative my-1">

                                                <span class="svg-icon svg-icon-1 position-absolute ms-6">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                            height="2" rx="1"
                                                            transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                        <path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>

                                                <input type="text" data-kt-user-table-filter="search"
                                                    class="form-control form-control-solid w-250px ps-14"
                                                    placeholder="Search user" />
                                            </div>

                                        </div>


                                        <div class="card-toolbar">

                                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                                                <button type="button" class="btn btn-light-primary me-3"
                                                    data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">

                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>


                                                <div class="menu menu-sub menu-sub-dropdown w-300px w-md-325px"
                                                    data-kt-menu="true">

                                                    <div class="px-7 py-5">
                                                        <div class="fs-5 text-dark fw-bold">Filter Options</div>
                                                    </div>


                                                    <div class="separator border-gray-200"></div>


                                                    <div class="px-7 py-5" data-kt-user-table-filter="form">

                                                        <div class="mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Role:</label>
                                                            <select class="form-select form-select-solid fw-bold"
                                                                data-kt-select2="true" data-placeholder="Select option"
                                                                data-allow-clear="true" data-kt-user-table-filter="role"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="Administrator">Administrator</option>
                                                                <option value="Analyst">Analyst</option>
                                                                <option value="Developer">Developer</option>
                                                                <option value="Support">Support</option>
                                                                <option value="Trial">Trial</option>
                                                            </select>
                                                        </div>


                                                        <div class="mb-10">
                                                            <label class="form-label fs-6 fw-semibold">Two Step
                                                                Verification:</label>
                                                            <select class="form-select form-select-solid fw-bold"
                                                                data-kt-select2="true" data-placeholder="Select option"
                                                                data-allow-clear="true"
                                                                data-kt-user-table-filter="two-step"
                                                                data-hide-search="true">
                                                                <option></option>
                                                                <option value="Enabled">Enabled</option>
                                                            </select>
                                                        </div>


                                                        <div class="d-flex justify-content-end">
                                                            <button type="reset"
                                                                class="btn btn-light btn-active-light-primary fw-semibold me-2 px-6"
                                                                data-kt-menu-dismiss="true"
                                                                data-kt-user-table-filter="reset">Reset</button>
                                                            <button type="submit"
                                                                class="btn btn-primary fw-semibold px-6"
                                                                data-kt-menu-dismiss="true"
                                                                data-kt-user-table-filter="filter">Apply</button>
                                                        </div>

                                                    </div>

                                                </div>



                                                <button type="button" class="btn btn-light-primary me-3"
                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">

                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.3" x="12.75" y="4.25" width="12"
                                                                height="2" rx="1"
                                                                transform="rotate(90 12.75 4.25)" fill="currentColor" />
                                                            <path
                                                                d="M12.0573 6.11875L13.5203 7.87435C13.9121 8.34457 14.6232 8.37683 15.056 7.94401C15.4457 7.5543 15.4641 6.92836 15.0979 6.51643L12.4974 3.59084C12.0996 3.14332 11.4004 3.14332 11.0026 3.59084L8.40206 6.51643C8.0359 6.92836 8.0543 7.5543 8.44401 7.94401C8.87683 8.37683 9.58785 8.34458 9.9797 7.87435L11.4427 6.11875C11.6026 5.92684 11.8974 5.92684 12.0573 6.11875Z"
                                                                fill="currentColor" />
                                                            <path opacity="0.3"
                                                                d="M18.75 8.25H17.75C17.1977 8.25 16.75 8.69772 16.75 9.25C16.75 9.80228 17.1977 10.25 17.75 10.25C18.3023 10.25 18.75 10.6977 18.75 11.25V18.25C18.75 18.8023 18.3023 19.25 17.75 19.25H5.75C5.19772 19.25 4.75 18.8023 4.75 18.25V11.25C4.75 10.6977 5.19771 10.25 5.75 10.25C6.30229 10.25 6.75 9.80228 6.75 9.25C6.75 8.69772 6.30229 8.25 5.75 8.25H4.75C3.64543 8.25 2.75 9.14543 2.75 10.25V19.25C2.75 20.3546 3.64543 21.25 4.75 21.25H18.75C19.8546 21.25 20.75 20.3546 20.75 19.25V10.25C20.75 9.14543 19.8546 8.25 18.75 8.25Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>



                                                    data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">

                                                    <span class="svg-icon svg-icon-2">
                                                        <svg width="24" height="24" viewBox="0 0 24 24"
                                                            fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <rect opacity="0.5" x="11.364" y="20.364" width="16"
                                                                height="2" rx="1"
                                                                transform="rotate(-90 11.364 20.364)"
                                                                fill="currentColor" />
                                                            <rect x="4.36396" y="11.364" width="16" height="2"
                                                                rx="1" fill="currentColor" />
                                                        </svg>
                                                    </span>

                                                    <a href="{{ route('dashboard.admins.create') }}"
                                                        style="text-decoration:none; color:white;">
                                                        Add Admin
                                                    </a>
                                                </button>


                                            </div>


                                            <div class="d-flex justify-content-end align-items-center d-none"
                                                data-kt-user-table-toolbar="selected">
                                                <div class="fw-bold me-5">
                                                    <span class="me-2"
                                                        data-kt-user-table-select="selected_count"></span>Selected
                                                </div>
                                                <button type="button" class="btn btn-danger"
                                                    data-kt-user-table-select="delete_selected">Delete Selected</button>
                                            </div>


                                            <div class="modal fade" id="kt_modal_export_users" tabindex="-1"
                                                aria-hidden="true">

                                                <div class="modal-dialog modal-dialog-centered mw-650px">

                                                    <div class="modal-content">

                                                        <div class="modal-header">

                                                            <h2 class="fw-bold">Export Users</h2>


                                                            <div class="btn btn-icon btn-sm btn-active-icon-primary"
                                                                data-kt-users-modal-action="close">

                                                                <span class="svg-icon svg-icon-1">
                                                                    <svg width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <rect opacity="0.5" x="6" y="17.3137"
                                                                            width="16" height="2" rx="1"
                                                                            transform="rotate(-45 6 17.3137)"
                                                                            fill="currentColor" />
                                                                        <rect x="7.41422" y="6" width="16"
                                                                            height="2" rx="1"
                                                                            transform="rotate(45 7.41422 6)"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>

                                                            </div>

                                                        </div>


                                                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">

                                                            <form id="kt_modal_export_users_form" class="form"
                                                                action="#">

                                                                <div class="fv-row mb-10">

                                                                    <label class="fs-6 fw-semibold form-label mb-2">Select
                                                                        Roles:</label>


                                                                    <select name="role" data-control="select2"
                                                                        data-placeholder="Select a role"
                                                                        data-hide-search="true"
                                                                        class="form-select form-select-solid fw-bold">
                                                                        <option></option>
                                                                        <option value="Administrator">Administrator
                                                                        </option>
                                                                        <option value="Analyst">Analyst</option>
                                                                        <option value="Developer">Developer</option>
                                                                        <option value="Support">Support</option>
                                                                        <option value="Trial">Trial</option>
                                                                    </select>

                                                                </div>


                                                                <div class="fv-row mb-10">

                                                                    <label
                                                                        class="required fs-6 fw-semibold form-label mb-2">Select
                                                                        Export Format:</label>


                                                                    <select name="format" data-control="select2"
                                                                        data-placeholder="Select a format"
                                                                        data-hide-search="true"
                                                                        class="form-select form-select-solid fw-bold">
                                                                        <option></option>
                                                                        <option value="excel">Excel</option>
                                                                        <option value="pdf">PDF</option>
                                                                        <option value="cvs">CVS</option>
                                                                        <option value="zip">ZIP</option>
                                                                    </select>

                                                                </div>


                                                                <div class="text-center">
                                                                    <button type="reset" class="btn btn-light me-3"
                                                                        data-kt-users-modal-action="cancel">Discard</button>
                                                                    <button type="submit" class="btn btn-primary"
                                                                        data-kt-users-modal-action="submit">
                                                                        <span class="indicator-label">Submit</span>
                                                                        <span class="indicator-progress">Please wait...
                                                                            <span
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


                                    <div class="card-body py-4">

                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_Admin">

                                            <thead>

                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                data-kt-check="true"
                                                                data-kt-check-target="#table_Admin .form-check-input"
                                                                value="1" />
                                                        </div>
                                                    </th>
                                                    <th class="min-w-125px">Name</th>
                                                    <th class="min-w-125px">user Name</th>
                                                    <th class="min-w-125px">Phone Number</th>
                                                    <th class="min-w-125px">is Active</th>
                                                    <th class="text-end min-w-100px">Actions</th>
                                                </tr>

                                            </thead>


                                            <tbody class="text-gray-600 fw-semibold">
                                                @forelse($admins as $admin)
                                                    <tr>

                                                        <td>
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="1" />
                                                            </div>
                                                        </td>


                                                        <td class="d-flex align-items-center">

                                                            <div
                                                                class="symbol symbol-circle symbol-50px overflow-hidden me-3">

                                                                <div class="symbol-label">
                                                                    <img src="{{ $admin->image }}" alt="Emma Smith"
                                                                        class="w-100" />
                                                                </div>

                                                            </div>


                                                            <div class="d-flex flex-column">
                                                                <a href=""
                                                                    class="text-gray-800 text-hover-primary mb-1">{{ $admin->name }}</a>
                                                                <span>{{ $admin->email }}</span>
                                                            </div>

                                                        </td>


                                                        <td>{{ $admin->user_name }}</td>


                                                        <td>
                                                            <div class="badge badge-light fw-bold">
                                                                {{ $admin->phone_number }}</div>
                                                        </td>



                                                        <td>
                                                            <div class="col-md-9">
                                                                <div class="form-check form-switch form-check-custom form-check-solid me-10">
                                                                    <form target="_self" id="toggleForm" class="FormToggleSubmit container max-w-3xl mx-auto" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" name="url" value="{{ route('dashboard.admins.status', $admin) }}">
                                                                        <input type="hidden" name="id" value="{{ $admin->id }}">

                                                                        <input class="form-check-input h-30px w-50px" name="autotimezone" type="checkbox" value=""
                                                                            id="autotimezone" {{ $admin->is_active == 1 ? 'checked' : '' }}>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </td>





                                                        <td class="text-end">
                                                            <a href="#"
                                                                class="btn btn-light btn-active-light-primary btn-sm"
                                                                data-kt-menu-trigger="click"
                                                                data-kt-menu-placement="bottom-end">Actions

                                                                <span class="svg-icon svg-icon-5 m-0">
                                                                    <svg width="24" height="24"
                                                                        viewBox="0 0 24 24" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z"
                                                                            fill="currentColor" />
                                                                    </svg>
                                                                </span>


                                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                                data-kt-menu="true">

                                                                <div class="menu-item px-3">
                                                                    <a href="{{ route('dashboard.admins.show', $admin->id) }}"
                                                                        class="menu-link px-3">show</a>
                                                                </div>
                                                                <div class="menu-item px-3">
                                                                    <a href="{{ route('dashboard.admins.edit', $admin->id) }}"
                                                                        class="menu-link px-3">Edit</a>
                                                                </div>


                                                                <div class="menu-item px-3">
                                                                    <form id="deleteForm"
                                                                        action="{{ route('dashboard.admins.destroy', $admin) }}"
                                                                        method="POST" style="display: inline;">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <a href="#" class="menu-link px-3"
                                                                            onclick="event.preventDefault(); document.getElementById('deleteForm').submit();"
                                                                            data-kt-users-table-filter="delete_row">Delete</a>
                                                                    </form>
                                                                </div>



                                                            </div>

                                                        </td>

                                                    </tr>
                                                @empty
                                                    <p>No replies</p>
                                                @endforelse


                                            </tbody>

                                        </table>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>




                </div>

            </div>

        </div>

    </div>
@endsection --}}
@section('content')

    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">

        <div class="app-page flex-column flex-column-fluid" id="kt_app_page">

            <div class=" flex-column flex-row-fluid" id="kt_app_wrapper">


                <div class="app-main flex-column flex-row-fluid" id="kt_app_main">

                    <div class="d-flex flex-column flex-column-fluid">

                        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">

                            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">

                                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">

                                    <h1
                                        class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                                        Users List</h1>


                                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                                        <li class="breadcrumb-item text-muted">
                                            <a href="../../demo1/dist/index.html"
                                                class="text-muted text-hover-primary">Home</a>
                                        </li>


                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>


                                        <li class="breadcrumb-item text-muted">User Management</li>


                                        <li class="breadcrumb-item">
                                            <span class="bullet bg-gray-400 w-5px h-2px"></span>
                                        </li>


                                        <li class="breadcrumb-item text-muted">Users</li>

                                    </ul>

                                </div>


                                <div class="d-flex align-items-center gap-2 gap-lg-3">

                                    <a href="{{ route('dashboard.admins.create') }}"
                                        class="btn btn-sm fw-bold btn-primary">Create</a>

                                </div>

                            </div>

                        </div>


                        <div id="kt_app_content" class="app-content flex-column-fluid">

                            <div id="kt_app_content_container" class="app-container container-xxl">

                                <div class="card">

                                    <div class="card-body py-4">

                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_Admin">

                                            <thead>

                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                data-kt-check="true"
                                                                data-kt-check-target="#table_Admin .form-check-input"
                                                                value="1" />
                                                        </div>
                                                    </th>
                                                    <th class="">Name</th>
                                                    <th class="">Name</th>
                                                    <th class="">user Name</th>
                                                    <th class="">Phone Number</th>
                                                    <th class="">is Active</th>
                                                    <th class="">is Active</th>

                                                    <th class="text-end ">Email</th>
                                                    <th class="text-end ">Actions</th>

                                                </tr>

                                            </thead>

                                        </table>

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

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function() {

                $('#table_Admin').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ url('en/dashboard/admins/any-data') }}",
                    columns: [{
                            data: 'id',
                            name: 'id'
                        }, {
                            data: 'image',
                            name: 'image'
                        }, {
                            data: 'name',
                            name: 'name'
                        }, {
                            data: 'email',
                            name: 'email'
                        }, {
                            data: 'user_name',
                            name: 'user_name'
                        }, {
                            data: 'phone_number',
                            name: 'phone_number'
                        }, {
                            data: 'is_active',
                            name: 'is_active'
                        },
                        {
                            data: 'active',
                            name: 'active'
                        },
                        {
                            data: 'action',
                            name: 'action'
                        },

                    ]
                });
            });

            $(document).on('click', '.delete', function(event) {

                var _this = $(this);
                event.preventDefault();

                var action = $(this).attr('href');

                var admin_name = _this.closest('tr').find("td:eq(2)").text();
                bootbox.confirm({
                    message: " (" + admin_name + ") ?",
                    buttons: {


                        confirm: {
                            label: '<i class="fa fa-check"></i> ',
                            className: 'btn-success'
                        },
                        cancel: {
                            label: '<i class="fa fa-remove"></i> ',
                            className: 'btn-danger'
                        },
                    },
                    callback: function(result) {
                        if (result) {
                            $.ajax({
                                url: action,
                                method: 'DELETE',
                                dataType: 'json',
                                data: {
                                    '_token': csrf_token
                                },
                                success: function(data) {

                                    if (data.status) {
                                        $('.alert').hide();
                                        toastr['success'](data.message, '');

                                        if ($("#admins_tbl").length) {
                                            var admins_tbl = $('#admins_tbl').DataTable();
                                            admins_tbl.ajax.reload();
                                        }

                                    } else {
                                        toastr['error'](data.message);
                                    }

                                },
                                error: function(xhr, status, error) {
                                    console.log(error);
                                }


                            });



                        }
                    }
                });


            });
        </script>
    @endsection
