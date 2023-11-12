

const apiUrl = 'https://restcountries.com/v3.1/all';

// Appel à l'API avec Axios
axios.get(apiUrl)
    .then(response => {
        // Gérer les données de réponse
        const countries = response.data;
        // Faire quelque chose avec les pays
        console.log(countries);
    })
    .catch(error => {
        // Gérer les erreurs
        console.log('Erreur lors de la récupération des pays :', error);
    });
