 @extends(dashboard_layout_vw())
 @section('content')
     <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
         <div id="kt_app_content" class="app-content flex-column-fluid">
             <div id="kt_app_content_container" class="app-container container-xxl">
                 <div class="card">
                     <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-row-reverse mt-12">
                         <div class="d-flex align-items-center gap-2 gap-lg-3">
                             <a href="{{ route('dashboard.admins.create') }}"
                                 class="btn btn-sm fw-bold btn-primary">{{ __('dashboard.create') }}</a>
                         </div>
                     </div>
                     <div class="card-body py-4">
                         <table class="table align-middle table-row-dashed fs-6 gy-5" id="table_Admin">
                             <thead>
                                 <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                     <th class="w-10px pe-2">
                                         <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                             <input class="form-check-input" type="checkbox" data-kt-check="true"
                                                 data-kt-check-target="#table_Admin .form-check-input" value="1" />
                                         </div>
                                     </th>

                                     <th class="text-center">{{ __('dashboard.image') }}</th>
                                     <th class="text-center">{{ __('dashboard.name') }}</th>
                                     <th class="text-center">{{ __('dashboard.email') }}</th>
                                     <th class="text-center">{{ __('dashboard.user name') }}</th>
                                     <th class="text-center">{{ __('dashboard.phone number') }}</th>
                                     <th class="text-center">{{ __('dashboard.active') }}</th>
                                     <th class="text-center">{{ __('dashboard.role') }}</th>
                                     <th class="text-center">{{ __('dashboard.actions') }}</th>
                                 </tr>
                             </thead>
                         </table>
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
                 ajax:  `/${locale}/dashboard/admins/any-data`,
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
                     },
                     {
                         data: 'active',
                         name: 'active'
                     },
                     {
                         data: 'role',
                         name: 'role'
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
                 message: " {!! __('dashboard.delete_msg') !!} (" + admin_name + ") ?",
                 buttons: {


                     confirm: {
                         label: '<i class="fa fa-check"></i> {!! __('dashboard.confirm') !!}',
                         className: 'btn-success'
                     },
                     cancel: {
                         label: '<i class="fa fa-remove"></i> {!! __('dashboard.change') !!}',
                         className: 'btn-danger'
                     },
                 },
                 callback: function(result) {
                     if (result) {
                         $.ajax({
                             url: action,
                             type: "POST",
                             data: {
                                 "_method": "DELETE",
                                 "_token": "{{ csrf_token() }}",
                             },
                             success: function(data) {
                                 if (data.status) {
                                     $('.alert').hide();
                                     toastr['success'](data.message, '');

                                     if ($("#table_Admin").length) {
                                         var admins_tbl = $('#table_Admin').DataTable();
                                         admins_tbl.ajax.reload();
                                     }
                                 } else {
                                     toastr['error'](data.message);
                                 }
                             },
                             error: function(xhr, status, error) {}


                         });



                     }
                 }
             });


         });
         $('#table_Admin').on('change', '.make-switch.active', function(event, state) {

             var admin_id = $(this).data('id');
             $.ajax({
                 url:`/en/dashboard/admins/${admin_id}/active`,

                 type: 'post',
                 dataType: 'json',
                 data: {
                     '_token': csrf_token
                 },
                 success: function(data) {
                    if (data.status) {
                        toastr['success'](data.message, '');
                     } else {
                         toastr['error'](data.message);
                     }

                 }
             });

         });
     </script>
 @endsection
