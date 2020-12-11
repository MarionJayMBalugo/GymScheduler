<template>
    <v-main>
      <v-container>
        <v-row>
          <v-col md="6">
            <v-btn style="background-color:#000080" class="white--text"  @click="addRedirect()">add schedule</v-btn>
          </v-col>
        </v-row>
        <v-row >
            <v-col md="12">
            <v-data-table :headers="scheduleHead" :items="schedule" class="elevation-3">
              <template v-slot:item.actions="{ item }">
                <v-btn @click="updateSchedule(item)" color="#000080" style="color:white">Update</v-btn>              
                <v-btn @click="deleteItem(item)" color="red" style="color:white">Delete</v-btn>
              </template>
            </v-data-table></v-col>
        </v-row>
        <v-row class="fill-height">
          <v-col>
            <v-sheet height="64">
              <v-toolbar flat>
                <v-btn outlined class="mr-4" color="grey darken-2" @click="setToday">Today</v-btn>
                <v-btn fab text small color="grey darken-2" @click="prev">
                  <v-icon small>mdi-chevron-left</v-icon>
                </v-btn>
                <v-btn fab text small color="grey darken-2" @click="next">
                  <v-icon small>mdi-chevron-right</v-icon>
                </v-btn>

                <!-- <v-toolbar-title v-if="$refs.calendar">{{ $refs.calendar.title }}</v-toolbar-title> -->
                <v-spacer></v-spacer>
                <v-menu bottom right>
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn outlined color="grey darken-2" v-bind="attrs" v-on="on">
                      <span>{{ typeToLabel[type] }}</span>
                      <v-icon right>mdi-menu-down</v-icon>
                    </v-btn>
                  </template>
                  <v-list>
                    <v-list-item @click="type = 'day'">
                      <v-list-item-title>Day</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="type = 'week'">
                      <v-list-item-title>Week</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="type = 'month'">
                      <v-list-item-title>Month</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="type = '4day'">
                      <v-list-item-title>4 days</v-list-item-title>
                    </v-list-item>
                  </v-list>
                </v-menu>
              </v-toolbar>
            </v-sheet>
            <v-sheet height="600">
              <v-calendar
                ref="calendar"
                id="calendar"
                @click:event="showEvent"
                v-model="focus"
                color="primary"
                :events="events"
                :type="type"
                :now="today"
                eventOverlap: false
                :event-color="getEventColor"
                :event-text-color="getProperColor"
                @click:more="viewDay"
                @click:date="viewDay"
              >
              </v-calendar>
            </v-sheet>
          </v-col>
        </v-row>
      </v-container>
    </v-main>
</template>

<script>
    import { mapGetters } from "vuex";
    export default {
      name: 'ScheduleView',
      mounted() {
        this.$refs.calendar.checkChange();
        this.schedule = this.$store.getters.schedules;
        // this.events = this.schedule;
      },
      data: function() {
        return {
          scheduleHead:[
            { text: "DATE", align: "center", value: "date" },
            { text: "RENTER", align: "center",value: "renter" },
            { text: "PURPOSE", align: "center",value: "purpose.name" },
            { text: "ACTIONS",align: "center", value: "actions", sortable: false } 
          ],
          schedule: [],
          focus:  new Date().toISOString().substr(0,10),
          events: [],
          type: "month",
          typeToLabel: {
            month: "Month",
            week: "Week",
            day: "Day",
            "4day": "4 Days"
          },
          selectedEvent: {},
          selectedElement: null,
          selectedOpen: false,
          today: new Date().toISOString().substr(0,10),
        }
      },
      methods: {
        showEvent({ nativeEvent, event }) {
          const open = () => {
            this.selectedEvent = event;
            this.selectedElement = nativeEvent.target;
            setTimeout(() => {
              this.selectedOpen = true;
            }, 10);
          };
          if (this.selectedOpen) {
            this.selectedOpen = false;
            setTimeout(open, 10);
          } else {
            open();
          }
          nativeEvent.stopPropagation();  
        },
        viewDay({ date }) {
          this.focus = date;
          this.type = "day";
        },
        updateRange(e) {
          console.log('events', this.events)
          const events = [];
          for (let i = 0; i < this.events.length; i++) {
              events.push({
              user_id: this.events[i].user_id,
              name: this.events[i].name,
              start: this.events[i].date,
              end: this.events[i].date,
              color: this.events[i].color
            });
          }
          this.events = events;
        },
        setToday() {
          this.focus = "";
        },
        prev() {
          this.$refs.calendar.prev();
        },
        next() { 
          this.$refs.calendar.next();
        },
         addRedirect() {
          this.$router.push({name: 'add'});
        },
        updateSchedule(item) {
          this.$router.push({name: 'edit', params: { id: item.id}});
        },
        deleteItem(item) {
          this.$axios.delete('/schedule/' + item.id).then((res)=>{
            this.$store.dispatch('get_by_user_schedule', this.$store.getters.user.id);
          });
        },
        getEventColor(event) {
          return event.color;
        },
        getProperColor(event) {
          var bright = this.isBright(event.color);
          return bright ? 'black': 'white';
        },
        isBright(color) {
        
        },
      },
      computed: {
          ...mapGetters(["schedules"])
      },
      watch: {
        schedules:function(val) {
          console.log(val);
          this.schedule = val;
          var events = [];
           for (let i = 0; i < this.schedule.length; i++) {
              events.push({
              user_id: this.schedule[i].user_id,
              name: this.schedule[i].renter,
              start: this.schedule[i].date,
              end: this.schedule[i].date,
              color: this.schedule[i].purpose.color
            });
          }
          this.events = events;
        }
      }
    }
</script>
