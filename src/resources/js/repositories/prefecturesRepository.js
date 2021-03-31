import Repository from './repository'

const resource = 'prefecture'
export default {
  get() {
    return Repository.get(`${resource}`)
  },
}
