<template>
  <div>
    <h1>Wizyty</h1>
    <ul>
      <!-- Wyświetlanie wizyt -->
      <li v-for="visit in visits" :key="visit.id" :class="{ past: visit.isPast }">
        <h3>{{ visit.service_type }}</h3>
        
        <!-- PAST Wizyty przeszłe -->
        <div v-if="visit.isPast" class="past-visit">
          <span><strong>Data wizyty:</strong> {{ visit.visit_date }}</span>
          <span><strong>Adres montażu:</strong> {{ visit.address }}</span>
          <span><strong>Imię klienta:</strong> {{ visit.name }}</span>
          <span><strong>Telefon:</strong> {{ visit.phone }}</span>
        </div>
        
        <!-- FUTURE Wizyty przyszłe -->
        <div v-else>
          <p><strong>Data wizyty:</strong> {{ visit.visit_date }}</p>
          <p><strong>Imię i nazwisko klienta:</strong> {{ visit.name }}</p>
          <p><strong>E-mail:</strong> {{ visit.email }}</p>
          <p><strong>Telefon:</strong> {{ visit.phone }}</p>
          <p><strong>Adres montażu:</strong> {{ visit.address }}</p>
          <p v-if="visit.photo_path"><strong>Zdjęcie:</strong> <a :href="visit.photo_path" target="_blank">Zobacz zdjęcie</a></p>
        </div>
      </li>
    </ul>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      visits: [],
    };
  },
  async mounted() {
    try {
      // Pobranie danych z backendu
      const response = await axios.get('/api/get_visits.php');
      
      // Mapowanie danych na odpowiedni format
      this.visits = response.data.map(visit => {
        const visitDate = new Date(visit.visit_date);
        const today = new Date();
        
        // Sprawdzenie czy wizyta już miała miejsce 
        const isPast = visitDate < today;

        return {
          ...visit,
          isPast, // właściwość isPast, wskazuje, czy wizyta jest w przeszłości
          visit_date: visitDate.toLocaleString(), 
        };
      });
    } catch (error) {
      console.error('Błąd podczas pobierania danych:', error);
    }
  },
};
</script>

<style scoped>
.past {
  color: gray;
}

.past-visit {
  display: flex;
  gap: 10px; 
  flex-wrap: wrap;
}

.past-visit span {
  margin-right: 15px;
}

</style>
