<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	<h4 class="modal-title">Részletek</h4>
</div>
<div class="modal-body">		
	<dl class="dl-horizontal">
		<dt style="font-size:100%; color:grey;">Azonosító szám:</dt>
		<dd>#<?php echo $content['product_id'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
		<dt style="font-size:100%; color:grey;">Kategória:</dt>
		<dd><?php echo $content['product_category_name_hu'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>                
                
                <dt style="font-size:100%; color:grey;">Kép:</dt>
		<dd><img src="<?php echo Config::get('productphoto.upload_path') . $content['product_photo'];?>"></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Megnevezés (magyar):</dt>
		<dd><?php echo $content['product_title_hu'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Leírás (magyar):</dt>
		<dd><?php echo $content['product_description_hu'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>
                
<dt style="font-size:100%; color:grey;">Megnevezés (English):</dt>
		<dd><?php echo $content['product_title_en'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Leírás (English):</dt>
		<dd><?php echo $content['product_description_en'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>                
		<dt style="font-size:100%; color:grey;">Státusz:</dt>
		<dd><?php echo ($content['product_status'] == 1) ? 'Aktív' : 'Inaktív';?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		
		<dt style="font-size:100%; color:grey;">Létrehozás dátuma:</dt>
		<dd><?php echo $content['product_create_timestamp'];?></dd>
		<div style="border-top:1px solid #E5E5E5; margin: 8px 0px;"></div>

		<dt style="font-size:100%; color:grey;">Módosítás dátuma:</dt>
		<dd><?php echo $content['product_update_timestamp'];?></dd>

	</dl>	
</div>	 
<div class="modal-footer">
	<button onclick="window.location.href = 'admin/products/update_product/<?php echo $content['product_id'];?>';" type="button" class="btn blue">Adatok módosítása</button>
	<button type="button" class="btn default" data-dismiss="modal">Bezár</button>
</div>