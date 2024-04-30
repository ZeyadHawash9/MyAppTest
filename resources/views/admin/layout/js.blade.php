@yield('js')

<script>
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-theme-mode");
        } else {
            if (localStorage.getItem("data-theme") !== null) {
                themeMode = localStorage.getItem("data-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-theme", themeMode);
    }
</script>
<script>
    var hostUrl = "/Admin/";
</script>
<!--begin::Global Javascript Bundle(mandatory for all pages)-->
<script src="/Admin/plugins/global/plugins.bundle.js"></script>
<script src="/Admin/js/scripts.bundle.js"></script>
<!--end::Global Javascript Bundle-->
<!--begin::Vendors Javascript(used for this page only)-->
<script src="/Admin/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/percent.js"></script>
<script src="https://cdn.amcharts.com/lib/5/radar.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>
<script src="https://cdn.amcharts.com/lib/5/map.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/continentsLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/usaLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZonesLow.js"></script>
<script src="https://cdn.amcharts.com/lib/5/geodata/worldTimeZoneAreasLow.js"></script>
<script src="/Admin/plugins/custom/datatables/datatables.bundle.js"></script>
<!--end::Vendors Javascript-->
<!--begin::Custom Javascript(used for this page only)-->
<script src="/Admin/js/widgets.bundle.js"></script>
<script src="/Admin/js/custom/widgets.js"></script>
<script src="/Admin/js/custom/apps/chat/chat.js"></script>
<script src="/Admin/js/custom/utilities/modals/upgrade-plan.js"></script>
<script src="/Admin/js/custom/utilities/modals/create-app.js"></script>
<script src="/Admin/js/custom/utilities/modals/new-target.js"></script>
<script src="/Admin/js/custom/utilities/modals/users-search.js"></script>
<script>
        var csrf_token = $('meta[name="csrf-token"]').attr('content');

</script>
<script>
    $(document).ready(function() {
        $(".FormToggleSubmit input[type='checkbox']").change(function(event) {
            event.preventDefault();
            var formData = new FormData(this.form); // Use this.form to get the associated form
            var submitUrl = formData.get('url');

            console.log(formData);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "post",
                url: submitUrl,
                data: formData,
                contentType: false, // Set content type to false for FormData
                processData: false,

                success: function(data) {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": false,
                        "progressBar": false,
                        "positionClass": "toastr-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "1000",
                        "timeOut": "5000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };

                    toastr.success("The status has been changed successfully");
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText); // Log the response text
                    console.log(status); // Log the status
                    console.log(error); // Log the error
                }
            });
        });
    });
</script>
