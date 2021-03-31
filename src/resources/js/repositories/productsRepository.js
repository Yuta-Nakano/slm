import Repository from './repository'

const resource = 'product'
export default {
  get(page = 1, searchCond = '') {
    return Repository.get(`${resource}?search_cond=${searchCond}&page=${page}`)
  },
  getProduct(id) {
    return Repository.get(`${resource}/${id}`)
  },
  createProduct(payload) {
    return Repository.post(`${resource}`, payload)
  },
  updateProduct(id, payload) {
    return Repository.patch(`${resource}/${id}`, payload)
  },
  destroyProduct(id) {
    return Repository.delete(`${resource}/${id}`)
  },
}
