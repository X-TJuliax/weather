<template>
    <div>
      <h1>Weather Search</h1>
      <input type="text" v-model="city" placeholder="Enter city name" @keyup.enter="searchWeather" />
      <button @click="searchWeather">Search</button>
  
      <div v-if="loading">Loading...</div>
      <div v-if="error">{{ error }}</div>
      <div v-if="weather">
        <h2>Weather in {{ weather.name }}</h2>
        <p>Temperature: {{ weather.main.temp }}°C</p>
        <p>Weather: {{ weather.weather[0].description }}</p>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        city: '',
        weather: null,
        loading: false,
        error: null,
      };
    },
    methods: {
      async searchWeather() {
        this.loading = true;
        this.error = null;
        this.weather = null;
  
        try {
          const response = await fetch(`/api/weather/${this.city}`);
          if (!response.ok) throw new Error('City not found');
  
          const data = await response.json();
          this.weather = data;
        } catch (error) {
          this.error = error.message;
        } finally {
          this.loading = false;
        }
      },
    },
  };
  </script>
  
  <style>
  input {
    margin-bottom: 1rem;
    padding: 0.5rem;
    font-size: 1rem;
  }
  </style>
  