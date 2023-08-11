<template>
  <div>
    <div class="container">
      <div class="card custom-bg w-75 p-4 d-flex">
        <div class="row">
          <div class="pb-3 h3 text-left">Flight Search &#128747;</div>
        </div>
        <form id="flight-form" >
          <div class="invalid-feedback">
            
          </div>
          <div class="row">
            <div class="form-group col-md align-items-start flex-column">
              <label for="origin" class="d-inline-flex">From</label>
              <input type="text" placeholder="City or Airport" class="form-control" id="origin" name="origin" required>
            </div>
            <div class="form-group col-md align-items-start flex-column">
              <label for="depart" class="d-inline-flex">To</label>
              <input type="text" placeholder="City or Airport" class="form-control" id="depart" name="depart" required>
            </div>
          </div>
          <div class="row">
            <div class="form-group col-md align-items-start flex-column">
              <label for="departure-date" class=" d-inline-flex">Depart</label>
              <input type="date" class="form-control" id="departure-date" name="departure-date" onkeydown="return false"
                required>
            </div>
          </div>
          <div class="row">
          </div>
          <div class="row">
            <div class="form-group col-lg-6 align-items-start flex-column">
              <label for="cabin" class="d-inline-flex">Cabin</label>
              <select class="form-select" id="cabin">
                <option value="ECONOMY">Economy</option>
                <option value="PREMIUM_ECONOMY">Business</option>
              </select>
            </div>
          </div>
          <div class="row">
            <div class="text-left col-auto">
              <button type="submit" class="btn btn-primary">Search flights</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- <table id="customers" v-if="!loading">
      <tr>
        <th>Flight Number</th>
        <th>Departure</th>
        <th>Destination</th>
        <th>Departure time</th>
        <th></th>
      </tr>

      <tr v-for="flight in flights">
        <td>{{ flight.flight_number }}</td>
        <td>{{ flight.departure }}</td>
        <td>{{ flight.destination }}</td>
        <td>{{ flight.departure_time }}</td>
        <td><button @click="">Get Detail</button></td>
      </tr>
    </table>
    <br> -->

  </div>
</template>

<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td,
#customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even) {
  background-color: #f2f2f2;
}

#customers tr:hover {
  background-color: #ddd;
}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}

@media (min-width: 1024px) {
  .about {
    min-height: 100vh;
    display: flex;
    align-items: center;
  }
}
</style>


<script>
import axios from 'axios'
export default {
  data() {
    return {
      error: null,
      loginState: true,
      form: {
        userName: '',
        password: '',
        confirmPassword: ''
      },
      url: 'http://localhost:8000',
      table: {},
      loading: false,
      flights: {},
      airlines: {}
    }
  },
  created() {

    this.getTable();

  },
  methods: {
    getTable: function () {

      this.loading = true;
      axios.get('http://localhost:8000/info/all')
        .then(response => {
          console.log('Response:', response.data);
          this.flights = response.data.airlines[1];
          this.airlines = response.data.airlines[0];
          console.log(response.data);
          this.loading = false;
        })
        .catch(error => {
          console.error('Error:', error);
          this.loading = false;
        });
    },
    getDetail: function () {
      this.loading = true;
      axios.get('http://localhost:8000/info/all')
        .then(response => {
          console.log('Response:', response.data);
          this.flights = response.data.airlines[1];
          this.airlines = response.data.airlines[0];
          console.log(response.data);
          this.loading = false;
        })
        .catch(error => {
          console.error('Error:', error);
          this.loading = false;
        });
    },
    searchFlightInformation: function () {

    }
  }
}
</script>