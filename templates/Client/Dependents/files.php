<?php //echo $type; exit; ?>
<body style="background: #0e0e0e;">
<div style="text-align:center;"> 
<?php if($type == 'image/jpeg' || $type == 'image/png'){ ?>
	<img  id="zoom_01"  height="100%"  data-zoom-image="<?php echo $file  ?>"   align="middle" src="<?php echo $file  ?>">
<?php }else{
?>
	<iframe class="center" src="<?php echo $file  ?>"  width="100%" height="100%"> </iframe>
    <?php } ?>

</div>


<style type="text/css">
.center {
text-align:center;
}

</style>
<?php echo $this->Html->script('admin/jQuery-2.2.0.min'); ?>
<?php echo $this->Html->script('admin/jquery.elevatezoom'); ?>
<script>
    $('#zoom_01').elevateZoom({
		scrollZoom : true,
		zoomLevel : 1,
		zoomType: "inner",
		cursor: "crosshair",
		
   });
</script>
</body>