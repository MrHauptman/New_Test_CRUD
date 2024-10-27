<template>
    <div>
      <!-- Форма для загрузки файла -->
      <form @submit.prevent="submitImage">
        <input type="file" @change="handleFileUpload" accept="image/*" required />
        <button type="submit">Загрузить изображение</button>
      </form>
  
      <!-- Превью изображения -->
      <div v-if="imagePreview">
        <h4>Предпросмотр изображения:</h4>
        <img :src="imagePreview" alt="Превью изображения" style="max-width: 200px;" />
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        imageFile: null, // Для хранения выбранного изображения
        imagePreview: null // Для превью изображения
      };
    },
    methods: {
      handleFileUpload(event) {
        const file = event.target.files[0];
        this.imageFile = file;
  
        // Генерируем превью изображения
        this.imagePreview = URL.createObjectURL(file);
      },
      async submitImage() {
        const formData = new FormData();
        formData.append('image', this.imageFile);
  
        try {
          const response = await axios.post('/api/upload-image', formData, {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          });
          alert('Изображение успешно загружено!');
        } catch (error) {
          console.error('Ошибка при загрузке изображения:', error);
        }
      }
    }
  };
  </script>