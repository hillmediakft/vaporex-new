<section class="no-bg-color-parallax parallax-black theme-section">
    <div class="bg-section bg-cover" style="background-image: url(<?php echo SITE_ASSETS; ?>media/paralax/paralax1.png)" ></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h1 class="text-uppercase paralax-header"> Kalkulátor </h1>
            </div>
            <div class="col-lg-6">
                <ol class="breadcrumb">
                    <li><a href="/">Kezdőlap</a></li>
                    <li class="active">Kalkulátor</li>
                </ol>
            </div>
        </div>
    </div>
</section>
<main class="main-content" >
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3"    >
                <?php include('system/site/view/_template/tpl_sidebar.php'); ?> 
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 ">
                <div class="row">
                    <div class="col-md-12">
                        <header class="section-header animated  animation-done fadeInUp" data-animation="fadeInUp">
                            <div class="heading-wrap">
                                <h2 class="heading"><span>Kalkulátor</span></h2>
                            </div>
                        </header>
                        <p>(jelenleg csak a mennyiségi adatok pontosak, a számolt végösszegek nem)</p>

                        <form id="kalkulator_form" name="kalkulator_form" action="kalkulator/ajax" method="post">
                            <div id="kalkulator_html">
                                <div class="well" id="felhasznalas_celja">
                                    <label for="felhcel">Felhasználás célja:</label>
                                    <div class="form-group">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="felhcel" value="1">minőségi vakolással megelőzni a falnedvességi problémákat
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="felhcel" value="2">falnedvességi problémák kezelése
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="felhcel" value="3">mészpótlás a habarcskészítésnél (emellett csökken a  nedvesedési hajlam és fokozódik a fagyállóság)
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="felhcel" value="4">vízzáró/vízálló minőségi beton vagy műkö készítése
                                            </label>
                                        </div>									
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="felhcel" value="5">festés előtti az alap szívóképeségének kiegyenlítése, a festék tapadásának növelése
                                            </label>
                                        </div>									
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="felhcel" value="6">felület (tégla, vakolat)) impregnálása (víztaszítóvá tétele)
                                            </label>
                                        </div>										

                                        <div class="radio">    
                                            <label>
                                                <input type="radio" name="felhcel" value="7">a keverővíz és habarcsban/betonban lévő víz fagyáspontjának csökkentése, szilárdulásgyorsítás vagy jégmentesítés
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="kalkulator_submit">
                                <button id="submit-button" name="submit-button" class="btn btn-primary" value="Kalkuláció" type="submit">Kalkuláció</button>
                            </div>
                        </form>                       
                        <div id="ajax_message"></div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
</div> <!-- raw -->
</div> <!-- container -->
</main>