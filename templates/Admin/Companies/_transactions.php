<style>
    .isdeleted {
        white-space: nowrap;
        padding: 5px 10px;
        margin: 0 3px;
        font-size: 13px;
        color: #fff !important;
        font-weight: 600;
        background: #a94242;
        border-radius: 3px;
    }

    .table_listing .download_report {
        margin: 0 3px 5px;
        display: inline-block;
    }

    .cus {
        font-size: small;
    }

    .yellow {
        background-color: #fff7a1;
    }
</style>
<div class="content-wrapper">
    <?php echo  $this->Flash->render();?>
    <!-- Main content -->
    <section class="content">
        <!-- Your Page Content Here -->
        <h2 class="global_title"><i class="fa fa-building-o"></i> Manage Company Transaction</h2>
        <div class="main_info_sec">
            <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
                <!-- <div class="col-lg-12">
				   <a href="/admin/companies/add_transaction" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a>
			   </div> -->
            </div>
            <style>
                .text-center.overlape {
                    position: absolute;
                    width: 100%;
                    z-index: 9999;
                    left: 0;
                    top: 39%;
                }

                .table_listing {
                    position: relative;
                }
            </style>
            <!--- for searching ----->
            <?php if(!$company_transactions->isEmpty()){ ?>

            <div class="clearfix"></div>
            <div class="for-search">
                <form class="form-inlin" id="report-form">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form_block">
                                <label for="company_id">Company:</label>
                                <?php echo $this->Form->input('company_id',['type' => 'select', 'options'=>$companies,'label'=>false,'div'=>false ,'empty'=>'Select Company','class'=>"form-control"]); ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form_block">
                                <label for="company_id">Transaction:</label>
                                <?php echo $this->Form->input('transaction_type_id',['type' => 'select', 'options'=>$transactions_type_ids,'label'=>false,'div'=>false ,'empty'=>'Select Transaction','class'=>"form-control"]); ?>
                            </div>
                        </div>
                        <!--<div class="col-md-2">
						 <div class="form_block" >
							<label for="company_id">Transaction Type:</label>
							<?php //echo $this->Form->input('transaction_type_id',['options'=>$transactions_type_ids,'label'=>false,'div'=>false ,'empty'=>'Select Transaction Type','class'=>"form-control"]); ?>
						 </div>
					  </div> -->

                        <div class="col-md-2">
                            <div class="form_block">
                                <label class="" for="searchQuery">Name</label>
                                <input type="text" class="form-control" name="email_or_name" id="searchQuery"
                                    placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form_block">
                                <label>&nbsp;</label>
                                <button type="submit" class="btn btn-large btn-block btn-info"
                                    id="search-reports">Search</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <?php } ?>
            <!-- Table -->
            <div class="for-search hide">
                <div class="pull-right" style="margin-right: 10px;">
                    <button class="btn btn-primary" id="create-xl-transaction">Export to Excel</button>
                </div>
            </div>
            <div class="table_listing rep_content">
                <div class="text-center overlape" id="loader" style="display:none">
                    <img src="/img/loading.gif" width="60px" height="60px">
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th align='left'><?php echo $this->Paginator->sort('name', 'Company Name');?></th>
                                <th align='left'>
                                    <?php echo $this->Paginator->sort('transaction_type_id', 'Transaction Types');?>
                                </th>
                                <th align='left'><?php echo $this->Paginator->sort('name', 'Name');?></th>
                                <th align='left'><?php echo $this->Paginator->sort('created', 'Created');?></th>
                                <th align='left'>Action</th>
                            </tr>
                            <?php
						$transactionsnew =array(1 =>'Quota', 2 =>'Job Offer', 3 =>'Work permit', 4 =>'Pre Aprovel',  5 =>'Bank guarantee', 6 =>'E Visa', 7=>'Change status', 8 =>'Medical fitness',  9 =>'Emirates ID', 10 =>'Typing labour card' , 11 =>'Submit labour card',  12 =>'Visa stamp', 13=>'Send to Employee');

						 if(!$company_transactions->isEmpty()){
								foreach($company_transactions as $company_transaction){
									$Colourclass = '';
									foreach($company_transaction['trasections_relation'] as $keyTra => $valueTra){
										if($valueTra['status'] == 1){
											$Colourclass = 'yellow';
										}
									}
									//echo '<pre>'; print_r($company_transaction); exit;
								?>
                            <tr class="<?php echo $Colourclass ?>">
                                <td><?php echo isset($company_transaction['company']) ? $company_transaction['company']['name'] : null;?></td>

                                <td><?php echo $company_transaction['transaction_type']['transaction_name'];?></td>
                                <td><?php echo $company_transaction['name'];?></td>
                                <td><?php echo $this->DateC->DateFormetforView($company_transaction->created);?></td>
                                <td>
                                    <?php

									$view = '<a class="trasection-details" data-id="'.base64_encode($company_transaction->id).'">
									<i class="fa fa-eye" title="View"></i></a>';

									$edit = '<a href="'.BASE_URL.'/admin/companies/edit_transaction/'.base64_encode($company_transaction->id).'">
									<i class="fa fa-edit" title="Edit"></i></a>';

									$delete = '<a href="'.BASE_URL.'/admin/companies/delete_transaction/'.base64_encode($company_transaction->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
									<i class="fa fa-remove" title="Delete" ></i></a>';
									echo $view.' '.$edit.'  '.$delete;
								?>
                                </td>
                            </tr>
                            <?php }		}else{ ?>
                            <tr>
                                <td colspan="6" class="no_record">No Record Found</td>
                            </tr>
                            <?php } ?>
                        </thead>
                    </table>
                </div>
                <div class="table_page_info">
                    <div class="row">
                        <div class="col-lg-5 col-sm-5 col-xs-12">
                            <p>
                                <?php echo $this->Paginator->counter('Showing {{ start }} to {{ end }} of {{ count }}');?>
                            </p>
                        </div>

                        <div class="col-lg-7 col-sm-7 col-xs-12">
                            <ul class="pagination">
                                <?php echo $this->Paginator->prev('  ' . __('Previous'));?>
                                <?php echo $this->Paginator->numbers();?>
                                <?php echo $this->Paginator->next('  ' . __('Next'));?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!---------------- / course------------->
<?php echo $this->Html->script('admin/search_transaction',['block'=>'scriptBottom']); ?>
<!-- Modal -->
<div id="trasectionDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Trasection Details</h4>
            </div>
            <div class="modal-body">
                <div class="row detailHtml">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<style>
    .for-search {
        padding: 0 20px 20px 20px;
        margin-bottom: 20px;
    }
</style>
<script>
    $('.trasection-details').click(function (e) {
        e.preventDefault();
        var trasection_id = $(this).attr('data-id');
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
