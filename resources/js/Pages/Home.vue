<template>
    <div class="container">
        <!-- Szűrő mezők -->
        <div class="filter-container">
            <input v-model="filter.name" type="text" placeholder="név" @input="validateInput" />
            <input v-model="filter.cardNumber" type="text" placeholder="Okmányazonosító" @input="validateInput" />
            <button @click="applyFilter">Szűrés</button>
        </div>
        <div>
            <p v-if="filterError" class="error">{{ filterError }}</p>
        </div>

        <div v-if="client">
            <ul  class="client-list">
                <li class="client-item">
                    <div @click="toggleClient(client.id)">
                        <div class="client-id">#{{ client.id }}</div>
                        <div class="client-info">
                            <strong>{{ client.name }}</strong>
                            <span class="card-number">💳 {{ client.cardNumber }}</span>
                        </div>
                    </div>

                     Car lista
                    <ul v-if="expandedClient === client.id" class="car-list">
                        <li v-for="car in client.cars" :key="car.id" class="car-item">
                            <div @click="toggleCarDetails(car.id)">
                                <div><strong>ID:</strong> {{ car.id }}</div>
                                <div><strong>Típus:</strong> {{ car.type }}</div>
                                <div><strong>Regisztrált:</strong> {{ formatDate(car.registered) }}</div>
                                <div><strong>Saját márka:</strong> {{ car.ownbrand ? "Igen" : "Nem" }}</div>
                                <div><strong>Balesetek:</strong> {{ car.accidents }}</div>
                                <div><strong>Utolsó szerviz megnevezése:</strong> {{ car.latestService?.event || "Nincs adat" }}</div>
                                <div><strong>Utolsó szerviz:</strong> {{ formatDate(car.latestService?.date) || "Nincs adat" }}</div>
                            </div>

                            <!-- Service lista -->
                            <div v-if="expandedCar === car.id">
                                <div v-if="services.length">
                                    <h4>Szolgáltatások:</h4>
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Log Number</th>
                                            <th>Event</th>
                                            <th>Event Time</th>
                                            <th>Document ID</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr v-for="service in services" :key="service.id">
                                            <td>{{ service.logNumber }}</td>
                                            <td>{{ service.event }}</td>
                                            <td>{{ formatDate(service.eventTime ?? car.registered) }}</td>
                                            <td>{{ service.documentId }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div v-else>Nem volt még szervizelve</div>
                            </div>
                        </li>
                        <li v-if="client.cars.length === 0" class="no-cars">Nincs autó hozzárendelve.</li>
                    </ul>

                    <!-- Bezárás gomb -->
                    <button v-if="expandedClient === client.id" @click="expandedClient = null">
                        Bezárás
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import moment from 'moment';

export default {
    data() {
        return {
            client: null,
            services: [],
            expandedClient: null,
            expandedCar: null,
            filter: {
                name: '',
                cardNumber: ''
            },
            filterError: ''
        };
    },
    methods: {
        async fetchClients() {
            try {
                const response = await axios.get(`/api/clients`, {
                    params: {
                        name: this.filter.name,
                        cardNumber: this.filter.cardNumber,
                    }
                });

                this.client = response.data.data;
            } catch (error) {
                console.error("Hiba az adatok betöltése közben:", error);
                this.filterError = error.response.data.message;
                this.client = null;
            }
        },
        async fetchServices() {
            try {
                const response = await axios.get(`/api/services`, {
                    params: {
                        clientId: this.expandedClient,
                        carId: this.expandedCar
                    }
                });
                this.services = response.data.data;
            } catch (error) {
                console.error("Hiba az adatok betöltése közben:", error);
            }
        },
        toggleClient(clientId) {
            this.expandedClient = this.expandedClient === clientId ? null : clientId;
            this.expandedCar = null;
        },
        toggleCarDetails(carId) {
            this.expandedCar = this.expandedCar === carId ? null : carId;
            if(this.expandedCar){
                this.fetchServices();
            }
        },
        formatDate(date) {
            return moment(date).format("YYYY-MM-DD HH:mm");
        },
        validateInput() {
            this.filterError = '';
            if (this.filter.name && this.filter.cardNumber) {
                this.filterError = "Csak az egyik mezőt töltheted ki!";
                return;
            }
            if (this.filter.cardNumber && !/^[a-zA-Z0-9]*$/.test(this.filter.cardNumber)) {
                this.filterError = "Az okmányazonosító csak betűket és számokat tartalmazhat!";
            }
        },
        applyFilter() {
            this.validateInput();

            if(!this.filterError){
                this.fetchClients();
            }
        },
    }
};
</script>

<style scoped>
.container {
    max-width: 700px;
    margin: 40px auto;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    color: #333;
}

.client-list {
    list-style: none;
    padding: 0;
}

.client-item {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    background: #fff;
    margin: 10px 0;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    cursor: pointer;
    transition: 0.3s;
}

.client-item:hover {
    background: #f1f1f1;
}

.client-id {
    font-weight: bold;
    color: #555;
}

.client-info {
    display: flex;
    flex-direction: column;
}

.card-number {
    font-size: 0.9em;
    color: #777;
}

.car-list {
    list-style: none;
    margin-top: 10px;
    padding-left: 15px;
    border-left: 3px solid #007bff;
    background: #eef5ff;
    padding: 10px;
    border-radius: 5px;
}

.car-item {
    background: #e3f2fd;
    padding: 10px;
    margin: 5px 0;
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.no-cars {
    color: #888;
    font-style: italic;
}

.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 15px;
    margin-top: 20px;
}

button {
    padding: 8px 12px;
    border: none;
    background: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #0056b3;
}

button:disabled {
    background: #ccc;
    cursor: not-allowed;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

th, td {
    padding: 8px;
    border: 1px solid #ddd;
    text-align: left;
}

th {
    background-color: #f4f4f4;
}

.filter-container {
    display: flex;
    gap: 10px;
    margin-bottom: 15px;
    align-items: center;
}

.filter-container input {
    flex: 1;
    padding: 10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.filter-container input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    outline: none;
}

.filter-container button {
    padding: 10px 15px;
    font-size: 16px;
}
</style>
