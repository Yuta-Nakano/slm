import Repository from './repository'

const resource = 'branch'
export default {
  get(page = 1, searchCond = '') {
    return Repository.get(`${resource}?search_cond=${searchCond}&page=${page}`)
  },
  getBranch(id) {
    return Repository.get(`${resource}/${id}`)
  },
  createBranch(payload) {
    return Repository.post(`${resource}`, payload)
  },
  updateBranch(id, payload) {
    return Repository.patch(`${resource}/${id}`, payload)
  },
  destroyBranch(id) {
    return Repository.delete(`${resource}/${id}`)
  },
}
