<template>
    <v-main>
      <v-container>
        <v-row>
          <v-col md="6">
           <h2><router-link to='/schedule/view' style="color:#000080">prev</router-link></h2>
          </v-col>
        </v-row>
        <v-row>
          <v-row justify="center"><h3>{{!id ? 'Add new Schedule' : 'Update Schedule ' }}</h3></v-row>
          <v-col md="12">
            <div  v-if="!isValid">
              <span style="color:red">
                all fields are required!
              </span>
            </div>
            <v-form ref="form" >
              <v-row>
                 <v-menu
                  :close-on-content-click="true"
                  transition="scale-transition"
                  offset-y
                  min-width="290px"
                  >
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field
                      v-model="scheduled_date"
                      label="Schedule Date*"
                      readonly
                      v-bind="attrs"
                      v-on="on"
                      color="primary"
                    ></v-text-field>
                  </template>
                  <v-date-picker
                    v-model="scheduled_date"
                    no-title
                    scrollable
                    color="primary"
                  ></v-date-picker>
                </v-menu>
              </v-row>
              <v-row>
                  <v-text-field v-model="renter_name" label="Name of Renter*">
                  </v-text-field>
              </v-row>
              <v-row>
                <v-select
                  v-model="selectedPurpose"
                  :items="purposesList"
                  item-text="name"
                  placeholder="Purpose*"
                  item-value="id"
                />
              </v-row>
              <v-row class="pa-0">
                <v-col  class="pl-0" md="6">
                  <v-btn  color="red" class="white--text" @click="back()" style="width:100%">
                   Cancel
                  </v-btn>
                </v-col>
                <v-col  class="pr-0" md="6">
                  <v-btn color="#000080" class="white--text" style="width:100%" @click="!id ? add() :  update()">{{ !id ? 'Add' : 'Update' }} </v-btn>
                </v-col>
              </v-row>
            </v-form>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
</template>

<script>
    import { mapGetters } from "vuex";
    export default {
      name: 'ScheduleAdd',
      mounted() {
        this.fetchPurposesList();
        this.user_info = this.$store.getters.user;
        if(this.id != null) {
          this.$store.dispatch('get_schedule_by_id',this.id);
        }
      },
      data: function() {
        return {
          purposesList: [],
          selectedPurpose: null,
          renter_name: null,
          scheduled_date: null,
          isValid: true,
          user_info: null,
          dfd:'ddd'
        };
      },
      props: ['id'],
      methods: {
        fetchPurposesList() {
          this.$axios.get('/purposes').then( resp => {
            this.purposesList = resp.data.map(el => {
              return {
                id: el.id,
                name: el.name,
                color: el.color
              }
            });
          }).catch(err => {});
        },
        add() {
          this.isValid = this.selectedPurpose != null && this.renter_name != null && this.scheduled_date != null ? true : false;
          if(this.isValid) {
              var params = {
                user_id: this.user_info.id,
                date: this.scheduled_date,
                purpose_id: this.selectedPurpose,
                renter: this.renter_name
              }
              this.$store.dispatch('add_schedule', params).then(() => {
                this.$router.push({name: 'view'});
              });
          }
        },
        update() {
          this.isValid = this.selectedPurpose != null && this.renter_name != null && this.scheduled_date != null ? true : false;
          if(this.isValid) {
             var params = {
                user_id: this.user_info.id,
                date: this.scheduled_date,
                purpose_id: this.selectedPurpose,
                renter: this.renter_name
              }
              this.$store.dispatch('edit_schedule', {id: this.id, data:params}).then(() => {
                this.$router.push({name: 'view'});
              });
          }
        },
        back() {
          this.$router.push({name: 'view'});
        }
      },
      computed: {
          ...mapGetters(["user", 'schedules_for_edit'])
      },
      watch: {
        user:function(val) {
          this.user_info = val;
        },
        schedules_for_edit:function( val) {
          this.scheduled_date = val.date,
          this.selectedPurpose = val.purpose,
          this.renter_name = val.renter
        }
      }
    }
</script>
