<?php echo $this->element('admin/tabular/title', ['title' => 'Manage Company Transaction', 'faClass' => "fa fa-building"]); ?>

<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <?php if(!$company_transactions->isEmpty()){ ?>

        <!--begin::Card title-->
        <div class="card-title">
            <form class="form-horizontal" id="report-form">
            <div class="d-flex align-items-center gap-2 gap-lg-3">
                <!--begin::Filter menu-->
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                            <!--end::Svg Icon-->
                    <?php echo $this->Form->input(
                        'company_id',
                            [
                                'type' => 'select',
                                'options' => $companies,
                                'label' => false,
                                'div' => false ,
                                'empty'=>'Select Company',
                                'class'=>"form-control form-control-solid w-250px ps-14"
                            ]
                        );
                    ?>
                </div>
                <div class="d-flex align-items-center position-relative my-1">

                            <!--end::Svg Icon-->
                    <?php echo $this->Form->input(
                        'transaction_type_id',
                            [
                                'type' => 'select',
                                'options' => $transactions_type_ids,
                                'label' => false,
                                'div' => false ,
                                'empty'=>'Select Transaction',
                                'class'=>"form-control form-control-solid w-250px ps-14"
                            ]
                        );
                    ?>
                </div>

                <div class="d-flex align-items-center position-relative my-1">
                    <input
                        type="text"
                        class="form-control form-control-solid w-250px ps-14"
                        name="email_or_name"
                        id="searchQuery"
                        placeholder="Email or Name"
                    />
                </div>
                <!--end::Search-->
                <button type="submit" class="btn btn-sm btn-primary" id="search-reports">
                    <span class="indicator-label">
                        Search
                    </span>
                    <span class="indicator-progress">
                        Please wait... <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                    </span>
                </button>
                <!--end::Primary button-->
            </form>
            </div>
            <!--end::Search-->
        </div>
        <?php } ?>

        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">

                <!--begin::Add user-->
                <a href="<?php  echo $this->request->getAttribute('webroot');  ?>admin/companies/add_transaction" class="btn btn-primary">
                    <span class="svg-icon svg-icon-2">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                                transform="rotate(-90 11.364 20.364)" fill="currentColor"></rect>
                            <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor"></rect>
                        </svg>
                    </span>
                    Add Record
                </a>
            </div>
            <!--end::Toolbar-->

            <!--begin::Modal - Adjust Balance-->
            <div class="modal fade" id="trasectionDetails" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content">
                        <!--begin::Modal header-->
                        <div class="modal-header">
                            <!--begin::Modal title-->
                            <h2 class="fw-bold">Transaction Detail</h2>
                            <!--end::Modal title-->
                            <!--begin::Close-->
                            <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal" aria-label="Close>
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->

                                <span class="svg-icon svg-icon-1">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                            transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                        <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                            transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                            <!--end::Close-->
                        </div>
                        <!--end::Modal header-->
                        <!--begin::Modal body-->
                        <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                            <div class="row detailHtml">

                            </div>
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Card-->

        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <div id="table_companies_container" class="dataTables_wrapper dt-bootstrap4 no-footer rep_content">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-condensed flip-content" id="kt_table_transactions">
                    <!--begin::Table head-->
                    <thead>
                        <!--begin::Table row-->
                        <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="User: activate to sort column ascending"
                                style="width: 277.586px;">
                                <?php echo $this->Paginator->sort('name', 'Company Name'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Last login: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('transaction_type_id', 'Transaction Types'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('name', 'Name'); ?>
                            </th>
                            <th class="min-w-125px sorting" tabindex="0" aria-controls="kt_table_users" rowspan="1"
                                colspan="1" aria-label="Two-step: activate to sort column ascending"
                                style="width: 162.461px;">
                                <?php echo $this->Paginator->sort('created', 'Created'); ?>
                            </th>

                            <th class="text-end min-w-100px sorting_disabled" rowspan="1" colspan="1"
                                aria-label="Actions" style="text-align: center !important;width: 130.547px; color: #181c32" >
                                Actions
                            </th>
                    </thead>
                    <tbody>
                           <?php
        						$transactionsnew = array(1 =>'Quota', 2 =>'Job Offer', 3 =>'Work permit', 4 =>'Pre Aprovel',  5 =>'Bank guarantee', 6 =>'E Visa', 7=>'Change status', 8 =>'Medical fitness',  9 =>'Emirates ID', 10 =>'Typing labour card' , 11 =>'Submit labour card',  12 =>'Visa stamp', 13=>'Send to Employee');

                                $number = 0;
                                $class = null;
                                if(!$company_transactions->isEmpty()) {
                                    foreach($company_transactions as $transaction){
                                        if ($number % 2 === 0) {
                                            $class = "even";
                                        } else {
                                            $class = "odd";
                                        }
                                    $Colourclass = '';
									foreach($transaction['trasections_relation'] as $keyTra => $valueTra){
										if($valueTra['status'] == 1){
											$Colourclass = 'yellow';
										}
									}
                            ?>
						<tr class="<?php echo $Colourclass ?>">
                            <td><?php echo isset($transaction['company']) ? $transaction['company']['name'] : null;?></td>
                            <td><?php echo $transaction['transaction_type']['transaction_name'];?></td>
                            <td><?php echo $transaction['name'];?></td>
                            <td><?php echo $this->DateC->DateFormetforView($transaction->created);?></td>
							<td style="text-align:center">

							<?php
                                $view = '<a class="trasection-details" data-attach-modal="'.base64_encode($transaction->id).'">
                                <i class="fa fa-eye" title="View"></i></a>';

                                echo $view." ";

                                echo $this->element(
                                    'admin/tabular/actions',
                                    [
                                        'editLink' => 'admin/companies/edit_transaction/',
                                        'deleteLink' => '/admin/companies/delete_transaction/',
                                        'id' => $transaction->id,
                                        'isAttachement' => false,
                                    ]
                                )
							?>
							</td>
						</tr>
						<?php }		}else{ ?>
					   <tr><td colspan="8" class="no_record">No Record Found</td></tr>
					  <?php } ?>
                        <!--end::Table row-->
                    <tbody>

                    <!--end::Table head-->
                    <!--begin::Table body-->

            </table>
        </div>
        <div class="row">
        <?php
            echo $this->element('admin/tabular/pagination')
        ?>
        </div>
    </div>
    <!--end::Table-->
</div>
<!--end::Card body-->
</div>
<?php echo $this->Html->script('admin/search_transaction', ['block'=>'scriptBottom']); ?>

<script>
    $('.trasection-details').click(function (e) {
        e.preventDefault();
        var trasection_id = $(this).attr('data-attach-modal');
        $.ajax({
            url: webroot + "/admin/companies/getTrasectionDetails",
            cache: false,
            type: 'POST',
            data: {
                'trasection_id': trasection_id
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function (html) {
                html = JSON.parse(html);
                if (html.transaction_type_id == 1) {
                    optionsV = {
                        1: 'Quota',
                        2: 'Job Offer',
                        3: 'Work permit',
                        4: 'Pre Aprovel',
                        5: 'Bank guarantee',
                        6: 'E Visa',
                        7: 'Change status',
                        8: 'Medical fitness',
                        9: 'Emirates ID',
                        10: 'Typing labour card',
                        11: 'Submit labour card',
                        12: 'Visa stamp',
                        13: 'Send to Employee'
                    };
                } else if (html.transaction_type_id == 2) {
                    optionsV = {
                        1: 'Medical fitness',
                        2: 'Emirates ID',
                        3: 'Visa stamp'
                    };
                } else if (html.transaction_type_id == 3) {
                    optionsV = {
                        1: 'Offer Letter',
                        2: 'Send to Employee',
                        3: 'Submisstion'
                    };
                } else if (html.transaction_type_id == 4) {
                    optionsV = {
                        0: 'Type Application',
                        1: 'Send Signature',
                        2: 'Submit in MOL'
                    };
                } else if (html.transaction_type_id == 5) {
                    optionsV = {
                        1: 'Type Application',
                        3: 'Approved by EDNRD'
                    };
                } else if (html.transaction_type_id == 6) {
                    optionsV = {
                        1: 'Send to Employee',
                        2: 'Submit to MOL'
                    };
                } else if (html.transaction_type_id == 7) {
                    optionsV = {
                        1: 'Type Application',
                        2: 'Send VISA in EDNRD'
                    };
                }
                statusV = {
                    1: 'Pending',
                    2: 'Under Process',
                    3: 'Done'
                };
                var detailHtml =
                    '<div class="well col-xs-12 col-sm-12 col-md-12 "> <div class="row"> <div class="col-xs-6 col-sm-6 col-md-6"><address> <strong>Company :</strong> ' +
                    html.company.name + '</address><name> <strong>Name :</strong> ' + html.name +
                    '  </name>  </div> <div class="col-xs-6 col-sm-6 col-md-6 text-right"> <p><em>Date: ' +
                    (new Date(html.created)).toDateString() +
                    '</em></p> </div> </div> <div class="row"> <div class="text-center">  <h1>' +
                    html.transaction_type.transaction_name +
                    '</h1> </div> </span> <table class="table table-hover"><thead> <tr><th>Type</th> <th>Starting Date</th> <th class="text-center">Status</th> <th class="text-center">Completion date</th><th class="text-center">Note</th> <th class="text-center">User</th></tr> </thead> <tbody>';
                $.each(html.trasections_relation, function (key, value) {
                    if (value.status != 1) {

                        //console.log(optionsV[value.transaction_type_id+1]);
                        //console.log(value)

                        var comple = value.status == 3 ? (new Date(value.completion_date))
                            .toDateString() : '---';
                        detailHtml += '<tr><td class="col-md-2"><em>' + optionsV[value
                                .transaction_type_id + 1] +
                            '</em></h4></td><td class="col-md-2" style="text-align: center">' +
                            (new Date(value.starting_date)).toDateString() +
                            '</td><td class="col-md-2 text-center">' + statusV[value
                            .status] + '</td><td class="col-md-2 text-center">' + comple +
                            '</td> <td class="col-md-2 text-center">' + value.note +
                            '</td>       <td class="col-md-2 text-center">' + html.user
                            .Username + '</td> </tr>';
                    }
                });
                detailHtml += '</tbody></table>  </div> </div>';
                $('.detailHtml').html(detailHtml);
                $('#trasectionDetails').modal('show');
                console.log(html);
            }
        });
    });
</script>
