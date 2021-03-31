import Vue from 'vue'
import { USER_REQUEST, USER_ERROR, USER_SUCCESS } from '../actions/user'
import { AUTH_LOGOUT } from '../actions/auth'

const state = () => ({
  status: '',
  profile: {},
})

const mutations = {
  [USER_REQUEST]: state => {
    state.status = 'loading'
  },
  [USER_SUCCESS]: (state, data) => {
    state.status = 'success'
    Vue.set(state, 'profile', data)
  },
  [USER_ERROR]: state => {
    state.status = 'error'
  },
  [AUTH_LOGOUT]: state => {
    state.profile = {}
  },
}

const actions = {
  [USER_REQUEST]: async ({ commit, dispatch }) => {
    commit(USER_REQUEST)
    await axios
      .get('/api/user')
      .then(({ data }) => {
        if (data) {
          commit(USER_SUCCESS, data)
        }
      })
      .catch(() => {
        commit(USER_ERROR)
      })
  },
}

const getters = {
  getProfile: state => state.profile,
  isProfileLoaded: state => !!state.profile.name,
  isAuthenticated: state => state.status === 'success',
}

export default {
  state,
  mutations,
  actions,
  getters,
}
