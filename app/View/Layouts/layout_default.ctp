<?php
/**
 * @author: Debdeep Nath
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo $title_for_layout; ?></title>
    <?php echo $this->Html->css('custom'); ?>
</head>

<body>
	
<?php echo $this->Element('header'); ?>

	<div style="padding: 10px;">
		<?php echo $this->fetch('content'); ?>
		
	</div>

<?php echo $this->Element('footer'); ?>


</body>

</html>
<?php //echo $this->element('sql_dump'); ?>
