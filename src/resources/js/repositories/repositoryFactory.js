import PrefecturesRepository from './prefecturesRepository'
import BranchesRepository from './branchesRepository'
import ProductsRepository from './productsRepository'
import InventoriesRepository from './inventoriesRepository'
import StocksRepository from './stocksRepository'

const repositories = {
  prefectures: PrefecturesRepository,
  branches: BranchesRepository,
  products: ProductsRepository,
  inventories: InventoriesRepository,
  stocks: StocksRepository,
}

export const RepositoryFactory = {
  get: name => repositories[name],
}
