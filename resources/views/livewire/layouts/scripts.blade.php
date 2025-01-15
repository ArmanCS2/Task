<script src="{{asset('admin-assets/js/jquery-3.7.1.min.js')}}"></script>
<script src="{{asset('admin-assets/js/popper.js')}}"></script>
<script src="{{asset('admin-assets/js/bootstrap/bootstrap.min.js')}}"></script>
<script src="{{asset('admin-assets/js/grid.js')}}"></script>
<script src="{{asset('admin-assets/select2/js/select2.min.js')}}"></script>
<script src="{{ asset('admin-assets/jalalidatepicker/persian-date.min.js') }}"></script>
<script src="{{ asset('admin-assets/jalalidatepicker/persian-datepicker.min.js') }}"></script>
<script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.js"></script>
<script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.js"></script>
@livewireScripts
<script>
    let modal = document.getElementById('exampleModal');
    if (modal) {
        var editModal = new bootstrap.Modal(modal);
    }
    Livewire.on('showEditForm', () => {
        editModal.show();
    });
    Livewire.on('hideEditForm', () => {
        editModal.hide();
    });
</script>

{{--<script>--}}
{{--    $(document).ready(function () {--}}
{{--        $('#end_date_view').persianDatepicker({--}}
{{--            format: 'YYYY/MM/DD',--}}
{{--            altField: '#end_date',--}}
{{--        })--}}
{{--    });--}}
{{--</script>--}}

<script>

    $('#end_date_view').persianDatepicker({
        format: 'YYYY/MM/DD',
        altField: '#end_date',
    })

</script>


