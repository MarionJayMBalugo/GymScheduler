let getters = {
  user: state => {
      return state.user
  },
  schedules: state => {
    return state.schedules
},
schedules_for_edit: state => {
    return state.schedules_for_edit
},
}
export default getters