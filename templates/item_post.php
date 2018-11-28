<?php if(!empty($title)):?>
	<div class="b-widget-view-header">
		<h2>
			<?php print $title;?>	
		</h2>
	</div>
<?php endif;?>

<?php if(!empty($header)):?>
	<div class="b-widget-view-header">
		<?php print $header;?>
	</div>
<?php endif;?>

<?php foreach ($posts as $data_post):?>

		<div class="b-widget-view-block-item">
			<h6 class="widget-views-post-title">
				<a href="<?php print get_permalink($data_post->ID);?>"><?php print get_the_title($data_post->ID);?></a>
			</h6>
			<div class="widget-views-post-date">
				<?php print get_the_date('Y m d', $data_post->ID );?>
			</div>
		</div>

<?php endforeach;?>





<?php if(!empty($footer)):?>
	<div class="b-widget-view-footer">
		<?php print $footer;?>
	</div>
<?php endif;?>