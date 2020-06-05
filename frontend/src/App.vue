<template>
  <div id="app">
    <form>
      <input type="text" placeholder="Nova url" v-model="linkValue" />
      <input type="button" value="Adicionar" @click="add" />
    </form>
    <link-list v-bind:links="links"></link-list>
  </div>
</template>

<script>
import LinkList from "./components/LinkList.vue";

export default {
  name: "App",
  components: {
    LinkList
  },
  data() {
    return {
      links: [],
      linkValue: ""
    };
  },
  created() {
    this.reload();
  },
  methods: {
    reload() {
      fetch("/api/v1/links")
        .then(response => response.json())
        .then(data => (this.links = data));
    },
    add() {
      let that = this;
      let body = new FormData();
      body.append("url", this.linkValue);

      fetch("/api/v1/links", {
        method: "POST",
        body
      }).then(response => response.json())
      .then(function() {
        setTimeout(function() {
          that.reload();
        }, 1000);
      });

      this.linkValue = "";
    }
  }
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 60px;
}
</style>
