<!-- HEADER -->
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-3  col-xs-12"> <a href="" class="logo"> <img src="<?php echo SITE_IMAGE; ?>logo.png" alt="logo"/></a> </div>
            <div class="col-md-9  col-xs-12">
                <div class="right-header">
                    <div class="col-right-header">
                        <h5>Küdjön üznetet</h5>
                        <h4><?php echo $settings['email']; ?></h4>
                    </div>
                    <div class="col-right-header">
                        <h5>Hívjon minket</h5>
                        <h4><?php echo $settings['tel']; ?></h4>
                    </div>
                    <div class="col-right-header">
                        <h5>Nyitva tartás</h5>
                        <h4>H - P 09:00 - 17:00</h4>
                    </div>
                    <div class="top-cart"> 
                        <a href="kosar"> 
                            <i class="fa fa-shopping-cart"></i> Kosár <span class="badge" id="cart_items_number"><?php echo $cart_items_number; ?></span>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="top-nav ">
        <div class="container">
            <div class="row">
                <div class="col-md-12  col-xs-12">
                    <form class="hidden-md  hidden-lg " id="search-global-mobile" method="get">
                        <input type="text" value="" id="search-mobile" name="s" >
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                    <div class="navbar yamm " >
                        <div class="navbar-header hidden-md  hidden-lg  hidden-sm ">
                            <button type="button" data-toggle="collapse" data-target="#navbar-collapse-1" class="navbar-toggle"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                            <a href="#" class="navbar-brand">Menu</a> </div>
                        <div id="navbar-collapse-1" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <li class="<?php $this->menu_active('home'); ?>"><a href="/"> Kezdőoldal </a></li>
                                <li class="<?php $this->menu_active('rolunk'); ?>"><a href="cegunkrol"> Cégünkről<strong class="caret"></strong> </a>
                                    <ul role="menu" class="dropdown-menu">
                                        <li> <a href="cegunkrol/miert-pont-vaporex"  > Miért pont Vaporex?</a> </li>
                                        <li> <a href="cegunkrol/mennyibe-kerul"  > Mennyibe kerül?</a> </li>
                                    </ul>
                                </li>
                                
                                <li class="<?php $this->menu_active('termekek'); ?>"><a href="termekek"> Termékek</a></li>
                                <li class="<?php $this->menu_active('referenciak'); ?>"><a href="referenciak"> Referenciák</a></li>
                                <li class="<?php $this->menu_active('letoltesek'); ?>"><a href="letoltesek"  > Letöltések</a></li>
                                <li class="<?php $this->menu_active('kalkulator'); ?>"><a href="kalkulator"> Kalkulátor</a></li>
                                <li class="<?php $this->menu_active('hirek'); ?>"><a href="hirek"> Hírek</a></li>
                                <li class="<?php $this->menu_active('gyakori-kerdesek'); ?>"><a href="gyakori-kerdesek"> Gyik</a></li>
                                <li class="<?php $this->menu_active('kapcsolat'); ?>"><a href="kapcsolat"> Kapcsolat</a></li>
                            </ul>

                            <form id="search-global-menu" method="get" action="kereses">
                                <input type="text" id="search" name="search" >
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- HEADER END --> 