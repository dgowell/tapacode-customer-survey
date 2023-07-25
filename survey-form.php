<div class="overlay open">
    <div id="custom-popup-form" class="open">
    <button id="close-popup-button">&times;</button>
        <div class="popup-header">
            <div class="popup-subheader">
                <h2>Customer Satisfaction Survey</h2>
                <p>Please answer the questions below to help us improve your experience.</p>
            </div>
            
        </div>
        <form method="post" action="<?php echo plugin_dir_url( __FILE__ ) . 'google-sheets-api.php'; ?>">
            <!-- Add a hidden input field for the order number -->
            <input type="hidden" id="order-number" name="order-number" value="<? echo $order_id?>">

            <div class="question selected">
                <label for="ease-of-use">How would you rate the ease of using our website?</label>
                <div class="radio-group">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="radio">                        
                        <input type="radio" id="ease-of-use-<?php echo $i; ?>" name="ease-of-use" value="<?php echo $i; ?>" required>
                        <label for="ease-of-use-<?php echo $i; ?>"><?php echo $i; ?></label>
                        <label class="label-small" for="quality-of-info-<?php echo $i; ?>"> <?php echo ($i == 1) ? 'Poor' : ''; ?><?php echo ($i == 5) ? 'Excellent' : ''; ?></label>
                    </div>
                    <?php } ?>
                </div>

                <div id="ease-of-use-feedback-container" style="display:none;">
                    <label for="ease-of-use-feedback">How can we improve to enhance your experience
                        on our website?</label>
                    <textarea id="ease-of-use-feedback" name="ease-of-use-feedback"></textarea>
                </div>
            </div>
            <div class="question">
                <label for="quality-of-info">How would you rate the quality of information provided on our website?</label>
                <div class="radio-group">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="radio">
                        <input type="radio" id="quality-of-info-<?php echo $i; ?>" name="quality-of-info"
                            value="<?php echo $i; ?>" required>
                        <label for="quality-of-info-<?php echo $i; ?>"><?php echo $i; ?></label>
                        <label class="label-small" for="quality-of-info-<?php echo $i; ?>"> <?php echo ($i == 1) ? 'Poor' : ''; ?><?php echo ($i == 5) ? 'Excellent' : ''; ?></label>
                    </div>
                    <?php } ?>
                </div>

                <div id="quality-of-info-container" style="display:none;">
                    <label for="quality-of-info-feedback">How can we improve the quality of our information?</label>
                    <textarea id="quality-of-info-feedback" name="quality-of-info-feedback"></textarea>
                </div>
            </div>
            <div class="question">
                <label for="consideration-of-competition">Did you consider other options before placing this
                    order?</label>
                <div class="radio-group even">
                    <div class="radio">
                        <input type="radio" id="consideration-of-competition-yes" name="consideration-of-competition"
                            value="yes">
                        <label for="consideration-of-competition-yes">Yes</label>
                    </div>
                    <div class="radio">
                        <input type="radio" id="consideration-of-competition-no" name="consideration-of-competition"
                            value="no">
                        <label for="consideration-of-competition-no">No</label>
                    </div>
                </div>

                <div id="consideration-of-competition-container" style="display:none;">
                    <label for="considered-products">Which products did you consider?</label>
                    <textarea id="considered-products" name="considered-products"></textarea>
                </div>

            </div>
            <div class="question">
                <label for="purchase-decision">What made you decide to buy from WooWoo?</label>
                <textarea id="purchase-decision" name="purchase-decision"></textarea>
            </div>
            <div class="question">
                <label for="recommendation">How likely are you to recommend WooWoo to a friend or colleague?</label>
                <div class="radio-group">
                    <?php for ($i = 1; $i <= 5; $i++) { ?>
                    <div class="radio">
                        <input type="radio" id="recommendation-<?php echo $i; ?>" name="recommendation"
                            value="<?php echo $i; ?>" required>
                        <label for="recommendation-<?php echo $i; ?>"><?php echo $i; ?></label>
                        <label class="label-small" for="quality-of-info-<?php echo $i; ?>"> <?php echo ($i == 1) ? 'Extremely Unlikely' : ''; ?><?php echo ($i == 5) ? 'Extremely Likely' : ''; ?></label>
                    </div>
                    <?php } ?>
                </div>
            </div>

            <input type="submit" value="Submit">
        </form>
    </div>
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

        // If the value is less than 5, show the second question
        if (easeOfUse < 5) {
            feedbackTextarea.style.display = 'block';
        } else {
          feedbackTextarea.style.display = 'none';
          //add class selected to the next question
          //rempve class selected from alls questions
            document.querySelectorAll('.question').forEach((question) => {
                question.classList.remove('selected');
            });
            document.querySelector('.question:nth-child(3)').classList.add('selected');
            //move the window to the next question
            window.scrollTo(0,document.body.scrollHeight);
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

        // If the value is less than 5, show the fourth question
        if (quality < 5) {
            infoQualityContainer.style.display = 'block';
        } else {
            infoQualityContainer.style.display = 'none';
            //remove selected class form all questions
            document.querySelectorAll('.question').forEach((question) => {
                question.classList.remove('selected');
            });
            //add class highlight to the next question
            document.querySelector('.question:nth-child(4)').classList.add('selected');
            //move the window to the next question
            window.scrollTo(0,document.body.scrollHeight);
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
            document.querySelectorAll('.question').forEach((question) => {
                question.classList.remove('selected');
            });
            //add class highlight to the next question
            document.querySelector('.question:nth-child(5)').classList.add('selected');
            //move the window to the next question
            window.scrollTo(0,document.body.scrollHeight);
        }

        // Remove the 'selected' class from all question labels
        document.querySelectorAll('.question label').forEach((label) => {
            label.classList.remove('selected');
        });

        // Add the 'selected' class to the label for the selected radio button
        const label = event.target.closest('.question').querySelector('label');
        label.classList.add('selected');
    });
});

