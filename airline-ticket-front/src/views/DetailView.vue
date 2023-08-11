<template>
  <div>
    <div class="container">
      <div v-if="loading">
        <h1>Đang load thông tin</h1>
      </div>
      <div v-else="loading">
        <div v-if="info && info.length > 0">
          <h1>Hãng máy bay: {{ info.airline.name }}</h1>
          <p>Điểm xuất phát: {{ info.departure }}</p>
          <p>Điểm đến: {{ info.destination }}</p>
          <p>Loại vé: {{ seatType }}</p>
          <p>Thời gian khởi hành: {{ info.departure_time }}</p>
          <p>Số chuyến bay: {{ info.flight_number }}</p>
          <p>Gía vé: {{ info.seat_types[0].pivot.price }}</p>
          <ul> Các loại thuế phí liên quan
            <li v-for="fee in info.extra_fees">
              {{ fee.category }} - {{ fee.price }}
            </li>
          </ul>
          <p>Tổng tiền: {{
            info.extra_fees.reduce((total, currentValue) => {
              return total + parseFloat(currentValue.price)
            }, parseFloat(info.seat_types[0].pivot.price))
          }}</p>
          <ul> Phí mua thêm cân cho hàng ký gửi.
            <li v-for="fee in info.airline.extra_weight_fee">
              {{ fee.category }} - {{ fee.pivot.price }}
            </li>
          </ul>
        </div>
        <div v-else>
          <h1>Không có thông tin</h1>
          
        </div>
      </div>



    </div>
  </div>
</template>
  
<style></style>
  
  
<script>

import axios from 'axios'
export default {
  data() {
    return {
      id: this.$route.params.id,
      seatType: this.$route.params.seatType,
      info: [],
      loading: false,
    }
  },
  created() {
    this.getDetail();
  },
  methods: {

    getDetail: function () {
      this.loading = true;
      const headers = {
        'Content-Type': 'multipart/form-data',
      }
      const formData = new FormData();
      formData.append('id', this.id);
      formData.append('seatType', this.seatType);
      axios.post('http://localhost:8000/info/detail', formData, { headers })
        .then(response => {
          this.info = response.data.info[0];
          this.loading = false
        })
        .catch(error => {
          console.error('Error:', error);
          this.loading = false;
        });
    },

  }
}
</script>