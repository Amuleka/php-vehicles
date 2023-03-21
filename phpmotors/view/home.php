<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/header.php';?>

    <h1>Welcome to PHP Motors!</h1>

    <div class="second-container">
        <p>DMC Delorean</p>
        <p>3 Cup holders</p>
        <p>Superman doors</p>
        <p>Fuzzy dice!</p>
        <button>Own Today</button>
    </div>
    <img class="home-img" src="/phpmotors/images/delorean.jpg" alt="car-image">
    <div class="main-div">
      <div class="upgrades">
        <h3>Delorean Upgrades</h3>
        <div class="delorean-item">
            <img class="capacitor upg-img" src="/phpmotors/images/upgrades/flux-cap.png" alt="flux">
        </div>
        <p class="flux">Flux Capacitor</p>
        <div class="delorean-item">
            <img class="upg-img" src="/phpmotors/images/upgrades/flame.jpg" alt="flame">
        </div>
        <p>Flame Decals</p>
        <div class="delorean-item">
            <img class="upg-img" src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="bumper">
        </div>
        <p>Bumper Stickers</p>
        <div class="delorean-item">
            <img class="upg-img" src="/phpmotors/images/upgrades/hub-cap.jpg" alt="hub">
        </div>
        <p>Hub Caps</p>
      </div>

      <div class="reviews">
        <h3 class="dmc">DMC Delorean Reviews</h3>
        <ul class="revs">
            <li>"So fast its almost like traveling in time. " (4/5)</li>

            <li>"Coolest ride on the road. " (4/5)</li>

            <li>"I'm feeling Marty Mcfly! " (5/5)</li>

            <li>"The most futuristic ride of our day. " (4.5/5)</li>

            <li>"80's livin and I love it! " (5/5)</li>
        </ul>
      </div>
    </div>

<?php include $_SERVER['DOCUMENT_ROOT'] 
. '/phpmotors/snippets/footer.php';?>