@extends('layout.wepper')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="pl-2 pr-2">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="text-center">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label slabel">Name</label>
                                        <div class="input-group l-input">
                                            <input type="text" class="form-control seach_input" id="seach_Party">
                                        </div>
                                    </div>
                                    <button type="button" id="seach" class="btn">
                                        SEARCH</button>
                                    <button type="button" onclick="reset()" class="btn">NEW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('save.party') }}" id="party_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="hiddenId">
                <div class="row partydiv">
                    <div class="col-md-6 pl-2 pr-2">
                        <div class="card partycard">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Party Name</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="name" name="name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Currency</label>
                                        <div class="input-group side">
                                            <select class="form-control" id="currency" name="currency">
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Rate</label>
                                        <div class="input-group side">
                                            <input type="text" name="rate" class="form-control" id="curr_rate"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Party Code</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="party_code" name="party_code">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Contact Person</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="contact_person"
                                                name="contact_person">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Executive</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="executive" name="executive">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">A/G Type</label>
                                        <div class="input-group finput">
                                            <select class="form-control" data-dropdown-css-class="select2-danger"
                                                name="account_type" id="account_type">
                                                @foreach (ag_type() as $item)
                                                    <option value="{{ $item }}">{{ $item }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Broker</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="broker" name="broker">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Mobile</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="mobile" name="mobile">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Fax</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="fax" name="fax">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Address</label>
                                        <div class="input-group finput">
                                            <textarea class="form-control" name="address" id="address"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Country</label>
                                        <div class="input-group side">
                                            <select class="form-control" id="country" name="country">
                                                <option value="">Select Country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">State</label>
                                        <div class="input-group side">
                                            <select class="form-control" id="state" name="state" disabled>
                                                <option value="">Select State</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">City</label>
                                        <div class="input-group side">
                                            <select class="form-control" id="city" name="city" disabled>
                                                <option value="">Select City</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Zipcode</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="zipcode" name="zipcode">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Bank A/c no</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="bank_account"
                                                name="bank_account">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Swift Code</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="swift_code"
                                                name="swift_code">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Bank Routing</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="bank_routing"
                                                name="bank_routing">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Limit</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="limit" name="limit">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Attachment</label>
                                        <div class="input-group finput">
                                            <input type="file" id="attachment" name="attachment"
                                                accept=".png, .jpg, .jpeg" onchange="previewFile(event)">
                                        </div>
                                        <img id="preview" alt="Preview Image" style="display: none;max-width:200px"
                                            class="mt-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 pl-2 pr-2">
                        <div class="card partycard">
                            <div class="card-body">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Date</label>
                                        <div class="input-group finput">
                                            <input type="date" class="form-control" id="pdate" name="pdate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Area</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="area" name="area">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Agent</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="agent" name="agent">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Due Days</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="due_days" name="due_days">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Over due</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="overdue" name="overdue">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Phone1</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="phone1" name="phone1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Phone2</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="phone2" name="phone2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Skype</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="skype" name="skype">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Email</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="email" name="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Website</label>
                                        <div class="input-group finput">
                                            <input type="text" class="form-control" id="website" name="website">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">1 Ref Party</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="ref_party_1"
                                                name="ref_party_1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">2 Ref Party</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="ref_party_2"
                                                name="ref_party_2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">1 Ref Phone</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="ref_phone_1"
                                                name="ref_phone_1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">2 Ref Phone</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="ref_phone_2"
                                                name="ref_phone_2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">1 Ref Comment</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="ref_comment_1"
                                                name="ref_comment_1">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">2 Ref Comment</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="ref_comment_2"
                                                name="ref_comment_2">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Op. Bal</label>
                                        <div class="input-group side">
                                            <input type="text" class="form-control" id="opening_bal"
                                                name="opening_bal">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-form-label party">Cr/Dr</label>
                                        <div class="input-group side">
                                            <select class="form-control" data-dropdown-css-class="select2-danger"
                                                name="debit_credit" id="account_type">
                                                <option value="CREDIT">CREDIT</option>
                                                <option value="DEBIT" selected="selected">DEBIT</option>
                                                <option value="RETURN">RETURN</option>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-form-label party">Remark</label>
                                        <div class="input-group finput">
                                            <textarea class="form-control" name="remark" id="remark"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>

    <section class="bottom fix" style="width: 100%; height: 40px;">
        <div class="container-fluid">
            <div class="col-md-12 row">
                <div class="card mb-2 mt-2 mr-0 ml-0" style="width: 100%;  height: 40px;">
                    <div class="card-body">
                        <div class="text-center">
                            @if (auth()->user()->add == '1')
                                <button type="button" class="btn" id="save">SAVE</button>
                            @endif
                            <button type="button" name="reset" class="btn" onclick="reset()">RESET</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('script')
    <script src="{{ asset('js/prc.js') }}"></script>
    <script src="{{ asset('js/custom.js?v=' . time()) }} "></script>
    <script src="{{ asset('js/jquery-ui.js') }}"></script>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            var dateInput = document.getElementById('pdate');
            dateInput.setAttribute('min', today);
        });

        function previewFile(event) {
            const file = event.target.files[0];

            if (file) {
                const fileExtension = file.name.split('.').pop().toLowerCase();
                const validImageExtensions = ['png', 'jpg', 'jpeg'];

                if (validImageExtensions.includes(fileExtension)) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#preview').hide();
                }
            } else {
                $('#preview').hide();
            }
        }

        $(document).ready(function() {
            partys();
            currancy();

            $('#country').change(function() {
                var countryId = $(this).val();
                if (countryId) {
                    $.ajax({
                        url: '/states/' + countryId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#state').empty().append(
                                '<option value="">Select State</option>');
                            $.each(data, function(key, state) {
                                $('#state').append('<option value="' + state.id + '">' +
                                    state.name + '</option>');
                            });
                            $('#state').prop('disabled', false);
                            $('#city').empty().append('<option value="">Select City</option>')
                                .prop('disabled', true);
                        }
                    });
                } else {
                    $('#state').empty().append('<option value="">Select State</option>').prop('disabled',
                        true);
                    $('#city').empty().append('<option value="">Select City</option>').prop('disabled',
                        true);
                }
            });

            $('#state').change(function() {
                var stateId = $(this).val();
                if (stateId) {
                    $.ajax({
                        url: '/cities/' + stateId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#city').empty().append('<option value="">Select City</option>');
                            $.each(data, function(key, city) {
                                $('#city').append('<option value="' + city.id + '">' +
                                    city.name + '</option>');
                            });
                            $('#city').prop('disabled', false);
                        }
                    });
                } else {
                    $('#city').empty().append('<option value="">Select City</option>').prop('disabled',
                        true);
                }
            });
        });

        function currancy() {
            getAjax("{{ route('get.currancy') }}", {}, function(res) {
                var ops = res.data;
                var html = '';
                $.each(ops, function(index, item) {
                    html += '<option data-rate="' + item + '">' + index + '</option>';
                });
                $('#currency').html(html);
                $('#currency').trigger('change');
            });
        }

        function updateCurrencyRate() {
            var selectedOption = $('#currency').find('option:selected');
            var rate = selectedOption.data('rate');
            $('#curr_rate').val(rate.toFixed(2));
            $('#curr_rate')
                .attr('value', rate.toFixed(2));
        }

        $('#currency').on('change', updateCurrencyRate);

        function partys() {
            $("#seach_Party").autocomplete({
                source: function(request, response) {
                    $.getJSON("{{ route('get.partys') }}?q=" + request.term, function(data) {
                        response($.map(data, function(value, key) {
                            return {
                                label: value,
                                value: value
                            };
                        }));
                    });
                },
                focus: function(event, ui) {
                    $(event).val(ui.item.label);
                },
                autoFocus: true,
                select: function(event, ui) {
                    $(event).val(ui.item.label);
                    $("#seach").on('click', function() {
                        get_details(ui.item.label);
                    });
                },
            });
        }

        function get_details(name) {
            getAjax("{{ route('get.party.details') }}", {
                name: name
            }, function(res) {
                if (res.status == 'Success') {
                    setData(res.data);
                } else {
                    swal(
                        res.status,
                        res.message,
                        'error'
                    );
                }
            });
        }

        function setData(data) {
            $("[name='name']").val(isNull(data.name));
            $("[name='hiddenId']").val(isNull(data.id));
            $("[name='account_type']").val(isNull(data.account_type));
            $("[name='address']").val(isNull(data.address));
            $("[name='agent']").val(isNull(data.agent));
            $("[name='area']").val(isNull(data.area));
            $("[name='bank_account']").val(isNull(data.bank_account));
            $("[name='bank_routing']").val(isNull(data.bank_routing));
            $("[name='broker']").val(isNull(data.broker));
            $("[name='contact_person']").val(isNull(data.contact_person));
            $("[name='currency']").val(isNull(data.currency));
            $("[name='pdate']").val(isNull(data.pdate));
            $("[name='debit_credit']").val(isNull(data.debit_credit));
            $("[name='due_days']").val(isNull(data.due_days));
            $("[name='email']").val(isNull(data.email));
            $("[name='executive']").val(isNull(data.executive));
            $("[name='fax']").val(isNull(data.fax));
            $("[name='limit']").val(isNull(data.limit));
            $("[name='mobile']").val(isNull(data.mobile));
            $("[name='opening_bal']").val(isNull(data.opening_bal));
            $("[name='overdue']").val(isNull(data.overdue));
            $("[name='party_code']").val(isNull(data.party_code));
            $("[name='phone1']").val(isNull(data.phone1));
            $("[name='phone2']").val(isNull(data.phone2));
            $("[name='rate']").val(isNull(data.rate.toFixed(2)));
            $("[name='ref_comment_1']").val(isNull(data.ref_comment_1));
            $("[name='ref_comment_2']").val(isNull(data.ref_comment_2));
            $("[name='ref_party_1']").val(isNull(data.ref_party_1));
            $("[name='ref_party_2']").val(isNull(data.ref_party_2));
            $("[name='ref_phone_1']").val(isNull(data.ref_phone_1));
            $("[name='ref_phone_2']").val(isNull(data.ref_phone_2));
            $("[name='remark']").val(isNull(data.remark));
            $("[name='skype']").val(isNull(data.skype));
            $("[name='swift_code']").val(isNull(data.swift_code));
            $("[name='website']").val(isNull(data.website));
            $("[name='zipcode']").val(isNull(data.zipcode));

            if (data.attachment) {
                const baseUrl = '/img/party';
                const imageName = data.attachment;
                const imageUrl = `${baseUrl}/${imageName}`;

                const validImageExtensions = ['png', 'jpg', 'jpeg'];
                const fileExtension = imageName.split('.').pop().toLowerCase();

                if (validImageExtensions.includes(fileExtension)) {
                    $('#preview').attr('src', imageUrl).show();
                } else {
                    $('#preview').hide();
                }
            } else {
                $('#preview').hide();
            }

            var countryId = isNull(data.country);
            var stateId = isNull(data.state);
            var cityId = isNull(data.city);

            if (countryId) {
                $('#country').val(countryId).change();
                $.ajax({
                    url: '/states/' + countryId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(states) {
                        $('#state').empty().append('<option value="">Select State</option>');
                        $.each(states, function(key, state) {
                            $('#state').append('<option value="' + state.id + '">' + state.name +
                                '</option>');
                        });
                        $('#state').prop('disabled', false);
                        $('#state').val(stateId).change();

                        if (stateId) {
                            $.ajax({
                                url: '/cities/' + stateId,
                                type: 'GET',
                                dataType: 'json',
                                success: function(cities) {
                                    $('#city').empty().append(
                                        '<option value="">Select City</option>');
                                    $.each(cities, function(key, city) {
                                        $('#city').append('<option value="' + city.id +
                                            '">' + city.name + '</option>');
                                    });
                                    $('#city').prop('disabled', false);
                                    $('#city').val(cityId);
                                }
                            });
                        } else {
                            $('#city').empty().append('<option value="">Select City</option>').prop('disabled',
                                true);
                        }
                    }
                });
            } else {
                $('#state').empty().append('<option value="">Select State</option>').prop('disabled', true);
                $('#city').empty().append('<option value="">Select City</option>').prop('disabled', true);
            }
        }

        function reset() {
            $('#seach_Party').val('');
            $('#party_form')[0].reset();
            $('#state').prop('disabled', true);
            $('#city').prop('disabled', true);
            $('#preview').hide().attr('src', '');
            $('#seach').off('click');
        }

        function isNull(value) {
            if (value == null) {
                return '';
            } else {
                return value;
            }
        }

        $(document).on('click', '#save', function() {
            $('#party_form').ajaxForm(function(res) {
                if (res.status == 'Success') {
                    swal(
                        res.status,
                        res.message,
                        'success'
                    )
                    reset();
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
