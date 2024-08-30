<style>
.isdeleted {
	white-space: nowrap;
	padding: 5px 10px;
	margin: 0 3px;
	font-size: 13px;
	color: #fff!important;
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
</style>
<div class="content-wrapper"> <?php echo  $this->Flash->render();?> 
  <!-- Main content -->
  <section class="content"> 
    <!-- Your Page Content Here -->
    <h2 class="global_title"><i class="fa fa-building-o"></i> Manage Dependent</h2>
    <div class="main_info_sec">
      <div class="row" style="margin-bottom:1%;padding:0 20px 10px">
        <div class="col-lg-3"> 
          <!-- <a href="/client/dependents/add" class="btn btn-info"><i class="fa fa-plus"></i> Add Record </a> --> 
        </div>
        <div class="col-lg-7 pull-right">
          <div class="for-search">
            <form class="form-inlin" id="report-form">
              <div class="row">
                <div class="col-md-5">
                  <div class="form_block" > <?php echo $this->Form->input('employee_id',['options'=>$employees,'label'=>false,'div'=>false ,'empty'=>'Select Employee','class'=>"form-control"]); ?> </div>
                </div>
                <div class="col-md-5">
                  <div class="form_block">
                    <input type="text" class="form-control" name="email_or_name" id="searchQuery" placeholder="Name">
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form_block">
                    <button type="submit" class="btn btn-large btn-block btn-info" id="search-reports">Search</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <style>
		   .text-center.overlape {
					position: absolute;
					width: 100%;
					z-index: 9999;
					left: 0;
					top: 39%;
			}
		   .table_listing{
			   position:relative;}
	   </style>
      <div class="for-search">
        <div class="pull-right" style="margin-right: 10px;margin-bottom:10px;">
          <button class="btn btn-primary" id="create-xls-dependents">Export to Excel</button>
        </div>
      </div>
      <!-- Table -->
      
      <div class="table_listing rep_content">
        <div class="text-center overlape" id="loader" style="display:none"> <img src ="/img/loading.gif" width="60px" height="60px"> </div>
        <div class="table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th align='left'><?php echo $this->Paginator->sort('name', 'Name');?></th>
                <th align='left'><?php echo $this->Paginator->sort('passport_no', 'Passport No');?></th>
                <th align='left'><?php echo $this->Paginator->sort('passport_exp_date', 'Passport Expire Date');?></th>
                <th align='left'><?php echo $this->Paginator->sort('visa_no', 'Visa No');?></th>
                <th align='left'><?php echo $this->Paginator->sort('visa_exp_date', 'Visa  Expire Date');?></th>
                <th align='left'><?php echo $this->Paginator->sort('emiratesID_no', 'Emirates ID No');?></th>
                <th align='left'><?php echo $this->Paginator->sort('emiratesID_exp_date', 'Emirates ID Expiry Date');?></th>
                <th align='left'>Action</th>
                <!----> 
              </tr>
              <?php 
					if(!$dependents->isEmpty()){
							foreach($dependents as $dependent){
						?>
              <tr>
                <td><?php echo $dependent->name;?></td>
                <td><?php echo $dependent->passport_no;?></td>
                <td><?php echo $this->DateC->DateFormetforView($dependent->passport_exp_date);?></td>
                <td><?php echo $dependent->visa_no;?></td>
                <td><?php echo $this->DateC->DateFormetforView($dependent->visa_exp_date);?></td>
                <td><?php echo $dependent->emiratesID_no;?></td>
                <td><?php echo $this->DateC->DateFormetforView($dependent->emiratesID_exp_date);?></td>
                <td><!---->
                  
                  <?php	
							
								$edit = '<a href="'.BASE_URL.'/client/dependents/edit/'.base64_encode($dependent->id).'">
								<i class="fa fa-edit" title="Edit"></i></a>';
								
								$delete = '<a href="'.BASE_URL.'/client/dependents/delete/'.base64_encode($dependent->id).'" onclick="return confirm('."'Are you sure you want to delete?'".');">
								<i class="fa fa-remove" title="Delete" ></i></a>';

								$attachment = '<a data-attach-depet="'.base64_encode($dependent->id).'" class="attach_for_depet" href="javascript:void(0)">
								<i class="fa fa-upload" title="Upload Attachment" ></i></a>';

							//	echo $edit.'  '.$delete.'  '.$attachment;
							
							?>
                            
                  <a data-toggle="modal" data-target="#documents-verifcation_<?php echo $dependent->id; ?>" ><i class="fa fa-file" aria-hidden="true"></i></a> <a data-toggle="modal" data-target="#documents-view_<?php echo $dependent->id; ?>" ><span class="icon-stack"> <i class="fa fa-file-o icon-stack-2x"></i> <i class="fa fa-eye icon-stack-1x"></i> </span></i> </a>
                  <div class="modal fade" id="documents-verifcation_<?php echo $dependent->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalLabel">Documents verification</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <?php $indexloop = 0; echo $this->Form->create($dependent, array('url' => '/client/dependents/edit/'.base64_encode($dependent->id)));?>
                        <div class="modal-body person_documents">
                          <table class="table borderless">
                            <tr>
                              <td width="10%">Passport: </td>
                              <td width="45%"> Sent</br>
                                <?php echo $this->Form->input('clients_document.passport_receive_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['passport_receive_client'] == 1 ? 'disabled' : false  ));
								
								echo $this->Form->input('clients_document.passport_receive_client_date', array('type'=>'hidden' ,  'value' => $dependent['clients_document']['passport_receive_client_date'] ));  ?>
                                
                                <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['passport_receive_client']){
					  	echo $this->DateC->DateFormetforView($dependent['clients_document']['passport_receive_client_date']);				}
						?>
                                </span>
                                <?php
						if($dependent['clients_document']['passport_send_admin']){
							echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['passport_send_admin_date']).')</span>'; 
						}
					?>
                                </span>
                                <?php if($dependent['clients_document']['passport_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="passport" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%">Received</br>
                                <?php echo $this->Form->input('clients_document.passport_send_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['passport_send_client'] == 1 ? 'disabled' : false )); 
								
								echo $this->Form->input('clients_document.passport_send_client_date', array('type'=>'hidden' ,  'value' => $dependent['clients_document']['passport_send_client_date'] ));   ?>
                                
                                <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['passport_send_client']){
					  		
							echo $this->DateC->DateFormetforView($dependent['clients_document']['passport_send_client_date']);
						}
						?>
                                </span>
                                <?php
						if($dependent['clients_document']['passport_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['passport_receive_admin_date']).')</span>'; 
							}	
					?>
                                </span></td>
                            </tr>
                            <tr>
                              <td width="10%">Birthday Certificate: </td>
                              <td width="45%">Sent</br>
                                <?php echo $this->Form->input('clients_document.bc_send_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['bc_send_client'] == 1 ? 'disabled' : false ));
								
								echo $this->Form->input('clients_document.bc_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['bc_send_client_date'] ));  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['bc_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['bc_send_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['bc_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_admin_date']).')</span>'; 
							}	
					?>
                                </span>
                                <?php if($dependent['clients_document']['bc_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="bc" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%"> Received</br>
                                <?php echo $this->Form->input('clients_document.bc_receive_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['bc_receive_client'] == 1 ? 'disabled' : false  ));  ?> <?php echo $this->Form->input('clients_document.bc_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['bc_receive_client_date'] ));  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['bc_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['bc_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent</span> ('.$this->DateC->DateFormetforView($dependent['clients_document']['bc_receive_admin_date']).')'; 
							}
					?>
                                </span></td>
                            </tr>
                            <tr>
                              <td width="10%">Marriage Certificate: </td>
                              <td width="45%">Sent</br>
                                <?php echo $this->Form->input('clients_document.mc_send_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['mc_send_client'] == 1 ? 'disabled' : false ));
								
								echo $this->Form->input('clients_document.mc_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['mc_send_client_date'] ));  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['mc_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['mc_send_client_date']);
						}
						?>
                                </span>
                                <?php  
						if($dependent['clients_document']['mc_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['mc_receive_admin_date']).')</span>' ; 
							}	
					?>
                                </span>
                                <?php if($dependent['clients_document']['mc_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="mc" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%"> Received</br>
                                <?php echo $this->Form->input('clients_document.mc_receive_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['mc_receive_client'] == 1 ? 'disabled' : false  ));
								
								echo $this->Form->input('clients_document.mc_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['mc_receive_client_date'] ));  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['mc_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['mc_receive_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['mc_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent ('.$this->DateC->DateFormetforView($dependent['clients_document']['mc_send_admin_date']).')</span>'; 
							}
					?>
                                </span></td>
                            </tr>
                            <tr>
                              <td width="10%">Emirates ID: </td>
                              <td width="45%">Sent</br>
                                <?php echo $this->Form->input('clients_document.eid_send_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['eid_send_client'] == 1 ? 'disabled' : false  )); 
								
								echo $this->Form->input('clients_document.eid_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['eid_send_client_date'] ));  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['eid_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['eid_send_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['eid_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_admin_date']).')</span>'; 
							}	
					?>
                                </span>
                                <?php if($dependent['clients_document']['eid_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="eid" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%"> Received</br>
                                <?php echo $this->Form->input('clients_document.eid_receive_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' , 'disabled' => $dependent['clients_document']['eid_receive_client'] == 1 ? 'disabled' : false ));
								echo $this->Form->input('clients_document.eid_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['eid_receive_client_date'] ));  ?><span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['eid_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['eid_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send ('.$this->DateC->DateFormetforView($dependent['clients_document']['eid_receive_admin_date']).')</span>'; 
							}
					?>
                                </span></td>
                            </tr>
                            <tr>
                              <td width="10%">Degree Certificate: </td>
                              <td width="45%">Sent</br>
                                <?php echo $this->Form->input('clients_document.dc_send_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['dc_send_client'] == 1 ? 'disabled' : false)); 
								
								echo $this->Form->input('clients_document.dc_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['dc_send_client_date'] ));  ?> 
                                <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['dc_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['dc_send_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['dc_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['dc_receive_admin_date']).')</span>'; 
							}	
					?>
                                </span>
                                <?php if($dependent['clients_document']['dc_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="dc" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%"> Received</br>
                                <?php echo $this->Form->input('clients_document.dc_receive_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['dc_receive_client'] == 1 ? 'disabled' : false )); 
								echo $this->Form->input('clients_document.dc_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['dc_receive_client_date'] ));  ?><span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['dc_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['dc_receive_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['dc_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent ('.$this->DateC->DateFormetforView($dependent['clients_document']['dc_send_admin_date']).')</span>'; 
							}
					?>
                                </span></td>
                            </tr>
                            <tr>
                              <td width="10%">Medical: </td>
                              <td width="45%">Sent</br>
                                <?php echo $this->Form->input('clients_document.medical_send_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['medical_send_client'] == 1 ? 'disabled' : false )); 
								echo $this->Form->input('clients_document.medical_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['medical_send_client_date']) );  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['medical_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['medical_send_client_date']);
						}
						?>
                                </span>
                                <?php  
						if($dependent['clients_document']['medical_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_admin_date']).')</span>'; 
							}		
					?>
                                </span>
                                <?php if($dependent['clients_document']['medical_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="medical" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%"> Received</br>
                                <?php echo $this->Form->input('clients_document.medical_receive_client', array('class' => 'regular-checkbox persnal-doc-check', 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['medical_receive_client'] == 1 ? 'disabled' : false )); 
								echo $this->Form->input('clients_document.medical_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['medical_receive_client_date'] ));  ?><span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['medical_receive_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['medical_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Sent</span> ('.$this->DateC->DateFormetforView($dependent['clients_document']['medical_receive_admin_date']).')' ; 
							}
					?>
                                </span></td>
                            </tr>
                            <tr>
                              <td width="10%">Other: </td>
                              <td width="45%">Sent</br>
                                <?php 
								 $class =  $dependent['clients_document']['other_receive_value'] != ''? '' : 'other_doc' ;
								  echo $this->Form->input('clients_document.other_send_client', array('class' => "regular-checkbox persnal-doc-check $class", 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['other_send_client'] == 1 ? 'disabled' : false ));  
								  echo $this->Form->input('clients_document.other_send_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['other_send_client_date'] ));  ?> <span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['other_send_client']){
							echo $this->DateC->DateFormetforView($dependent['clients_document']['other_send_client_date']);
						}
						?>
                                </span>
                                <?php 
						if($dependent['clients_document']['other_receive_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Received ('.$this->DateC->DateFormetforView($dependent['clients_document']['other_receive_admin_date']).')</span>'; 
							}	
					?>
                                </span>
                                <?php if($dependent['clients_document']['other_send_client'] || $dependent['clients_document']['other_receive_admin'] ){ ?>
                                <div  class="other-doc-parent form_block">
                                  <input readonly   type="text"  class="input_field" style="width: 90%; margin-top:10px" value="<?php echo $dependent['clients_document']['other_receive_value'] ?>" />
                                </div>
                                <?php } ?>
                                <?php if($dependent['clients_document']['other_receive_client']){ ?>
                                <span class="resend">
                                <button type-id="<?php echo base64_encode($dependent['clients_document']['id']); ?>" type="button" data-type="other" class="btn btn-primary btn-xs re-set-doc">Send again</button>
                                </span>
                                <?php }?></td>
                              <td width="45%"> Received</br>
                                <?php
								$class =  $dependent['clients_document']['other_send_admin'] != ''? '' : 'other_doc' ;
								 echo $this->Form->input('clients_document.other_receive_client', array('class' => "regular-checkbox persnal-doc-check $class", 'label' => false, 'type'=>'checkbox' ,'disabled' => $dependent['clients_document']['other_receive_client'] == 1 ? 'disabled' : false ));  
								 echo $this->Form->input('clients_document.other_receive_client_date', array('type'=>'hidden' , 'value' => $dependent['clients_document']['other_receive_client_date'] ));  ?><span class="documents_date"> <span class="date">
                                <?php if($dependent['clients_document']['other_receive_client']){
								echo $this->DateC->DateFormetforView($dependent['clients_document']['other_receive_client_date']);
								}
							?>
                                </span>
                                <?php 
						if($dependent['clients_document']['other_send_admin']){
								echo '<span class="doc-status" ><i class="btn btn-primary btn-sm fa fa-check"aria-hidden="true"></i> Send</span> ('.$this->DateC->DateFormetforView($dependent['clients_document']['other_send_admin_date']).')'; 
							}
					?>
                                </span>
                                <?php 
								if($dependent['clients_document']['other_send_admin'] || $dependent['clients_document']['other_receive_client'] ){
									?>
                                <div  class="other-doc-parent form_block">
                                  <input readonly   type="text"  class="input_field" style="width: 90%; margin-top:10px;" value="<?php echo $dependent['clients_document']['other_send_value'] ?>" required />
                                </div>
                                <?php } ?></td>
                            </tr>
                          </table>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                        <?php $indexloop++; echo $this->Form->end(); ?>
                      </div>
                    </div>
                  </div>
                  <div class="modal fade" id="documents-view_<?php echo $dependent->id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h4 class="modal-title" id="exampleModalLabel">Attached Documents</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                        </div>
                        <div class="modal-body person_documents">
                          <div class="row">
                            <?php
				if(count($dependent['documents']) > 0){
                	foreach($dependent['documents'] as $ca){
                ?>
                            <div style='float:left; text-align: center;' class='col-lg-2 attachments'>
                              <h5 class='attachment_title'><?php echo $ca['aTitle']; ?></h5>
                              <?php												
                if (strpos($ca['file'], '.png') !== false || strpos($ca['file'], '.jpg') !== false || strpos($ca['file'], '.jpeg') !== false ) { ?>
                              <a target="_blank" href="<?php echo BASE_URL;?>/client/dependents/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'>
                              <?php } else { ?>
                              <a target="_blank" href="<?php echo BASE_URL;?>/client/dependents/files/<?php echo base64_encode($ca->id); ?>"><img src='<?php echo BASE_URL;?>/attachments/center/text.png' style='width:100px;height:100px;'></a>
                              <?php }	?>
							  
							  <br>
							  <a style="color: #3c8dbc;"  href='<?php echo BASE_URL."/client/dependents/DownloadDependentDocument/".base64_encode($ca->id);?>' >Download</a>
							  
                            </div>
                            <?php
            		}
				}else{
					echo '<h5>No Documents Attached</h5>';
				}
				?>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div></td> 
                <!-- --> 
              </tr>
              <?php  }		}else{ ?>
              <tr>
                <td colspan="7" class="no_record">No Record Found</td>
              </tr>
              <?php } ?>
            </thead>
          </table>
        </div> 
        <div class="table_page_info">
          <div class="row">
            <div class="col-lg-5 col-sm-5 col-xs-12">
              <p> <?php echo $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}}');?> </p>
            </div>
            <div class="col-lg-7 col-sm-7 col-xs-12">
              <ul class="pagination">
                <?php echo $this->Paginator->prev('  ' . __('Previous'));?> <?php echo $this->Paginator->numbers();?> <?php echo $this->Paginator->next('  ' . __('Next'));?>
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

<!-- Modal -->
<div class="modal fade" id="upload-model" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Upload Attachment</h4>
      </div>
      <div class="modal-body">
        <form id="attac_upload" class="form-horizontal" method="post" action="/client/dependents/upload_attachment" autocomplete="off" enctype="multipart/form-data">
          <input type="hidden" class="dependent-id" name="dependent-id" value="">
          <div class="form-group">
            <label class="control-label col-sm-2" for="title">Title:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="attachment-title" id="attachment-title" placeholder="Enter Attachment Title" required>
            </div>
          </div>
          <div class="form-group">
            <label class="control-label col-sm-2" for="attachment-file">File:</label>
            <div class="col-sm-10">
              <input type="file" class="form-control" id="attachment-file" name="attachment-file" accept="image/x-png,image/gif,image/jpeg,.pdf" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default">Upload</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<?php echo $this->Html->script('client/dependent_attachment',['block'=>'scriptBottom']); ?> 
<script>
	$('#attac_upload').parsley();
	$(".person_documents input").change(function() {
		if(this.checked) {
			//console.log($(this).parent().parent().children('.documents_date').children('.date').html());
			$(this).parent().parent().children('.documents_date').children('.date').html(formatDate(new Date()));
			date = new Date()
			$('input#'+$(this).attr('id')+'-date').val(date.getFullYear()+'-'+ (date.getMonth()+1) +'-'+ date.getDate()); 
		}else{
			$('input[name="'+$(this).attr('name')+'_date"]').val('');
			$(this).parent().parent().children('.documents_date').children('.date').html('');
		}
	});
	
	function formatDate(date) {
	var monthNames = [
		"Jan", "Feb", "March",
		"April", "May", "June", "July",
		"Aug", "Sep", "Oct",
		"Nov", "Dec"
	];
	
	var day = date.getDate();
	var monthIndex = date.getMonth();
	var year = date.getFullYear();
	return day + ' ' + monthNames[monthIndex] + ' ' + year;
}
	$('.other_doc').change(function() {
		if(this.checked) {
			var name = $(this).attr('name');
			name = name.replace('_client','_value');
			//console.log($(this).parent().parent('td').html());
			$(this).parent().parent('td').append('<div  class="other-doc-parent form_block"><input  name="'+name+'" type="text"  class="input_field" style="width: 90%; margin-top:10px" required /></div>');
		}else{
			$(this).parent().parent().children('.other-doc-parent').remove();
		}
	});
	$('.re-set-doc').click(function(){
			type_id   = $(this).attr('type-id');
			data_type = $(this).attr('data-type');
			data = {'type_id' : type_id,'data_type' : data_type };
			//console.log(data); return false;
			$.ajax({
				url: webroot+'/client/dependents/re_set',
				data : data,
				cache: false,
				type:'POST',	
				context : this,
				success: function(html){
					html = JSON.parse(html);
					if(html.status == true){
						if(data_type == 'other'){
							$(this).parent().parent('td').parent('tr').find('.input_field').remove();
							//$('.other-doc-parent input').attr('readonly' , false).val('');
						}
						$(this).parent().parent('td').next().children('.documents_date').children().html('');
						$(this).parent().siblings('.documents_date').children().html('');
						$('#clients-document-'+data_type+'-send-client').attr('checked', false);
						$('#clients-document-'+data_type+'-receive-client').attr('checked', false);
						
						$('#clients-document-'+data_type+'-send-client').attr('disabled', false);
						$('#clients-document-'+data_type+'-receive-client').attr('disabled', false);
						
						$('#clients-document-'+data_type+'-send-client-date').val('');
						$('#clients-document-'+data_type+'-receive-client-date').val('');
						$(this).parent().parent('td').next().children('.documents_date').children().html('');
						$(this).parent().remove();
						$('#clients-document-'+data_type+'-send-client').trigger('click');
					}
				}
			});
		});
</script>
<style>
.parsley-errors-list{padding:0;list-style:none;color:red;}
.person_documents .table tr td:nth-child(2),.person_documents .table tr td:nth-child(3){
	    text-align: left;
}
    .icon-stack {
      position: relative;
      display: inline-block;
         width: 1em;
    height: 2em;
      line-height: 2em;
      vertical-align: middle;
    }
    .icon-stack-1x,
    .icon-stack-2x,
    .icon-stack-3x {
      position: absolute;
      left: 0;
      width: 100%;
      text-align: right;
    }
    .icon-stack-1x {
      line-height: inherit;
    }
    .icon-stack-2x , .fa-file {
      font-size: 1.5em;
    }
    .icon-stack-3x {
      font-size: 2em;
    }
	.fa-eye{
		color: #000;
    font-size: 14px;
	}
	.doc-status .btn{
		cursor: default;
	}
@media (min-width: 767px) {
	.modal-dialog {
		width: 800px !important;
	}
}

</style>
