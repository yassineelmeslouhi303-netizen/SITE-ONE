function afficherProfil(coach) {

    if (coach === "kungfu") {
        alert("Coach Kung-fu\nExpérience : 8 ans\nSpécialiste du Kung-fu");
    }

    if (coach === "boxe") {
        alert("Coach Boxe\nExpérience : 6 ans\nSpécialiste de la boxe");
    }

    if (coach === "judo") {
        alert("Coach Judo\nExpérience : 7 ans\nSpécialiste du Judo");
    }
}
function afficherProfil(coach) {

    let name = document.getElementById("profileName");
    let info = document.getElementById("profileInfo");
    let experience = document.getElementById("profileExperience");
    let modal = document.getElementById("profileModal");

    if (coach === "kungfu") {

        name.textContent = "Coach Kung-fu";
        info.textContent = "Spécialiste des arts martiaux et des techniques de Kung-fu.";
        experience.textContent = "Expérience : 8 ans";

    } else if (coach === "boxe") {

        name.textContent = "Coach Boxe";
        info.textContent = "Spécialiste de la boxe et de la préparation physique.";
        experience.textContent = "Expérience : 6 ans";

    } else if (coach === "judo") {

        name.textContent = "Coach Judo";
        info.textContent = "Spécialiste des techniques de Judo.";
        experience.textContent = "Expérience : 7 ans";
    }

    modal.style.display = "flex";
}


function fermerProfil() {

    document.getElementById("profileModal").style.display = "none";

}
function ouvrirProfil(type) {
    const modal = document.getElementById("profileModal");

    if (type === "kungfu") {
        document.getElementById("profileName").textContent = "Coach Kung-fu";
        document.getElementById("profileInfo").textContent =
            "Spécialiste des arts martiaux et des techniques de Kung-fu.";
        document.getElementById("profileExperience").textContent =
            "Expérience : 8 ans";
    }

    if (type === "boxe") {
        document.getElementById("profileName").textContent = "Coach Boxe";
        document.getElementById("profileInfo").textContent =
            "Entraînement technique, endurance et préparation physique.";
        document.getElementById("profileExperience").textContent =
            "Expérience : 6 ans";
    }

    if (type === "judo") {
        document.getElementById("profileName").textContent = "Coach Judo";
        document.getElementById("profileInfo").textContent =
            "Apprentissage des techniques de projection et de contrôle.";
        document.getElementById("profileExperience").textContent =
            "Expérience : 7 ans";
    }

    modal.style.display = "flex";
}

// function fermerProfil() {
//     document.getElementById("profileModal").style.display = "none";
// }



//    FONCTION DE INSCRIPTION
function inscription(duree, prix, assurance) {

    let total = prix + assurance;

    document.getElementById("abonnementChoisi").value =
        duree + " - " + prix + " DH";

    document.getElementById("totalInscription").value =
        total + " DH";

    document.getElementById("inscription").scrollIntoView({
        behavior: "smooth"
    });
}
const connexionForm = document.getElementById("connexionForm");

if (connexionForm) {

    connexionForm.addEventListener("submit", function(event) {

        event.preventDefault();

        let email = document.getElementById("email").value;
        let password = document.getElementById("password").value;
        let message = document.getElementById("messageConnexion");

        if (email === "" || password === "") {

            message.textContent = "Veuillez remplir tous les champs.";
            message.style='color:red'

        } else {

            message.textContent = "Connexion réussie !";
            message.style='color:green'
        }

    });

}