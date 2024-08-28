@extends('layout.wepper')
@section('content')
    <style>
        .tabulator-calcs-bottom [tabulator-field="avg_carat"] {
            color: red;
        }

        .tabulator-calcs-bottom [tabulator-field="avg_rate"] {
            color: red;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="in_carat"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="out_carat"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="rate"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="amount"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="in_carat"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="avg_rate"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="avg_carat"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="avg_amount"] {
            background-color: #DCECFC;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="cost"] {
            background-color: #B8DDFF;
        }

        .tabulator .tabulator-row .tabulator-cell[tabulator-field="cost_amount"] {
            background-color: #B8DDFF;
        }

        .tabulator-menu-item label input {
            margin-right: 10px !important;
        }

        .tabulator-menu-item label {
            margin-bottom: 0 !important;
            cursor: pointer;
        }

        .tabulator-popup-container {
            max-height: calc(100vh - 200px);
            height: auto;
            overflow: auto;
        }

        #example-table-party {
            height: calc(100vh - 150px);
        }

        .input-group.lotinput {
            width: auto !important;
        }

        .aglable {
            min-width: 60px !important;
        }
    </style>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="col-md-12 row">
                                        {{-- <div class="col-md-2"> --}}
                                        <div class="form-group row pr-3">
                                            <label class="col-form-label">Party Name</label>
                                            <div class="input-group lotinput" data-target-input="nearest">
                                                <input type="text" class="form-control " id="party" />
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                        {{-- <div class="col-md-2"> --}}
                                        <div class="form-group row">
                                            <label class="col-form-label aglable">A/G Type</label>
                                            <div class="input-group lotinput" data-target-input="nearest">
                                                <select class="form-control" data-dropdown-css-class="select2-danger"
                                                    name="account_type" id="account_type">
                                                    <option value="">All</option>
                                                    @foreach ($masters as $master)
                                                        <option value="{{ $master->name }}">
                                                            {{ strtoupper($master->name) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- </div> --}}
                                    </div>
                                    <div class="lot mt-2">
                                        <button type="button" class="btn" id="load">LOAD</button>
                                        <button type="reset" onclick="reset()" class="btn">RESET</button>
                                        <button type="button" class="btn custom" id="download-xlsx">
                                            <span class="mr-1 import_loader" style="display: none"><i
                                                    class="fa fa-spinner fa-spin"></i></span>PRINT XLSX
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row bottom">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-0">
                            <div id="example-table-party"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('js/tabulator6_0.js') }} "></script>
    <script src="{{ asset('js/xlsx.full.min.js') }} "></script>
    <script src="{{ asset('js/exceljs.min.js') }} "></script>
    <script src="{{ asset('js/custom.js?v=' . time()) }} "></script>

    <script type="text/javascript">
        document.addEventListener('click', function handleClickOutsideBox(event) {
            if ($(event.target).closest(".tabulator-popup-container").length === 0) {
                $(".tabulator-popup-container").hide();
            }
        });

        $(document).ready(function() {
            getReport();
        });

        var table = '';

        function getReport() {
            table = new Tabulator("#example-table-party", {
                layout: "fitDataFill",
                layoutColumnsOnNewData: true,
                printAsHtml: true,
                ajaxConfig: {
                    method: "POST",
                    headers: {
                        'X-CSRF-Token': '{{ csrf_token() }}'
                    },
                },
                ajaxResponse: function(url, params, response) {
                    var from = $("input[name='from_date']").val();
                    var to = $("input[name='to_date']").val();
                    var in_carat = 0;
                    let out_carat = 0;
                    let cost_amount = 0;
                    let balance_crt = 0;
                    let balance_amount = 0;
                    let mfg_rate_amount = 0;
                    let mfg_rate = 0;

                    const x = new Date(from);
                    const y = new Date(to);
                    if (response.status == 'Error') {
                        swal(
                            response.status,
                            response.message,
                            'error'
                        );
                        return [];
                        return false;
                    } else {
                        return response;
                    }
                },
                dataLoaderLoading: "<img style='width:60px;' src='{{ asset('img/diamond.gif') }}' />",
                printHeader: "<h1>Example Table Header<h1>",
                printFooter: "<h2>Example Table Footer<h2>",
                renderHorizontal: "virtual",
                placeholder: "No Data",
                selectableRange: true,
                selectableRangeColumns: true,
                selectableRangeRows: true,
                clipboard: true,
                clipboardCopyStyled: false,
                clipboardCopyRowRange: "range",
                clipboardPasteParser: "range",
                clipboardPasteAction: "range",
                columns: [{
                        resizable: false,
                        frozen: true,
                        hozAlign: "center",
                        formatter: "rownum",
                        download: false
                    },
                    {
                        title: "Name",
                        field: "name",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "A/G Type",
                        field: "account_type",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Contact Person",
                        field: "contact_person",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Mobile",
                        field: "mobile",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Email",
                        field: "email",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Address",
                        field: "address",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "City",
                        field: "city_name",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "State",
                        field: "state_name",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Country",
                        field: "country_name",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Zipcode",
                        field: "zipcode",
                        headerFilter: "input",
                        hozAlign: "center",
                    },
                    {
                        title: "Attachment",
                        field: "attachment",
                        headerFilter: "input",
                        hozAlign: "center",
                        formatter: function(cell, formatterParams, onRendered) {
                            var attachmentPath = cell.getValue();
                            if (attachmentPath) {
                                var attachmentUrl = `${window.location.origin}/img/party/${attachmentPath}`;
                                return `<a href="${attachmentUrl}" target="_blank" rel="noopener noreferrer">${attachmentPath}</a>`;
                            } else {
                                return "No Attachment";
                            }
                        }
                    },
                    {
                        title: "DELETE",
                        field: "id",
                        headerFilter: "input",
                        hozAlign: "center",
                        download: false,
                        formatter: function(cell, formatterParams, onRendered) {
                            var row = cell.getData();
                            var value = cell.getValue();

                            return `<i class="fa fa-trash btnDelete" aria-hidden="true" data-id="${value}"></i>`;

                        },
                    },
                ],
            });
        };

        document.getElementById("download-xlsx").addEventListener("click", async function() {
            var data = table.getData();
            var workbook = new ExcelJS.Workbook();
            var worksheet = workbook.addWorksheet("PartyData");

            worksheet.columns = [{
                    header: "Name",
                    key: "name"
                },
                {
                    header: "A/G Type",
                    key: "account_type"
                },
                {
                    header: "Contact Person",
                    key: "contact_person"
                },
                {
                    header: "Mobile",
                    key: "mobile"
                },
                {
                    header: "Email",
                    key: "email"
                },
                {
                    header: "Address",
                    key: "address"
                },
                {
                    header: "City",
                    key: "city_name"
                },
                {
                    header: "State",
                    key: "state_name"
                },
                {
                    header: "Country",
                    key: "country_name"
                },
                {
                    header: "Zipcode",
                    key: "zipcode"
                },
                {
                    header: "Attachment",
                    key: "attachment"
                }
            ];

            data.forEach(row => {
                worksheet.addRow({
                    name: row.name,
                    account_type: row.account_type,
                    contact_person: row.contact_person,
                    mobile: row.mobile,
                    email: row.email,
                    address: row.address,
                    city_name: row.city_name,
                    state_name: row.state_name,
                    country_name: row.country_name,
                    zipcode: row.zipcode,
                    attachment: row.attachment ? {
                        text: row.attachment,
                        hyperlink: `${window.location.origin}/img/party/${row.attachment}`
                    } : "No Attachment"
                });
            });

            worksheet.columns.forEach(column => {
                let maxLength = 0;
                column.eachCell({
                    includeEmpty: true
                }, cell => {
                    if (cell.value) {
                        maxLength = Math.max(maxLength, cell.value.toString().length);
                    }
                });
                column.width = maxLength + 3;
            });

            worksheet.getColumn(11).eachCell({
                includeEmpty: true
            }, (cell) => {
                if (cell.value && typeof cell.value === 'object' && cell.value.hyperlink) {
                    cell.font = {
                        color: {
                            argb: "FF0000FF"
                        },
                        underline: true
                    };
                }
            });

            workbook.xlsx.writeBuffer().then((buffer) => {
                const blob = new Blob([buffer], {
                    type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
                });
                const link = document.createElement("a");
                link.href = URL.createObjectURL(blob);
                link.download = "Party.xlsx";
                link.click();
            });
        });

        $(document).on('click', '#load', function() {
            table.setData("{{ route('party.report') }}", getFormData());
        });

        function getFormData() {
            var data = [];
            data['party'] = $("#party").val();
            data['account_type'] = $("#account_type").val();
            return data;
        }

        $(document).on('click', '.btnDelete', function() {
            var id = $(this).data('id');
            swal({
                title: 'Are you sure you want to delete?',
                showCancelButton: true,
                showDenyButton: true,
                confirmButtonText: 'DELETE',
            }).then((result) => {
                if (result.value == true) {
                    deleteAjax("{{ route('party.delete') }}", {
                        'id': id,
                        '_token': "{{ csrf_token() }}"
                    }, function(res) {
                        if (res.status == "Error") {
                            swal(
                                res.status,
                                res.message,
                                'error'
                            );
                        } else {
                            swal(
                                res.status,
                                res.message,
                                'success'
                            );
                            $('#load').trigger('click');
                        }
                    });
                }
            })
        });

        function reset() {
            document.getElementById('party').value = '';
            document.getElementById('account_type').selectedIndex = 0;
            table.clearData();
        }
    </script>
@endpush
