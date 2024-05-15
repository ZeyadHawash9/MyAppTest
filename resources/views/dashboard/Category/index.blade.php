 @extends(dashboard_layout_vw())
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
                                     <a href="{{ route('dashboard.categories.create') }}"
                                         class="btn btn-sm fw-bold btn-primary">Create</a>
                                 </div>
                             </div>
                         </div>
                         <div id="kt_app_content" class="app-content flex-column-fluid">
                             <div id="kt_app_content_container" class="app-container container-xxl">
                                 <div class="card">
                                     <div class="card-body py-4">
                                        <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_categories">
                                            <thead>
                                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                                    <th class="w-10px pe-2">
                                                        <div
                                                            class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                            <input class="form-check-input" type="checkbox"
                                                                data-kt-check="true"
                                                                data-kt-check-target="#table_categories .form-check-input"
                                                                value="1" />
                                                        </div>
                                                    </th>
                                                    <th class="text-center">{{ __('Image') }}</th>
                                                    <th class="text-center">{{ __('Name') }}</th>
                                                    <th class="text-center">{{ __('Description') }}</th>
                                                    <th class="text-center">{{ __('Parent') }}</th>
                                                    <th class="text-center">{{ __('Active') }}</th>
                                                    <th class="text-center">{{ __('Actions') }}</th>
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
                $('#table_categories').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('en/dashboard/categories/any-data') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'image',
                        name: 'image'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                            data: 'active',
                            name: 'active'
                        },
                    {
                        data: 'action',
                        name: 'action'
                    }
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
