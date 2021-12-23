import moment from 'moment';

export const formatDate = (value, format = 'DD MMM - YYYY') => {
  return value ? moment(value).format(format) : '';
};
