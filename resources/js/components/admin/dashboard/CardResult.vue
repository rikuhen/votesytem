<template>
  <div class="card comp-card">
    <div class="card-body">
      <div class="row align-items-center">
        <div class="col">
          <h6 class="m-b-25">{{name}}</h6>
          <h3 class="f-w-700 text-c-blue">{{count}}</h3>
        </div>
        <div class="col-auto bg-c-blue rounded" v-if="place">
          <h6 class="text-center align-middle m-0 p-2 text-white font-weight-bolder">{{place}}</h6>
        </div>
        <div class="col-auto" v-if="icon">
          <feather :type="icon" class="text-c-red f-18"></feather>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardResult",
  props: {
    name: {
      type: String,
      default: ""
    },
    count: {
      type: String,
      default: ""
    },
    place: {
      type: Number,
      default: 0
    },
    icon: {
      type: String,
      default: ""
    }
  }
};
</script>

<style>
</style>
