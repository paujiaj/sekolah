function validateAndSubmit(event) {
    // Prevent default form submission
    event.preventDefault();

    // Get checkbox values
    const isTrueChecked = document.getElementById("trueCheckbox").checked;
    const isFalseChecked = document.getElementById("falseCheckbox").checked;

    // Check if either checkbox is selected
    if (isTrueChecked || isFalseChecked) {
        // Form is valid; submit the form
        event.target.submit();
    } else {
        // Display error message if neither is checked
        alert("Tolong pilih salah satu.");
    }
}

// Ensure only one checkbox is selected at a time
function toggleCheckboxes(selectedCheckbox) {
    const trueCheckbox = document.getElementById("trueCheckbox");
    const falseCheckbox = document.getElementById("falseCheckbox");

    if (selectedCheckbox === trueCheckbox) {
        falseCheckbox.checked = false;
    } else {
        trueCheckbox.checked = false;
    }
}