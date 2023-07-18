<div id="custom-popup-form">
    <h2>Customer Survey</h2>
    <form method="post" action="<?php echo plugin_dir_url( __FILE__ ) . 'google-sheets-api.php'; ?>">
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
       
        <label for="consideration-of-competition">Did you consider other options before placing this order?</label>
        <div>
            <input type="radio" id="consideration-of-competition-yes" name="consideration-of-competition" value="yes">
            <label for="consideration-of-competition-yes">Yes</label>
        </div>
        <div>
            <input type="radio" id="consideration-of-competition-no" name="consideration-of-competition" value="no">
            <label for="consideration-of-competition-no">No</label>
        </div>
        <br>
        <div id="consideration-of-competition-container" style="display:none;">
            <label for="considered-products">If yes, which products did you consider?</label>
            <textarea id="considered-products" name="considered-products"></textarea>
        </div>
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

// Get a reference to the radio buttons for the fifth question and the sixth question textarea
const competitionRadios = document.querySelectorAll('input[name="consideration-of-competition"]');
const competitionTextarea = document.querySelector('#consideration-of-competition-container');

// Add an event listener to each radio button for the fifth question
competitionRadios.forEach((radio) => {
    radio.addEventListener('change', (event) => {
        // Get the value of the selected radio button
        const competition = event.target.value;

        // If the value is yes, show the sixth question
        if (competition === 'yes') {
            competitionTextarea.style.display = 'block';
        } else {
            competitionTextarea.style.display = 'none';
        }
    });
});
</script>