const popup = document.querySelector('#custom-popup-form');
const body = document.querySelector('body');
const overlay = document.querySelector('.overlay');

popup.addEventListener('click', (event) => {
    if (event.target === popup) {
        popup.classList.remove('open');
        body.classList.remove('popup-open');
        overlay.classList.remove('open');
    }
});

const closePopupButton = document.querySelector('#close-popup-button');
closePopupButton.addEventListener('click', () => {
    popup.classList.remove('open');
    body.classList.remove('popup-open');
    overlay.classList.remove('open');
});

const purchaseDecisionTextarea = document.querySelector('#purchase-decision');
const parentQuestion = purchaseDecisionTextarea.closest('.question');

purchaseDecisionTextarea.addEventListener('focus', () => {
    document.querySelectorAll('.question label').forEach((label) => {
            label.classList.remove('selected');
        });
    parentQuestion.classList.add('selected');
});

purchaseDecisionTextarea.addEventListener('blur', () => {
    parentQuestion.classList.remove('selected');
});

const radioButtons = document.querySelectorAll('input[type="radio"]');

radioButtons.forEach((radio) => {
    const parentQuestion = radio.closest('.question');

    radio.addEventListener('focus', () => {
        document.querySelectorAll('.question').forEach((label) => {
            label.classList.remove('selected');
        });
        parentQuestion.classList.add('selected');
        
    });

    radio.addEventListener('blur', () => {
        parentQuestion.classList.remove('selected');
    });
});
const textareas = document.querySelectorAll('textarea');

textareas.forEach((textarea) => {
    const parentQuestion = textarea.closest('.question');

    textarea.addEventListener('focus', () => {
        document.querySelectorAll('.question').forEach((label) => {
            label.classList.remove('selected');
        });
        parentQuestion.classList.add('selected');
    });

    textarea.addEventListener('blur', () => {
        parentQuestion.classList.remove('selected');
    });
});
</script>