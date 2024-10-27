<template>
    <div>
      <h2>Create a New Product</h2>
      <form @submit.prevent="submitProduct">
        <div>
          <label for="name">Name:</label>
          <input type="text" v-model="product.name" required />
        </div>
        <div>
          <label for="price">Price:</label>
          <input type="number" v-model="product.price" required />
        </div>
        <div>
          <label for="description">Description:</label>
          <textarea v-model="product.description" required></textarea>
        </div>
        <div>
          <label for="image">Image:</label>
          <input type="file" @change="handleFileUpload" />
        </div>
        <button type="submit">Create Product</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        product: {
          name: '',
          price: '',
          description: ''
        },
        imageFile: null
      };
    },
    methods: {
      handleFileUpload(event) {
        this.imageFile = event.target.files[0];
      },
      async submitProduct() {
        const formData = new FormData();
        formData.append('name', this.product.name);
        formData.append('price', this.product.price);
        formData.append('description', this.product.description);
        formData.append('image', this.imageFile);
  
        try {
         

          const response = await axios.post('/products/store', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          });
          console.log('Product created successfully:', response.data);
        } catch (error) {
          console.error('Error creating product:', error);
        }
      }
    }
  };
  </script>
  