
const popup = document.querySelector('#custom-popup-form');
const body = document.querySelector('body');
const overlay = document.querySelector('.overlay');
const closePopupButton = document.querySelector('#close-popup-button');
const successMessage = document.querySelector('#custom-form-success');
const closeSuccessMessageButton = document.querySelector('#close-success-button');

popup.addEventListener('click', (event) => {
    if (event.target === popup) {
        popup.classList.remove('open');
        body.classList.remove('popup-open');
        overlay.classList.remove('open');
    }
});

closePopupButton.addEventListener('click', () => {
    console.log('close');
    popup.classList.remove('open');
    body.classList.remove('popup-open');
    overlay.classList.remove('open');
    successMessage.classList.remove('open');
});

closeSuccessMessageButton.addEventListener('click', () => {
    popup.classList.remove('open');
    body.classList.remove('popup-open');
    overlay.classList.remove('open');
    successMessage.classList.remove('open');
});

/*
* Handle the form submission event
*/
jQuery('#customer-satisfaction-form').on('submit', function(event) {
    // Prevent the default form submission behavior
    event.preventDefault();
    console.log(event);

    
    // Get the form data
    var formData = jQuery(this).serialize();
    var ajaxurl = myScriptData.pluginDirUrl + 'google-sheets-api.php';
    // Send an AJAX request to the server
    jQuery.ajax({
        type: 'POST',
        url: ajaxurl,
        data: {
            action: 'my_plugin_handle_form_submission',
            form_data: formData
        },
        success: function(response) {
            // Handle the response from the server
            console.log('successfully posted to google sheets');
            popup.classList.remove('open');
            body.classList.remove('popup-open');
            successMessage.classList.add('open');
        }
    });
});


// Get the overlay and custom-popup-form elements
var customPopupForm = document.querySelector('#custom-popup-form');

// Wait for 4 seconds and add the open class to the elements
setTimeout(function() {
    console.log('open');
    overlay.classList.add('open');
    customPopupForm.classList.add('open');
}, 4000);


/*
*   Highlight the selected radio button label
*/
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

/*
*   Highlight the selected radio button label
*/
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

/*
*   Highlight the selected radio button label
*/
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

/*
*   Highlight the selected radio button label
*/
const purchaseDecisionTextarea = document.querySelector('#purchase-decision');
const parentQuestion = purchaseDecisionTextarea.closest('.question');
const recommendationQuestion = document.querySelector('.question label[for="recommendation"]').parentNode;

purchaseDecisionTextarea.addEventListener('focus', () => {
    document.querySelectorAll('.question label').forEach((label) => {
            label.classList.remove('selected');
        });
    parentQuestion.classList.add('selected');
    
});

purchaseDecisionTextarea.addEventListener('blur', () => {
    parentQuestion.classList.remove('selected');
});

/*
*   Highlight the selected radio button label
*/
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

/*
*   Highlight the selected radio button label
*/
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

