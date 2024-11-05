<template>
  <div class="create-container">
    <h2 class="title">Refill Account Balance</h2>
    <form @submit.prevent="refillBalance">
      <div class="form-group">
        <label for="balance">Transfer Money in $</label>
        <input type="number" v-model="user.balance" required class="input-field"/>
      </div>
      <button type="submit" class="submit-btn">Refill Balance</button>
    </form>
    
    <!-- Уведомление об успехе -->
    <div v-if="showNotification" class="notification success">
      Balance refilled successfully!
    </div>
  </div>
</template>

<script>

export default{
data(){
    return{
        user: {
            balance: ''
        }
    }
},
methods: {
    async refillBalance() {
      const formData = new FormData();
      console.log(this.user.balance);
      formData.append('balance', this.user.balance);

      try {
        const response = await axios.post('/profile/balance/update', formData);
        this.showNotification = true;
        setTimeout(() => {
          this.showNotification = false;
        }, 3000);
        this.user.balance = '';
        console.log('Balance refilled successfully:', response.data.message);
      } catch (error) {
        console.error('Error refilling balance:', error);
      }
    }
  }    
};

</script>

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