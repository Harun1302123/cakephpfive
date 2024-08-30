<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- <li><a href="<?php echo BASE_URL;?>/admin/Users/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
		<!-- <li><a href="<?php echo BASE_URL;?>/admin/settings/"><i class="fa fa-wrench"></i> <span>Settings</span></a></li> -->
	<!--<li class="treeview">
          <a href="#"><i class="fa fa-building"></i> <span>Manage Companies</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="/client/companies"><span>Manage Companies</span></a></li>
			<li><a href="/client/companies/add"><span>Add Company</span></a></li>
          </ul>
        </li>-->
<li><a href="/client/companies"><i class="fa fa-building"></i><span>Manage Company</span></a></li>
		<li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Employees</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="/client/employees"><span>Manage Employees</span></a></li>
			<!-- <li><a href="/client/employees/add"><span>Add Employee</span></a></li> -->
          </ul>
        </li>

		<li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Dependents</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="/client/dependents"><span>Manage Dependents</span></a></li>
			<!-- <li><a href="/client/dependents/add"><span>Add Dependent</span></a></li> -->
          </ul>
        </li>

		 <li class="treeview">
          <a href="#"><i class="fa fa-exchange"></i> <span>Manage Transactions</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
		<!--	 <li><a href="<?php echo BASE_URL;?>/client/transactions"><span>Manage Transactions</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/client/transactions"><span>Add Transaction</span></a></li>-->
			 <li><a href="<?php echo BASE_URL;?>/client/companies/transactions"><span>Manage Company Transactions</span></a></li>
			 <!--<li><a href="<?php echo BASE_URL;?>/client/companies/add_transaction"><span>Add Company Transactions</span></a></li>
			  <li><?php echo $this->Html->link('Manage Transaction',array('controller'=>'Transactions','action'=>'index'));?></li> -->
          </ul>
        </li>

		<!-- <li class="treeview">
          <a href="#"><i class="fa fa-wrench"></i> <span>Alert settings</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="<?php echo BASE_URL;?>/client/settings/alerts"><span>Manage Alert</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/client/settings/add_alert"><span>Add Alert</span></a></li>
          </ul>
        </li> -->

		<?php // if($this->request->getSession()->read('Auth.User.user_role_id') == 1){ ?>
		 <!-- <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Users</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
			 <li><a href="<?php echo BASE_URL;?>/client/users"><span>Manage Users</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/client/users/add"><span>Add User</span></a></li>

          </ul>
        </li>

		<li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Roles</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
			 <li><a href="<?php echo BASE_URL;?>/client/userRoles"><span>Manage Roles</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/client/userRoles/add"><span>Add Role</span></a></li>

          </ul>
        </li> -->
      <?php // } ?>

		<!-- <li><a href="<?php echo BASE_URL;?>/client/transaction_follows/manage"><i class="fa fa-exchange"></i> <span>Employees Page</span></a></li>
		<li><a href="<?php echo BASE_URL;?>/client/clients"><i class="fa fa-users"></i> <span>Clients</span></a></li> -->

		<li class="treeview">
          <a href="#"><i class="fa fa-file-text-o"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
        <ul class="treeview-menu">
			<!-- <li><a href="<?php //echo BASE_URL;?>/client/reports/trasection_report"><i class="fa fa-exchange"></i> <span>Transaction</span></a></li>-->
			<li><a href="<?php echo BASE_URL;?>/client/reports/employee"><i class="fa fa-user"></i> <span>Employee</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/client/reports/dependents"><i class="fa fa-users"></i> <span>Dependent</span></a></li> <!---->

			<!--
            <li><a href="<?php //echo BASE_URL;?>/client/reports/send_recieve"><i class="fa fa-users"></i> <span>Send & Recieve Documents</span></a></li>
            <li><a href="<?php //echo BASE_URL;?>/client/reports/reminders"><i class="fa fa-users"></i> <span> Reminders </span></a></li>-->
          </ul>


        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
	</aside>
