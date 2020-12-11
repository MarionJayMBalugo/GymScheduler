<template>
      <v-app>
        <v-app-bar dark fixed app>
         <v-toolbar-title class="mr-auto">GYM SCHEDULER</v-toolbar-title>
        <v-toolbar-title class="ml-auto">
          <v-btn @click="logout()"> log out</v-btn>
        </v-toolbar-title>
      </v-app-bar>
        <router-view></router-view>
        <Confirmation
          ref="confirms"
          :title="confirmationTitle"
          :message="confirmationMessage"
          @onConfirm="confirm($event)"
        ></Confirmation>
      </v-app>
</template>
<script>
    import Confirmation from "./components/Modals/Confirm.vue";
    import { mapGetters } from "vuex";
    export default {
      name: 'dashboard',
      data:function() {
        return {
          confirmationTitle: null,
          confirmationMessage: null
        }
      },
      props: ['user'],
      components: {
        Confirmation
      },
      created() {
        this.$store.commit('initiateUser',this.user);
        this.$store.dispatch('get_by_user_schedule', this.user.id);
      },
      methods: {
        confirm(){
          if(this.confirmationTitle == 'Log Out' ) {
            this.$axios
            .post(
              "logout")
            .then(response => {
              location.reload();
              window.location.replace("/");
            })
          }
        },
        logout() {
          this.confirmationTitle='Log Out'
          this.confirmationMessage = 'Are you sure you want to Logout?'
          this.$refs.confirms.show();
        }
      }
    }
</script>
