<div class="users form">
<?= $this->Form->create() ?>
    <fieldset>
        <legend><?= __('Add User') ?></legend>
        <?= $this->Form->input('Username') ?>
        <?= $this->Form->input('Password') ?>
       
   </fieldset>
<?= $this->Form->button(__('Submit')); ?>
<?= $this->Form->end() ?>
</div>