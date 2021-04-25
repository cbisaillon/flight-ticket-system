<template>
  <div>
    <form method="GET" :action="resultEndpoint">
      <div>
        <label class="form-label">Origin*</label>
        <select name="origin" v-model="originId" required class="form-control">
          <option
              v-for="airport in origins"
              :key="airport.id"
              :value="airport.id"
          >
            {{ airport.country_code }} - {{ airport.region_code }} ({{ airport.code }})
          </option>
        </select>
      </div>

      <div>
        <label class="form-label">Destination*</label>
        <select name="destination" v-model="destinationId" required class="form-control">
          <option
              v-for="airport in destinations"
              :key="airport.id"
              :value="airport.id"
          >
            {{ airport.country_code }} - {{ airport.region_code }} ({{ airport.code }})
          </option>
        </select>
      </div>

      <div class="row">
        <div class="col-md-6">
          <div>
            <label class="form-label">Departure Date*</label>
            <input type="date" name="departure_date" required class="form-control"/>
          </div>
        </div>
        <div class="col-md-6">
          <div>
            <label class="form-label">Return Date</label>
            <input type="date" name="return_date" class="form-control"/>
          </div>
        </div>
      </div>

      <button class="btn btn-success mt-2">Find tickets !</button>
    </form>
  </div>

</template>

<script>
export default {
  name: "TripPlannerForm",
  props: {
    resultEndpoint: {
      type: String,
      required: true
    },
    airports: {
      type: Array,
      required: true
    }
  },
  data: function(){
    return {
      originId: null,
      destinationId: null
    }
  },
  computed: {
    origins: function() {
      return this.airports;
    },
    destinations: function() {
      // Can't fly from and to the same airport !!
      return this.airports.filter((airport) => airport.id !== this.originId)
    }
  }
}
</script>

<style scoped>

</style>
