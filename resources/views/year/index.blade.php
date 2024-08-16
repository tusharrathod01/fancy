@extends('layout.wepper')
@section('content')
    <style>
        .card-body.table-responsive.p-0.saletbl {
            height: calc(100vh - 70px);
        }
    </style>
    <form class="add_entry" method="POST" action="{{ route('year.save') }}">
        {{ csrf_field() }}
        <section class="content">
            <div class="container-fluid">
                <div class="row bottom">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body table-responsive p-0 saletbl">
                                <table id="dv" class="table text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Year</th>
                                            <th>Status</th>
                                            <th>From Date</th>
                                            <th>To Date</th>
                                        </tr>
                                    </thead>
                                    <tbody id="add_entry" style="background-color: #fff;">

                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center">
                                <div class="end-btn">
                                    @if (auth()->user()->add == '1')
                                        <button type="button" class="btn seach_hide" id="saveEntry">SAVE</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('js/Blob.js') }} "></script>
    <script src="{{ asset('js/FileSaver.js') }} "></script>
    <script src="{{ asset('js/jhxlsx.js') }} "></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/tabulator6_0.js') }} "></script>
    <script src="{{ asset('js/xlsx.full.min.js') }} "></script>
    <script src="{{ asset('js/jspdf.umd.min.js') }} "></script>
    <script src="{{ asset('js/jspdf.plugin.autotable.min.js') }} "></script>
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/custom.js?v=' . time()) }} "></script>
    <script type="text/javascript">
        $(document).ready(function() {
            get_data();
        });

        function get_data() {
            getAjax("{{ route('get.year') }}", {}, function(res) {
                var ops = res.data;
                var html = '';
                $.each(ops, function(index, item) {
                    if (item.from_date !== "" && item.from_date !== "0000-00-00") {
                        var from_date = moment(item.from_date).format('DD-MM-YYYY');
                    } else {
                        var from_date = '';
                    }
                    if (item.to_date !== "" && item.to_date !== "0000-00-00") {
                        var to_date = moment(item.to_date).format('DD-MM-YYYY');
                    } else {
                        var to_date = '';
                    }
                    html +=
                        `<tr>
                            <td>${index + 1}</td>
                            <td>
                                <input type="text" class="year valid"
                                    name="entry[${index}][year]" id="year_${index}" value="${item.year}">

                                <input type="hidden" class="id"
                                    name="entry[${index}][id]" id="id_${index}" value="${item.id}">
                            </td>
                            <td>
                                <input type="text" class="status valid"
                                    name="entry[${index}][status]"
                                    id="status_${index}" value="${item.status}">
                            </td>
                            <td>
                                <input autocomplete="off" class="from_date datetimepicker-input" type="text" name="entry[${index}][from_date]" id="from_datepicker_${index}" autocomplete="off" value="${from_date}">
                            </td>
                            <td>
                                <input autocomplete="off" class="to_date datetimepicker-input" type="text" name="entry[${index}][to_date]" id="to_datepicker_${index}" autocomplete="off" value="${to_date}">
                            </td>
                        </tr>`;
                });
                $('table #add_entry').html(html);
                add_row();
            });
        }

        function add_row() {
            var rows = $('#add_entry').find('tr').length;
            var index = parseFloat(rows) + 1
            var markup = `<tr>
            <td>` + index + `</td>
            <td>
                <input type="text" class="year valid"
                    name="entry[` + rows + `][year]" id="year_` + rows + `">
            </td>
            <td>
                <input type="text" class="status valid"
                    name="entry[` + rows + `][status]"
                    id="status_` + rows + `" value="0">
            </td>
            <td>
                <input autocomplete="off" class="from_date datetimepicker-input" type="text" name="entry[` + rows +
                `][from_date]" id="from_datepicker_` + rows + `" autocomplete="off">
            </td>
            <td>
                <input autocomplete="off" class="to_date datetimepicker-input" type="text" name="entry[` + rows +
                `][to_date]" id="to_datepicker_` + rows + `" autocomplete="off">
            </td>
         </tr>`;

            $(function() {
                $('.from_date').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear',
                        format: 'DD-MM-YYYY',
                    },
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    "drops": "auto",
                });

                $('.from_date').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY'));
                });
            });
            $(function() {
                $('.to_date').daterangepicker({
                    autoUpdateInput: false,
                    locale: {
                        cancelLabel: 'Clear',
                        format: 'DD-MM-YYYY',
                    },
                    singleDatePicker: true,
                    showDropdowns: true,
                    autoApply: true,
                    "drops": "auto",
                });

                $('.to_date').on('apply.daterangepicker', function(ev, picker) {
                    $(this).val(picker.startDate.format('DD-MM-YYYY'));
                });
            });
            $("table #add_entry").append(markup);
        }

        $(document).on('focusout', '.to_date', function() {
            var Length = $(this).closest('tr').next('tr').length;
            var refno_check = $(this).val();
            if (Length == 0 && refno_check !== '') {
                add_row();
            }
        });
        $(document).on('click', '#saveEntry', function() {
            var tr = $('#add_entry').find('tr');
            $('.add_entry').ajaxForm(function(res) {
                if (res.status == 'Success') {
                    swal(
                        res.status,
                        res.message,
                        'success'
                    );
                    get_data();
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            }).submit();
        });
    </script>
@endpush
