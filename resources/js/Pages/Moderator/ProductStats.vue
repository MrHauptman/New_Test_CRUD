<template>
  <div>
    <h1>Product Stats for Today</h1>
    <div v-if="stats">
      <p>Total products created today: {{ stats.total_products }}</p>
      <p>Created By:{{ stats.owner }}</p>
      <!-- Можно добавить еще какую-то статистику -->
    </div>
    <p v-else>Loading stats...</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      stats: null,
    };
  },
  methods: {
    fetchStats() {
      axios.get('/api/moderator/stats')
        .then(response => {
          this.stats = response.data;
        })
        .catch(error => {
          console.error('Error fetching stats:', error);
        });
    }
  },
  mounted() {
    this.fetchStats();
    setInterval(this.fetchStats, 60000); // Обновляем данные каждую минуту
  }
};
</script>