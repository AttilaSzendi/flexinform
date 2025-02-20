<script>
import axios from 'axios';

export default {
    data() {
        return {
            cars: [],
        };
    },
    async created() {
        try {
            const response = await axios.get('/api/cars');
            this.cars = response.data;
        } catch (error) {
            console.error('Hiba történt az autók lekérése közben:', error);
        }
    }
};
</script>

<template>
    <div>
        <h2>Autók listája</h2>
        <ul v-if="cars.length">
            <li v-for="car in cars" :key="car.id">{{ car.name }}</li>
        </ul>
        <p v-else>Adatok betöltése...</p>
    </div>
</template>

<style scoped>

</style>
