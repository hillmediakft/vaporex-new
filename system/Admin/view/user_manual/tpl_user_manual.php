<div class="page-content">
    <!-- BEGIN PAGE HEADER-->
    <!-- BEGIN PAGE TITLE & BREADCRUMB-->
    <!--
    <h3 class="page-title">
        CMS <small>dokumentáció</small>
    </h3>
    -->
    <div class="page-bar">
        <ul class="page-breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="admin/home">Kezdőoldal</a> 
                <i class="fa fa-angle-right"></i>
            </li>
            <li><a href="#">Dokumentáció</a></li>
        </ul>
    </div>
    <!-- END PAGE TITLE & BREADCRUMB-->
    <!-- END PAGE HEADER-->

    <div class="margin-bottom-20"></div>

    <!-- BEGIN PAGE CONTENT-->
    <div class="row">
        <div class="col-md-12">


            <h3><legend>CMS dokumentáció</legend></h3>

            <div class="tab-pane" id="tab_1_3">
                <div class="row profile-account documentation">
                    <div class="col-md-3">
                        <ul class="ver-inline-menu tabbable margin-bottom-10">
                            <li class="active">
                                <a data-toggle="tab" href="#tab_1-1"><i class="fa fa-cog"></i>A CMS-ről</a> 
                                <span class="after"></span>                                    
                            </li>
                            <li ><a data-toggle="tab" href="#tab_2-2"><i class="fa fa-building"></i> Ingatlanok kezelése</a></li>
                            <li ><a data-toggle="tab" href="#tab_3-3"><i class="fa fa-edit"></i> Ingatlan felvitele</a></li>  
                            <li ><a data-toggle="tab" href="#tab_4-4"><i class="fa fa-file-text-o"></i> Kategória és jellemzők listák</a></li> 
                            <li ><a data-toggle="tab" href="#tab_5-5"><i class="fa fa-book"></i> Dokumentumok feltöltése</a></li>   
                            <li ><a data-toggle="tab" href="#tab_6-6"><i class="fa fa-files-o"></i> Oldalak szerkesztése</a></li>
                            <li ><a data-toggle="tab" href="#tab_7-7"><i class="fa fa-font"></i> Érkezési oldalak</a></li>
                            <li ><a data-toggle="tab" href="#tab_8-8"><i class="fa fa-pencil"></i> Hírek</a></li>

                            <li ><a data-toggle="tab" href="#tab_9-9"><i class="fa fa-users"></i> Felhasználók</a></li>
                            <li ><a data-toggle="tab" href="#tab_10-10"><i class="fa fa-picture-o"></i> Képek kezelése</a></li>

                            <li ><a data-toggle="tab" href="#tab_11-11"><i class="fa fa-suitcase"></i> Modulok</a></li>
                            <li ><a data-toggle="tab" href="#tab_12-12"><i class="fa fa-cogs"></i> Beállítások</a></li>
                        </ul>
                    </div>

                    <div class="col-md-9">
                        <div class="tab-content">

                            <!-- ****************************** A CMS RENDSZERRŐL ***************************** -->                                
                            <div id="tab_1-1" class="tab-pane active">
                                <h3>EasyIngatlan tartalomkezelő rendszer</h3>

                                <p>A weblap funkcióinak megfelelően kialakított adminisztrációs felületet lehetőséget biztosít a weblap tartalmának karbantartásához, frissítéséhez. Használatához nem szükséges szakirányú ismeretekkel rendelkezni, bárki könnyen megtanulhatja a rendszer kezelését.</p>
                                <h4><i class="fa fa-chevron-circle-right"></i> A tartalomkezelőrendszer funkció</h4>
                                <ul>
                                    <li>Ingatlanok feltöltése és kezelése</li>
                                    <li>Ingatlanokhoz kapcsolódó listák (kategóriák, jellemzők) kezelése</li>
                                    <li>Ingatlanokhoz kapcsolódó dokumentumok feltöltése</li>
                                    <li>Hírek kezelése</li>
                                    <li>Pop-up ablakok kezelése</li>
                                    <li>Hirdetésekhez használt érkezési oldalak kezelése</li>
                                    <li>Oldalak tartalmának szerkesztése</li>
                                    <li>Felhasználók kezelése (az adminisztrációs rendszer felhasználói)</li>
                                    <li>Nyelvi verziókhoz tartozó fordítások kezelése</li>
                                    <li>Modulok
                                        <ul>
                                            <li>Kezdőoldali slider (képváltó)</li>
                                            <li>Rólunk mondták</li>
                                            <li>Partnerek</li>
                                        </ul>
                                    </li>    
                                    <li>Fájlkezelő</li>
                                    <li>Beállítások</li>
                                    <li>Dokumentáció</li>
                                </ul>
                            </div>

                            <!-- ****************************** NGATLANOK LISTÁJA ***************************** -->                                
                            <div id="tab_2-2" class="tab-pane">
                                <h3>Ingatlanok listája</h3>

                                <p>Az adminisztrációs rendszerben felvitt ingatlanok listázása lehetővé teszi az ingatlanok áttekintését (a főbb jellemzők alapján), valamint műveletek végrehajtását az ingatlanokkal. A listázáshoz beállítható (listából kiválasztva), hogy egy oldalon mennyi ingatlan jelenjen meg, és a "keresés" nevű gyorskereső pedig lehetővé teszi a listában megjelenített szöveges elemekben történő keresését.</p>
                                <p>A lista fejlécében található háromszögekre kattintva a lista az oszlopok szerint (nem mindegyik alapján) sorba rendezhető. </p>

                                <img src="<?php echo ADMIN_IMAGE; ?>ingatlan_lista.jpg" class="img-thumbnail">                        

                                <h4><i class="fa fa-chevron-circle-right"></i> Műveletek az ingatlanokkal</h4>
                                <p>Az ingatlan lista utolsó oszlopában található fogakkerés ikonra kattintva megjelenik az adott ingatlannal végezhető műveletek listája.</p>

                                <ul>
                                    <li><strong>Részletek:</strong> az ingatlan valamennyi adata megtekinthető</li>
                                    <li><strong>Szerkesztés:</strong> a rögzített adatok módosítása, képek és fájlok törlése, újak feltöltése</li>
                                    <li><strong>Törlés:</strong> a művelet véglegesen törli az ingatlant az adatbázisból, a hozzá tartozó képekkel és fájlokkal együtt</li>
                                    <li><strong>Klónozás:</strong> egy már az adatbázisban szereplő ingatlan klónozása. Az új ingatlan új azonosító számmal kerül be az adatbázisba, de minden adata megegyezik azon ingatlanéval, amelyikről klónozták.</li> 
                                    <li><strong>Blokkolás / aktiválás:</strong> a blokkolt ingatlan inaktív státuszba kerül, ami azt jelenti, hogy nem jelneik meg a front oldalon, de nem törlődik az adatbázisból. A blokkolt ingatlan újra aktív állapotba állítható.</li>    
                                    <li><strong>Kiemelés:</strong> a kiemelt ingatlanok a front oldal kezdőlapján jelennek meg.</li>
                                </ul>

                                <h4><i class="fa fa-chevron-circle-right"></i> Szűrés (összetett keresés)</h4>

                                <p>A "szűrési feltételek" gombra kattintva nyílik le az összetett keresést biztosító kereső űrlap. A bezáráshoz szintén a "szűrési feltételek" gombra kell kattintani. A keresési feltételek a "törlés" gomba kattintva törölhetők.</p>
                                <p>Az ingatlanok elhelyezkedésére vonatkozó szűréshez először a megyét kell a listából kiválasztani (itt szerepel Budapest is), majd ezt követően jelenik meg a város mezőben a megyében található városok listája. Budapest estében a kerület is kiválasztható. </p>
                                <p>Keresés indítása után az űrlap "emlékezni fog" az utolsó keresési feltételekre, így a szűrés pontosításakor nem kell minden szűrési feltételt újra kiválasztani / beírni. A tárolt szűrési feltételek a "szűrés törlése" gombra kattintva törölhetők. Technikailag ugyanez történik, ha az adminisztrációs rendszer egy másik oldalát tölti be.</p>    

                                <img src="<?php echo ADMIN_IMAGE; ?>ingatlan_szures.jpg" class="img-thumbnail">  

                                <h4><i class="fa fa-chevron-circle-right"></i> Csoportos műveletek</h4>
                                <p>A lista első oszlopában található checkbox-ra kattintva több ingatlan is kijelölhető, majd ezen ingatlanokon csoportos műveletek hajthatók végre:</p>
                                <ul>
                                    <li<strong>Aktiválás / inaktiválás:</strong> Az inaktív ingatlanok nem jelennek meg a front oldalon.</li>
                                    <li><strong>Kiemelés / kiemelés törlése:</strong> a kiemelt ingatlanok a front oldal egyes részein jelennek meg (pl.: kezdőoldal, jobb oldali sáv)</li>
                                    <li><strong>Törlés:</strong> ingatlanok törlése</li>
                                    <li><strong>Referens módosítás:</strong> az ingatlanok más referenshez történő "áthelyezése"</li> 
                                </ul>
                            </div> 

                            <!-- ****************************** NGATLANOK FELVITELE ***************************** -->                                
                            <div id="tab_3-3" class="tab-pane">
                                <h3>Ingatlanok felvitele</h3>

                                <p>Új ingatlan hozzáadása az ingatlanok menüben, az ingatlan hozzáadása almenüben történik. Ugyanez a felület az ingatlanok listája oldalról, az „Új ingatlan” gombra kattintva is elérhető.Az ingatlan adatai a jobb áttekinthetőség érdekében több szegmensbe csoportosítva jelennek meg. Az adatfelvitel mentés előtt bármikor megszakítható, a „mégse” gombra kattintás után az „ingatlanok listája” töltődik be.</p>
                                <p>A piros csillaggal jelölt mezők kitöltése kötelező. Amennyiben úgy történik a mentés, hogy nincs minden kötelező mező kitöltve, hibaüzenet figyelmeztet a nem kitöltött mezőkre.</p>

                                <img src="<?php echo ADMIN_IMAGE; ?>uj_ingatlan_felvitele.jpg" class="img-thumbnail">                                      

                                <h4><i class="fa fa-chevron-circle-right"></i> Alap adatok</h4>                                   
                                <p>A referens kód mezőbe automatikusan a bejelentkezett felhasználó kódja kerül, és amennyiben nem szuperadminisztrátor a bejelentkezett felhasználó, akkor ez a mező nem szerkeszthető. A szuperadminisztrátor kiválaszthatja, hogy melyik referenshez kívánja rögzíteni az ingatlant.</p>
                                <p>A státusz mező azt határozza meg, hogy az ingatlan megjelenjen-e a front oldalon. Az inaktív státuszú (blokkolt) ingatlanok a front oldalon nem jelennek meg, de az admin rendszerben az ingatlanok listájában megtalálhatók.</p>
                                <p>Az ügylet típusa, vagyis hogy eladó vagy kiadó ingatlanról van szó, kiválasztásakor az eladási ár és a bérleti díj mezők megjelenítése automatikusan változik. Eladó kiválasztásakor az eladási ár mezőbe írható adat, míg a bérleti díj mező inaktív lesz (ebbe a mezőbe ilyenkor nem írható be adat). Kiadó kiválasztásakor ennek az ellenkezője történik: a bérleti díj mező lesz aktív, és az eladási ár mező inaktív.</p>

                                <h4><i class="fa fa-chevron-circle-right"></i> Cím és megjelenítés</h4> 
                                <p>Az ingatlan elhelyezkedésének megadásához először a megyék listájából kell választani, Budapest is itt található. A megye kiválasztása után töltődik be a kiválasztott megyében található városok listája. A megye listában Budapestet kiválasztva a város mezőben is Budapest fog megjelenni, és aktívvá válik a kerület kiválasztása mező.</p>

                                <p>Az ingatlan földrajzi koordinátáinak meghatározása (a térképes megjelenítéshez) a cím adatok alapján történik, ezért fontos, hogy minden adat pontos legyen. Az utca mezőbe történő beíráskor automatikusan megjelenik a beírt betűkkel kezdődő utcák listája. Ez lista csak egy segédeszköz az utca beírásához, az utcák litája nem naprakész, ezért hibás adatokat is tartalmazhat.</p>
                                <p>A cím adatok beírása után ellenőrizhető, hogy az ingatlan helyesen jelenik-e meg a térképen. Amennyiben valamilyen adat nem pontosan lett beírva, előfordulhat, hogy a Google Maps szolgáltatása helytelen földrajzi koordinátákat határoz meg.</p>
                                <p>A front oldalon (ingatlan adatlap) a térképen nem az ingatlan pontos pozíciója jelenik meg, hanem egy néhányszáz méteres kör jelzi az ingatlan pozícióját.</p>
                                <p>Az utca, házszám és térképes megjelenítéssel beállítható, hogy ezek az adatok megjelenjenek-e a front oldalon az ingatlan adatlapon. </p>
                                <img src="<?php echo ADMIN_IMAGE; ?>terkep.jpg" class="img-thumbnail">   

                                <h4><i class="fa fa-chevron-circle-right"></i> Jellemzők</h4>                                   

                                <p>A jellemzők alatt az ingatlan különféle jellemzői választhatók ki illetve adhatók meg. </p>

                                <h4><i class="fa fa-chevron-circle-right"></i> Megnevezés / leírás</h4>                                   
                                <p>A megnevezés az ingatlan rövid egy mondatos megnevezése (ez fog az url-ben is szerepelni), a leírásban pedig hosszabb, akár beágyazott videót is tartalmazó szöveg szerepelhet. Az egységes megjelenés érdekében ide nem érdemes képeket beszúrni, erre a célra a képfeltöltés szolgál. </p>                                

                                <h4><i class="fa fa-chevron-circle-right"></i> A tulajdonos adatai</h4>                                  

                                <p>A tulajdonos adatainak megadása segíti a tulajdonos alapján történő keresést, és azért, hogy egyértelműen a tulajdonosához tudjuk a rögzítendő ingatlant kapcsolani. A tulajdonos adatainak megadása nem kötelező.</p>

                                <h4><i class="fa fa-chevron-circle-right"></i> Képek és dokumentumok feltöltése</h4>                                  

                                <p>Képek feltöltéséhez először el kell menteni az ingatlant (a "mentés és folytatás” gombra kattintással), a kötelezően megadandó adatokkal. A mentés után az ingatlan bekerül az adatbázisba, és már tölthetők fel hozzá képek. </p>

                                <p>A kötelező adatok kitöltése és elmentése után elkezdhetjük a képek feltöltését. Képek egyenként és csoportosan is feltölthetők. A kiválasztott képek a képek hozzáadása dobozban jelennek meg. Amelyiket mégsem akarjuk feltöltei, az egyszerűen eltávolítható a „kuka” ikonra kattintva.</p>

                                <img src="<?php echo ADMIN_IMAGE; ?>kep_feltoltes.jpg" class="img-thumbnail"> 

                                <p>A feltöltés során a rendszer a képeket megfelelő méretekre konvertálja, és feltölti őket a szerverre, a megfelelő mappába. A folyamat végeztével a feltöltött képek megjelennek a feltöltött képek listájában. Innen egyszerűen törölhetők (a „kuka” ikonra kattintva), és az úgynevezett „fogd és húzd” technikával egyszerűen módosítható a sorrend: a mozgatáshoz a kurzort a kép fölé kell vinni, majd az egér bal gombját lenyomva tartva a kép a kívánt pozícióba mozgatható. </p>
                                <p>Az első kép lesz az úgynevezett kezdőkép, ez jelenik meg az ingatlan listákban (teljes és szűrt listák, kedvencek, hasonló ingatlanok, kiemelt ingatlanok).</p>
                                <p>A sorrend módosítása és a képek feltöltése automatikusan történik, nem kell külön ezeket a módosításokat elmenteni, de érdemes a munka befejeztével a „mentés és kilépés” gombra kattintani, hogy minden módosítást elmentsen a rendszer.    </p>


                                <p>A dokumentumok / fájlok feltöltésére ugyanaz vonatkozik, mint a képekre: először el kell menteni az ingatlant. </p>
                                <img src="<?php echo ADMIN_IMAGE; ?>doc_feltoltes.jpg" class="img-thumbnail">


                                <p>Nem megengedett fájlformátumú fájl feltöltésekor a rendszer figyelmeztető üzenetet jelenít meg. A következő formátumok támogatottak: jpg, txt, pdf, xps, csv, doc, docx, xls, xlsx, ppt, pps, rtf, ods, odt, odp.</p>

                                <h4><i class="fa fa-chevron-circle-right"></i> Felvitel befejezése</h4>                                  

                                <p>Amennyiben minden adatot kitöltüttünk, feltöltöttük a képeket és a dokumentumokat, a „mentés és kilépés” gombra kattintva a rendszer minden módosítást elment. Később, ha módosítani akarjuk az adatokat, vagy képeket, dokumentumokat, az ingatlanok listájában a „szerkesztés” művelettel tehetjük ezt meg.  </p>



                            </div> 

                            <!-- ****************************** KATEGÓRIÁK / JELLEMZŐK ***************************** -->                                
                            <div id="tab_4-4" class="tab-pane">
                                <h3>Kategóriák / jellemzők listái</h3>

                                <p>Az ingatlanokhoz kapcsolódó kategóriák, jellemzők a "listák szerkesztése" menüpont alatt tekinthetők meg. A listák elemei szerkeszthetők, és új elem is létrehozható. Amennyiben valamelyik lista törlendő eleme használatban van, akkor az illető elem nem törölhető, és erről hibaüzenet tájékoztat. Például a lakás kategória nem törölhető, amennyiben van az adatbázisban olyan ingatlan, amelynek lakás a kategóriája.</p>

                                <img src="<?php echo ADMIN_IMAGE; ?>lista_szerkesztes.jpg" class="img-thumbnail"> 

                            </div>

                            <!-- ****************************** DOKUMENTUMOK FELTÖLTÉSE ***************************** -->                                
                            <div id="tab_5-5" class="tab-pane">
                                <h3>Dokumentumok feltöltése</h3>

                                <p>Általános jellegű dokumentumok (pl.: szerződés minták) feltöltésére és rendszerezésére szolgáló funkció. Az itt feltöltött dokumentumok nem kapcsolódnak konkrét ingatlanhoz, az ingatlan felvitele / szerkesztése oldalakon van lehetőség konkrét ingatlanhoz kapcsolódó dokumentumok feltötésére.</p>
                                <p>Dokumentum(ok) feltöltéséhez először mentést kell végrehajtani (a "mentés és folytatás” gombra kattintással) a kötelezően megadandó adatokkal. A mentés után a dokumentum feltöltés bekerül az adatbázisba, és már tölthetők fel hozzá dokumentumok. Egyszerre több dokumentum is feltölthető.</p>
                                
                                 <img src="<?php echo ADMIN_IMAGE; ?>dokumentumok.jpg" class="img-thumbnail">

                                <p>A feltöltött dokumentumhoz megnevezés és leírás tartozik, valamint kategóriába sorolható, hogy egyszerűbb legyen a nyilvántartás és rendszerezés. </p>
                            </div>

                            <!-- ****************************** Oldalak szerkesztése ***************************** -->									
                            <div id="tab_6-6" class="tab-pane">

                                <h3>Oldalak szerkesztése</h3>
                                
                                <p>Az úgynevezett statikus oldalak tartalmának szerkesztése az Oldalak menüben, az Oldalak listája menüpont alatt érhető el. A listában a szerkesztés gombra kattintva jelenik meg a szerkesztő felület, amelyen az úgynevezett meta adatok (title, description, keywords) és a tartalom szerkeszthető. Ez utóbbi szerkesztése egy WYSIWYG szerkesztő felületen történik.

                                <h4><i class="fa fa-chevron-circle-right"></i> Title, description és keywords megadása</h4>
                                <p>A szerkeszthető oldalak esetében megadhatók a title, description és keywords meta adatok, amelyek a weboldalon közvetlenül nem láthatók, de van funkciójuk. A title a keresőoptimalizálás terén fontos elem, a jól megfogalmazott description növelheti a kattintási arányt a Google találati listájában, a keywords azonban a Google esetében már nem bír jelentőséggel, így ez az elem akár üresen is hagyható. </p>
                                <h4><i class="fa fa-chevron-circle-right"></i> Title (az oldal címe)</h4>
                                <p>A title (amennyiben az oldal tartalmához reveleváns módon van megfogalmazva) képezi a Google találati listájában megjelenő címet, és ez jelenik meg a böngésző füleken is címként. 
                                <p>Az oldal címét (title) az alábbi szempontok szerint érdemes összeállítani:</p>
                                <ul>
                                    <li>Szerkezet:  A title elején legyen a kulcsszó (kulcsszó kifejezés), amire az adott oldalt szeretnénk optimalizálni. </li>
                                    <li>Hossz: a title ne legyen hosszabb 70 karakternél, de ne is legyen nagyon rövid.</li>
                                    <li>Minden title különböző legyen</li>
                                    <li>Ne legyen a kulcsszó többször ismételve</li>

                                </ul>
                                <h4><i class="fa fa-chevron-circle-right"></i> Description (leírás)</h4>
                                <p>A description a weboldal tartalmát írja le a title-nél kicsit hossszabban. Amennyiben a description releváns a weboldal tartalmához, a Google a találati listában a cím alatt az oldal description elemét jeleníti meg leírásként, ellenkező esetben a weboldal szövegéből választ a Google algoritmusa szövegrészleteket. A jó leírás növelheti a kattintási arányt, de keresőoptimalizálási szempontból nincs közvetlen jelentősége.</p>  
                                <h4><i class="fa fa-chevron-circle-right"></i> Keywords (kulcsszavak)</h4>
                                <p>A weboldalra jellemző kulcsszavakat lehet a keywords meta elemben elhelyezni. Mivel korábban manipulatív céllal használták, ezért a Google algoritmusa már nem veszi figyelembe.</p> 
                                
                                <h3>WYSIWYG szerkesztő</h3>
                                <p>Az úgynevezett WYSIWYG  (What You See Is What You Get = Amit lát, azt kapja) szövegszerkesztő segítségével, a Word-höz hasonlóan formázhatja meg a szöveget, vagy szúrhat be képeket, YouTube videókat, vagy HTML elemeket. A mentés után a weboldalon máris a módosított tartalom érhető el. A WYSIWYG szerkesztők célkitűzése egy olyan felületet biztosítása a felhasználók számára, amelyen keresztül vizuálisan lehet elkészíteni a formázott szöveget, akár a HTML nyelv ismerete és a forráskód szerkesztése nélkül is. </p>
                                <p>Nem szükséges tehát a HTML nyelv ismerete a weblap tartalmának módosításához, a szöveges tartalmakat, képeket, beágyazott videókat egyszerűen szerkesztheti. A forráskód nézetben a komolyabb szerkesztési műveletek is elvégezhetők, de ehhez nem árt némi HTML ismerettel rendelkezni. </p>
                                <img src="<?php echo ADMIN_IMAGE; ?>wysiwyg_editor_1.jpg" class="img-thumbnail">

                                <h4><i class="fa fa-chevron-circle-right"></i> A WYSIWYG szerkesztő előnyei</h4>
                                <ul>
                                    <li>Áttekinthető tartalom: a szerkesztő nagyjából helyesen mutatja a tartalmat, ahhoz hasonlóan, ahogy az a weboldalon meg fog jelenni.</li>
                                    <li>A tartalom szerkesztésekor azonnal látható az eredmény, a WYSIWYG szerkesztő az eredményhez közeli állapotot mutatja a HTML forrás helyett</li>
                                    <li>A tartalom egyszerű szerkesztése: a megfelelő elemre kattinthatva azt átszerkeszthetjük, míg a forráskód esetén nem kis ügyességet igényel a forráskód vonatkozó részét tévedés nélkül megtalálni és módosítani.</li>                                    
                                </ul> 
                                <p>
                                    <span class="badge badge-danger">FIGYELEM</span>
                                    <span>A módosítások elmentése után nincs lehetőség visszaállításra, ezért a mentést célszerű körültekintéssel végezni!</span>
                                </p>
                                <p>
                                    <span class="badge badge-info">INFO</span>
                                    <span>A WYSIWYG szerkesztő nem profi HTML szerkesztő alkalmazás, ezért csak kellő tapasztalattal és HTML ismeretekkel érdemes a forráskódot szerkeszteni!</span>
                                </p>

                                <h4><i class="fa fa-chevron-circle-right"></i> Mire kell figyelni?</h4>
                                <ul>
                                    <li>Formázás alkalmazása: a szerkesztőben elvégzett formázások módosítják a weblap megjelenését, felülírják a weblaphoz készített úgynevezett stíluslap utasításait. Formázás alkalmazásával eltűnhetnek az eredetileg alkalmazott stílusok.</li>
                                    <li>Lehetőleg ne módosítsa a betűtípust! A módosított betűtípus helyesen (ékezetekkel) csak akkor fog a weblapot meglátogató felhasználó számára megjelenni, ha annak magyar ékezetes készlete telepítve van a felhasználó gépére. A különöző, nem összeillő betűtípusok az egységes dizánt rontják, amatőr hatást keltenek.</li>
                                    <li>Képek beszúrásakor, módosításakor a kép feltöltése eredeti méretben történik, ezért ügyelni kell arra, hogy ne nagyméretű képeket töltsön le a böngésző, mivel a nagy fájlméret lassítja a weboldal betöltését. </li>                                    
                                </ul> 
                                <h4> <i class="fa fa-chevron-circle-right"></i> Képek beszúrása, módosítása</h4>
                                <p>A weboldal szöveges tartalmába képek szúrhatók be, illezve a meglévő képek helyett más képek helyezhetők el a dokumentumban..</p>
                                <p>Kép beszúrás folyamata:</p>
                                <ul>
                                    <li>A szekesztő ikon sorában kattintson a kép ikonra, vagy kép módosításakor kattintson kétszer a képre.</li>
                                    <li>A kép tulajdonságai ablakban kattintson a "böngészés a szerveren" gombra.</li>
                                    <li>A külön ablakban megnyíló fájlkezelőben dupla kattintással válassza aki a kívánt képet, vagy a feltöltés gombra kattintva töltsön fel új képet, majd azt válassza ki (a szerkesztőben feltöltött képek az uploads/images mappába kerülnek).</li> 
                                    <li>A kép tulajdonságai ablakban megjelenik a kiválasztott kép elérési útvoanala (hivatkozás) valamint az előnézete. Amennyiben megjelennek a szélesség és magasság rubrikákban a kép méretei, törölje ki azokat, mivel a méret megadása tönkre teszi a reszponzív megjelenítést.</li> 
                                </ul> 
                                <img src="<?php echo ADMIN_IMAGE; ?>kep_beszuras.jpg" class="img-thumbnail">     

                            </div>
                            <!-- ****************************** Meta adatok ***************************** -->									
                            <div id="tab_7-7" class="tab-pane">

                                <h3>Érkezési oldalak</h3>
                                
                                <p>Az érkezési oldalak olyan, hirdetésekhez használható céloldalak, amelyekre akkor kerül a látogató, amikor egy hirdetésre (pl.: Adwords) kattint. Az érkezési oldalakra a weblapon belül nem mutat link. Az érkezési oldalak tartalmának szerkesztése az "Érkezési oldalak" menüben, az "Érkezési oldalak listája" menüpont alatt érhető el. A listában a szerkesztés gombra kattintva jelenik meg a szerkesztő felület, amelyen a meta adatok (title, description, keywords) és a tartalom szerkeszthető. Ez utóbbi szerkesztése egy WYSIWYG szerkesztő felületen történik. Az érkezési oldalak szerkesztése ugyanolyan módon történik, mint a statikus oldalaké.</p>

                              
                            </div>                                

                            <!-- ****************************** WYSIWYG szerkesztő ***************************** -->									
                            <div id="tab_8-8" class="tab-pane">

                                <h3>WYSIWYG szerkesztő</h3>
                                <p>Az úgynevezett WYSIWYG  (What You See Is What You Get = Amit lát, azt kapja) szövegszerkesztő segítségével, a Word-höz hasonlóan formázhatja meg a szöveget, vagy szúrhat be képeket, YouTube videókat, vagy HTML elemeket. A mentés után a weboldalon máris a módosított tartalom érhető el. A WYSIWYG szerkesztők célkitűzése egy olyan felületet biztosítása a felhasználók számára, amelyen keresztül vizuálisan lehet elkészíteni a formázott szöveget, akár a HTML nyelv ismerete és a forráskód szerkesztése nélkül is. </p>
                                <p>Nem szükséges tehát a HTML nyelv ismerete a weblap tartalmának módosításához, a szöveges tartalmakat, képeket, beágyazott videókat egyszerűen szerkesztheti. A forráskód nézetben a komolyabb szerkesztési műveletek is elvégezhetők, de ehhez nem árt némi HTML ismerettel rendelkezni. </p>
                                <img src="<?php echo ADMIN_IMAGE; ?>wysiwyg_editor_1.jpg" class="img-thumbnail">

                                <h4><i class="fa fa-chevron-circle-right"></i> A WYSIWYG szerkesztő előnyei</h4>
                                <ul>
                                    <li>Áttekinthető tartalom: a szerkesztő nagyjából helyesen mutatja a tartalmat, ahhoz hasonlóan, ahogy az a weboldalon meg fog jelenni.</li>
                                    <li>A tartalom szerkesztésekor azonnal látható az eredmény, a WYSIWYG szerkesztő az eredményhez közeli állapotot mutatja a HTML forrás helyett</li>
                                    <li>A tartalom egyszerű szerkesztése: a megfelelő elemre kattinthatva azt átszerkeszthetjük, míg a forráskód esetén nem kis ügyességet igényel a forráskód vonatkozó részét tévedés nélkül megtalálni és módosítani.</li>                                    
                                </ul> 
                                <p>
                                    <span class="badge badge-danger">FIGYELEM</span>
                                    <span>A módosítások elmentése után nincs lehetőség visszaállításra, ezért a mentést célszerű körültekintéssel végezni!</span>
                                </p>
                                <p>
                                    <span class="badge badge-info">INFO</span>
                                    <span>A WYSIWYG szerkesztő nem profi HTML szerkesztő alkalmazás, ezért csak kellő tapasztalattal és HTML ismeretekkel érdemes a forráskódot szerkeszteni!</span>
                                </p>

                                <h4><i class="fa fa-chevron-circle-right"></i> Mire kell figyelni?</h4>
                                <ul>
                                    <li>Formázás alkalmazása: a szerkesztőben elvégzett formázások módosítják a weblap megjelenését, felülírják a weblaphoz készített úgynevezett stíluslap utasításait. Formázás alkalmazásával eltűnhetnek az eredetileg alkalmazott stílusok.</li>
                                    <li>Lehetőleg ne módosítsa a betűtípust! A módosított betűtípus helyesen (ékezetekkel) csak akkor fog a weblapot meglátogató felhasználó számára megjelenni, ha annak magyar ékezetes készlete telepítve van a felhasználó gépére. A különöző, nem összeillő betűtípusok az egységes dizánt rontják, amatőr hatást keltenek.</li>
                                    <li>Képek beszúrásakor, módosításakor a kép feltöltése eredeti méretben történik, ezért ügyelni kell arra, hogy ne nagyméretű képeket töltsön le a böngésző, mivel a nagy fájlméret lassítja a weboldal betöltését. </li>                                    
                                </ul> 
                                <h4> <i class="fa fa-chevron-circle-right"></i> Képek beszúrása, módosítása</h4>
                                <p>A weboldal szöveges tartalmába képek szúrhatók be, illezve a meglévő képek helyett más képek helyezhetők el a dokumentumban..</p>
                                <p>Kép beszúrás folyamata:</p>
                                <ul>
                                    <li>A szekesztő ikon sorában kattintson a kép ikonra, vagy kép módosításakor kattintson kétszer a képre.</li>
                                    <li>A kép tulajdonságai ablakban kattintson a "böngészés a szerveren" gombra.</li>
                                    <li>A külön ablakban megnyíló fájlkezelőben dupla kattintással válassza aki a kívánt képet, vagy a feltöltés gombra kattintva töltsön fel új képet, majd azt válassza ki (a szerkesztőben feltöltött képek az uploads/images mappába kerülnek).</li> 
                                    <li>A kép tulajdonságai ablakban megjelenik a kiválasztott kép elérési útvoanala (hivatkozás) valamint az előnézete. Amennyiben megjelennek a szélesség és magasság rubrikákban a kép méretei, törölje ki azokat, mivel a méret megadása tönkre teszi a reszponzív megjelenítést.</li> 
                                </ul> 
                                <img src="<?php echo ADMIN_IMAGE; ?>kep_beszuras.jpg" class="img-thumbnail">                                    





                            </div>


                            <div id="tab_9-9" class="tab-pane">
                                <h3>Felhasználók</h3>

                                <h4><i class="fa fa-chevron-circle-right"></i> Az adminisztrációs rendszerhez hozzáféréssel rendelkező felhasználók kezelése</h4>
                                <p>A felhasználók menüben - jogosultságtól függően - a következő funkciók érhetők el:
                                <ul>
                                    <li>Felhasználók listázása</li>
                                    <li>Új felhasználó létrehozása (csak szuperadmin hozhat létre felhasználót, szuperadmin vagy admin jogosultsággal</li>
                                    <li>Felhasználó törlése (egyedi vagy csoportos törlés, szuperadmin nem törölhető, admin nem törölhet admin jogosultságú felhasználót)</li> 
                                    <li>Felhasználó státusz (aktív / inaktív) módosítása (szuperadmin nem tehető inaktívvá). Az inaktív felhasználó nem léphet be az adminisztrációs rendszerbe. </li> 
                                    <li>Felhasználói profil módosítása. A bejelentkezett felhasználó módosíthatja adatait.</li> 
                                </ul>    
                                <p>Az adminisztrációs rendszerben a felhasználók felhasználói csoportokba tartoznak. A egyes felhasználói csoportok különböző jogosultságokkal rendelkeznek, és ennek megfelelően eltérő adminisztrációs felületet (funkciókat) érhetnek el. </p>
                                <h4><i class="fa fa-chevron-circle-right"></i> Felhasználói jogosultságok</h4>        
                                <p>Kétféle jogosultság létezik az adminisztrációs rendszerben: szuperadminisztrátor (szuperadmin) és adminisztrátor (admin). A szuperadmin létrehozhat új felhasználót, és törölhet admin jogosultságú felhasználót. Az admin nem hozhat létre és nem törölhet felhasználót. A szuperadmin bármelyik felhasznál nevében rögzíthet munkát, míg az admin csak a saját nevében teheti ezt meg. Egyéb tekintetben megegyeznek a felhasználói jogosultságok. </p>

                            </div>

                            <!-- ****************************** Képek kezelése, feltöltése ***************************** -->							
                            <div id="tab_10-10" class="tab-pane">
                                <h3>Képek kezelése, feltöltése </h3>


                                <h4><i class="fa fa-chevron-circle-right"></i> Képek feltöltése a különböző modulokban (pl.:felhasználók, slider, képgaléria)</h4>

                                <p>A képfeltöltésnél a "kiválasztás" gombra kattintva lehet feltöltésre képet kiválasztani. Kiválasztás után megjelenik egy "módosít" és egy "töröl" elnevezésű gomb. A módosít gombra kattintva választható ki másik kép, a töröl gombbal pedig „resetelhető”  a kiválasztás. A kép feltöltése (és méretezése) ténylegesen a hozzá kapcsolódó űrlap elmentésekor történik meg.</p>
                                <p>A felhasználókhoz, valamint az egyes modulokban feltöltött képeket a rendszer a megfelelő méretben tölti fel a szerverre (általában egy kisebb és egy nagyobb méretben), és az UPLOADS mappa megfelelő almappáiba kerülnek.   
                                <p>

                                    <span class="badge badge-danger">FIGYELEM</span>
                                    <span>A feltöltött képek fájlnevét ne módosítsa, mivel  a képek elérését a rendszer adatbázosban tárolja, így azok a képek, amelyeknek a nevét módosítja, elérhetetlenné válnak! Ne módosítsa a képek méretét sem!</span>


                                <h4><i class="fa fa-chevron-circle-right"></i> Képek kezelése a WYSIWYG szerkesztőben</h4>

                                <p>A WYSIWYG szerkesztő a képfeltöltéskor és beillesztéskor nem „csinál semmit” a képpel, vagyis az eredeti képméretben töltődik fel a szerverre ( a html dokumentumba a képre való hivatkozás kerül be). Ezért érdemes a feltöltés előtt a kép méretét optimalizálni (pl. egy 3000 pixel széles képet elég maximum 600-700 pixeles méretben feltölteni). Az optimalizálás feltöltés után is végrehajtható. Erre használható az admin rendszer  fájlkezelője is, de ez viszonylag nagy képméretet produkál.</p>    
                                <p>A WYSIWG szerkesztőben feltöltött képek az uploads/images mappába kerülnek. </p>
                                <p>A szerkesztőben történő kép beszúrásról részletesebb információ a <strong>WYSIWYG szerkesztő</strong> részben található.</p> 

                                <h4><i class="fa fa-chevron-circle-right"></i> Az admin rendszer fájlkezelője</h4>

                                <p>Az adminisztrációs rendszer fájlkezelője lehetővé teszi az UPLOADS mappában található képek (vagy más típusú fájlok) kezelését. A képek másolhatók, törölhetők, átnevezhetők, valamint módosítható a méretük, kivághatók, illetve elforgathatók. </p>
                                <p>Az IMAGES (a WYSIWYG szerkesztőben feltöltött képek kerülnek ide) mappa kivételével a képek a rendszer által megszabott méretben és néven kerülnek a szerverre, ezeket a képeket ezért nem ajánlatos bármilyen módon módosítani.</p>
                                <p>Az IMAGES mappába feltöltött képek esetében csak arra kell figyelni, hogy ne változzon meg a kép neve.</p>
                            </div>

                            <!-- ****************************** Modulok ***************************** -->

                            <div id="tab_11-11" class="tab-pane">
                                <h3>Modulok kezelése</h3>


                                <h4><i class="fa fa-chevron-circle-right"></i> Kezdőoldali slider</h4>

                                <p>A kezdőoldalon megjelenő slider (képváltó) szerkeszthető. A slider több slide-ból áll, az egyes slide-ok pedig a következő elemekből állnak: 
                                <ul>    
                                    <li>kép</li> 
                                    <li>cím</li> 
                                    <li>szöveg</li>
                                    <li>link</li>
                                    <li>státusz</li> 
                                </ul>  
                                <p>A slide-hoz tartozó kép akkor lesz optimális (torzításmentes és a lehető legjobb minőségű), ha 1170X420 képpont méretű képet tölt fel. A rendszer ugyanis ilyen méretre kovertálva tölti fel a kiválasztott képet. Ha a kiválasztott kép méretaránya ettől eltérő, vagy kisebb méretű, akkor a kép torzítva (összenyomva, széthúzva), vagy nagyítás esetén gyengébb képminőségben jelenik meg.</p>
                                <p> Az inaktív státuszú slide-ok elérhetők az adatbázisban, de nem jelennek meg a slider-ben. Minden slide szerkeszthető, törölhető, és új slide is létrehozható. Szerkesztéskor módosítható minden paraméter: a kép, a cím, a szöveg és a státusz.</p>
                                <p>A megjelenés sorrendje is módosítható. Módosításhoz mozgassa a kurzort a fölé a slide fölé, amelynek a sorrendjét módosítani kívánja. A slide fölött a kurzor négy irányú nyíl formára vált, ekkor tudja a slide-ot a bal egér gomb lenyomása mellett mozgatni. Mozgassa a slide-ot a kívánt pozícióba, majd engedje el az egér gombját. Az új sorrend elmentése automatikusan megtörténik. </p> 



                            </div>

                            <!-- *********************** BEÁLLÍTÁSOK ************************* -->
                            <div id="tab_12-12" class="tab-pane">
                                <h3>Beállítások</h3>

                                <p>A beállítások menüben a következő adatok módosíthatók:</p>
                                <ul>
                                    <li>Cégnév - a weblap különböző helyein (kapcsolat, footer) megjelenő cégnév</li>
                                    <li>Cím - a weblap különböző helyein (kezdőoldal, kapcsolat, footer) megjelenő cím.</li>
                                    <li>Általános e-mail cím - a weblap különböző helyein (kezdőoldal, kapcsolat, footer) megjelenő e-mail. Erre az e-mail címre érkezik a weboldalról küldött üzenetek egy része.</li>
                                    <li>Telefonszám(ok) - a weblap különböző helyein (kezdőoldal, kapcsolat, footer) megjelenő központi telefonszám(ok)</li>
                                    <li>Közösségi oldalak linkjei (Facebook, Google+, Twitter, Pinterest)</li> 
                                    <li>Megjelenített elemek száma oldalanként</li>  
                                </ul>

                                <p>A beállításban tárolt adat módosítása után a weblapon az illető adat minden helyen automatikusan módosulni fog. </p>    

                            </div>                                


                        </div> <!--END TAB-CONTENT-->
                    </div> <!--END COL-MD-9--> 
                </div> <!--END ROW PROFILE-ACCOUNT-->
            </div> <!--END TAB-PANE-->


        </div> <!-- END COL-MD-12 -->
    </div> <!-- END ROW -->	

</div> <!-- END PAGE CONTAINER-->