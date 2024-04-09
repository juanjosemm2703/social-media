/**
 * Function to validate a form, specifically for comments.
 * parameters: commentId - An optional parameter to identify the comment being validated ( multiple comments on a page).
 * returns: boolean - Returns true if the form is valid, otherwise returns false and displays error messages.
 */

function validateForm(commentId= ''){
  
    var nameField = document.getElementById(`uname${commentId}`);
    var messageField = document.getElementById(`message${commentId}`);
    console.log("Form submitted");
    console.log("Name Field Value:", nameField.value);
    console.log("Message Field Value:", messageField.value);    
    var errors = []

    if (nameField.value.length<4){
        errors.push("Name must have at least 4 characters")
    }
    if(/[0-9]/.test(nameField.value)){
        errors.push("Name must not have numeric characters")
    }

    var commentWords = messageField.value.split(' ')

    if(commentWords.length < 5){
        errors.push("Comment must have at least 5 words")
    }

    var errorContainer = document.getElementById('error-container')
   errorContainer.innerHTML = ""

    if (errors.length == 0){
        return true
    }

    errors.forEach(function(error){
        var errorDiv = document.createElement('div')
        errorDiv.className= 'error'
        errorDiv.innerHTML = error
        errorContainer.appendChild(errorDiv)
    })


    return false

}