<style>
    .ui-menu.ui-widget {
        z-index: 99999999999999 !important;
    }

    .border-error {
        border: solid 1px red;
    }

    td input {
        width: 100% !important;
    }

    th {
        padding: 0 8px !important;
    }

    td {
        padding: 0 4px !important;
    }

    .l1,
    .l2,
    .rate {
        min-width: 50px;
    }

    .tlotno {
        width: 350px;
    }

    th.lotsize {
        width: 90px;
    }

    td.lotcolor {
        width: 120px;
    }

    table#dv tbody tr td:nth-child(2) {
        width: 150px;
    }

    table#dv thead {
        position: sticky;
        top: 0;
        border-bottom: 1px solid gray;
    }

    .end-btn {
        padding-bottom: 10px;
        margin: auto;
        text-align: left;
    }

    #dv {
        table-layout: auto;
        width: auto;
        border-collapse: collapse;
    }

    #dv td {
        padding: 2px;
        white-space: nowrap;
    }
</style>

@php
    $activity_data = json_decode($activity->old_data);
    $new_activity_data = json_decode($activity->new_data);
@endphp
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    @if ($activity_data)
                        <div class="card col-md-12 mb-4">
                            <div class="card-header m-auto">
                                <h5 class="card-title">Old Data</h5>
                            </div>
                            <div class="card-body table-responsive p-0">
                                <table class="table table-head-fixed text-nowrap text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Name</th>
                                            <th>Currency</th>
                                            <th>Rate</th>
                                            <th>Party Code</th>
                                            <th>Contact Person</th>
                                            <th>Executive</th>
                                            <th>Account Type</th>
                                            <th>Broker</th>
                                            <th>Mobile</th>
                                            <th>Fax</th>
                                            <th>Address</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>City</th>
                                            <th>Zipcode</th>
                                            <th>Bank Account</th>
                                            <th>Swift Code</th>
                                            <th>Bank Routing</th>
                                            <th>Limit</th>
                                            <th>Pdate</th>
                                            <th>Area</th>
                                            <th>Agent</th>
                                            <th>Due Days</th>
                                            <th>Overdue</th>
                                            <th>Phone1</th>
                                            <th>Phone2</th>
                                            <th>Skype</th>
                                            <th>Email</th>
                                            <th>Website</th>
                                            <th>Ref Party 1</th>
                                            <th>Ref Party 2</th>
                                            <th>Ref Phone 1</th>
                                            <th>Ref Phone 2</th>
                                            <th>Ref Comment 1</th>
                                            <th>Ref Comment 2</th>
                                            <th>Opening Bal</th>
                                            <th>Debit Credit</th>
                                            <th>Remark</th>
                                            <th>Attachment Name</th>
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: #fff;">
                                        @if ($activity_data)
                                            <tr>
                                                <td>1</td>
                                                <td>{{ $activity_data->name ?? '' }}</td>
                                                <td>{{ $activity_data->currency ?? '' }}</td>
                                                <td>{{ $activity_data->rate ?? '' }}</td>
                                                <td>{{ $activity_data->party_code ?? '' }}</td>
                                                <td>{{ $activity_data->contact_person ?? '' }}</td>
                                                <td>{{ $activity_data->executive ?? '' }}</td>
                                                <td>{{ $activity_data->account_type ?? '' }}</td>
                                                <td>{{ $activity_data->broker ?? '' }}</td>
                                                <td>{{ $activity_data->mobile ?? '' }}</td>
                                                <td>{{ $activity_data->fax ?? '' }}</td>
                                                <td>{{ $activity_data->address ?? '' }}</td>
                                                <td>{{ $activity_data->country ?? '' }}</td>
                                                <td>{{ $activity_data->state ?? '' }}</td>
                                                <td>{{ $activity_data->city ?? '' }}</td>
                                                <td>{{ $activity_data->zipcode ?? '' }}</td>
                                                <td>{{ $activity_data->bank_account ?? '' }}</td>
                                                <td>{{ $activity_data->swift_code ?? '' }}</td>
                                                <td>{{ $activity_data->bank_routing ?? '' }}</td>
                                                <td>{{ $activity_data->limit ?? '' }}</td>
                                                <td>{{ $activity_data->pdate ?? '' }}</td>
                                                <td>{{ $activity_data->area ?? '' }}</td>
                                                <td>{{ $activity_data->agent ?? '' }}</td>
                                                <td>{{ $activity_data->due_days ?? '' }}</td>
                                                <td>{{ $activity_data->overdue ?? '' }}</td>
                                                <td>{{ $activity_data->phone1 ?? '' }}</td>
                                                <td>{{ $activity_data->phone2 ?? '' }}</td>
                                                <td>{{ $activity_data->skype ?? '' }}</td>
                                                <td>{{ $activity_data->email ?? '' }}</td>
                                                <td>{{ $activity_data->website ?? '' }}</td>
                                                <td>{{ $activity_data->ref_party_1 ?? '' }}</td>
                                                <td>{{ $activity_data->ref_party_2 ?? '' }}</td>
                                                <td>{{ $activity_data->ref_phone_1 ?? '' }}</td>
                                                <td>{{ $activity_data->ref_phone_2 ?? '' }}</td>
                                                <td>{{ $activity_data->ref_comment_1 ?? '' }}</td>
                                                <td>{{ $activity_data->ref_comment_2 ?? '' }}</td>
                                                <td>{{ $activity_data->opening_bal ?? '' }}</td>
                                                <td>{{ $activity_data->debit_credit ?? '' }}</td>
                                                <td>{{ $activity_data->remark ?? '' }}</td>
                                                <td>{{ $activity_data->attachment_name ?? $activity_data->attachment }}</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if ($new_activity_data)
                    <div class="card col-md-12">
                        <div class="card-header m-auto">
                            <h5 class="card-title">New Data</h5>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-head-fixed text-nowrap text-nowrap">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Name</th>
                                        <th>Currency</th>
                                        <th>Rate</th>
                                        <th>Party Code</th>
                                        <th>Contact Person</th>
                                        <th>Executive</th>
                                        <th>Account Type</th>
                                        <th>Broker</th>
                                        <th>Mobile</th>
                                        <th>Fax</th>
                                        <th>Address</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>City</th>
                                        <th>Zipcode</th>
                                        <th>Bank Account</th>
                                        <th>Swift Code</th>
                                        <th>Bank Routing</th>
                                        <th>Limit</th>
                                        <th>Pdate</th>
                                        <th>Area</th>
                                        <th>Agent</th>
                                        <th>Due Days</th>
                                        <th>Overdue</th>
                                        <th>Phone1</th>
                                        <th>Phone2</th>
                                        <th>Skype</th>
                                        <th>Email</th>
                                        <th>Website</th>
                                        <th>Ref Party 1</th>
                                        <th>Ref Party 2</th>
                                        <th>Ref Phone 1</th>
                                        <th>Ref Phone 2</th>
                                        <th>Ref Comment 1</th>
                                        <th>Ref Comment 2</th>
                                        <th>Opening Bal</th>
                                        <th>Debit Credit</th>
                                        <th>Remark</th>
                                        <th>Attachment Name</th>
                                    </tr>
                                </thead>
                                <tbody style="background-color: #fff;">
                                    @if ($new_activity_data)
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $new_activity_data->name ?? '' }}</td>
                                            <td>{{ $new_activity_data->currency ?? '' }}</td>
                                            <td>{{ $new_activity_data->rate ?? '' }}</td>
                                            <td>{{ $new_activity_data->party_code ?? '' }}</td>
                                            <td>{{ $new_activity_data->contact_person ?? '' }}</td>
                                            <td>{{ $new_activity_data->executive ?? '' }}</td>
                                            <td>{{ $new_activity_data->account_type ?? '' }}</td>
                                            <td>{{ $new_activity_data->broker ?? '' }}</td>
                                            <td>{{ $new_activity_data->mobile ?? '' }}</td>
                                            <td>{{ $new_activity_data->fax ?? '' }}</td>
                                            <td>{{ $new_activity_data->address ?? '' }}</td>
                                            <td>{{ $new_activity_data->country ?? '' }}</td>
                                            <td>{{ $new_activity_data->state ?? '' }}</td>
                                            <td>{{ $new_activity_data->city ?? '' }}</td>
                                            <td>{{ $new_activity_data->zipcode ?? '' }}</td>
                                            <td>{{ $new_activity_data->bank_account ?? '' }}</td>
                                            <td>{{ $new_activity_data->swift_code ?? '' }}</td>
                                            <td>{{ $new_activity_data->bank_routing ?? '' }}</td>
                                            <td>{{ $new_activity_data->limit ?? '' }}</td>
                                            <td>{{ $new_activity_data->pdate ?? '' }}</td>
                                            <td>{{ $new_activity_data->area ?? '' }}</td>
                                            <td>{{ $new_activity_data->agent ?? '' }}</td>
                                            <td>{{ $new_activity_data->due_days ?? '' }}</td>
                                            <td>{{ $new_activity_data->overdue ?? '' }}</td>
                                            <td>{{ $new_activity_data->phone1 ?? '' }}</td>
                                            <td>{{ $new_activity_data->phone2 ?? '' }}</td>
                                            <td>{{ $new_activity_data->skype ?? '' }}</td>
                                            <td>{{ $new_activity_data->email ?? '' }}</td>
                                            <td>{{ $new_activity_data->website ?? '' }}</td>
                                            <td>{{ $new_activity_data->ref_party_1 ?? '' }}</td>
                                            <td>{{ $new_activity_data->ref_party_2 ?? '' }}</td>
                                            <td>{{ $new_activity_data->ref_phone_1 ?? '' }}</td>
                                            <td>{{ $new_activity_data->ref_phone_2 ?? '' }}</td>
                                            <td>{{ $new_activity_data->ref_comment_1 ?? '' }}</td>
                                            <td>{{ $new_activity_data->ref_comment_2 ?? '' }}</td>
                                            <td>{{ $new_activity_data->opening_bal ?? '' }}</td>
                                            <td>{{ $new_activity_data->debit_credit ?? '' }}</td>
                                            <td>{{ $new_activity_data->remark ?? '' }}</td>
                                            <td>{{ $new_activity_data->attachment_name ?? '' }}</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
