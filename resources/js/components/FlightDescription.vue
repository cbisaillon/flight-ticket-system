<template>
  <div>
    <table>
      <!-- From -->
      <tr>
        <td>{{ flight.departure_date }}</td>
        <td><b>{{ flight.origin_airport.city }} ({{ flight.origin_airport.code }})</b></td>
      </tr>
      <!-- To -->
      <tr>
        <td>{{ flight.arrival_date }}</td>
        <td><b>{{ flight.arrival_airport.city }} ({{ flight.arrival_airport.code }})</b></td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
name: "FlightDescription",
  props: {
    flight: {
      type: Object,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
