<template>
  <a :href="link.url">{{ link.title }}</a>
</template>

<script>
export default {
  name: "Link",
  props: {
    link: Object
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
a {
  color: #9d3fc2;
}
</style>
