// Fonction pour récupérer les données depuis l'API (simulé)
async function fetchExpensesData(agency, period) {
    // Ici, vous devriez effectuer une requête vers votre API pour obtenir les données
    // Remplacez ce code simulé par votre propre logique de requête API
    return new Promise(resolve => {
        setTimeout(() => {
            // Exemple de données simulées
            const expensesData = [
                { agence: "Agence 1", annee: "2023", mois: "Janvier", alloue: 50000, utilise: 48000 },
                { agence: "Agence 1", annee: "2023", mois: "Février", alloue: 50000, utilise: 45000 },
                { agence: "Agence 2", annee: "2023", mois: "Janvier", alloue: 60000, utilise: 55000 },
                // Ajouter d'autres données ici
            ];

            // Filtrer les données en fonction de l'agence et de la période
            const filteredExpenses = expensesData.filter(expense => expense.agence === agency && expense[period] === period);

            resolve(filteredExpenses);
        }, 1000); // Simuler une requête API
    });
}

// Fonction pour afficher les données de dépenses
async function displayExpenses(agency, period) {
    // Récupérer les données depuis l'API
    const expensesData = await fetchExpensesData(agency, period);

    // Créer un objet pour regrouper les montants utilisés par agence
    const montantsUtilisesParAgence = {};

    // Calculer la somme totale des montants utilisés
    let totalMontantUtilise = 0;

    // Remplir l'objet montantsUtilisesParAgence avec les montants utilisés
    expensesData.forEach(expense => {
        if (!montantsUtilisesParAgence[expense.agence]) {
            montantsUtilisesParAgence[expense.agence] = 0;
        }
        montantsUtilisesParAgence[expense.agence] += expense.utilise;
        totalMontantUtilise += expense.utilise;
    });

    // Trier les agences par ordre d'utilisation croissante
    const sortedAgences = Object.keys(montantsUtilisesParAgence).sort((a, b) => montantsUtilisesParAgence[a] - montantsUtilisesParAgence[b]);

    // Créer le graphique à barres avec Chart.js
    const ctx = document.getElementById('expenseChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar', // Utiliser un graphique à barres
        data: {
            labels: sortedAgences,
            datasets: [
                { data: sortedAgences.map(agency => montantsUtilisesParAgence[agency]), backgroundColor: 'rgba(75, 192, 192, 0.5)' },
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // Remplir le tableau des détails de dépenses par agence
    const tbody = document.querySelector("#expenseTable tbody");
    tbody.innerHTML = '';
    sortedAgences.forEach(agency => {
        const tr = document.createElement("tr");
        tr.innerHTML = `
            <td>${agency}</td>
            <td>${montantsUtilisesParAgence[agency]}</td>
        `;
        tbody.appendChild(tr);
    });

    // Afficher le montant total utilisé
    document.querySelector("#totalMontantUtilise").textContent = totalMontantUtilise;
}

// Fonction pour gérer la soumission du formulaire
document.getElementById("expenseForm").addEventListener("submit", function(event) {
    event.preventDefault();
    const selectedAgency = document.getElementById("selectAgency").value;
    const selectedPeriod = document.getElementById("selectPeriod").value;

    // Appeler la fonction pour afficher les données de dépenses
    displayExpenses(selectedAgency, selectedPeriod);
});

// Exemple de liste d'agences
const agenciesList = ["Agence 1", "Agence 2", "Agence 3"]; // Ajouter d'autres agences ici

// Remplir la liste déroulante des agences
const selectAgency = document.getElementById("selectAgency");
agenciesList.forEach(agency => {
    const option = document.createElement("option");
    option.value = agency;
    option.textContent = agency;
    selectAgency.appendChild(option);
});
