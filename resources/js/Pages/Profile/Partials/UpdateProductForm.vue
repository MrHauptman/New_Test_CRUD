<template>
  <div class="update-container">
    <h2 class="title">Update Product {{ product.id }}</h2>
    <form @submit.prevent="submitProductUpdate">
      <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" v-model="product.name" required class="input-field"/>
      </div>
      <div class="form-group">
        <label for="price">Price:</label>
        <input type="number" v-model="product.price" required class="input-field"/>
      </div>
      <div class="form-group">
        <label for="description">Description:</label>
        <textarea v-model="product.description" required class="textarea-field"></textarea>
      </div>
      <button type="submit" class="submit-btn">Update Product</button>
    </form>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      product: {
        id: null,
        name: '',
        price: '',
        description: ''
      }
    };
  },
  mounted() {
    this.getProductIdFromUrl();
    this.fetchProductData();
  },
  methods: {
    getProductIdFromUrl() {
      const urlParams = new URLSearchParams(window.location.search);
      this.product.id = urlParams.get('id');
    },
    async fetchProductData() {
      // try {
      //   const response = await axios.get(`/api/products/${this.product.id}`);
      //   this.product = response.data;
      // } catch (error) {
      //   console.error('Error fetching product data:', error);
      // }
    },
    async submitProductUpdate() {
      try {
        const response = await axios.patch(`/products/update/${this.product.id}`, this.product);
        console.log('Product updated:', response.data);
      } catch (error) {
        console.error('Error updating product:', error);
      }
    }
  }
};
</script>
<!---------------------------------------------------------------------   
   --------------------------------------------------------------------->
   <style scoped>
   .create-container {
     max-width: 600px;
     margin: 50px auto;
     padding: 20px;
     background-color: #f9f9f9;
     border-radius: 10px;
     box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
   }
   
   .title {
     font-size: 24px;
     margin-bottom: 20px;
     text-align: center;
     color: #333;
   }
   
   .form-group {
     margin-bottom: 15px;
   }
   
   label {
     display: block;
     margin-bottom: 5px;
     font-size: 16px;
     color: #555;
   }
   
   .input-field, .textarea-field, .file-input {
     width: 100%;
     padding: 10px;
     font-size: 14px;
     border: 1px solid #ccc;
     border-radius: 5px;
   }
   
   .textarea-field {
     height: 100px;
     resize: vertical;
   }
   
   .input-field:focus, .textarea-field:focus, .file-input:focus {
     border-color: #007BFF;
     outline: none;
     box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
   }
   
   .submit-btn {
     width: 100%;
     padding: 12px;
     background-color: #28a745;
     color: white;
     border: none;
     border-radius: 5px;
     font-size: 16px;
     cursor: pointer;
   }
   
   .submit-btn:hover {
     background-color: #218838;
   }
   
   .submit-btn:active {
     background-color: #1e7e34;
   }
   
   @media (max-width: 600px) {
     .create-container {
       margin: 20px;
       padding: 15px;
     }
   
     .title {
       font-size: 20px;
     }
   
     .submit-btn {
       font-size: 14px;
     }
   }
   </style>