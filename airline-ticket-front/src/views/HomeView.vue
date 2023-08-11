<script>
import router from '../router';
import axios from 'axios'
export default {
  data() {
    return {
      loginState: true,
      searchForm: {
        seatType: 'Any',
        depature: '',
        destination: '',
        departureTime: '',
      },
      errors: {},
      flights: {},
      ticketResult: {},
      JSONToken: window.localStorage.getItem('token'),
    }
  },
  methods: {
    getDetail: function (id, seatType) {
      if (this.JSONToken) {
        router.push({ name: 'detail', params: { id: id, seatType: seatType } })
      } else {
        router.push({ name: 'login' })
      }
    },

    search: function (event) {
      event.preventDefault();
      let errorList = [];
      if (!this.searchForm.depature || this.searchForm.depature?.length == 0) {
        errorList.depature = "Mời bạn điền điểm khởi hành";

      }

      if (!this.searchForm.destination || this.searchForm.destination?.length == 0) {
        errorList.destination = "Mời bạn điền điểm hạ cánh";
        const arraylala = ["1", "2"]
        console.log(arraylala.length)
      }
      console.log(Object.keys(errorList).length);
      this.errors = errorList;

      if (Object.keys(errorList).length == 0) {
        console.log("true")
        const formData = new FormData();
        formData.append('departure', this.searchForm.depature);
        formData.append('destination', this.searchForm.destination);
        formData.append('departureTime', this.searchForm.departureTime);
        formData.append('seatType', this.searchForm.seatType);
      
        const headers = {
          'Content-Type': 'multipart/form-data',
          'Authorization': 'Bearer ' + window.localStorage.getItem('token')
        }
        this.loading = true;
        axios.post('http://localhost:8000/info/find', formData, { headers })
          .then(response => {
            this.flights = response.data.airlines;
            let result = [];
            console.log(this.flights);
            this.flights.forEach(flight => {

              flight.seat_types.forEach(seatType => {

                const ticket = {
                  id: flight.id,
                  airline: flight.airline.name,
                  seatType: seatType.name,
                  departureTime: flight.departure_time,
                  flightNumber: flight.flight_number,
                  ticketPrice: parseFloat(seatType.pivot.price),
                  totalFee: flight.extra_fees.reduce((total, currentValue) => {
                    return total + parseFloat(currentValue.price)
                  }, parseFloat(seatType.pivot.price))

                }
                result = [...result, ticket];


              });
            });
            console.log(result);
            this.ticketResult = result;
            this.loading = false;
          })
          .catch(error => {
            console.log(error);
            this.loading = false;
          });
      }

    }
  }
}
</script>

<template>
  <div class="container">
    <div class="card custom-bg  p-4 d-flex">
      <div class="row">
        <div class="pb-3 h3 text-left">Flight Search &#128747;</div>
      </div>
      <div v-if="Object.keys(errors).length > 0">
        <p class="text-danger">{{ errors.depature }}</p>
        <p class="text-danger">{{ errors.destination }}</p>
      </div>


      <form id="flight-form" onsubmit="return validateForm()">
        <div class="row">
          <div class="form-group col-md align-items-start flex-column">
            <label for="origin" class="d-inline-flex">From</label>
            <input type="text" placeholder="City or Airport" class="form-control" id="origin" name="origin"
              v-model="searchForm.depature" required>
          </div>
          <div class="form-group col-md align-items-start flex-column">
            <label for="depart" class="d-inline-flex">To</label>
            <input type="text" placeholder="City or Airport" class="form-control" id="depart" name="depart"
              v-model="searchForm.destination" required>
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md align-items-start flex-column">
            <label for="departure-date" class=" d-inline-flex">Depart</label>
            <input type="date" class="form-control" id="departure-date" name="departure-date"
              v-model="searchForm.departureTime" required>
          </div>
        </div>
        <div class="row">
        </div>
        <div class="row">
          <div class="form-group col-lg-6 align-items-start flex-column">
            <label for="seatType" class="d-inline-flex">Cabin</label>
            <select class="form-select" v-model="searchForm.seatType" name="seatType">
              <option selected value="Any">Any</option>
              <option value="Economic">Economic</option>
              <option value="Business">Business</option>
            </select>
          </div>
        </div>
        <div class="row">
          <div class="text-left col-auto">
            <button type="submit" @click="(event) => search(event)" class="btn btn-primary">Search flights</button>
          </div>
        </div>
      </form>

    </div>
    <div class="container">

      <table class="table">
        <caption class="text-center">Search Result</caption>
        <thead>
          <tr>
            <th scope="col">Airline(Hãng máy bay)</th>
            <th scope="col">Seat Type(Loại vé)</th>
            <th scope="col">Departure time(Khởi hành lúc)</th>
            <th scope="col">Flight Number(Mã chuyến bay)</th>
            <th scope="col">Ticket Price(Gía vé)</th>
            <th scope="col">Total money(Tổng số tiền)</th>
          </tr>
        </thead>
        <tbody v-if="ticketResult && ticketResult.length > 0">

          <tr v-for="ticket in ticketResult" @click="getDetail(ticket.id, ticket.seatType)">
            <td>{{ ticket.airline }}</td>
            <td>{{ ticket.seatType }}</td>
            <td>{{ ticket.departureTime }}</td>
            <td>{{ ticket.flightNumber }}</td>
            <td>{{ ticket.ticketPrice }}</td>
            <td v-if="JSONToken">{{ ticket.totalFee }}</td>
            <td v-else>Xin mời đăng nhập</td>
          </tr>

        </tbody>
        <tbody v-else>
          Không tìm thấy kết quả nào
        </tbody>
      </table>
    </div>
  </div>
</template>
