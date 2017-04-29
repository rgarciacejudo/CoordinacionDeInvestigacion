<?php echo $this->Html->css('font-awesome.min'); ?>
<?php echo $this->Html->css('jssocials'); ?>
<?php echo $this->Html->css('jssocials-theme-minima'); ?>
<?php echo $this->Html->script('vendor/jssocials.min'); ?>
<script>
    $(document).ready(function(){
        $("#share").jsSocials({
            shares: ["twitter", "facebook", "googleplus", "linkedin", "whatsapp"]
        });
    });    
</script>