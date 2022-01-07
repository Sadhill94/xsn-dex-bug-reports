import Vue from 'vue';
import Fuse from 'fuse.js';

const defaultOptions = {
  // includeScore: true,
  threshold: 0.4,
  keys: [
    'id',
    'description',
    'os',
    // 'version',
    'category.name',
    'type.name',
    'status.name',
  ],
};

const FuseSetup = {
  install(Vue) {
    Vue.prototype.$searchItems = function (
      items,
      searchInput,
      options = defaultOptions
    ) {
      const fuse = new Fuse(items, options);
      const results = fuse.search(searchInput);
      return results.map((x) => x.item);
    };
  },
};

Vue.use(FuseSetup);
