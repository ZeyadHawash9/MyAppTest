@extends(dashboard_layout_vw())
@section('content')
    <div class="d-flex flex-column flex-root app-root" id="kt_app_root">
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div id="kt_app_content_container" class="app-container container-xxl">
                <div class="card shadow-sm">
                    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex justify-content-between mt-4 mb-4">
                        <h3 class="card-title">{{ __('dashboard.brands') }}</h3>
                        <div class="d-flex align-items-center gap-2 gap-lg-3">
                            <a href="{{ route('dashboard.brands.create') }}" class="btn btn-sm fw-bold btn-primary">{{ __('dashboard.create') }}</a>
                        </div>
                    </div>
                    <div class="card-body py-4">
                        <table class="table table-striped table-bordered align-middle table-hover fs-6 gy-5" id="table_Admin">
                            <thead>
                                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                                    <th title="Field #1">#</th>

                                    <th class="text-center">{{ __('dashboard.image') }}</th>
                                    <th class="text-center">{{ __('dashboard.name') }}</th>
                                    <th class="text-center">{{ __('dashboard.description') }}</th>
                                    <th class="text-center">{{ __('dashboard.active') }}</th>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_Admin').DataTable({
                processing: true,
                serverSide: true,
                ajax: `/${locale}/dashboard/brands/any-data`,
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    { data: 'image', name: 'image' },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'active', name: 'active' },
                    { data: 'action', name: 'action' },
                ]
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
                                        toastr.success(data.message);
                                        $('#table_Admin').DataTable().ajax.reload();
                                    } else {
                                        toastr.error(data.message);
                                    }
                                },
                                error: function(xhr, status, error) {
                                    toastr.error(error);
                                }
                            });
                        }
                    }
                });
            });

            $('#table_Admin').on('change', '.make-switch.active', function(event, state) {
                var admin_id = $(this).data('id');
                $.ajax({
                    url: `/en/dashboard/brands/${admin_id}/active`,
                    type: 'post',
                    dataType: 'json',
                    data: {
                        '_token': "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        if (data.status) {
                            toastr.success(data.message);
                        } else {
                            toastr.error(data.message);
                        }
                    }
                });
            });
        });
    </script>
@endsection
