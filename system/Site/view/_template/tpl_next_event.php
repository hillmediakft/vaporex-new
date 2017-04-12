<?php if(!empty($kovetkezo_jatszohaz)) { ?>
<!-- KÖVETKEZŐ JÁTSZÓHÁZ -->
<div class="search-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                
                <label>
                    <i class="fa fa-child"></i>
                    
                    <span>A következő Megajátszóház: <?php echo $kovetkezo_jatszohaz['city_name'];?>, <?php echo Util::hun_month(strftime("%B %d, %Y", $kovetkezo_jatszohaz['rendezveny_start_timestamp']));?></span>
                </label>
                <span>
                    <a class="btn btn-white btn-ghost search-btn" href="jatszohazak/<?php echo Util::string_to_slug($kovetkezo_jatszohaz['city_name'] . '-' . strftime("%Y-%m-%d", $kovetkezo_jatszohaz['rendezveny_start_timestamp']));?>/<?php echo $kovetkezo_jatszohaz['rendezveny_id'];?>">Megnézem</a>
                </span>
               
            </div>
        </div>
    </div>
</div>
<?php } ?>

