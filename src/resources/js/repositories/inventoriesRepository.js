import Repository from './repository'

const resource = 'inventory'
export default {
  createInventory(payload) {
    return Repository.post(`${resource}`, payload)
  },
  destroyInventory(id) {
    return Repository.delete(`${resource}/${id}`)
  },
  getInProduct(page = 1, product) {
    return Repository.get(`${resource}/product/${product}/in?page=${page}`)
  },
}
