import Repository from './repository'

const resource = 'stock'
export default {
  createStock(payload) {
    return Repository.post(`${resource}`, payload)
  },
  getHistory(page = 1, branch, product) {
    return Repository.get(
      `${resource}/branch/${branch}/product/${product}/history?page=${page}`
    )
  },
}
