<template>
    <div>
      <h1>Agenda wizyt</h1>
      <AdminCalendar />
      <FullCalendar ref="fullCalendar" :options="calendarOptions" />
    </div>
  </template>
  
  <script>
  import AdminCalendar from '@/components/AdminCalendar.vue';
  
  export default {
    components: {
      AdminCalendar,
    },
  };
  </script>
  