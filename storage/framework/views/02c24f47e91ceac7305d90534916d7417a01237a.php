<div class="alert alert-primary text-center">
    <i class="fe fe-alert-triangle mr-2"></i> <?php echo app('translator')->getFromJson('You don\'t have any accounts. Please, <a href=":link">add account</a> to start.', ['link' => route('account.create')]); ?>
</div><?php /**PATH /var/www/html/autodimes/resources/views/partials/no-accounts.blade.php ENDPATH**/ ?>