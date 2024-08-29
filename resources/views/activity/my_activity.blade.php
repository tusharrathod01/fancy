@extends('layout.wepper')
@section('content')
    <style>
        .tabulator .tabulator-row .tabulator-cell[tabulator-field="types"],
        .tabulator .tabulator-row .tabulator-cell[tabulator-field="comment"],
        .tabulator .tabulator-row .tabulator-cell[tabulator-field="user_name"] {
            text-transform: uppercase;
        }
    </style>
    <section class="content">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-form-label row">From</label>
                                <div class="input-group report-date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="datepicker"
                                        name="from_date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label row todateall">To</label>
                                <div class="input-group report-date" data-target-input="nearest">
                                    <input type="text" class="form-control datetimepicker-input" id="todatepicker"
                                        name="to_date">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label row pl-2">Period</label>
                                <div class="input-group-t drop pl-2">
                                    <select class="form-control" data-dropdown-css-class="select2-danger"
                                        id="daterange-daterange-drop">
                                        <option>TODAY</option>
                                        <option>YESTERDAY</option>
                                        <option>THIS WEEK</option>
                                        <option>LAST WEEK</option>
                                        <option>LAST 2 WEEK</option>
                                        <option>LAST TO LAST WEEK</option>
                                        <option selected>THIS MONTH</option>
                                        <option>LAST MONTH</option>
                                        <option>LAST TO LAST MONTH</option>
                                        <option>ALL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <button type="button" class="btn" id="load">LOAD</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row bottom">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div id="example-table-activity"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="modal-xl">
        <div class="modal-dialog ">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 id="header_title">Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body pb-2">

                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/tabulator.min.js') }} "></script>
    <script src="{{ asset('js/custom.js') }} "></script>

    <script type="text/javascript">
        $('#todatepicker').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY',
            },
            singleDatePicker: true,
            showDropdowns: true,
            "autoApply": true,
            maxDate: new Date(),
        });
        $('#datepicker').daterangepicker({
            locale: {
                format: 'DD-MM-YYYY',
            },
            singleDatePicker: true,
            showDropdowns: true,
            "autoApply": true,
            maxDate: new Date(),
        });
        var table = '';
        $(document).ready(function() {
            var due_date = $('#datepicker').val();
            var new_date = moment(due_date, "DD-MM-YYYY").subtract(1, 'months').format("DD-MM-YYYY");
            $('#datepicker').val(new_date);
            getReport();
            setTimeout(() => {
                load();
            }, 500);
        });

        function load() {
            table.setData("{{ route('get.my.activity') }}", getFormData());
        }
        var editIcon = function(cell, formatterParams) {
            return "<i class='fas fa-eye'></i>";
        };

        function getReport() {
            table = new Tabulator("#example-table-activity", {
                layout: "fitDataFill",
                layoutColumnsOnNewData: true,
                printAsHtml: true,
                clipboard: true,
                ajaxConfig: {
                    method: "POST",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                },
                ajaxResponse: function(url, params, response) {
                    return response.data;
                },
                dataLoaderLoading: "<img style='width:60px;' src='{{ asset('img/diamond.gif') }}' />",
                printHeader: "<h1>Example Table Header<h1>",
                printFooter: "<h2>Example Table Footer<h2>",
                renderHorizontal: "virtual",
                placeholder: "No Data",
                columns: [{
                        title: "DATE",
                        field: "created_at",
                        inputFormat: "dd-MM-yyyy",
                        hozAlign: "center",
                        sorter: "date",
                        headerFilter: "input",
                        headerSort: false,
                        formatter: function(cell, formatterParams, onRendered) {
                            var value = cell.getValue();
                            value = moment(value).format("DD-MM-YYYY");
                            return value;
                        }
                    },
                    {
                        title: "Invoice",
                        field: "bill_no",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Ref No",
                        field: "inv_no",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "PARTY",
                        field: "party",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "TYPE",
                        field: "types",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "DESCRIPTION",
                        field: "comment",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "USER",
                        field: "user_name",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "CLIENT",
                        field: "client",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        formatter: editIcon,
                        width: 40,
                        hozAlign: "center",
                        cellClick: function(e, cell) {
                            var d = cell.getRow().getData();
                            var title = d.types;
                            appoved(d.id, d.types, title);
                        }
                    },
                ],
            });
        };

        function appoved(id, type, title) {
            postAjax("{{ route('get.my.activity.detail') }}", {
                'id': id,
                'type': type,
                '_token': "{{ csrf_token() }}"
            }, function(res) {
                if (res.status == "Error") {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                } else {
                    $("#header_title").text(title);
                    if (type == 'sale invoice' || type == 'purchase invoice') {
                        $(".modal-dialog").addClass('modal-xl');
                    } else {
                        $(".modal-dialog").removeClass('modal-xl');
                        $(".modal-dialog").addClass('modal-lg');
                    }
                    $('.modal-body').html(res);
                    $("#modal-xl").modal('show');
                }
            });
        }

        $(document).on('change', '#daterange-daterange-drop', function() {
            var ranges = $(this).val();
            var date = $("#todatepicker").val();
            var enddate = $("#datepicker").val();

            if (ranges == "TODAY") {
                var startDate = moment();
                var endDate = moment();
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "YESTERDAY") {
                var startDate = moment().subtract(1, 'days');
                var endDate = moment().subtract(1, 'days');
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "THIS WEEK") {
                var startDate = moment().startOf('week').add(1, 'days');
                var endDate = moment();
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }

            if (ranges == "LAST WEEK") {
                var startDate = moment().subtract(1, 'week').startOf('week').add(1, 'days');
                var endDate = moment().subtract(1, 'week').endOf('week').add(1, 'days');
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "LAST 2 WEEK") {
                var startDate = moment().subtract(2, 'week').startOf('week').add(1, 'days');
                var endDate = moment().endOf('week').add(1, 'days');
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "LAST TO LAST WEEK") {
                var startDate = moment().subtract(2, 'week').startOf('week').add(1, 'days');
                var endDate = moment().subtract(2, 'week').endOf('week').add(1, 'days');
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "THIS MONTH") {
                var startDate = moment().startOf('month');
                var endDate = moment();
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "LAST MONTH") {
                var startDate = moment().subtract(1, 'month').startOf('month')
                var endDate = moment().subtract(1, 'month').endOf('month');
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "LAST TO LAST MONTH") {
                var startDate = moment().subtract(2, 'month').startOf('month')
                var endDate = moment().subtract(2, 'month').endOf('month');
                $('#datepicker').val(startDate.format('DD-MM-yy')),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
            if (ranges == "ALL") {
                var startDate = "01-01-2016";
                var endDate = moment();
                $('#datepicker').val(startDate),
                    $('#todatepicker').val(endDate.format('DD-MM-yy'))
            }
        });

        $(document).on('click', '#load', function() {
            load();
        });

        function getFormData() {
            var data = [];
            data['from'] = $("input[name='from_date']").val();
            data['to'] = $("input[name='to_date']").val();
            data['client'] = $("input[name='client[]']:checked").map(function() {
                return $(this).val();
            }).get();
            return data;
        }
    </script>
@endpush
