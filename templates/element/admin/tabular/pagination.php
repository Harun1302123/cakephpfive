<div class="col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
    <?php echo $this->Paginator->counter('Showing {{start}} to {{end}} of {{count}}');?>
</div>
<div class="col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end">
    <div class="dataTables_paginate paging_simple_numbers" id="kt_table_users_paginate">
        <ul class="pagination pagination-circle pagination-outline">
        <?php echo $this->Paginator->prev();?>
        <?php echo $this->Paginator->numbers();?>
        <?php echo $this->Paginator->next();?>
        </ul>
    </div>
</div>
