document.getElementById('newProjectBtn').addEventListener('click', function() {
    document.getElementById('projectForm').style.display = 'block';
});

document.getElementById('newUserBtn').addEventListener('click', function() {
    document.getElementById('userForm').style.display = 'block';
});

document.getElementById("userForm").addEventListener("submit", function(event) {
    console.log("Formular wird gesendet");
});
