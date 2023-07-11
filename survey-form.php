<div id="custom-popup-form">
    <h2>Customer Survey</h2>
    <form method="post">
        <!-- Add a hidden input field for the order number -->
        <input type="hidden" id="order-number" name="order-number" value="">

        <label for="ease-of-use">Ease of Using the Website:</label>
        <?php for ($i = 1; $i <= 10; $i++) { ?>
        <input type="radio" id="ease-of-use-<?php echo $i; ?>" name="ease-of-use" value="<?php echo $i; ?>" required>
        <label for="ease-of-use-<?php echo $i; ?>"><?php echo $i; ?></label>
        <?php } ?>
        <br>
        <div id="ease-of-use-feedback-container" style="display:none;">
            <label for="ease-of-use-feedback">If rating below 8, how can we improve to enhance your experience on our
                website?</label>
            <textarea id="ease-of-use-feedback" name="ease-of-use-feedback"></textarea>
        </div>
        <br>
        <label for="quality-of-info">Quality of Information:</label>
        <?php for ($i = 1; $i <= 10; $i++) { ?>
        <input type="radio" id="quality-of-info-<?php echo $i; ?>" name="quality-of-info" value="<?php echo $i; ?>"
            required>
        <label for="quality-of-info-<?php echo $i; ?>"><?php echo $i; ?></label>
        <?php } ?>
        <br>
        <div id="quality-of-info-container" style="display:none;">
            <label for="quality-of-info-feedback">If rating below 8, how can we improve the quality of our
                information?</label>
            <textarea id="quality-of-info-feedback" name="quality-of-info-feedback"></textarea>
        </div>
        <br>
        <label for="source-of-awareness">Where did you first hear about us?</label>
        <select id="source-of-awareness" name="source-of-awareness">
            <option value="social-media">Social Media</option>
            <option value="search-engines">Search Engines (e.g. Google)</option>
            <option value="word-of-mouth">Word of Mouth</option>
            <option value="advertisement">Advertisement</option>
            <option value="other">Other - please specify</option>
        </select>
        <br>
        <label for="customer-category">Where will your new purchase be used?</label>
        <select id="customer-category" name="customer-category">
            <option value="boat">Boat</option>
            <option value="motor-vehicle">Motor Vehicle</option>
            <option value="garden-building">Garden Building</option>
            <option value="home">Home</option>
            <option value="glamping-camping-site">Glamping/Camping Site</option>
            <option value="allotment-community-garden">Allotment/Community Garden</option>
            <option value="school-nursery">School/Nursery</option>
            <option value="church-cemetery">Church/Cemetery</option>
            <option value="other">Other - please specify</option>
        </select>
        <br>
        <label for="consideration-of-competition">Did you consider other options before placing this order?</label>
        <select id="consideration-of-competition" name="consideration-of-competition">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>
        <br>
        <label for="considered-products">If yes, which products did you consider?</label>
        <textarea id="considered-products" name="considered-products"></textarea>
        <br>
        <label for="purchase-decision">What made you decide to buy from WooWoo?</label>
        <textarea id="purchase-decision" name="purchase-decision"></textarea>
        <br>
        <label for="recommendation">On a scale of 0 to 10, with 10 being extremely likely, how likely are you to
            recommend WooWoo to a friend or colleague?</label>
        <?php for ($i = 0; $i <= 10; $i++) { ?>
        <input type="radio" id="recommendation-<?php echo $i; ?>" name="recommendation" value="<?php echo $i; ?>"
            required>
        <label for="recommendation-<?php echo $i; ?>"><?php echo $i; ?></label>
        <?php } ?>
        <br>
        <input type="submit" value="Submit">
    </form>
</div>
<script>
// Get a reference to the radio buttons for the first question and the second question textarea
const easeOfUseRadios = document.querySelectorAll('input[name="ease-of-use"]');
const feedbackTextarea = document.querySelector('#ease-of-use-feedback-container');

// Add an event listener to each radio button for the first question
easeOfUseRadios.forEach((radio) => {
    radio.addEventListener('change', (event) => {
        // Get the value of the selected radio button
        const easeOfUse = event.target.value;

        // If the value is less than 8, show the second question
        if (easeOfUse < 8) {
            feedbackTextarea.style.display = 'block';
        } else {
            feedbackTextarea.style.display = 'none';
        }
    });
});
// Get a reference to the radio buttons for the third question and the fourth question container
const infoQualityRadios = document.querySelectorAll('input[name="quality-of-info"]');
const infoQualityContainer = document.querySelector('#quality-of-info-container');

// Add an event listener to each radio button for the third question
infoQualityRadios.forEach((radio) => {
    radio.addEventListener('change', (event) => {
        // Get the value of the selected radio button
        const quality = event.target.value;

        // If the value is less than 8, show the fourth question
        if (quality < 8) {
            infoQualityContainer.style.display = 'block';
        } else {
            infoQualityContainer.style.display = 'none';
        }
    });
});
</script>