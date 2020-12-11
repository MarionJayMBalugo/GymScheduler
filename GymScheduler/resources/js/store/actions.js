
let actions = {
    add_schedule({commit}, payload) {
        axios.post('/schedule/add', payload).then(res => {
            commit('add_schedule', res.data);
        }).catch(err => {
            console.log(err)
        })
    },
    get_by_user_schedule({commit}, payload) {
        axios.get('/schedule/' + payload).then(res => {
            commit('set_schedule', res.data);
        }).catch(err => {
            console.log(err)
        })
    },
    get_schedule_by_id({commit}, payload) {
        axios.get('/schedule/edit/' + payload).then(res => {
            commit('set_schedules_for_edit', res.data);
        }).catch(err => {
            console.log(err)
        })
    },
    edit_schedule({commit}, payload) {
        axios.post('/schedule/edit/' + payload.id, payload.data).then(res => {
            commit('edit_schedule', res.data);
        }).catch(err => {
            console.log(err)
        })
    },
}
export default actions