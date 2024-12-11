<template>
    <form @submit.prevent="submitForm" enctype="multipart/form-data" class="form-box">
      <input type="text" v-model="form.name" placeholder="Imię i nazwisko" required />
      <input type="email" v-model="form.email" placeholder="Email" required />
      <input type="tel" v-model="form.phone" placeholder="Telefon" required />
      <input type="text" v-model="form.address" placeholder="Adres montażu" required />
      <select v-model="form.service_type" required>
        <option value="Montaż okien">Montaż okien</option>
        <option value="Montaż drzwi">Montaż drzwi</option>
        <option value="Inne">Inne</option>
      </select>
      <input type="datetime-local" v-model="form.visit_date" required />
      <input type="file" @change="handleFileUpload" />
      <button type="submit">Zarezerwuj wizytę</button>
    </form>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          phone: '',
          address: '',
          service_type: '',
          visit_date: '',
        },
        photo: null,
      };
    },
    methods: {
      handleFileUpload(event) {
        this.photo = event.target.files[0];
      },
      async submitForm() {
        const formData = new FormData();
        Object.keys(this.form).forEach(key => {
          formData.append(key, this.form[key]);
        });
        if (this.photo) {
          formData.append('photo', this.photo);
        }
  
        try {
          const response = await axios.post('/api/add_visit.php', formData, {
            headers: { 'Content-Type': 'multipart/form-data' },
          });
          alert(response.data.message);
        } catch (error) {
          console.error('Błąd:', error);
          alert('Nie udało się zarezerwować wizyty.');
        }
      },
    },
  };
  </script>
  
<style>
.form-box {
  display: flex;
  flex-direction: column;
  width: 400px;
  padding: 10px;
  margin: 10px;
  background-color: #ccc;
  border-radius: 10px;
}
.form-box > * {
  padding: 7px;
  margin: 5px;
}
</style>