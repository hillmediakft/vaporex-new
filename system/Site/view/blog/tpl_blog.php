<div class="container">
	<div class="row">
	
		<div class="col-md-12">
			<h1>Blog</h1>
			<br /><br />
		</div>
		
		<div class="col-md-6">
		
		<?php //var_dump($content);?>
		
		<?php foreach($content as $value) { ?>
			<div>
				<div>
					<img class="img-responsive img-rounded" src="<?php echo $value['blog_picture'];?>" alt="<?php echo $value['blog_title'];?>" />
				</div>
				<h3><?php echo $value['blog_title'];?></h3>
				<p>
					<small><?php echo $value['blog_add_date'];?></small>
				</p>
				<div>
					<?php echo $value['blog_body'];?>
				</div>
			</div>
		
		<div style="height:1px; margin:40px 0px; background:gray;"></div>
			
		<?php }  ?>
		
		
		</div>
	
	</div>
</div>