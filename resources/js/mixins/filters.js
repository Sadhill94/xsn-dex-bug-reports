import { formatDate } from '@/helpers/date';

export const FiltersMixin = {
  filters: {
    humanizeDate(value) {
      return formatDate(value, 'DD MMM YYYY');
    },
    removeExtensionIfExist(value) {
      const values = value.split('.');
      if (values.length > 1) {
        return values[0];
      } else {
        return value;
      }
    },
  },
};
