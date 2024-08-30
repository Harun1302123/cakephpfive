<section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Record</h2>
      <div class="main_info_sec">
            <?php echo $this->Form->create($transactions,['url' =>'/admin/Transactions/edit/'.base64_encode($transactions->id)]);
			echo $this->Form->hidden('id',['value'=>$transactions['id']]);
			//echo $this->Form->hidden('user_id',['value'=>$center['user_id']]);
			?>
            <div class="global_form">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<div class="form_block">
							<label class = "nitin">Transaction<span class="clor"> * </span> :</label>
						  <?php echo $this->Form->input('name', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
						</div>
					</div>
					
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<div class="form_block">
							<label class = "nitin">Goverment Fees<span class="clor"> * </span> :</label>
						  <?php echo $this->Form->input('gov_fees', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
						</div>
					</div>
					
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<div class="form_block">
							<label class = "nitin">Typing Fees<span class="clor"> * </span> :</label>
						  <?php echo $this->Form->input('typing_fees', array('required' => 'required', 'class' => 'input_field', 'label' => false));  ?>
						</div>
					</div>             
										
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<div class="global_btn_info">
							<button class="save"><i class="fa fa-floppy-o"></i> Submit</button>
						</div>
					</div>
				</div>                    
            </div
            <?php echo $this->Form->end(); ?>
        </div>
    </section>
