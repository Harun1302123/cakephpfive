<aside class="main-sidebar">
<!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
         <!--<li><a href="<?php echo BASE_URL;?>/admin/Users/dashboard"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li> -->
		 <!-- -->
		<li class="treeview">
          <a href="#"><i class="fa fa-building"></i> <span>Manage Companies</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="<?php echo BASE_URL;?>/admin/companies"><span>All Companies</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/admin/companies/add"><span>Add Company</span></a></li>
          </ul>
        </li>

		<li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Employees</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="<?php echo BASE_URL;?>/admin/employees"><span>All Employees</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/admin/employees/add"><span>Add Employee</span></a></li>
          </ul>
        </li>

		<li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Dependents</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="<?php echo BASE_URL;?>/admin/dependents"><span>All Dependents</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/admin/dependents/add"><span>Add Dependent</span></a></li>
          </ul>
        </li>

		 <li class="treeview">
          <a href="#"><i class="fa fa-exchange"></i> <span>Manage Transactions</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
			 <li class="hide" ><a href="<?php echo BASE_URL;?>/admin/transactions"><span>Manage Transactions</span></a></li>
			 <li class="hide" ><a href="<?php echo BASE_URL;?>/admin/transactions"><span>Add Transaction</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/admin/companies/transactions"><span>All Transactions</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/admin/companies/add_transaction"><span>Add Transactions</span></a></li>
			 <!-- <li><?php echo $this->Html->link('Manage Transaction',array('controller'=>'Transactions','action'=>'index'));?></li> -->
          </ul>
        </li>

		<li class="treeview">
          <a href="#"><i class="fa fa-wrench"></i> <span>Alert settings</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li><a href="<?php echo BASE_URL;?>/admin/settings/alerts"><span>All Alert</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/admin/settings/add_alert"><span>Add Alert</span></a></li>
          </ul>
        </li>

		<?php if($this->request->getSession()->read('Auth.User.user_role_id') == 1){ ?>
		 <li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Users</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
			 <li><a href="<?php echo BASE_URL;?>/admin/users"><span>All Users</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/admin/users/add"><span>Add User</span></a></li>

          </ul>
        </li>

		<li class="treeview">
          <a href="#"><i class="fa fa-users"></i> <span>Manage Roles</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
			 <li><a href="<?php echo BASE_URL;?>/admin/userRoles"><span>All Roles</span></a></li>
			 <li><a href="<?php echo BASE_URL;?>/admin/userRoles/add"><span>Add Role</span></a></li>

          </ul>
        </li>
      <?php } ?>

		<!-- <li><a href="<?php echo BASE_URL;?>/admin/transaction_follows/manage"><i class="fa fa-exchange"></i> <span>Employees Page</span></a></li> -->
		<li><a href="<?php echo BASE_URL;?>/admin/clients"><i class="fa fa-users"></i> <span>Clients</span></a></li>

        <li><a href="<?php echo BASE_URL;?>/admin/settings/"><i class="fa fa-cog"></i> <span>Settings</span></a></li>

		<li class="treeview">
          <a href="#"><i class="fa fa-file-text-o"></i> <span>Reports</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
			 <li><a href="<?php echo BASE_URL;?>/admin/reports/trasection_report"><i class="fa fa-exchange"></i> <span>Transaction</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/admin/reports/employee"><i class="fa fa-user"></i> <span>Employee</span></a></li>
			<li><a href="<?php echo BASE_URL;?>/admin/reports/dependents"><i class="fa fa-users"></i> <span>Dependent</span></a></li> <!---->


            <li><a href="<?php echo BASE_URL;?>/admin/reports/send_recieve"><i class="fa fa-users"></i> <span>Send & Recieve Documents</span></a></li>
            <li><a href="<?php echo BASE_URL;?>/admin/reports/reminders"><i class="fa fa-users"></i> <span> Reminders </span></a></li>
          </ul>
        </li>

      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
	</aside>
