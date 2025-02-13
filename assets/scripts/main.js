document.getElementById('newProjectBtn').addEventListener('click', function() {
    document.getElementById('projectForm').style.display = 'flex';
});

document.getElementById('newUserBtn').addEventListener('click', function() {
    document.getElementById('userForm').style.display = 'flex';
});

document.getElementById("userForm").addEventListener("submit", function(event) {
    console.log("Formular wird gesendet");
});

