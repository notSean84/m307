document.getElementById('newProjectBtn').addEventListener('click', function() {
    document.getElementById('projectForm').style.display = 'flex';
});

document.getElementById('newUserBtn').addEventListener('click', function() {
    document.getElementById('userForm').style.display = 'flex';
});

document.getElementById("userForm").addEventListener("submit", function(event) {
    console.log("Formular wird gesendet");
});

document.querySelectorAll(".editBtn").forEach(btn => {
    btn.addEventListener("click", function() {
        let id = this.getAttribute("data-id"); // Teammitglied-ID holen
        let editForm = document.getElementById("editForm-" + id);

        // Alle Bearbeitungsformulare ausblenden (aber nicht das Zuweisungsformular)
        document.querySelectorAll(".form-container").forEach(form => {
            if (!form.id.includes("assigForm")) {
                form.style.display = "none";
            }
        });

        // Das richtige Bearbeitungsformular einblenden
        if (editForm.style.display === "none" || editForm.style.display === "") {
            editForm.style.display = "flex";
        } else {
            editForm.style.display = "none";
        }
    });
});

