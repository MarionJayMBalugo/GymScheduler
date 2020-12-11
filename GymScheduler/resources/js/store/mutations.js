let mutations = {
  initiateUser(state, user) {
    state.user = user;
  },
  state_loading(state, payload) {
      state.isLoading = payload;
  },
  add_schedule(state, data) {
    state.schedules.push(data);
  },
  set_schedule(state, data) {
    state.schedules = data;
  },
  set_schedules_for_edit(state, data) {
    state.schedules_for_edit = data;
  },
  edit_schedule(state, data) {
    state.schedules_for_edit = data;
    // state.schedules = state.schedules.map(function(el) {
    //   return el;
    // });
  },
}
export default mutations