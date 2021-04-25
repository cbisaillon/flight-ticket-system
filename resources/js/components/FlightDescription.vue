<template>
  <div>
    asdf
    <table>
      <!-- From -->
      <tr>
        <td>{{ flight.departure.departure_date }}</td>
        <td>{{ flight.departure.origin_airport.city }} ({{ flight.departure.origin_airport.code }})</td>
      </tr>
      <!-- To -->
      <tr>
        <td>{{ flight.departure.arrival_date }}</td>
        <td>{{ flight.departure.arrival_airport.city }} ({{ flight.departure.arrival_airport.code }})</td>
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
