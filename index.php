<?php include 'header/header.php'; ?>

<div class="carousel">

    <div class="slide active">
        <div class="overlay">
            <div class="left-content">
                <h1>Explore the Pearl of Indian Ocean</h1>
                <p>Experience the adventures of Mirabilis: eat, sleep, hike, climb, fly, jump, swim, snorkel, surf, and
                    dive.</p>
                <a href="tourpackages.php" class="button"> Explore More </a>
            </div>
            <div class="vertical-line"></div>
            <div class="right-content">
                <p>Mirabilis awaits with endless experiences in a land of lush landscapes, stunning beaches, and vibrant
                    culture.</p>
            </div>
        </div>
    </div>


    <div class="slide">
        <div class="overlay">
            <div class="left-content">
                <h1>Let's Make Memories</h1>
                <p>Make unforgettable memories with romantic and adventurous experiences.</p>
                <a href="tourpackages.php" class="button"> Explore More </a>
            </div>
            <div class="right-content">
                <p>Find joy in every moment, from scenic sunsets to thrilling outdoor activities.</p>
            </div>
        </div>
    </div>


    <div class="scrollclick">
        <button class="prev" onclick="changeSlide(-1)">&#10094;</button>
        <button class="next" onclick="changeSlide(1)">&#10095;</button>
    </div>
</div>

<script src="scripts/scripts.js"></script>
<?php include 'footer/footer.php'; ?>

</body>

</html>