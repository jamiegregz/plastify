function Validator(input) {
    this.input = $("input[name='" + input.name + "']");
    
    this.Empty = function() {
        if(this.input.val() == "" || this.input.val() == undefined) {
            return true;
        }
        return false;
    }
    
    this.DoesNotMatchString = function() {
        if(this.input.val() != $(this.input).data("string")) {
            return true;
        }
        return false;
    }
    
    this.DoesNotMatchInput = function() {
        // Get the input to test the value against
        var testInputName = this.input.data("validatorDoesNotMatchInputInput");
        var testInput = $("input[name='" + testInputName + "']");
        console.log(testInputName);
        
        if(this.input.val() != testInput.val()) {
            return true;
        }
        
        return false;
    }
    
    this.EmailExists = function(string) {
        return true;
    }
    
    this.
}

function InputValidator(input) {
    this.input = input;
    this.validationErrorMessage = "";
    
    this.forceCustomErrorMessage = function(message) {
        
    }
    
    this.removeExistingMessages = function() {
        // Remove any messages attached to the input
        $(this.input).parent().removeClass("success error");
        $(this.input).removeClass("success error");
        $(this.input).parent().find(".input-message").remove();
    }
    
    this.showErrorMessage = function() {
        this.removeExistingMessages();
        
        // Add the styling to the input
        $(this.input).parent().addClass("error");
        $(this.input).addClass("error");
        
        // Show the error message
        $(this.input).parent().append("<div class='input-message error'>" + this.validationErrorMessage + "</div>");
    }
    
    this.isValid = function() {
        var validator = new Validator(this.input);
        
        // Loop through each validation attribute attached to the input
        for(var key in this.input.dataset) {
            // Check if the data attribute is for validation and isn't a message
            if(key.substring(0, 9) == "validator" && !key.endsWith("Message")) {
                // Remove "validator" from the string
                key = key.substring(9);
                
                // Test the validity of the input against the current rule
                if(typeof validator[key] === "function" && validator[key]()) {
                    // Store the error message
                    this.validationErrorMessage = $(this.input).data("validator" + key + "Message");
                    return false;
                } else {
                    // The users input has passed this validation test, next validation test.
                    continue;
                }
            }
        }
        return true;
    }
}

$(document).ready(function() {
    // Check if any inputs have a change to them, or if the form is submitted
    $("form").submit(function(e) {
        // Check if all of the forms attributes are valid
        var inputs = $(this).context.elements;
        var inputError = false;
        
        for(var i = 0; i < inputs.length; i++) {
            var input = inputs[i];
            var inputValidator = new InputValidator(input);
            
            inputValidator.removeExistingMessages();
            
            if(!inputValidator.isValid()) {
                // Show the input error
                inputValidator.showErrorMessage();
                inputError = true;
            }
        }
        
        if(inputError) {
            return false;
        }
    });
});


















/*
function Message(input, validationErrorMessage, validationSuccessMessage) {
	// Set messages to either the defined value or an empty string
	this.errorMessage = validationErrorMessage || "",
    this.successMessage = validationSuccessMessage || "",

    this.removeMessage = function() {
        // Remove message wording
        if (input.nextElementSibling && (input.nextElementSibling.className == 'input-message error' || input.nextElementSibling.className == 'input-message success'))
            input.nextElementSibling.remove();

        // Remove error class
        if (input.classList) input.classList.remove("error");
        else input.className = input.className.replace(new RegExp('(^|\\b)' + "error".split(' ').join('|') + '(\\b|$)', 'gi'), ' ');

        // Remove success class
        if (input.classList) input.classList.remove("success");
        else input.className = input.className.replace(new RegExp('(^|\\b)' + "success".split(' ').join('|') + '(\\b|$)', 'gi'), ' ');
    },

    this.displayError = function() {
        // Remove the old error if it exists
        this.removeMessage();

        // Create the error message HTML
        var errorMessage = "";
        if (!(this.errorMessage == "" || this.errorMessage == true)) errorMessage = "<div class='input-message error'>" + this.errorMessage + "</div>";
        else errorMessage = "";

        // Add the error class to the input
        if (input.classList) input.classList.add("error");
        else input.className += ' ' + "error";

        // Display the error wording
        input.insertAdjacentHTML('afterend', errorMessage);
    },
    this.displaySuccess = function() {
        // Remove the currently displayed message
        this.removeMessage();

        // Create the success message HTML
        var successMessage = "";
        if (this.successMessage != "") successMessage = "<div class='input-message success'>" + this.successMessage + "</div>";
        // Add the success class to the input
        if (input.classList) input.classList.add("success");
        else input.className += ' ' + "success";

        // Display the success message wording
        input.insertAdjacentHTML('afterend', successMessage);
    },

    this.isError = function() {
        return (this.errorMessage != false);
    }
}

function validateInput(e) {
	var validationError = false;
	var validationSuccess = e.target.dataset.validationSuccessMessage;

	for (var key in e.target.dataset) {
		switch (key) {
			case "validationEmpty":
				// Check if the field is empty
				validationError = (e.target.value == "") ? (e.target.dataset.validationEmptyMessage || true) : false;
				break;
			case "validationEmail":
				// Check if the email address is valid
				var emailPattern = new RegExp("[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])+");
				validationError = !(emailPattern.test(e.target.value)) ? (e.target.dataset.validationEmailMessage || true) : false;
				break;
			case "validationPostcode":
				var postcodePattern = new RegExp("^(([gG][iI][rR] {0,}0[aA]{2})|((([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y]?[0-9][0-9]?)|(([a-pr-uwyzA-PR-UWYZ][0-9][a-hjkstuwA-HJKSTUW])|([a-pr-uwyzA-PR-UWYZ][a-hk-yA-HK-Y][0-9][abehmnprv-yABEHMNPRV-Y]))) {0,}[0-9][abd-hjlnp-uw-zABD-HJLNP-UW-Z]{2}))$");
				validationError = !(postcodePattern.test(e.target.value)) ? (e.target.dataset.validationPostcodeMessage || true) : false;
				break;
			case "validationRegex":
				// Custom regex check
				var regexPattern = new RegExp(e.target.dataset.validationRegex);
				validationError = !(regexPattern.test(e.target.value)) ? (e.target.dataset.validationRegexMessage || true) : false;
				break;
            case "validationMatch":
                // Get the value of the element trying to be matched then check the values of both inputs
                var matchingInput = document.getElementById(e.target.dataset.validationMatchInput).value;
                validationError = !(e.target.value == matchingInput) ? (e.target.dataset.validationMatchMessage || true) : false;
                break;
            case "validationUsernameExistance":
                // Query the API to check if the username exists
                var ajax = new AjaxRequest("POST", "/lib/ajax/ajax", {
                    // The endpoint to hit
                    "endpoint": "/api/v1/userexists",

                    // The parameters to send to the API
                    "request": {
                        "ginty": "123comewithme",
                        "hello": 123
                    }
                });
                ajax.sendRequest();

                if(ajax.response)
                {
                    // No errors occured check the response
                    console.log(ajax.response);
                }
                break;
			default:
		}
		// Check if an error has been detected, if so break out of the loop
		if (validationError != false) break;
	}

	// Display the message, either success or failure
	var message = new Message(e.target, validationError, validationSuccess);
	if (message.isError()) message.displayError();
	else message.displaySuccess();
}

function formSubmission(e) {
	e.preventDefault();
	alert("submit!");
	return false;
}
/*
(function() {
	document.querySelector("body").addEventListener("keyup", validateInput, false);
	document.querySelector("form").addEventListner("submit", formSubmission, false);
})();*/