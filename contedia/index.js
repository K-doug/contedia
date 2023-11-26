"use strict";


//function to display the pop up and populate it with the information from PHP
function openForm(){
    $.ajax({
        url: "info-form.php",
        method: "GET",
        success: function(data){
            document.getElementById("formContent").innerHTML = data;
            document.getElementById("formContainer").style.display = "block";
        },
        error: function(error){
            console.error("Unable to display form:", error);
        }
    })
}

function validateForm() {
    // Validate Name
    var nameInput = document.getElementById("name");
    console.log(document.getElementById("name").value);
    if (nameInput.value.trim() === "") {
        alert("Please provide your name.");
        return false;
    }

    // Validate Email
    var emailInput = document.getElementById("email");
    console.log(document.getElementById("email").value);
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(emailInput.value.trim())) {
        alert("Please provide a valid email address.");
        return false;
    }

    return true;

}

function submitForm() {

    if (validateForm()) {
        var formElement = document.getElementById('dynamicForm');
        var formData = new FormData(formElement);

        // Add the filename to the formData with the 'photo' key
        var fileInput = document.getElementById('photoInput');
        if (fileInput.files.length > 0) {
            formData.set('photo', fileInput.files[0], fileInput.files[0].name);
        }

        $.ajax({
            url: "add_info.php",
            method: "POST",
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting contentType
            success: function (response) {
                response = response.trim();
                if (response === "addition successful") {
                    alert("Your information has been successfully added to the database");
                    closeForm();
                } else if (response === "unable to find table - unsuccessful") {
                    alert("Adding your information was unsuccessful. Please try again.");
                }
            }
        });
    }
}

//function to close the form
function closeForm(){
    document.getElementById("formContainer").style.display = "none";
}


function handlePhotoSelection() {
    var photoPreviewContainer = document.getElementById("photoPreviewContainer");
    var reader = new FileReader();

    reader.onload = function (e) {

        var img = document.createElement("img");
        img.src = e.target.result;
        img.style.maxHeight = "20vh";
        img.style.maxWidth = "50%";
        img.style.margin = "0.5rem auto";
        img.classList.add("preview-image");

        console.log(img.src);

        photoPreviewContainer.innerHTML = ""; // Clear previous selection
        photoPreviewContainer.appendChild(img);
    };

    var file = document.getElementsByName('photo')[0].files[0];
    reader.readAsDataURL(file);
}