const form = document.getElementById('form')
const Firstname_input = document.getElementById('Firstname-input')
const Email_input = document.getElementById('Email-input')
const Password_input = document.getElementById('Password-input')
const Repeat_Password_input = document.getElementById('Repeat-Password-input')
const error_message = document.getElementById('error-message')

form.addEventListener('submit',(e) => {
   // e.preventDefault() #prevent submit

let errors = []

if (Firstname_input){
    errors = getSignupformErrors(Firstname_input.value, Email_input.value, Password_input.value,Repeat_Password_input.value)
}

else{
    errors = getLoginformErrors(Email_input.value, Password_input.value)
}
if (errors.length > 0){
e.preventDefault() 
error_message.innerText = errors.join(".")
}
})      

function getSignupformErrors(Firstname, Email, Password, RepeatPassword){
let errors = []

if (Firstname == ''|| Firstname == null){
    errors.push('First Name is required')
    Firstname_input.parentElement.classList.add('Incorrect')
}
if (Email == ''|| Email == null){
    errors.push('email is required')
    Email_input.parentElement.classList.add('Incorrect')
}
if (Pssword.length <8){
    errors.push('Password must have at least 8 characters')
    Password_input.parentElement.classList.add('Incorrect')
}
if (Password == ''|| Password  == null){
    errors.push('password is required')
    Password_input.parentElement.classList.add('Incorrect')
    if (password.lenth <8){
    errors.push('Password must have at least 8 characters')
    Password_input.parentElement.classList.add('Incorrect')
}
}
if (Password !== RepeatPassword){
    errors.push('Password does not match repeated password')
}   Password_input.parentElement.classList.add('Incorrect')
    Repeat_Password_input.parentElement.classList.add('Incorrect')
return errors;
}

function getLoginformErrors(Email,Password){
    let errors = []

    if (Email == ''|| Email == null){
    errors.push('Email is required')
    Email_input.parentElement.classList.add('Incorrect')
}


    return errors;
}
const allInputs = [Firstname_input, Email_input, Password_input, Repeat_Password_input].filter(input => input != null);

allInputs.forEach(input => {
    input.addEventListener('input', () => {
        if (input.parentElement.classList.contains('incorrect')) {
            input.parentElement.classList.remove('incorrect');
            error_message.innerText = '';
        }
    });
});


<script>
function openFeedbackBox() {
    document.getElementById("feedbackPopup").style.display = "block"
}

function closeFeedbackBox() {
document.getElementById("feedbackPopup").style.display = "none"
}

document.addEventListener("DOMContentLoaded", () => {
    const stars = document.querySelectorAll("#starsContainer .star");
}

stars.forEach((star, index) => {
    star.addEventListener("click", () => {
    stars.forEach((s, i) => {
        s.classList.toggle("selected", i <= index)
    });
    })
  })

</script>

