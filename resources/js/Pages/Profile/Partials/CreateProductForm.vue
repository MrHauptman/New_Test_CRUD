<template>
  <div class="create-container">
    <h2 class="title">Create a New Product</h2>
    <form @submit.prevent="submitProduct">
      <div class="form-group">
        <label class="product-name" for="name">Name:</label>
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
      <div class="form-group">
        <label for="image">Image:</label>
        <input type="file" @change="handleFileUpload" class="file-input"/>
      </div>
      <button type="submit" class="submit-btn">Create Product</button>
    </form>
    <div v-if="showNotification" class="notification success">
      Product created successfully!
    </div>
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
        imageFile: null,
        showNotification: false
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
          this.showNotification = true;
        
        // Скрываем уведомление через 3 секунды
        setTimeout(() => {
          this.showNotification = false;
        }, 3000);
          this.product.name = '';
        this.product.price = '';
        this.product.description = '';
        this.imageFile = null;
          console.log('Product created successfully:', response.data);
        } catch (error) {
          console.error('Error creating product:', error);
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