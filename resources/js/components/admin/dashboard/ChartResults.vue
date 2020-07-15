<template>
  <div class="card sale-card">
    <div class="card-header">
      <h5>{{labelDataSet}}</h5>
    </div>
    <div class="card-block">
      <canvas id="domChartJs" ref="domChartJs"></canvas>
    </div>
  </div>
</template>
<script>
import Chart from "chart.js";

export default {
  name: "ChartResults",
  props: {
    chtype: {
      type: String,
      default: "bar"
    },
    labels: {
      type: Array,
      default: () => []
    },
    data: {
      type: Array,
      default: () => []
    },
    labelDataSet: {
      type: String,
      default: ""
    }
  },
  methods: {
    getRandomColors() {
      let min = 0;
      let max = 255;
      return Math.floor(Math.random() * (max - min + 1) + min);
    },
    renderChart() {
      const chart = new Chart(this.$refs.domChartJs, {
        type: this.$props.chtype,
        data: {
          labels: this.$props.labels,
          datasets: [
            {
              label: this.$props.labelDataSet,
              data: this.$props.data,
              fill: false,
              backgroundColor: [
                "rgba(255, 99, 132, 0.2)",
                "rgba(255, 159, 64, 0.2)",
                "rgba(255, 205, 86, 0.2)"
              ],
              borderColor: [
                "rgb(255, 99, 132)",
                "rgb(255, 159, 64)",
                "rgb(255, 205, 86)"
              ],
              borderWidth: 1
            }
          ]
        },
        options: { scales: { yAxes: [{ ticks: { beginAtZero: true } }] } }
      });
    }
  },
  mounted() {
    this.renderChart();
  }
};
</script>
