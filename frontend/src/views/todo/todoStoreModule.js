import axios from '@axios'

export default {
  namespaced: true,
  state: {},
  getters: {},
  mutations: {},
  actions: {
    fetchTasks(ctx, payload) {
      return new Promise((resolve, reject) => {
        axios
          .get('/api/tasks',  { params: payload })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
    addTask(ctx, taskData) {
      return new Promise((resolve, reject) => {
        axios
          .post('/api/addtask', { task: taskData })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },


    updateTask(ctx, { task }) {
      return new Promise((resolve, reject) => {
        axios
          .post(`/api/updatetask/${task.id}`, { task })
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },




    removeTask(ctx, { id }) {
      return new Promise((resolve, reject) => {
        axios
          .post(`/api/deletetask/${id}`)
          .then(response => resolve(response))
          .catch(error => reject(error))
      })
    },
  },
}
