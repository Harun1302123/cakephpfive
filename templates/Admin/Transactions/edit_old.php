<style>
	.clr{
		color:red;
	}

.global_btn_info .save{
		padding : 12px 25px 10px 58px;
	}
</style>

<div class="content-wrapper">
    <!-- Main content -->
	<?php echo  $this->Flash->render();?>
    <section class="content">
      <!-- Your Page Content Here -->
      <h2 class="global_title"><i class="fa fa-building-o"></i> Edit Record</h2>
      <div class="main_info_sec">
            <?php echo $this->Form->create($transactions);
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

					<div class="col-lg-6 col-sm-6 col-xs-6">
						<div class="global_btn_info">
							<button class="save"><i class="fa fa-floppy-o"></i> Submit</button>
						</div>
					</div>
				</div>
            </div
            <?php echo $this->Form->end(); ?>
        </div>
    </section>
    <!-- /.content -->
  </div>
