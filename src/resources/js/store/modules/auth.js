import {
  AUTH_REQUEST,
  AUTH_ERROR,
  AUTH_SUCCESS,
  AUTH_LOGOUT,
} from '../actions/auth'
import { USER_REQUEST } from '../actions/user'

const state = () => ({
  status: '',
  // token: '',
  hasLoadedOnce: false,
})

const mutations = {
  [AUTH_REQUEST]: state => {
    state.status = 'loading'
  },
  [AUTH_SUCCESS]: (state, data) => {
    state.status = 'success'
    state.hasLoadedOnce = true
    //  state.token = data.token
  },
  [AUTH_ERROR]: state => {
    state.status = 'error'
    state.hasLoadedOnce = true
  },
  [AUTH_LOGOUT]: state => {
    //  state.token = '
  },
}

const actions = {
  [AUTH_REQUEST]: async ({ commit, dispatch }, auth) => {
    commit(AUTH_REQUEST)
    await axios.get('/sanctum/csrf-cookie')
    await axios
      .post('/api/login', auth)
      .then(async ({ data }) => {
        commit(AUTH_SUCCESS, data)
        await dispatch(USER_REQUEST)
      })
      .catch(err => {
        commit(AUTH_ERROR, err)
      })
  },
  [AUTH_LOGOUT]: async ({ commit }) => {
    commit(AUTH_LOGOUT)
    await axios
      .get('/api/logout')
      .then(({ data }) => {
        commit(USER_REQUEST)
      })
      .catch(err => {
        commit(AUTH_ERROR, err)
      })
  },
}

const getters = {
  // isAuthenticated: state => !!state.token,
  // authStatus: state => state.status,
}

export default {
  state,
  mutations,
  actions,
  getters,
}
