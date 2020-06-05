<template>
  <div>
    <h3>Links</h3>
    <ul>
      <li v-for="link in links" :key="link.id">
        <Link v-bind:link="link" />
      </li>
    </ul>
  </div>
</template>

<script>
import Link from "./Link.vue";

export default {
  name: "LinkList",
  components: {
    Link
  },
  props: {
    links: Array
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  margin: 10px 10px;
}
</style>
