<!-- <template>
  <div class = "product-container">
    <h1 class = "title">My Products List </h1>
    <ul v-if="products.length" class="product-list">
      <li v-for="product in products" :key="product.id" class="product-card">
        <h3>{{ product.name }}</h3>
        <p>{{ product.description }}</p>
        <p>Price: {{ product.price }} $</p>
        <p>Owner: {{ product.owner }}</p>
        <img :src="product.image" alt="Product Image" class="product-image" />
      </li>
    </ul>
    <p v-else>No products available...</p>
  </div>
</template> -->
<template>
  <div class="products-container">
    <h1 class="title">My Products List</h1>
    <ul v-if="products.length" class="products-list">
      <li v-for="product in products" :key="product.id" class="product-card">
        <img :src="product.image" alt="Product Image" class="product-image" />
        <div class="product-info">
          <h3 class="product-name">{{ product.name }}</h3>
          <p class="product-description">{{ product.description }}</p>
          <p class="product-price">Price: {{ product.price }} $</p>
          <p class="product-owner">Owner: me</p>
   
        </div>
      </li>
    </ul>
    <p v-else class="no-products">No products created yet...</p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      products: []
    };
  },
  methods: {
    async fetchProducts() {
      try {
        const response = await axios.get('/products/own/index');
        this.products = response.data;
      } catch (error) {
        console.error('Error fetching products:', error);
      }
    }
  },
  mounted() {
    this.fetchProducts();
  }
};
</script>
<style scoped>
.products-container {
  padding: 20px;
  max-width: 800px;
  margin: 0 auto;
}

.title {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
}

.products-list {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  list-style: none;
  padding: 0;
}

.product-card {
  background-color: #f9f9f9;
  border: 1px solid #ddd;
  border-radius: 8px;
  width: calc(33.333% - 20px);
  padding: 15px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  display: flex;
  flex-direction: column;
  align-items: center;
}

.product-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
}

.product-info {
  text-align: center;
}

.product-name {
  font-size: 18px;
  margin: 10px 0;
  font-weight: bold;
}

.product-description {
  font-size: 14px;
  margin: 5px 0;
}

.product-price {
  color: #333;
  font-weight: bold;
  margin: 10px 0;
}

.product-owner {
  font-size: 12px;
  color: #777;
}

.no-products {
  text-align: center;
  font-size: 16px;
  color: #555;
}
</style>
