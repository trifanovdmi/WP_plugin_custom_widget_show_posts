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

	<?php setup_postdata($data_post);?>

		<div class="b-widget-view-block-item">
			<h6 class="widget-views-post-title">
				<a href="<?php the_permalink();?>"><?php print get_the_title();?></a>
			</h6>
			<div class="widget-views-post-date">
				<?php print get_the_date();?>
			</div>
		</div>

	<?php wp_reset_postdata($data_post);?>
<?php endforeach;?>





<?php if(!empty($footer)):?>
	<div class="b-widget-view-footer">
		<?php print $header;?>
	</div>
<?php endif;?>