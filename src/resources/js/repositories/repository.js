import axios from 'axios'
// axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest'
// axios.defaults.withCredentials = true

const baseDomain = process.env.MIX_API_URL || ''
const baseURL = `${baseDomain}/api`

export default axios.create({
  baseURL,
})
